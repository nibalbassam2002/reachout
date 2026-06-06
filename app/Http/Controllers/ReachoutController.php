<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReachoutController extends Controller
{
    // رقم الواتساب والإيميل الرسمي للمنظمة
    const WA_NUMBER    = '972568200088';
    const ORG_EMAIL    = 'info@mentalhealthfrontline.org';

    // ══════════════════════════════════════════════════
    //  1. حفظ طلب جديد
    //  POST /reachout/store
    // ══════════════════════════════════════════════════
    public function store(Request $request)
    {
        // ── التحقق من البيانات ──────────────────────
        $request->validate([
            'channel'           => 'required|in:whatsapp,email',
            'child_name'        => 'required|string|max:191',
            'child_age'         => 'required|integer|min:3|max:18',
            'child_gender'      => 'required|in:male,female,prefer_not',
            'child_grade'       => 'nullable|string|max:50',
            'guardian_name'     => 'required|string|max:191',
            'guardian_relation' => 'required|string|max:50',
            'guardian_phone'    => 'required|string|max:25',
            'symptoms'          => 'required|array|min:1',
            'extra_symptom'     => 'nullable|string|max:191',
            'impact_level'      => 'required|in:1,2,3',
            'notes'             => 'required|string|min:20',
        ]);

        // ── توليد الرقم المرجعي ─────────────────────
        $caseNumber = $this->generateCaseNumber();

        // ── تحديد الأولوية بناءً على مستوى التأثير ──
        $priority = match($request->impact_level) {
            '1' => 'low',
            '2' => 'medium',
            '3' => 'high',
            default => 'medium',
        };

        DB::beginTransaction();
        try {

            // ── 1. حفظ أو تحديث بيانات ولي الأمر ────
            $contact = DB::table('contacts')->where('identifier', $request->guardian_phone)->first();

            if ($contact) {
                // ولي الأمر موجود مسبقاً → نحدّث بياناته
                DB::table('contacts')->where('id', $contact->id)->update([
                    'display_name'      => $request->guardian_name,
                    'guardian_relation' => $request->guardian_relation,
                    'channel'           => $request->channel,
                    'country_code'      => $request->country_code ?? null,
                    'last_contact_at'   => now(),
                    'updated_at'        => now(),
                ]);
                $contactId = $contact->id;
            } else {
                // ولي أمر جديد → نُنشئ سجل جديد
                $contactId = DB::table('contacts')->insertGetId([
                    'identifier'        => $request->guardian_phone,
                    'channel'           => $request->channel,
                    'display_name'      => $request->guardian_name,
                    'guardian_relation' => $request->guardian_relation,
                    'country_code'      => $request->country_code ?? null,
                    'first_contact_at'  => now(),
                    'last_contact_at'   => now(),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            // ── 2. حفظ الحالة ─────────────────────────
            $caseId = DB::table('child_cases')->insertGetId([
                'case_number'    => $caseNumber,
                'contact_id'     => $contactId,
                'channel'        => $request->channel,
                'child_name'     => $request->child_name,
                'child_age'      => $request->child_age,
                'child_grade'    => $request->child_grade,
                'child_gender'   => $request->child_gender,
                'symptoms'       => json_encode($request->symptoms),
                'extra_symptom'  => $request->extra_symptom,
                'impact_level'   => $request->impact_level,
                'notes'          => $request->notes,
                'priority'       => $priority,
                'status'         => 'new',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // ── 3. توليد الرسالة النصية المنسقة ──────
            $message = $this->buildMessage($request, $caseNumber);

            // ── 4. توليد رابط التواصل ─────────────────
            $contactUrl = $request->channel === 'whatsapp'
                ? 'https://wa.me/' . self::WA_NUMBER . '?text=' . urlencode($message)
                : 'mailto:' . self::ORG_EMAIL
                    . '?subject=' . urlencode('New Case: ' . $caseNumber)
                    . '&body=' . urlencode($message);

            // ── 5. حفظ الرابط في الحالة ───────────────
            DB::table('child_cases')->where('id', $caseId)->update([
                'contact_url' => $contactUrl,
            ]);

            DB::commit();
            // ── الرد على الـ frontend ──────────────────
            return response()->json([
                'success'      => true,
                'ref_number'   => $caseNumber,
                'contact_url'  => $contactUrl,
                // للتوافق مع الـ popup
                'whatsapp_url' => $request->channel === 'whatsapp' ? $contactUrl : null,
                'mailto_url'   => $request->channel === 'email'    ? $contactUrl : null,
            ]);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'line'    => $e->getLine(),
                    'file'    => $e->getFile(),
                ], 500);
    }
    }

    // ══════════════════════════════════════════════════
    //  2. البحث عن حالة بالرقم المرجعي (للمتابعة)
    //  POST /reachout/lookup
    // ══════════════════════════════════════════════════
    public function lookup(Request $request)
    {
        $request->validate([
            'ref_number' => 'required|string',
        ]);

        // البحث عن الحالة مع بيانات ولي الأمر
        $case = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->where('child_cases.case_number', $request->ref_number)
            ->select(
                'child_cases.id',
                'child_cases.case_number',
                'child_cases.child_name',
                'child_cases.child_age',
                'child_cases.child_grade',
                'child_cases.child_gender',
                'child_cases.status',
                'contacts.display_name as guardian_name',
                'contacts.identifier as guardian_phone',
            )
            ->first();

        if (!$case) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'child' => [
                'id'     => $case->id,
                'name'   => $case->child_name,
                'age'    => $case->child_age,
                'grade'  => $case->child_grade,
                'gender' => $case->child_gender,
                'status' => $case->status,
            ],
        ]);
    }

    // ══════════════════════════════════════════════════
    //  3. حفظ متابعة على حالة موجودة
    //  POST /reachout/followup
    // ══════════════════════════════════════════════════
    public function followup(Request $request)
    {
        $request->validate([
            'ref_number' => 'required|string',
            'note'       => 'required|string|min:20',
        ]);

        // التحقق من وجود الحالة
        $case = DB::table('child_cases')
            ->where('case_number', $request->ref_number)
            ->first();

        if (!$case) {
            return response()->json(['success' => false, 'message' => 'Case not found.'], 404);
        }

        // حفظ المتابعة
        DB::table('child_case_followups')->insert([
            'child_case_id' => $case->id,
            'note'          => $request->note,
            'sent_via'      => $case->channel,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json(['success' => true]);
    }

    // ══════════════════════════════════════════════════
    //  Helper: توليد رقم مرجعي فريد
    // ══════════════════════════════════════════════════
    private function generateCaseNumber(): string
    {
        do {
            $number = 'MHF-' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (DB::table('child_cases')->where('case_number', $number)->exists());

        return $number;
    }

    // ══════════════════════════════════════════════════
    //  Helper: بناء الرسالة النصية المنسقة
    // ══════════════════════════════════════════════════
    private function buildMessage(Request $request, string $caseNumber): string
    {
        // ترجمة الأعراض
        $symptomLabels = [
            'sleep'         => 'Sleep Issues',
            'anxiety'       => 'Anxiety',
            'sadness'       => 'Sadness',
            'aggression'    => 'Aggression',
            'withdrawal'    => 'Withdrawal',
            'school'        => 'School Issues',
            'appetite'      => 'Appetite Change',
            'concentration' => 'Poor Focus',
        ];

        $symptomsText = collect($request->symptoms)
            ->map(fn($s) => $symptomLabels[$s] ?? $s)
            ->join(', ');

        if ($request->extra_symptom) {
            $symptomsText .= ', ' . $request->extra_symptom;
        }

        // ترجمة مستوى التأثير
        $impactText = match($request->impact_level) {
            '1' => 'Mild',
            '2' => 'Noticeable',
            '3' => 'Severe',
            default => '—',
        };

        // ترجمة الجنس
        $genderText = match($request->child_gender) {
            'male'       => 'Male',
            'female'     => 'Female',
            'prefer_not' => 'Not specified',
            default      => '—',
        };

        return
            "*Mental Health Frontline*\n" .
            " *Ref:* {$caseNumber}\n" .
            "──────────────────────\n" .
            " *Child:* {$request->child_name}\n" .
            " *Age:* {$request->child_age}" . ($request->child_grade ? " | {$request->child_grade}" : '') . "\n" .
            " *Gender:* {$genderText}\n" .
            "──────────────────────\n" .
            " *Guardian:* {$request->guardian_name} ({$request->guardian_relation})\n" .
            " *Phone:* {$request->guardian_phone}\n" .
            "──────────────────────\n" .
            " *Symptoms:* {$symptomsText}\n" .
            " *Impact:* {$impactText}\n" .
            "──────────────────────\n" .
            " *Details:*\n{$request->notes}";
    }
}
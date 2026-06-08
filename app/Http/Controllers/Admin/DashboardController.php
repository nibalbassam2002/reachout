<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\PolicyComplaint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ═══════════════════════════════════════════
    //  Dashboard Home
    // ═══════════════════════════════════════════
    public function index()
    {
        // ── Stat Cards ──
        $totalCases       = DB::table('child_cases')->count();
        $totalFollowups   = DB::table('child_case_followups')->count();
        $pendingCases     = DB::table('child_cases')->whereIn('status', ['new', 'assigned'])->count();
        $highPriority     = DB::table('child_cases')->whereIn('priority', ['high', 'crisis'])->count();
        $unreadComplaints = PolicyComplaint::unread()->count();
        $totalContacts    = DB::table('contacts')->count();

        // ── Recent Cases (last 5) ──
        $recentCases = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->select(
                'child_cases.id',
                'child_cases.case_number',
                'child_cases.child_name',
                'child_cases.child_age',
                'child_cases.status',
                'child_cases.priority',
                'child_cases.channel',
                'child_cases.created_at',
                'contacts.display_name as guardian_name'
            )
            ->orderBy('child_cases.created_at', 'desc')
            ->take(5)
            ->get();

        // ── Cases by Status ──
        $casesByStatus = DB::table('child_cases')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // ── Cases by Priority ──
        $casesByPriority = DB::table('child_cases')
            ->select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority');

        // ── Cases by Channel ──
        $casesByChannel = DB::table('child_cases')
            ->select('channel', DB::raw('count(*) as total'))
            ->groupBy('channel')
            ->pluck('total', 'channel');

        // ── Symptoms distribution ──
        $allSymptoms = DB::table('child_cases')
            ->whereNotNull('symptoms')
            ->pluck('symptoms');

        $symptomsCount = [];
        foreach ($allSymptoms as $raw) {
            $arr = json_decode($raw, true) ?: [];
            foreach ($arr as $s) {
                $symptomsCount[$s] = ($symptomsCount[$s] ?? 0) + 1;
            }
        }
        arsort($symptomsCount);
        $symptomsCount = array_slice($symptomsCount, 0, 6, true);

        // ── Cases last 7 days ──
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('d M');
            $count = DB::table('child_cases')
                ->whereDate('created_at', $date)
                ->count();
            $last7Days[] = ['label' => $label, 'count' => $count];
        }

        // ── Recent Activity (from activity_logs if exists, else fallback) ──
        $recentActivity = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalCases',
            'totalFollowups',
            'pendingCases',
            'highPriority',
            'unreadComplaints',
            'totalContacts',
            'recentCases',
            'casesByStatus',
            'casesByPriority',
            'casesByChannel',
            'symptomsCount',
            'last7Days',
            'recentActivity'
        ));
    }

    // ═══════════════════════════════════════════
    //  Bank Settings
    // ═══════════════════════════════════════════
    public function editBank()
    {
        $bank = BankAccount::first();
        return view('dashboard.admin.bank_settings', compact('bank'));
    }

    public function updateBank(Request $request)
    {
        $bank = BankAccount::first() ?? new BankAccount();
        $bank->fill($request->all());
        $bank->save();
        return back()->with('success', 'Bank details updated successfully!');
    }

    // ═══════════════════════════════════════════
    //  Cases — Index (with search + filters)
    // ═══════════════════════════════════════════
    public function cases(Request $request)
    {
        $unreadComplaints = PolicyComplaint::unread()->count();

        $query = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->select(
                'child_cases.id',
                'child_cases.case_number',
                'child_cases.child_name',
                'child_cases.child_age',
                'child_cases.child_grade',
                'child_cases.child_gender',
                'child_cases.channel',
                'child_cases.priority',
                'child_cases.status',
                'child_cases.impact_level',
                'child_cases.symptoms',
                'child_cases.created_at',
                'contacts.display_name as guardian_name',
                'contacts.identifier   as guardian_phone',
                'contacts.guardian_relation',
            );

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('child_cases.child_name', 'like', "%{$search}%")
                  ->orWhere('child_cases.case_number', 'like', "%{$search}%")
                  ->orWhere('contacts.display_name', 'like', "%{$search}%")
                  ->orWhere('contacts.identifier', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('child_cases.status', $status);
        }
        if ($priority = $request->input('priority')) {
            $query->where('child_cases.priority', $priority);
        }
        if ($channel = $request->input('channel')) {
            $query->where('child_cases.channel', $channel);
        }

        $query->orderByRaw("FIELD(child_cases.priority, 'crisis', 'high', 'medium', 'low')")
              ->orderByRaw("FIELD(child_cases.status, 'new', 'assigned', 'in_progress', 'resolved')")
              ->orderBy('child_cases.created_at', 'desc');

        $cases = $query->paginate(20)->withQueryString();

        return view('dashboard.admin.cases', compact('cases', 'unreadComplaints'));
    }

    // ═══════════════════════════════════════════
    //  Cases — Show Detail Page
    // ═══════════════════════════════════════════
    public function caseShow($id)
    {
        $case = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->where('child_cases.id', $id)
            ->select(
                'child_cases.*',
                'contacts.display_name as guardian_name',
                'contacts.identifier   as guardian_phone',
                'contacts.guardian_relation'
            )
            ->first();

        if (!$case) abort(404, 'Case not found');

        $followups = DB::table('child_case_followups')
            ->where('child_case_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($f) => [
                'note'       => $f->note,
                'created_at' => \Carbon\Carbon::parse($f->created_at)->format('M d, Y · h:i A'),
            ])
            ->toArray();

        $unreadComplaints = PolicyComplaint::unread()->count();

        return view('dashboard.admin.case-show', compact('case', 'followups', 'unreadComplaints'));
    }

    // ═══════════════════════════════════════════
    //  Cases — Update (AJAX from detail page)
    // ═══════════════════════════════════════════
    public function caseUpdate(Request $request, $id)
    {
        $request->validate([
            'status'        => 'required|in:new,assigned,in_progress,resolved,closed',
            'priority'      => 'required|in:low,medium,high,crisis',
            'doctor_note'   => 'nullable|string|max:3000',
            'doctor_rating' => 'nullable|integer|min:1|max:5',
        ]);

        DB::table('child_cases')->where('id', $id)->update([
            'status'        => $request->status,
            'priority'      => $request->priority,
            'doctor_note'   => $request->doctor_note,
            'doctor_rating' => $request->doctor_rating,
            'updated_at'    => now(),
        ]);

        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════
    //  Cases — Export CSV
    // ═══════════════════════════════════════════
    public function casesExport()
    {
        $cases = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->select(
                'child_cases.*',
                'contacts.display_name as guardian_name',
                'contacts.identifier   as guardian_phone',
                'contacts.guardian_relation'
            )
            ->orderBy('child_cases.created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="cases-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($cases) {
            $h = fopen('php://output', 'w');
            fputs($h, "\xEF\xBB\xBF");
            fputcsv($h, [
                'Ref', 'Child Name', 'Age', 'Grade', 'Gender',
                'Guardian', 'Relation', 'Phone', 'Channel',
                'Priority', 'Status', 'Impact', 'Doctor Rating',
                'Notes', 'Doctor Note', 'Date',
            ]);
            foreach ($cases as $c) {
                $symptomsArr = json_decode($c->symptoms ?? '[]', true) ?: [];
                fputcsv($h, [
                    $c->case_number,
                    $c->child_name,
                    $c->child_age,
                    $c->child_grade ?? '—',
                    $c->child_gender,
                    $c->guardian_name,
                    $c->guardian_relation,
                    $c->guardian_phone,
                    $c->channel,
                    $c->priority,
                    $c->status,
                    ['1'=>'Mild','2'=>'Noticeable','3'=>'Severe'][$c->impact_level] ?? $c->impact_level,
                    $c->doctor_rating ?? '—',
                    $c->notes,
                    $c->doctor_note ?? '—',
                    \Carbon\Carbon::parse($c->created_at)->format('Y-m-d H:i'),
                ]);
            }
            fclose($h);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function search(Request $request)
{
    $q = trim($request->get('q', ''));

    if (strlen($q) < 2) {
        return response()->json(['results' => []]);
    }

    $results = [];
    $like    = "%{$q}%";

    try {
        // 1. الحالات - بحث في الاسم، رقم الحالة، ورقم هاتف ولي الأمر
        $cases = DB::table('child_cases')
            ->join('contacts', 'child_cases.contact_id', '=', 'contacts.id')
            ->where(function($query) use ($like) {
                $query->where('child_cases.child_name', 'like', $like)
                      ->orWhere('child_cases.case_number', 'like', $like)
                      ->orWhere('contacts.identifier', 'like', $like); // رقم الجوال
            })
            ->select('child_cases.id', 'child_cases.child_name', 'child_cases.case_number', 'child_cases.status')
            ->limit(5)
            ->get();

        foreach ($cases as $c) {
            $results[] = [
                'type'     => 'case',
                'icon'     => 'bi-folder2',
                'title'    => $c->child_name . ' — ' . $c->case_number,
                'subtitle' => 'حالة: ' . ucfirst($c->status),
                // استخدمنا رابط يدوي مؤقتاً للتأكد من عدم حدوث خطأ 500
                'url'      => url("/admin/cases/" . $c->id), 
                'color'    => '#1f5a8a',
            ];
        }

        // 2. الأطباء
        $doctors = DB::table('users')
            ->where('role', 'doctor')
            ->where('name', 'like', $like)
            ->limit(3)
            ->get();

        foreach ($doctors as $d) {
            $results[] = [
                'type'     => 'doctor',
                'icon'     => 'bi-person-badge',
                'title'    => 'د. ' . $d->name,
                'subtitle' => $d->email,
                'url'      => url("/admin/doctors"), 
                'color'    => '#1d9e75',
            ];
        }

        return response()->json(['results' => $results]);

    } catch (\Exception $e) {
        // في حال حدوث أي خطأ، سيرجع لك رسالة الخطأ بدلاً من 500
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\PolicyComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ═══════════════════════════════════════════
    //  Dashboard Home
    // ═══════════════════════════════════════════
    public function index()
    {
        $complaints      = PolicyComplaint::latest()->take(5)->get();
        $unreadComplaints = PolicyComplaint::unread()->count();

        return view('dashboard.index', compact('complaints', 'unreadComplaints'));
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


        // Query with filters
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

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('child_cases.child_name', 'like', "%{$search}%")
                  ->orWhere('child_cases.case_number', 'like', "%{$search}%")
                  ->orWhere('contacts.display_name', 'like', "%{$search}%")
                  ->orWhere('contacts.identifier', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($status = $request->input('status')) {
            $query->where('child_cases.status', $status);
        }
        if ($priority = $request->input('priority')) {
            $query->where('child_cases.priority', $priority);
        }
        if ($channel = $request->input('channel')) {
            $query->where('child_cases.channel', $channel);
        }

        // Sort: priority order → status order → newest
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

        if (!$case) {
            abort(404, 'Case not found');
        }

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
            fputs($h, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel Arabic support
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
}
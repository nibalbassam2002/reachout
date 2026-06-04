<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\PolicyComplaint; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $complaints = PolicyComplaint::latest()->take(5)->get();
        $unreadComplaints = PolicyComplaint::unread()->count();

        return view('dashboard.index', compact('complaints', 'unreadComplaints')); // ✅ عدّل هاد
    }

    public function editBank() {
        $bank = BankAccount::first();
        return view('dashboard.admin.bank_settings', compact('bank'));
    }

    public function updateBank(Request $request) {
        $bank = BankAccount::first() ?? new BankAccount();
        $bank->fill($request->all());
        $bank->save();
        return back()->with('success', 'Bank details updated successfully!');
    }
}
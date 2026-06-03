<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); 
    }
    public function editBank() {
    $bank = BankAccount::first();
    return view('dashboard.admin.bank_settings', compact('bank'));
}

    public function updateBank(Request $request) {
        // تحديث البيانات أو إنشاؤها إذا لم تكن موجودة
        $bank = BankAccount::first() ?? new BankAccount();
        $bank->fill($request->all());
        $bank->save();

        return back()->with('success', 'Bank details updated successfully!');
    }
}
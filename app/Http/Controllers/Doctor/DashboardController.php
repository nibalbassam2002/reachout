<?php

namespace App\Http\Controllers\Doctor; // تأكدي من هذا السطر جيداً

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // هنا نجلب البيانات الخاصة بالطبيب المسجل دخوله فقط
        $doctor = Auth::user();
        
        // مثلاً: جلب الحالات المحولة لهذا الدكتور فقط
        // $cases = $doctor->assignedCases()->latest()->get();

        return view('dashboard.doctor.dashboard'); 
    }
}
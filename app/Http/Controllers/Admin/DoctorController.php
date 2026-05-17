<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    // 1. عرض جدول كل الأطباء
    public function index()
    {
        // جلب الأطباء مع البروفايل الخاص بهم
        $doctors = User::doctors()->with('doctorProfile')->get();
        return view('dashboard.admin.doctors.index', compact('doctors'));
    }

    // 2. عرض صفحة "إضافة دكتور جديد"
    public function create()
    {
        return view('dashboard.admin.doctors.create');
    }

    // 3. عملية الحفظ في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8',
            'specialization' => 'required|string',
            'bio'            => 'nullable|string',
        ]);

        // الحفظ باستخدام Transaction (تمت إزالة الـ backslash الزائد)
        DB::transaction(function () use ($request) {
            // حفظ في جدول Users
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'doctor',
                'is_active' => true,
            ]);

            // حفظ في جدول DoctorProfiles
            $user->doctorProfile()->create([
                'specialization' => $request->specialization,
                'bio'            => $request->bio,
            ]);
        });

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor account created successfully!');
    }
// 5. عرض صفحة تعديل بيانات الدكتور
    public function edit($id)
    {
        // جلب الدكتور مع بروفايله
        $doctor = User::with('doctorProfile')->findOrFail($id);
        return view('dashboard.admin.doctors.edit', compact('doctor'));
    }

    // 6. تحديث البيانات في قاعدة البيانات
    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);

        // التحقق من البيانات (لاحظي استثناء إيميل الدكتور الحالي من فحص التكرار)
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $id,
            'password'       => 'nullable|min:8', // الباسوورد اختياري عند التعديل
            'specialization' => 'required|string',
            'bio'            => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $doctor) {
            // تحديث بيانات اليوزر
            $doctor->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            // إذا أدخل باسوورد جديد نقوم بتحديثه
            if ($request->filled('password')) {
                $doctor->update(['password' => Hash::make($request->password)]);
            }

            // تحديث أو إنشاء البروفايل
            $doctor->doctorProfile()->updateOrCreate(
                ['user_id' => $doctor->id],
                [
                    'specialization' => $request->specialization,
                    'bio'            => $request->bio,
                ]
            );
        });

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully!');
    }
    // 4. حذف الدكتور
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // حذف البروفايل أولاً لأن قاعدة البيانات MyISAM (لا يوجد Cascade)
        if ($user->doctorProfile) {
            $user->doctorProfile->delete();
        }
        
        // حذف اليوزر
        $user->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
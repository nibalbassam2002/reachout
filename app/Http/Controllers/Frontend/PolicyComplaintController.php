<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PolicyComplaint;
use Illuminate\Http\Request;

class PolicyComplaintController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'contact_info'    => 'required|string|max:255',
            'type_of_concern' => 'required|string|max:255',
            'details'         => 'required|string|min:10',
        ], [
            'contact_info.required'    => 'Please enter your name or email.',
            'type_of_concern.required' => 'Please enter the type of concern.',
            'details.required'         => 'Please describe your concern.',
            'details.min'              => 'Please provide more details (at least 10 characters).',
        ]);

        // حفظ البيانات
        PolicyComplaint::create([
            'contact_info'    => $validated['contact_info'],
            'type_of_concern' => $validated['type_of_concern'],
            'details'         => $validated['details'],
            'ip_address'      => $request->ip(),
        ]);

        // رسالة نجاح وإرجاع للصفحة
        return back()->with('complaint_success', 'Your concern has been submitted successfully. We will review it confidentially.');
    }
}
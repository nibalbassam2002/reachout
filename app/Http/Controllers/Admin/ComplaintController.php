<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PolicyComplaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        PolicyComplaint::where('is_read', false)->update(['is_read' => true]);

        $complaints = PolicyComplaint::latest()->paginate(15);

        return view('dashboard.admin.complaints', compact('complaints'));
    }

    public function updateStatus(PolicyComplaint $complaint, Request $request)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,resolved'
        ]);

        $complaint->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }
}
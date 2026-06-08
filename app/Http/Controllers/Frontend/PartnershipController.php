<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\PartnershipInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PartnershipController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'fname'   => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:5',
        ]);

        Mail::to('info@mentalhealthfrontline.org')->send(new PartnershipInquiry(
            $request->fname,
            $request->lname ?? '',
            $request->email,
            $request->phone ?? '',
            $request->message,
        ));

        return response()->json(['success' => true]);
    }
}
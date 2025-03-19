<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class SupportController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::raw($data['message'], function ($mail) use ($data) {
            $mail->to('support@example.com')
                ->subject('Yêu cầu hỗ trợ từ ' . $data['email']);
        });

        return response()->json(['message' => 'Yêu cầu hỗ trợ đã được gửi'], 201);
    }
}

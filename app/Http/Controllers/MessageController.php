<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra request có dữ liệu hợp lệ không
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        // Lưu tin nhắn
        $message = Message::create([
            'user_id' => auth()->id(), // Nếu có user login
            'text' => $request->text,
        ]);

        return response()->json($message, 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    public function index()
    {
        $data = Message::leftJoin('users', 'users.id', 'messages.user')->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'user' => $request->user()->id,
            'text' => $request->text
        ]);

        if($message){
            return response()->json([
                'message' => 'thành công',
                'text' => $request->text
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'thất bại'
        ], Response::HTTP_BAD_REQUEST);
    }
}

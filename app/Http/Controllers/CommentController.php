<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function layBinhLuan(){
        $data = Comment::get();
        return response()->json([
            'status' => 200,
            'data'=> $data
        ]);
    }
    public function taoBinhLuan(Request $request)
    {
        Comment::create([
            "userID"=>$request->userID,
            "tableID"=>$request->tableID,
            "content"=>$request->content,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo bình luận thành công'
        ]);
    }
    public function xoaBinhLuan($id){
            Comment::where('id', $id)->delete();
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Xóa bình luận thành công!',
            ]);
        }
    public function capNhat(Request $request){
        $comment = Comment::find($request->id);

        if ($comment) {
            $updated = Comment::where('id', $request->id)
                ->update([
                    "userID"=>$request->userID,
                    "tableID"=>$request->tableID,
                    "content"=>$request->content,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công bình luận ' . $request->userID,
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Không có thay đổi nào',
                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'bình luận không tồn tại',
            ]);
        }
    }
    public function timKiem(Request $request){
        $key = "%".$request->userID."%";
        $data = Comment::where("userID","like",$key)->get();

        return response()->json([
            'Comment' => $data,
        ]);

    }
}


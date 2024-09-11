<?php

namespace App\Http\Controllers;

use App\Models\Evaluate;
use Illuminate\Http\Request;

class EvaluateController extends Controller
{
    public function layDanhGia(){
        $data = Evaluate::get();
        return response()->json([
            'status' => 200,
            'data'=> $data
        ]);
    }
    public function taoDanhGia(Request $request)
    {
        Evaluate::create([
            "tableID"=>$request->tableID,
            "userID"=>$request->userID,
            "content"=>$request->content,
            "rate"=>$request->rate,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo đánh giá thành công'
        ]);
    }
    public function xoaDanhGia($id){
            Evaluate::where('id', $id)->delete();
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Xóa đánh giá thành công!',
            ]);
        }
    public function capNhat(Request $request){
        $evaluate = Evaluate::find($request->id);

        if ($evaluate) {
            // Cập nhật bản ghi
            $updated = Evaluate::where('id', $request->id)
                ->update([
                    "tableID"=>$request->tableID,
                    "userID"=>$request->userID,
                    "content"=>$request->content,
                    "rate"=>$request->rate,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công đánh giá ' . $request->userID,
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
                'message' => 'đánh giá không tồn tại',
            ]);
        }
    }
    public function timKiem(Request $request){
        $key = "%".$request->tableID."%";
        $data = Evaluate::where("tableID","like",$key)->get();

        return response()->json([
            'Evaluate' => $data,
        ]);

    }
}



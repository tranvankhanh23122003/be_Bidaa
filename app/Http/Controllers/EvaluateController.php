<?php

namespace App\Http\Controllers;

use App\Models\Evaluate;
use Illuminate\Http\Request;

class EvaluateController extends Controller
{
    public function layDanhGia() {
        $data = Evaluate::all();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function taoDanhGia(Request $request) {
        $request->validate([
            'tableID' => 'required|string|max:50',
            'userID' => 'required|string|max:255',
            'content' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        Evaluate::create([
            'tableID' => $request->tableID,
            'userID' => $request->userID,
            'content' => $request->content,
            'rate' => $request->rate,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Tạo đánh giá thành công'
        ]);
    }

    public function xoaDanhGia($id) {
        Evaluate::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa đánh giá thành công!'
        ]);
    }

    public function capNhat(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:evaluates,id',
            'tableID' => 'required|string|max:50',
            'userID' => 'required|string|max:255',
            'content' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        $evaluate = Evaluate::find($request->id);
        if ($evaluate) {
            $updated = $evaluate->update([
                'tableID' => $request->tableID,
                'userID' => $request->userID,
                'content' => $request->content,
                'rate' => $request->rate,
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
                'message' => 'Đánh giá không tồn tại',
            ]);
        }
    }

    public function timKiem(Request $request) {
        $key = "%" . $request->tableID . "%";
        $data = Evaluate::where("tableID", "like", $key)->get();

        return response()->json([
            'Evaluate' => $data,
        ]);
    }
}

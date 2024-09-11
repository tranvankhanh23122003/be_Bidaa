<?php

namespace App\Http\Controllers;

use App\Models\Oder;
use Illuminate\Http\Request;

class OderController extends Controller
{
    public function layDonHang(){
        $data = Oder::get();
        return response()->json([
            'status' => 200,
            'data'=> $data
        ]);
    }
    public function taoDonHang(Request $request)
    {
        Oder::create([
            "tableID"=>$request->tableID,
            "userID"=>$request->userID,
            "startTime"=>$request->startTime,
            "status"=>1,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo đơn hàng thành công'
        ]);
    }
    public function xoaDonHang($id){
            Oder::where('id', $id)->delete();
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Xóa đơn hàng thành công!',
            ]);
        }
    public function capNhat(Request $request){
        $oder = Oder::find($request->id);

        if ($oder) {
            // Cập nhật bản ghi
            $updated = Oder::where('id', $request->id)
                ->update([
                    "tableID"=>$request->tableID,
                    "userID"=>$request->userID,
                    "startTime"=>$request->startTime,
                    "status"=>$request->status,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công đơn hàng ' . $request->number,
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
                'message' => 'đơn hàng không tồn tại',
            ]);
        }
    }
    public function timKiem(Request $request){
        $key = "%".$request->tableID."%";
        $data = Oder::where("tableID","like",$key)->get();

        return response()->json([
            'Oder' => $data,
        ]);

    }
}

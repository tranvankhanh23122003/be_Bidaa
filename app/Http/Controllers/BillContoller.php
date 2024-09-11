<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillContoller extends Controller
{
    public function layHoaDon(){
        $data = Bill::join('oders', 'bills.id', 'oders.oders')
        ->select('bills.*')
        ->get();
        return response()->json([
            'status' => 200,
            'data'=> $data
        ]);
    }
    public function taoHoaDon(Request $request)
    {
        Bill::create([
            "oderID"=>$request->oderID,
            "amount"=>$request->amount,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo phòng thành công'
        ]);
    }
    public function xoaHoaDon($id){
            Bill::where('id', $id)->delete();
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Xóa phòng thành công!',
            ]);
        }
    public function capNhat(Request $request){
        $bill = Bill::find($request->id);

        if ($bill) {
            // Cập nhật bản ghi
            $updated = Bill::where('id', $request->id)
                ->update([
                    "oderID"=>$request->oderID,
                    "amount"=>$request->amount,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công Bill ' . $request->number,
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
                'message' => 'phòng không tồn tại',
            ]);
        }
    }
    public function timKiem(Request $request){
        $key = "%".$request->oderID."%";
        $data = Bill::where("oderID","like",$key)->get();

        return response()->json([
            'Bill' => $data,
        ]);

    }
}

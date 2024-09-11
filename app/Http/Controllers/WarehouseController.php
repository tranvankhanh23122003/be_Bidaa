<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function layKho(){
        $data = Warehouse::get();
        return response()->json([
            'status' => 200,
            'data'=> $data
        ]);
    }
    public function taoKho(Request $request)
    {
        Warehouse::create([
            "productName"=>$request->productName,
            "cost"=>$request->cost,
            "quantity"=>$request->quantity,
            "status" => 0,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo kho hàng thành công'
        ]);
    }
    public function xoaKho($id){
            Warehouse::where('id', $id)->delete();
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Xóa kho hàng thành công!',
            ]);
        }
    public function capNhat(Request $request){
        $warehouse = Warehouse::find($request->id);

        if ($warehouse) {
            // Cập nhật bản ghi
            $updated = Warehouse::where('id', $request->id)
                ->update([
                    "productName"=>$request->productName,
                    "cost"=>$request->cost,
                    "quantity"=>$request->quantity,
                    'status' => $request->status,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công kho hàng ' . $request->productName,
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
                'message' => 'kho hàng không tồn tại',
            ]);
        }
    }
    public function doiTrangThai(Request $request){
        Warehouse::where('id', $request->id)
        ->update([
            "status" => $request->status,
            ]);
            return response()->json([
                'status'            =>   200,
                'message'           =>   'Đã cập nhật trạng thái thành công!',
                ]);
    }
    public function timKiem(Request $request){
        $key = "%".$request->number."%";
        $data = Warehouse::where("number","like",$key)->get();

        return response()->json([
            'warehouse' => $data,
        ]);

    }
}

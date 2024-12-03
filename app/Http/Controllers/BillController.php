<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function layHoaDon()
    {
        $data = Bill::leftJoin('oders', 'oders.id', 'bills.oderID')
            ->leftJoin('users', 'users.id', 'oders.userID')
            ->get();
        // $data = Bill::all();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function taoHoaDon(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string|max:255',
            'customerPhone' => 'required|string|max:15',
            'totalAmount' => 'required|numeric|min:0',
        ]);

        Bill::create([
            "customerName" => $request->customerName,
            "customerPhone" => $request->customerPhone,
            "totalAmount" => $request->totalAmount,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Tạo hóa đơn thành công'
        ]);
    }

    public function xoaHoaDon($id)
    {
        Bill::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xóa hóa đơn thành công!',
        ]);
    }

    public function capNhat(Request $request)
    {
        $bill = Bill::find($request->id);

        if ($bill) {
            $request->validate([
                'customerName' => 'required|string|max:255',
                'customerPhone' => 'required|string|max:15',
                'totalAmount' => 'required|numeric|min:0',
            ]);

            $bill->update([
                'customerName' => $request->customerName,
                'customerPhone' => $request->customerPhone,
                'totalAmount' => $request->totalAmount,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật hóa đơn thành công',
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Không tìm thấy hóa đơn',
        ]);
    }

    public function timKiemHoaDon(Request $request)
    {
        $key = "%" . $request->keyword . "%";
        $bills = Bill::where('customerName', 'like', $key)
            ->orWhere('customerPhone', 'like', $key)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $bills
        ]);
    }
}

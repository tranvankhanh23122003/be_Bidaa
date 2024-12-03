<?php

namespace App\Http\Controllers;

use App\Models\Room;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function layPhong()
    {
        $data = Room::get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    public function taoPhong(Request $request)
    {
        Room::create([
            "number" => $request->number,
            "type" => $request->type,
            "status" => $request->status,
        ]);
        return response()->json([
            'status' => 201,
            'message' => 'Tạo phòng thành công'
        ]);
    }
    public function xoaPhong($id)
    {
        Room::where('id', $id)->delete();
        return response()->json([
            'status'            =>   200,
            'message'           =>   'Xóa phòng thành công!',
        ]);
    }
    public function capNhat(Request $request)
    {
        $room = Room::find($request->id);

        if ($room) {
            $updated = Room::where('id', $request->id)
                ->update([
                    "number" => $request->number,
                    "type" => $request->type,
                    'status' => $request->status,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công Room ' . $request->number,
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
    public function doiTrangThai(Request $request)
    {
        Room::where('id', $request->id)
            ->update([
                "status" => $request->status,
            ]);
        return response()->json([
            'status'            =>   200,
            'message'           =>   'Đã cập nhật trạng thái thành công!',
        ]);
    }
    public function timKiem(Request $request)
    {
        $key = "%" . $request->number . "%";
        $data = Room::where("number", "like", $key)->get();

        return response()->json([
            'Room' => $data,
        ]);
    }
}

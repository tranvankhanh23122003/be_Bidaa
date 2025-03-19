<?php

namespace App\Http\Controllers;

use App\Enums\TableStatus;
use App\Models\Table;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TableController extends Controller
{
    public function layBan()
    {
        $data = Table::leftJoin('rooms', 'rooms.id', '=', 'tables.roomID')
            ->select('tables.*', 'rooms.number as room_number')
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'No tables found',
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $data
        ]);
    }
    public function taoBan(Request $request)
    {
        Table::create([
            "number" => $request->number,
            "type" => $request->type,
            "roomID" => $request->roomID,
            "image" => $request->image,
            "status" => $request->status,
        ]);
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Tạo bàn thành công'
        ]);
    }
    public function xoaBan($id)
    {
        Table::where('id', $id)->delete();
        return response()->json([
            'status'            =>   Response::HTTP_OK,
            'message'           =>   'Xóa bàn thành công!',
        ]);
    }
    public function capNhat(Request $request)
    {
        $table = Table::find($request->id);

        if ($table) {
            // Cập nhật bản ghi
            $updated = Table::where('id', $request->id)
                ->update([
                    'number' => $request->number,
                    'type' => $request->type,
                    'roomID' => $request->roomID,
                    'status' => $request->status,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Đã cập nhật thành công table ' . $request->number,
                ]);
            } else {
                return response()->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Không có thay đổi nào',
                ]);
            }
        } else {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Bàn không tồn tại',
            ]);
        }
    }
    public function doiTrangThai(Request $request)
    {
        Table::where('id', $request->id)
            ->update([
                "status" => $request->status,
            ]);
        return response()->json([
            'status'            =>   Response::HTTP_OK,
            'message'           =>   'Đã cập nhật trạng thái thành công!',
        ]);
    }
    public function timKiem(Request $request)
    {
        $key = "%" . $request->abc . "%";
        $data = Table::join('rooms', 'rooms.id', 'tables.rooms')
            ->select('tables.*', 'rooms.number')
            ->where("number", "like", $key)
            ->get();

        return response()->json([
            'table' => $data,
        ]);
    }
}

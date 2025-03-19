<?php

namespace App\Http\Controllers;

use App\Models\Datban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DatBanController extends Controller
{
    public function Datban()
    {
        return response()->json([
            'data' => Datban::leftJoin('tables', 'tables.id', 'dat_ban.table_id')
            // ->leftJoin('rooms', 'rooms.id', 'tables.roomID')
            ->get()
        ], 200);
    }


    public function store(Request $request)
    {
        try {
            //code...

        // $validated = $request->validate([
        //     'booking_date' => 'require|date',
        //     'booking_time' => 'require|string',
        //     'billiard_type' => 'required|string',
        //     'table_id' => 'required|integer',
        // ]);
        $datBan = Datban::create($request->all());
        return response()->json([
            'message' => 'Đặt bàn thành công!',
            'data' => $datBan
        ], 201);
    } catch (\Throwable $th) {
        Log::info($th->getMessage());
        //throw $th;
    }
    }
    public function destroy($id)
    {
        $datBan = Datban::find($id);
        if (!$datBan) {
            return response()->json(['error' => 'Không tìm thấy đặt bàn'], 404);
        }
        $datBan->delete();
        return response()->json(['message' => 'Xóa đặt bàn thành công'], 200);
    }
}

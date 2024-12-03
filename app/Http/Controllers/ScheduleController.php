<?php

namespace App\Http\Controllers;

use App\Models\Schedule; // Đảm bảo rằng bạn đã import mô hình Schedule
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Lấy danh sách lịch
    public function layLich()
    {
        $data = Schedule::leftJoin('users', 'users.id', 'schedules.userID')
            ->select('schedules.*', 'users.userName')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    // Tạo lịch làm việc mới
    public function taoLich(Request $request)
    {
        Schedule::create([
            "userID" => $request->userID,
            "date" => $request->date,
            "startTime" => $request->startTime,
            "endTime" => $request->endTime,
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Tạo lịch thành công'
        ]);
    }

    public function xoaLich($id)
    {
        $lich = Schedule::find($id);
        if ($lich) {
            $lich->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Xóa lịch thành công!',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Lịch không tồn tại!',
            ]);
        }
    }

    public function capNhat(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if ($schedule) {
            $schedule->update([
                "userID" => $request->userID,
                "date" => $request->date,
                "startTime" => $request->startTime,
                "endTime" => $request->endTime,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật thành công lịch ' . $request->userID,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Lịch không tồn tại',
            ]);
        }
    }

    public function timKiem(Request $request)
    {
        $key = "%" . $request->abc . "%";
        $data = Schedule::join('users', 'users.id', '=', 'schedules.userID')
            ->select('schedules.*', 'users.userName')
            ->where("date", "like", $key)
            ->get();

        return response()->json([
            'schedule' => $data,
        ]);
    }
}

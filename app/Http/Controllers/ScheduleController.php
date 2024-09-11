<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function layLich()
    {
        $data = Schedule::join('users', 'users.id', 'schedules.users')
            ->select('schedules.*', 'users.userName')
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
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
            'message' => 'Tạo lich thành công'
        ]);
    }
    public function xoaLich($id)
    {
        Schedule::where('id', $id)->delete();
        return response()->json([
            'status'            =>   200,
            'message'           =>   'Xóa lich thành công!',
        ]);
    }
    public function capNhat(Request $request)
    {
        $Schedule = Schedule::find($request->id);

        if ($Schedule) {
            // Cập nhật bản ghi
            $updated = Schedule::where('id', $request->id)
                ->update([
                    "userID" => $request->userID,
                    "date" => $request->date,
                    "startTime" => $request->startTime,
                    "endTime" => $request->endTime,
                ]);

            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Đã cập nhật thành công Schedule ' . $request->userID,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không có thay đổi nào',
                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'lich không tồn tại',
            ]);
        }
    }
    public function timKiem(Request $request)
    {
        $key = "%" . $request->abc . "%";
        $data = Schedule::join('users', 'users.id', 'schedules.users')
            ->select('schedules.*', 'users.userName')
            ->where("date", "like", $key)->get()
            ->get();
        return response()->json([
            'schedule' => $data,
        ]);
    }
}

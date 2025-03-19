<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DatBanController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\OderController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Contracts\Service\Test\ServiceLocatorTest;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/get-user', [UserController::class, 'getUser']);

    Route::prefix('/ban-bida')->group(function () {
        Route::get('/', [TableController::class, 'layBan']);
        Route::post('/', [TableController::class, 'taoBan']);
        Route::post('/tim-ban', [TableController::class, 'timKiem']);
        Route::delete('{id}', [TableController::class, 'xoaBan']);
        Route::put('/', [TableController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [TableController::class, 'doiTrangThai']);
    });

    Route::prefix('/phong')->group(function () {
        Route::get('/', [RoomController::class, 'layPhong']);
        Route::post('/', [RoomController::class, 'taoPhong']);
        Route::post('/tim-phong', [RoomController::class, 'timKiem']);
        Route::delete('{id}', [RoomController::class, 'xoaPhong']);
        Route::put('/', [RoomController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [RoomController::class, 'doiTrangThai']);
    });

    Route::prefix('/lich-lam')->group(function () {
        Route::get('/', [ScheduleController::class, 'layLich']);
        Route::post('/', [ScheduleController::class, 'taoLich']);
        Route::post('/tim-lich', [ScheduleController::class, 'timKiem']);
        Route::delete('/{id}', [ScheduleController::class, 'xoaLich']);
        Route::put('/{id}', [ScheduleController::class, 'capNhat']);
    });

    Route::prefix('/hoa-don')->group(function () {
        Route::get('/', [BillController::class, 'layHoaDon']);
        Route::post('/', [BillController::class, 'taoHoaDon']);
        Route::post('/tim-hoaDon', [BillController::class, 'timKiem']);
        Route::delete('{id}', [BillController::class, 'xoaHoaDon']);
        Route::put('/', [BillController::class, 'capNhat']);
    });

    Route::prefix('/kho-hang')->group(function () {
        Route::get('/', [WarehouseController::class, 'layKho']);
        Route::post('/', [WarehouseController::class, 'taoKho']);
        Route::post('/tim-kho', [WarehouseController::class, 'timKiem']);
        Route::delete('{id}', [WarehouseController::class, 'xoaKho']);
        Route::put('/', [WarehouseController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [WarehouseController::class, 'doiTrangThai']);
    });
    Route::prefix('/don-hang')->group(function () {
        Route::get('/', [OderController::class, 'layDonHang']);
        Route::post('/', [OderController::class, 'taoDonHang']);
        Route::post('/tim-DonHang', [OderController::class, 'timKiem']);
        Route::delete('{id}', [OderController::class, 'xoaDonHang']);
        Route::put('/', [OderController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [OderController::class, 'doiTrangThai']);
    });
    Route::prefix('/binh-luan')->group(function () {
        Route::get('/', [CommentController::class, 'layBinhLuan']);
        Route::post('/', [CommentController::class, 'taoBinhLuan']);
        Route::post('/tim-BinhLuan', [CommentController::class, 'timKiem']);
        Route::delete('{id}', [CommentController::class, 'xoaBinhLuan']);
        Route::put('/', [CommentController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [CommentController::class, 'doiTrangThai']);
    });
    Route::prefix('/danh-gia')->group(function () {
        Route::get('/', [EvaluateController::class, 'layDanhGia']);
        Route::post('/', [EvaluateController::class, 'taoDanhGia']);
        Route::post('/tim-DanhGia', [EvaluateController::class, 'timKiem']);
        Route::delete('{id}', [EvaluateController::class, 'xoaDanhGia']);
        Route::put('/', [EvaluateController::class, 'capNhat']);
        Route::put('/doi-trang-thai', [EvaluateController::class, 'doiTrangThai']);
    });
    Route::get('/messages', [ChatController::class, 'index']);
    Route::post('/messages', [ChatController::class, 'store']);
    Route::post('/support', [SupportController::class, 'store']);

    Route::prefix('/dat-ban')->group(function () {
    Route::get('/', [DatBanController::class, 'Datban']);
    Route::post('/', [DatBanController::class, 'store']);
    Route::get('/{id}', [DatBanController::class, 'destroy']);
    });


    Route::get('/kiem-tra-admin', [UserController::class, 'checkAdmin']);
});

Route::post('/dang-ky', [UserController::class, 'dangKy']);
Route::post('/dang-nhap', [UserController::class, 'dangNhap']);

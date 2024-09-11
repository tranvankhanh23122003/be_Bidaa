<?php

use App\Http\Controllers\BillContoller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\OderController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
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
});

Route::post('/dang-ky',[UserController::class,'dangKy']);
Route::post('/dang-nhap', [UserController::class, 'dangNhap']);



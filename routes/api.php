<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\AutoEcoleController;
use App\Http\Controllers\Api\WorkProcessController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperGerantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(["middleware" => "auth:api"], function () {
    Route::get('profile', [AuthController::class, 'profile'])->name("profile");
    Route::get('refresh', [AuthController::class, 'refreshToken'])->name("refreshToken");
    Route::get('logout', [AuthController::class, 'logout'])->name("logout");


    // Super Admin routes
    Route::group([], function () {
        Route::post('/super-admin/create-admin/{role}', [SuperAdminController::class, 'createUser']);
        Route::get('/super-admin/handle-admins/{role}', [SuperAdminController::class, 'handleUsers']);
    });

    // Super Gerant routes
    Route::group([], function () {
        Route::post('/super-gerant/create-user/{role}', [SuperGerantController::class, 'createUser']);
        Route::get('/super-gerant/handle-users/{role}', [SuperGerantController::class, 'handleUsers']);
    });



    Route::apiResource('autoEcoles', AutoEcoleController::class);
    Route::get("ma-auto-ecoles", [AutoEcoleController::class, "monAutoEcoles"]);
    // Route::controller(AutoEcoleController::class)->group(function () {
    //     Route::get('autoEcoles', 'index')->name('list_auto_ecole');
    //     Route::get('autoEcoles/{autoEcole}', 'show')->name('show_auto_ecole');
    //     Route::post('autoEcoles', 'store')->name('create_auto_ecole');
    //     Route::put('autoEcoles/{autoEcole}', 'update')->name('update_auto_ecole');
    //     Route::delete('autoEcoles/{autoEcole}', 'destroy')->name('delete_auto_ecole');
    // });


    Route::apiResource('workProcess', WorkProcessController::class);
    // Route::controller(WorkProcessController::class)->group(function () {
    //     Route::get('workProcess', 'index')->name('list_work_process');
    //     Route::get('workProcess/{workProcess}', 'show')->name('show_work_process');
    //     Route::post('workProcess', 'store')->name('create_work_process');
    //     Route::put('workProcess/{workProcess}', 'update')->name('update_work_process');
    //     Route::delete('workProcess/{workProcess}', 'destroy')->name('delete_work_process');
    // });
});

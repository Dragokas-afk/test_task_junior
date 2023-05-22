<?php

use Illuminate\Support\Facades\Route;
use App\Models\Equipment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
   return view('layout.main');
});

//TODO: Нереально заверстать странички хотя бы чуть чуть...

//Страница авторизации
Route::get('/login', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');

//Middleware на проверку авторизации
Route::middleware('auth')->group(function () {

    //Middleware на проверку поставщика
    Route::middleware('isProvider')->group(function () {

        //Форма создания нового оборудования для поставщика
        Route::get('/newEquipment', [\App\Http\Controllers\EquipmentController::class, 'index'])->name('newEquipment');
        Route::post('/newEquipment', [\App\Http\Controllers\EquipmentController::class, 'createEquipment']);

        //Отчет поставщика с фильтрами и поиском
        Route::get('/reportProvider', [\App\Http\Controllers\FilterController::class, 'reportProvider'])->name('reportProvider');

    });

    //Middleware на проверку Управляющий
    Route::middleware('isManager')->group(function () {

        //Список оборудования для Управляющего
        Route::get('/equipmentList', [\App\Http\Controllers\EquipmentController::class, 'indexList'])->name('replaceEquipment');
        Route::post('/equipmentList', [\App\Http\Controllers\EquipmentController::class, 'replaceEquipment']);

        //Отчет управляющего с филтрами и поиском
        Route::get('/reportManager', [\App\Http\Controllers\FilterController::class, 'reportManager'])->name('reportManager');

    });


});


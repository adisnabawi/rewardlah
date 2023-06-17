<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedeemController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/verify', [AuthController::class, 'verify'])->name('login.verify');
});

Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('register');
    })->name('register');
    Route::post('/store', [AuthController::class, 'registerCompany'])->name('register.store');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::middleware('auth')->name('dashboard.')->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('index');
    Route::get('/mypoints',[DashboardController::class, 'mypoints'])->name('mypoints');
    Route::prefix('/employee')->group(function () {
        Route::get('/',[EmployeeController::class, 'index'])->name('employee');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
    });

    Route::prefix('/department')->group(function () {
        Route::get('/',[DepartmentController::class, 'index'])->name('department');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
    });

    Route::prefix('/points')->group(function () {
        Route::post('/send', [PointsController::class, 'send'])->name('points.send');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/',[ProductController::class, 'index'])->name('product');
        Route::post('/add', [ProductController::class, 'add'])->name('product.add');
    });

    Route::prefix('/redeem')->group(function () {
        Route::get('/',[RedeemController::class, 'index'])->name('redeem');
        Route::post('/add', [RedeemController::class, 'redeem'])->name('redeem.add');
    });

    Route::get('/leaderboard',[DashboardController::class, 'leaderboard'])->name('leaderboard');
});

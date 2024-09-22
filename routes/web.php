<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExampleController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RawmaterialsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TypeofRawmaterialsController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'check')->name('check');
    Route::get('/user/add-order', 'userOrderPage')->name('user.add.order.index');
    Route::post('/user/add-order', 'userOrderPost')->name('user.add.order.post');
    Route::get('/user/orders', 'userOrders')->name('user.orders.index');
    Route::get('/user/orders/list', 'userOrdersList')->name('user.order.get.list');
});
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'loginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'checkAdmin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile/update', [ProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('profile/setting', [ProfileController::class, 'adminProfileSetting'])->name('admin.profile.setting');
    Route::post('profile/change/password', [ProfileController::class, 'adminChangePassword'])->name('admin.change.password');

    Route::group(['prefix' => '/setting'], function () {
        Route::get('/general', [SettingController::class, 'general'])->name('admin.setting.general');
        Route::get('/static-content', [SettingController::class, 'staticContent'])->name('admin.setting.static.content');
        Route::get('/legal-content', [SettingController::class, 'legalContent'])->name('admin.setting.legal.content');
        Route::post('/update', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::get('/change-language', [SettingController::class, 'changeLanguage'])->name('admin.setting.change.language');
    });

    Route::group(['prefix' => '/role'], function () {
        Route::get('/generate/right/{mdule_name}', [RoleController::class, 'generate'])->name('admin.role.right.generate');
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/get/role/list', [RoleController::class, 'getRoleList']);
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::any('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::get('/right', [RoleController::class, 'right'])->name('admin.role.right');
        Route::get('/get/right/list', [RoleController::class, 'getRightList']);
        Route::post('/right/store', [RoleController::class, 'rightStore'])->name('admin.role.right.store');
        Route::get('/right/edit/{id}', [RoleController::class, 'editRight'])->name('admin.role.right.edit');
        Route::any('/right/update/{id}', [RoleController::class, 'roleRightUpdate'])->name('admin.role.right.update');
        Route::get('/right/delete/{id}', [RoleController::class, 'rightDelete'])->name('admin.role.right.delete');
    });
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('/get/list', [UserController::class, 'getList']);
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::any('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::post('/change', [UserController::class, 'changePassword'])->name('admin.user.changepassword');
    });
    Route::group(['prefix' => '/employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('admin.employee.index');
        Route::get('/get/list', [EmployeeController::class, 'getList'])->name('admin.employee.get.list');
        Route::post('/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::post('/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::get('/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');
    });
    Route::group(['prefix' => '/customer'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer.index');
        Route::get('/get/list', [CustomerController::class, 'getList'])->name('admin.customer.get.list');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::get('/edit', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::post('/update', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::get('/delete', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });
    Route::group(['prefix' => '/order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/get/list', [OrderController::class, 'getList'])->name('admin.order.get.list');
        Route::post('/store', [OrderController::class, 'store'])->name('admin.order.store');
        Route::get('/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::post('/update', [OrderController::class, 'update'])->name('admin.order.update');
        Route::get('/delete', [OrderController::class, 'delete'])->name('admin.order.delete');
    });
    Route::group(['prefix' => '/rawmaterialsimporthistory'], function () {
        Route::get('/', [RawmaterialsController::class, 'index'])->name('admin.rawmaterialsimporthistory.index');
        Route::get('/get/list', [RawmaterialsController::class, 'getList'])->name('admin.rawmaterialsimporthistory.get.list');
        Route::post('/store', [RawmaterialsController::class, 'store'])->name('admin.rawmaterialsimporthistory.store');
        Route::get('/edit', [RawmaterialsController::class, 'edit'])->name('admin.rawmaterialsimporthistory.edit');
        Route::post('/update', [RawmaterialsController::class, 'update'])->name('admin.rawmaterialsimporthistory.update');
        Route::get('/delete', [RawmaterialsController::class, 'delete'])->name('admin.rawmaterialsimporthistory.delete');
    });
    Route::group(['prefix' => '/typeofrawmaterials'], function () {
        Route::get('/', [TypeofRawmaterialsController::class, 'index'])->name('admin.typeofrawmaterials.index');
        Route::get('/get/list', [TypeofRawmaterialsController::class, 'getList'])->name('admin.typeofrawmaterials.get.list');
        Route::post('/store', [TypeofRawmaterialsController::class, 'store'])->name('admin.typeofrawmaterials.store');
        Route::get('/edit', [TypeofRawmaterialsController::class, 'edit'])->name('admin.typeofrawmaterials.edit');
        Route::post('/update', [TypeofRawmaterialsController::class, 'update'])->name('admin.typeofrawmaterials.update');
        Route::get('/delete', [TypeofRawmaterialsController::class, 'delete'])->name('admin.typeofrawmaterials.delete');
    });
    Route::group(['prefix' => '/attendance'], function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('admin.attendance.index');
        Route::get('/get-attendance-single-day', [AttendanceController::class, 'getSingleDayAttendance'])->name('admin.attendance.single.day');
        Route::post('/post-attendance-single-day', [AttendanceController::class, 'postSingleDayAttendance'])->name('admin.attendance.single.day.submit');
    });
    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/get/list', [ProductController::class, 'getList'])->name('admin.products.get.list');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/delete', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::get('/add-material-row', [ProductController::class, 'addMaterialRow'])->name('admin.products.add.material.row');
    });
    Route::group(['prefix' => '/producttype'], function () {
        Route::get('/', [ProductTypeController::class, 'index'])->name('admin.producttype.index');
        Route::get('/get/list', [ProductTypeController::class, 'getList'])->name('admin.producttype.get.list');
        Route::post('/store', [ProductTypeController::class, 'store'])->name('admin.producttype.store');
        Route::get('/edit', [ProductTypeController::class, 'edit'])->name('admin.producttype.edit');
        Route::post('/update', [ProductTypeController::class, 'update'])->name('admin.producttype.update');
        Route::get('/delete', [ProductTypeController::class, 'delete'])->name('admin.producttype.delete');
    });
    Route::group(['prefix' => '/example'], function () {
        Route::get('/', [ExampleController::class, 'index'])->name('admin.example.index');
        Route::get('/list', [ExampleController::class, 'getList'])->name('admin.example.list');
        Route::post('/store', [ExampleController::class, 'store'])->name('admin.example.store');
        Route::get('/edit', [ExampleController::class, 'edit'])->name('admin.example.edit');
        Route::post('/update', [ExampleController::class, 'update'])->name('admin.example.update');
        Route::post('/delete', [ExampleController::class, 'delete'])->name('admin.example.delete');
    });
});
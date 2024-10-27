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
use App\Http\Controllers\Backend\Salarycontroller;
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

Route::group(['middleware' => 'checkAdmin'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/adminprofile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/adminprofile/update', [ProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/adminprofile/setting', [ProfileController::class, 'adminProfileSetting'])->name('admin.profile.setting');
    Route::post('/adminprofile/change/password', [ProfileController::class, 'adminChangePassword'])->name('admin.change.password');

    Route::get('/admin/setting/general', [SettingController::class, 'general'])->name('admin.setting.general');
    Route::get('/admin/setting/static-content', [SettingController::class, 'staticContent'])->name('admin.setting.static.content');
    Route::get('/admin/setting/legal-content', [SettingController::class, 'legalContent'])->name('admin.setting.legal.content');
    Route::post('/admin/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::get('/admin/setting/change-language', [SettingController::class, 'changeLanguage'])->name('admin.setting.change.language');

    Route::get('/admin/role/generate/right/{mdule_name}', [RoleController::class, 'generate'])->name('admin.role.right.generate');
    Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role');
    Route::get('/admin/role/get/role/list', [RoleController::class, 'getRoleList']);
    Route::get('/admin/role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('/admin/role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('/admin/role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::any('/admin/role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('/admin/role/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    Route::get('/admin/role/right', [RoleController::class, 'right'])->name('admin.role.right');
    Route::get('/admin/role/get/right/list', [RoleController::class, 'getRightList']);
    Route::post('/admin/role/right/store', [RoleController::class, 'rightStore'])->name('admin.role.right.store');
    Route::get('/admin/role/right/edit/{id}', [RoleController::class, 'editRight'])->name('admin.role.right.edit');
    Route::any('/admin/role/right/update/{id}', [RoleController::class, 'roleRightUpdate'])->name('admin.role.right.update');
    Route::get('/admin/role/right/delete/{id}', [RoleController::class, 'rightDelete'])->name('admin.role.right.delete');

    /* User Route */
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::get('/admin/user/get/list', [UserController::class, 'getList']);
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::any('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    Route::post('/admin/user/change', [UserController::class, 'changePassword'])->name('admin.user.changepassword');

    /* Employee Route */
    Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('/admin/employee/get/list', [EmployeeController::class, 'getList'])->name('admin.employee.get.list');
    Route::post('/admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::get('/admin/employee/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
    Route::get('/admin/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');

    /* Customer Route */
    Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/admin/customer/get/list', [CustomerController::class, 'getList'])->name('admin.customer.get.list');
    Route::post('/admin/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('/admin/customer/edit', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::post('/admin/customer/update', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::get('/admin/customer/delete', [CustomerController::class, 'delete'])->name('admin.customer.delete');

    /* Order Route */
    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/get/list', [OrderController::class, 'getList'])->name('admin.order.get.list');
    Route::post('/admin/order/store', [OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/admin/order/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
    Route::post('/admin/order/update', [OrderController::class, 'update'])->name('admin.order.update');
    Route::get('/admin/order/delete', [OrderController::class, 'delete'])->name('admin.order.delete');

    /* Raw material Route */
    Route::get('/admin/rawmaterialsimporthistory', [RawmaterialsController::class, 'index'])->name('admin.rawmaterialsimporthistory.index');
    Route::get('/admin/rawmaterialsimporthistory/get/list', [RawmaterialsController::class, 'getList'])->name('admin.rawmaterialsimporthistory.get.list');
    Route::post('/admin/rawmaterialsimporthistory/store', [RawmaterialsController::class, 'store'])->name('admin.rawmaterialsimporthistory.store');
    Route::get('/admin/rawmaterialsimporthistory/edit', [RawmaterialsController::class, 'edit'])->name('admin.rawmaterialsimporthistory.edit');
    Route::post('/admin/rawmaterialsimporthistory/update', [RawmaterialsController::class, 'update'])->name('admin.rawmaterialsimporthistory.update');
    Route::get('/admin/rawmaterialsimporthistory/delete', [RawmaterialsController::class, 'delete'])->name('admin.rawmaterialsimporthistory.delete');

    /* Type of material Route */
    Route::get('/admin/typeofrawmaterials', [TypeofRawmaterialsController::class, 'index'])->name('admin.typeofrawmaterials.index');
    Route::get('/admin/typeofrawmaterials/get/list', [TypeofRawmaterialsController::class, 'getList'])->name('admin.typeofrawmaterials.get.list');
    Route::post('/admin/typeofrawmaterials/store', [TypeofRawmaterialsController::class, 'store'])->name('admin.typeofrawmaterials.store');
    Route::get('/admin/typeofrawmaterials/edit', [TypeofRawmaterialsController::class, 'edit'])->name('admin.typeofrawmaterials.edit');
    Route::post('/admin/typeofrawmaterials/update', [TypeofRawmaterialsController::class, 'update'])->name('admin.typeofrawmaterials.update');
    Route::get('/admin/typeofrawmaterials/delete', [TypeofRawmaterialsController::class, 'delete'])->name('admin.typeofrawmaterials.delete');

    /* Attendance Route */
    Route::get('/admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('/admin/attendance/get-attendance-single-day', [AttendanceController::class, 'getSingleDayAttendance'])->name('admin.attendance.single.day');
    Route::post('/admin/attendance/post-attendance-single-day', [AttendanceController::class, 'postSingleDayAttendance'])->name('admin.attendance.single.day.submit');

    /* Product Route */
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/get/list', [ProductController::class, 'getList'])->name('admin.products.get.list');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/admin/products/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('/admin/products/delete', [ProductController::class, 'delete'])->name('admin.products.delete');
    Route::get('/admin/products/add-material-row', [ProductController::class, 'addMaterialRow'])->name('admin.products.add.material.row');

    /* Product Type Route */
    Route::get('/admin/producttype', [ProductTypeController::class, 'index'])->name('admin.producttype.index');
    Route::get('/admin/producttype/get/list', [ProductTypeController::class, 'getList'])->name('admin.producttype.get.list');
    Route::post('/admin/producttype/store', [ProductTypeController::class, 'store'])->name('admin.producttype.store');
    Route::get('/admin/producttype/edit', [ProductTypeController::class, 'edit'])->name('admin.producttype.edit');
    Route::post('/admin/producttype/update', [ProductTypeController::class, 'update'])->name('admin.producttype.update');
    Route::get('/admin/producttype/delete', [ProductTypeController::class, 'delete'])->name('admin.producttype.delete');

    /* Salary Route */
    Route::get('/admin/salary', [Salarycontroller::class, 'index'])->name('admin.salary.index');
    Route::get('/admin/salary/get/list', [Salarycontroller::class, 'getList'])->name('admin.salary.get.list');
    Route::post('/admin/salary/store', [Salarycontroller::class, 'store'])->name('admin.salary.store');
    Route::get('/admin/salary/edit', [Salarycontroller::class, 'edit'])->name('admin.salary.edit');
    Route::post('/admin/salary/update', [Salarycontroller::class, 'update'])->name('admin.salary.update');
    Route::get('/admin/salary/delete', [Salarycontroller::class, 'delete'])->name('admin.salary.delete');
    Route::get('/admin/salary/make-sheet', [Salarycontroller::class, 'makeSalary'])->name('admin.salary.make.sheet');

    Route::group(['prefix' => '/example'], function () {
        Route::get('/', [ExampleController::class, 'index'])->name('admin.example.index');
        Route::get('/list', [ExampleController::class, 'getList'])->name('admin.example.list');
        Route::post('/store', [ExampleController::class, 'store'])->name('admin.example.store');
        Route::get('/edit', [ExampleController::class, 'edit'])->name('admin.example.edit');
        Route::post('/update', [ExampleController::class, 'update'])->name('admin.example.update');
        Route::post('/delete', [ExampleController::class, 'delete'])->name('admin.example.delete');
    });
});

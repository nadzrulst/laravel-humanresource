<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollComponentController;
use App\Http\Controllers\SalaryComponentController;
use App\Http\Controllers\EmployeeSalaryComponentController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LeaveApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\barController;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserAccountMail;

// Test Email Route


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginWeb']);
Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');



// Additional Routes
Route::get('das', function () {
    return view('das'); 
});

Route::get('bar', function () {
    return view('bar'); 
});

Route::get('/', function () {
    return view('welcome');
});

// API Auth Route
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', function () {
        return auth()->user();
    });

    // Resource Routes
Route::resource('users', UserController::class);
Route::resource('employees', EmployeeController::class);
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('attendances', AttendanceController::class);
Route::resource('leave_requests', LeaveRequestController::class);
Route::resource('leave_types', LeaveTypeController::class);
Route::resource('leave_balances', LeaveBalanceController::class);
Route::post('leave_balances/add_days', [LeaveBalanceController::class, 'addDays'])->name('leave_balances.add_days');
Route::resource('payrolls', PayrollController::class);
Route::resource('payroll_component', PayrollComponentController::class);
Route::resource('salary_components', SalaryComponentController::class);
Route::resource('employee_salary_components', EmployeeSalaryComponentController::class);
Route::resource('activity_logs', ActivityLogController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('leave_approvals', LeaveApprovalController::class);
Route::resource('dashboard', barController::class);

});

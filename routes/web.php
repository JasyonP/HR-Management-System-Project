<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\JobandDepartmentController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ViewEmployees;

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

Route::get('/', function () {
    return view('login');
});

// TYPES OF DASHBOARD
Route::middleware(['preventBackHistory'])->group(function () {
    Route::post('/login', [AuthController:: class, 'login'])->name('login');
    Route::post('/logout', [AuthController:: class, 'logout'])->name('logout');

    Route::get('user/employee/dashboard', [DashboardController:: class, 'employeePage'])->name('employee.dashboard'); // EMPLOYEES DASHBOARD
    Route::get('user/staff/dashboard', [DashboardController::class, 'staffPage'])->name('staff.dashboard'); // STAFF DASHBOARD
});

// EMPLOYEES CONTENT --------------------------------------------------------------------------------------------------------------------
Route::get('user/employee/documents', [DocumentsController::class, 'documents'])->name('dashboard.documents'); // DOCUMENTS LIST

// DOCUMENTS FUNCTIONS
Route::post('/employee-create-docs', [DocumentsController::class, 'storeDocument'])->name('dashboard.docs-create'); // CREATE DOCUMENTS
Route::post('/employee-delete-docs/{document}', [DocumentsController::class, 'deleteDocument'])->name('dashboard.docs-delete'); // DELETE DOCUMENTS
Route::post('/employee-edit-docs/{document}', [DocumentsController::class, 'editDocument'])->name('dashboard.docs-edit'); // DELETE DOCUMENTS

// STAFF CONTENT --------------------------------------------------------------------------------------------------------------------
Route::get('user/staff/rankings', [RankingController::class, 'rankPage'])->name('dashboard.ranking'); // LIST OF EMPLOYEES
Route::get('user/staff/employees-list', [EmployeesController::class, 'list_employee'])->name('dashboard.employees'); // LIST OF EMPLOYEES
Route::get('user/staff/job-dept-list', [JobandDepartmentController::class, 'job_dept'])->name('dashboard.job-dept'); // LIST OF JOBS AND DEPARTMENTS

// EMPLOYEES FUNCTIONS
Route::post('/staff-create-employee', [EmployeesController::class, 'storeEmployee'])->name('dashboard.employees-create'); // CREATE EMPLOYEES
Route::post('/staff-delete-employee/{user}', [EmployeesController::class, 'deleteEmployee'])->name('dashboard.employees-delete'); // DELETE EMPLOYEES
Route::post('/staff-update-employee/{user}', [EmployeesController::class, 'updateEmployee'])->name('dashboard.employees-update'); // UP

// JOBS FUNCTIONS
Route::post('/staff-create-job', [JobandDepartmentController::class, 'newJob'])->name('dashboard.job-create'); // CREATE CREATE JOBS
Route::post('/staff-delete-job/{user}', [JobandDepartmentController::class, 'deleteJob'])->name('dashboard.job-delete'); // DELETE JOBS
Route::post('/staff-update-job/{user}', [JobandDepartmentController::class, 'updateJob'])->name('dashboard.job-update'); // UPDATE JOBS

// DEPARTMENTS FUNCTIONS
Route::post('/staff-create-department', [JobandDepartmentController::class, 'newDepartment'])->name('dashboard.department-create'); // CREATE DEPARTMENTS
Route::post('/staff-delete-department/{user}', [JobandDepartmentController::class, 'deleteDepartment'])->name('dashboard.dept-delete'); // DELETE DEPARTMENTS
Route::post('/staff-update-department/{user}', [JobandDepartmentController::class, 'updateDept'])->name('dashboard.dept-update'); // UPDATE DEPARTMENTS

// SEARCH
Route::get('/staff/employees/query', [EmployeesController::class, 'search_employee'])->name('dashboard.search-employee'); // SEARCH MEDICAL RECORDS

// RANK PAGE FILTER
Route::get('/ranking', [RankingController::class, 'rankPage'])->name('rankPage');

// EMPLOYEES DOCS VIEW
Route::get('/staff/employee/view/{employeeid}', [ViewEmployees::class, 'listview_employee'])->name('employee.docs'); //
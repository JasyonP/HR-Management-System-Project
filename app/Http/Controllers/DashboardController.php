<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function staffPage()
        {
            $user = Auth::guard('staff')->user();

            // Get the count of employees grouped by department
            $employeeCounts = DepartmentModel::withCount('employees')->get();

             // Get the count of Full Time and Part Time employees
            $fullTimeCount = EmployeeModel::where('work_status', 'Full Time')->count();
            $partTimeCount = EmployeeModel::where('work_status', 'Part Time')->count();

            $active = EmployeeModel::where('employment_status', 'Active')->count();
            $retired = EmployeeModel::where('employment_status', 'Retired')->count();

            return view('dashboard/staff/layouts/dashboard', compact('user', 'employeeCounts', 'fullTimeCount', 'partTimeCount', 'active', 'retired'));
        }

        public function employeePage() {
            $user = Auth::guard('web')->user();
        
            $partTimeCount = EmployeeModel::where('department_id', $user->department_id)
                                         ->where('work_status', 'Part Time')
                                         ->count();
        
            $fullTimeCount = EmployeeModel::where('department_id', $user->department_id)
                                         ->where('work_status', 'Full Time')
                                         ->count();
        
            $employeesByJobId = EmployeeModel::where('department_id', $user->department_id)
                                            ->selectRaw('job_id, COUNT(*) as count')
                                            ->groupBy('job_id')
                                            ->get();
        
            return view('dashboard/employee/layouts/dashboard', compact('user', 'employeesByJobId', 'partTimeCount', 'fullTimeCount'));
        }
        
        
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\JobsModel;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function rankPage(Request $request)
    {
        $user = Auth::guard('staff')->user();
        $departmentId = $request->input('department_id', 'all');
        
        $query = EmployeeModel::select('employee_tbl.*', 'rank_tbl.id')
            ->join('jobs_tbl', 'employee_tbl.job_id', '=', 'jobs_tbl.id')
            ->join('rank_tbl', 'jobs_tbl.id', '=', 'rank_tbl.id')
            ->orderBy('rank_tbl.id', 'asc');
        
        if ($departmentId && $departmentId !== 'all') {
            $query->where('employee_tbl.department_id', $departmentId);
        }
        
        $employees = $query->paginate(15)->appends(['department_id' => $departmentId]);
        $departments = DepartmentModel::all(); // Assuming you have a DepartmentModel to fetch departments

         // Get the count of employees grouped by department
         $employeeCounts = DepartmentModel::withCount('employees')->get();

         // Get the count of Full Time and Part Time employees
        $fullTimeCount = EmployeeModel::where('work_status', 'Full Time')->count();
        $partTimeCount = EmployeeModel::where('work_status', 'Part Time')->count();

        $active = EmployeeModel::where('employment_status', 'Active')->count();
        $retired = EmployeeModel::where('employment_status', 'Retired')->count();
        
        return view('dashboard/staff/content/ranking', compact('user', 'employees', 'departments', 'departmentId', 'employeeCounts', 'fullTimeCount', 'partTimeCount', 'active', 'retired'));
    }
    
    
}

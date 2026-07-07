<?php

namespace App\Http\Controllers;

use App\Models\JobsModel;
use Illuminate\Http\Request;
use App\Models\DocumentModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ViewEmployees extends Controller
{
    public function listview_employee(Request $request, EmployeeModel $employeeid) {
        $user = Auth::guard('staff')->user();
        $staffID = $user->id;
    
        $empdocs = EmployeeModel::orderBy('created_at', 'desc')
            ->paginate(5);

        $depts = DepartmentModel::all();
        $jobs = JobsModel::all();
        $totalEmployees = EmployeeModel::count();
    
      
        $documents = DocumentModel::where('employee_id', $employeeid->id) 
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if ($documents->isEmpty() && $documents->currentPage() > 1) {
            // Redirect to the previous page
            return redirect($documents->url($documents->currentPage() - 1));
        }

           // Get the count of employees grouped by department
           $employeeCounts = DepartmentModel::withCount('employees')->get();

           // Get the count of Full Time and Part Time employees
          $fullTimeCount = EmployeeModel::where('work_status', 'Full Time')->count();
          $partTimeCount = EmployeeModel::where('work_status', 'Part Time')->count();
 
          $active = EmployeeModel::where('employment_status', 'Active')->count();
          $retired = EmployeeModel::where('employment_status', 'Retired')->count();
 

        // Update session URL
        Session::put('emp_url', request()->fullUrl());
    
        return view('dashboard/staff/content/view-employee', compact('staffID', 'employeeid', 'empdocs', 'depts', 'jobs', 'user', 'totalEmployees', 'documents', 'employeeCounts', 'fullTimeCount', 'partTimeCount', 'active', 'retired'));
    }

}

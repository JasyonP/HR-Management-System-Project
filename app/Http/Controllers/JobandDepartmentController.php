<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\JobsModel;
use App\Models\RankModel;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;

class JobandDepartmentController extends Controller
{
        // JOBS AND DEPARTMENTS
        public function job_dept() {

            try {
    
            $user = Auth::guard('staff')->user();
            // $firstName = $user->first_name;
            // $lastName = $user->last_name;
            // $title = $user->title;
    
            $jobs = JobsModel::all();
            $depts = DepartmentModel::all();
            $ranks = RankModel::all();
    
            $totalEmployees = EmployeeModel::count();

             // Get the count of employees grouped by department
          $employeeCounts = DepartmentModel::withCount('employees')->get();

          // Get the count of Full Time and Part Time employees
         $fullTimeCount = EmployeeModel::where('work_status', 'Full Time')->count();
         $partTimeCount = EmployeeModel::where('work_status', 'Part Time')->count();

         $active = EmployeeModel::where('employment_status', 'Active')->count();
         $retired = EmployeeModel::where('employment_status', 'Retired')->count();
    
            return view('dashboard/staff/content/job-department', compact('jobs', 'depts', 'ranks', 'user', 'totalEmployees', 'employeeCounts', 'fullTimeCount', 'partTimeCount', 'active', 'retired'));
    
            } catch (Exception $e) {
                
                return redirect('/');
                }
        }
    
        // -------------- JOBS
        public function newJob(Request $request) {
    
            JobsModel::create($request->all());
            return redirect('user/staff/job-dept-list')->with('success', 'Job Added');
        }
    
        public function updateJob(Request $request, JobsModel $user) {
            $user->update($request->all());
            return redirect('user/staff/job-dept-list')->with('success', 'Job Edited');
        }
    
        public function deleteJob(JobsModel $user) {
            $user->delete();
            return redirect('user/staff/job-dept-list')->with('success', 'Job Deleted');
        }
    
        // ------------- DEPARTMENTS
        public function newDepartment(Request $request) {
    
            DepartmentModel::create($request->all());
            return redirect('user/staff/job-dept-list')->with('success', 'Department Added');
        }
    
        public function updateDept(Request $request, DepartmentModel $user) {
            $user->update($request->all());
            return redirect('user/staff/job-dept-list')->with('success', 'Deparment Edited');
        }
    
        public function deleteDepartment(DepartmentModel $user) {
            $user->delete();
            return redirect('user/staff/job-dept-list')->with('success', 'Department Deleted');
        }
}

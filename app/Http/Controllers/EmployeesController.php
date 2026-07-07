<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\JobsModel;
use Illuminate\Http\Request;
use App\Models\DocumentModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class EmployeesController extends Controller
{
    // EMPLOYEES 
    public function list_employee() {
        $user = Auth::guard('staff')->user();
        $staffID = $user->id;
    
        $empdocs = EmployeeModel::orderBy('created_at', 'desc')
            ->paginate(6);
        $depts = DepartmentModel::all();
        $jobs = JobsModel::all();
        $totalEmployees = EmployeeModel::count();
    
        $documents = [];
        foreach ($empdocs as $empdoc) {
            $documents[$empdoc->id] = DocumentModel::where('employee_id', $empdoc->id)->get();
        }

        if ($empdocs->isEmpty() && $empdocs->currentPage() > 1) {
            // Redirect to the previous page
            return redirect($empdocs->url($empdocs->currentPage() - 1));
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
    
        return view('dashboard/staff/content/employees', compact('staffID', 'employeeCounts', 'fullTimeCount', 'partTimeCount', 'active', 'retired', 'empdocs', 'depts', 'jobs', 'user', 'totalEmployees', 'documents'));
    }
    

    public function storeEmployee(Request $request) 
    {

        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string',
            'work_status' => 'required|string',
            'employment_status' => 'required|string',
            'job_id' => 'required|integer',
            'department_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'profile' => 'nullable|file|mimes:png,jpg,jpeg,webp',
        ]); 

        $path = '';
        $filename = '';
        
        if($request->has('profile')) {

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'documents/profiles/';
            $file->move($path, $filename);
        }

            EmployeeModel::create([
                'username' => $request->username,
                'password' => $request->password,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'work_status' => $request->work_status,
                'employment_status' => $request->employment_status,
                'job_id' => $request->job_id,
                'department_id' => $request->department_id,
                'staff_id' => $request->staff_id,
                'profile' => $path.$filename,
            ]);
      
        // EmployeeModel::create($request->all());
        if(session('emp_url')) {
            return redirect(session('emp_url'))->with('success', 'Employee Added');
        } 
    }

    public function updateEmployee(Request $request, EmployeeModel $user) {
        try {
            $request->validate([
                // validation rules...
            ]);
    
            // Update other fields
            $user->update($request->except('profile'));
    
            // Handle profile picture update
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'documents/profiles/';
    
                // Remove old profile picture if exists
                if ($user->profile) {
                    if (file_exists(public_path($user->profile))) {
                        unlink(public_path($user->profile));
                    }
                }
    
                // Move new profile picture to the directory
                $file->move($path, $filename);
    
                // Update profile field in the database
                $user->profile = $path . $filename;
                $user->save(); // Save changes to the database
    
                // Debugging: Check if profile picture path is correct
                // dd($user->profile); // Check if the profile picture path is correct
            }
    
            // Debugging: Check if other fields are being updated correctly
            // dd($user->toArray()); // Check if other fields are being updated correctly
    
            if(session('emp_url')) {
                return redirect(session('emp_url'))->with('success', 'Employee Edited');
            } 
        } catch (\Exception $e) {
            // Debugging: Check for any exceptions
            // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred.']);
        }
    }
    
    public function deleteEmployee(EmployeeModel $user) {
        // Get the employee's first name and last name
        $firstName = $user->first_name;
        $lastName = $user->last_name;
    
        // Delete the employee's documents directory
        $documentsDirectory = public_path('documents/' . $firstName . '_' . $lastName);
        if (file_exists($documentsDirectory)) {
            $files = glob($documentsDirectory . '/*'); // Get all files in the directory
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete each file
                }
            }
            rmdir($documentsDirectory); // Delete the directory itself
        }
    
        // Delete the employee from the database
        $user->delete();
    
        if(session('emp_url')) {
            return redirect(session('emp_url'))->with('success', 'Employee Deleted');
        } 
    }
    
    public function search_employee(Request $request) {
        $user = Auth::guard('staff')->user();
        $staffID = $user->id;

        $search = $request->input('search');
    
        $empdocs = EmployeeModel::orderBy('created_at', 'desc')
        ->where(function(Builder $query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere(function(Builder $query) use ($search) {
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
                })
                ->orWhere('work_status', 'like', "%$search%")
                ->orWhere('employment_status', 'like', "%$search%");
        })
        ->orWhereHas('job', function (Builder $query) use ($search) {
            $query->where('job_title', 'like', "%$search%");
        })
        ->orWhereHas('department', function (Builder $query) use ($search) {
            $query->where('department_name', 'like', "%$search%");
        })
        ->paginate(5);


        $depts = DepartmentModel::all();
        $jobs = JobsModel::all();
        $totalEmployees = EmployeeModel::count();
    
        $documents = [];
        foreach ($empdocs as $empdoc) {
            $documents[$empdoc->id] = DocumentModel::where('employee_id', $empdoc->id)->get();
        }

        if ($empdocs->isEmpty() && $empdocs->currentPage() > 1) {
            // Redirect to the previous page
            return redirect($empdocs->url($empdocs->currentPage() - 1));
        }

        // Update session URL
        Session::put('emp_url', request()->fullUrl());
    
        return view('dashboard/staff/content/employees', compact('staffID', 'empdocs', 'depts', 'jobs', 'user', 'totalEmployees', 'documents'));
    }
    
}

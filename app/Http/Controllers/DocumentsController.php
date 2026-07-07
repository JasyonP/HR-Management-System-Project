<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DocumentModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function documents() {
        
        try {

        $user = Auth::guard('web')->user();
        $employeeID = $user->id;
        // $firstName = $employee->first_name;
        // $lastName = $employee->last_name;
        // $jobTitle = $employee->job->job_title;
        // $profile = $employee->profile;

        $documents = DocumentModel::where('employee_id', $employeeID)
        ->orderByDesc('created_at')
        ->paginate(10);

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


    
        return view('dashboard.employee.content.document', compact('user', 'documents', 'employeeID', 'employeesByJobId', 'partTimeCount', 'fullTimeCount'));

        } catch (Exception $e) {
            
            return redirect('/');
        }
    }
    

    public function storeDocument(Request $request) {
   
        $request->validate([
            'name' => 'required|string',
            'document' => 'required|file|mimes:png,jpg,jpeg,webp,pdf,docx',
        ]);
        
        $employee = auth()->user();
        $path = 'documents/' . $employee->first_name . '_' . $employee->last_name;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('document');

        $filename = time() . '_' . $file->getClientOriginalName();
        
        $file->move($path, $filename);

        DocumentModel::create([
            'employee_id' => $employee->id,
            'name' => $request->name,
            'document' => $path . '/' . $filename, 
        ]);

        return redirect('user/employee/documents')->with('success', 'Document Added');
    }
    
    public function editDocument(Request $request, DocumentModel $document) {
        $request->validate([
            'name' => 'required|string',
            'document' => 'nullable|file|mimes:png,jpg,jpeg,webp,pdf,docx',
        ]);
        
        // Retrieve the authenticated user
        $employee = auth()->user();
    
        // Get the existing document path
        $oldFilePath = $document->document;
    
        // Check if a new file is uploaded
        if ($request->hasFile('document')) {
            // Validate and process the new file
            $newFile = $request->file('document');
            $newFilename = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = 'documents/' . $employee->first_name . '_' . $employee->last_name . '/' . $newFilename;
            
            // Move the new file to the storage location
            $newFile->move('documents/' . $employee->first_name . '_' . $employee->last_name, $newFilename);
    
            // Remove the old file if it exists
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
    
            // Update the document record with the new file path
            $document->update([
                'name' => $request->name,
                'document' => $newFilePath,
            ]);
        } else {
            // If no new file is uploaded, update only the document name
            $document->update([
                'name' => $request->name,
            ]);
        }
    
        return redirect('user/employee/documents')->with('success', 'Document Edited');
    }
    
    
    public function deleteDocument(DocumentModel $document) {
  
        $filePath = $document->document;
        
        if(file_exists($filePath)) {
            unlink($filePath);
        }
    
        $document->delete();

        return redirect('user/employee/documents')->with('success', 'Document Deleted');
    }   
}

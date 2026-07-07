<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .custom-modal-editemp{
           max-width:70% !important;
       }
   </style>
</head>
<body>
    <div class="modal fade" id="updateEmployee{{$empdoc->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered custom-modal-editemp">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Employee</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body d-flex gap-2">
                    @csrf

                    <div class="col p-3 border border-5" >
                        <div class="row">
                            <h5 class="d-flex justify-content-start">Credentials</h5>
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Username:</label>
                                <input type="text" name="username" id="username" value="{{$empdoc->username}}" class="form-control" required >
                            </div>

                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Password:</label>
                                <input type="password" name="password" id="password" value="{{$empdoc->password}}" class="form-control" required>
                            </div>
                        </div> 

                        <div class="row mt-3">
                            <h5 class="d-flex justify-content-start">Information</h5>
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">First Name:</label>
                                <input type="text" name="first_name" id="first_name" value="{{$empdoc->first_name}}" class="form-control" required>
                            </div>

                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" value="{{$empdoc->last_name}}" class="form-control" required>
                            </div>
                        </div> 

                        <div class="row mt-3">
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Date of Birth:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{$empdoc->date_of_birth}}" class="form-control" required>
                            </div>

                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Gender:</label>
                                <select class="form-select" name="gender" id="gender" class="form-control"required>
                                   <option value="{{$empdoc->gender}}" disabled selected hidden>{{$empdoc->gender}}</option>
                                   <option value="Male">Male</option>
                                   <option value="Female">Female</option>
                               </select>
                            </div>

                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Phone #:</label>
                                <input type="text" name="phone_number" id="phone_number" value="{{$empdoc->phone_number}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="column mt-3">
                            <h5 class="d-flex justify-content-start">Address</h5>
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Address:</label>
                                <input type="text" name="address" id="address" value="{{$empdoc->address}}" class="form-control" required>
                            </div>

                            <div class="col mt-3">
                                <label for="" class="d-flex justify-content-start">Email:</label>
                                <input type="email" name="email" id="email" value="{{$empdoc->email}}" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col p-3 border border-5" >
                        <div class="row">
                            <h5 class="d-flex justify-content-start">Job & Department</h5>
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Job:</label>
                                <select class="form-select" name="job_id" id="job_id" class="form-control"required>
                                    @foreach($jobs as $job)
                                    <option value="{{$empdoc->job_id}}" disabled selected hidden>{{$empdoc->job->job_title}}</option>
                                    <option value="{{$job->id}}">{{$job->job_title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Department:</label>
                                <select class="form-select" name="department_id" id="department_id" class="form-control"required>
                                    @foreach($depts as $dept)
                                    <option value="{{$empdoc->department_id}}" disabled selected hidden>{{$empdoc->department->department_name}}</option>
                                    <option value="{{$dept->id}}">{{$dept->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 

                        <div class="row mt-3">
                            <h5 class="d-flex justify-content-start">Status</h5>
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Work Status:</label>
                                <select class="form-select" name="work_status" id="work_status" class="form-control" required>
                                    <option value="{{$empdoc->work_status}}" disabled selected hidden>{{$empdoc->work_status}}</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Full Time">Full Time</option>
                                </select>
                            </div>
                        
                            <div class="col">
                                <label for="" class="d-flex justify-content-start">Employment Status:</label>
                                <select class="form-select" name="employment_status" id="employment_status" class="form-control" required>
                                    <option value="{{$empdoc->employment_status}}" disabled selected hidden >{{$empdoc->employment_status}}</option>
                                    <option value="Active">Active</option>
                                    <option value="Retired">Retired</option>
                                </select>
                            </div>
                        </div>   

                        <h5 class="d-flex justify-content-start mt-3">New Profile</h5>
                        <input type="file" name="profile" id="profile" class="form-control">

                        <h5 class="d-flex justify-content-start mt-3">Current Profile</h5>
                        <img src="{{asset($empdoc->profile)}}" style="width:100px; height:100px;" alt="">
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
 </div>
</body>
</html>
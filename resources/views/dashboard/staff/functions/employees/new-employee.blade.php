<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
         .custom-modal-addemp{
            max-width:70% !important;
        }
    </style>
</head>
<body>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered custom-modal-addemp">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">New Employee</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body d-flex gap-2">

                  
                        <div class="col p-3 border border-5" >
                            <div class="row">
                                <h5>Credentials</h5>
                                <div class="col">
                                    <input type="text" name="username" id="username" placeholder="Username" class="form-control" required >
                                </div>

                                <div class="col">
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                                </div>
                            </div> 

                            <div class="row mt-3">
                                <h5>Information</h5>
                                <div class="col">
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required>
                                </div>

                                <div class="col">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required>
                                </div>
                            </div> 

                            <div class="row mt-3">
                                <div class="col">
                                    <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" class="form-control" required>
                                </div>

                                <div class="col">
                                     <select class="form-select" name="gender" id="gender" class="form-control"required>
                                        <option value="" disabled selected hidden>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <input type="text" name="phone_number" id="phone_number" placeholder="Phone #" class="form-control" required>
                                </div>
                            </div>

                            <div class="column mt-3">
                                <h5>Address</h5>
                                <div class="col">
                                    <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>
                                </div>

                                <div class="col mt-3">
                                    <input type="email" name="email" id="email" placeholder="Email Address" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col p-3 border border-5" >
                            <div class="row">
                                <h5>Job & Department</h5>
                                <div class="col">
                                    <select class="form-select" name="job_id" id="job_id" class="form-control"required>
                                        @foreach($jobs as $job)
                                        <option value="" disabled selected hidden>List of Jobs</option>
                                        <option value="{{$job->id}}">{{$job->job_title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <select class="form-select" name="department_id" id="department_id" class="form-control"required>
                                        @foreach($depts as $dept)
                                        <option value="" disabled selected hidden>List of Department</option>
                                        <option value="{{$dept->id}}">{{$dept->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 

                            <div class="row mt-3">
                                <h5>Status</h5>
                                <div class="col">
                                    <select class="form-select" name="work_status" id="work_status" class="form-control" required>
                                        <option value="" disabled selected hidden>Work Status</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
                                    </select>
                                </div>
                            
                                <div class="col">
                                    <select class="form-select" name="employment_status" id="employment_status" class="form-control" required>
                                        <option value="" disabled selected hidden >Employment Status </option>
                                        <option value="Active">Active</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                            </div>   

                            <h5 class="mt-3">Profile</h5>
                            <input type="file" name="profile" id="profile" class="form-control" required>
                            
                            <input type="text" name="staff_id" id="staff_id" value="{{$staffID}}" hidden>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
 </div>
</body>
</html>
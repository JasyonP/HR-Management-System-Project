<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff - Job/Department</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
         .toast-top-center {
             top: 12px;
             margin: 0 auto;
             left: 0%;
        }

        #toast-container > .toast-success {
            background-color: #28a745 !important; 
        }

        #toast-container > .toast-error {
            background-color: #dc3545 !important; 
        }

        #toast-container > .toast-info {
            background-color: #17a2b8 !important; 
        }

        #toast-container > .toast-warning {
            background-color: #ffc107 !important; 
        }
    </style>

</head>
<body>
    

    
    @extends('dashboard\staff\layouts\dashboard')

    @section('content')

   <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                    <div class="d-flex flex-row justify-content-between">

                        <h1 class="h1-page">Jobs</h1>
                        <form action="/staff-create-job" method="POST" class="d-inline">
                            <div>
                            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createJob"> ADD JOB
                            </button>

                            </div>
                            @include('dashboard/staff/functions/job-department/new-job')
                        </form>
                    </div>

                <table class="table table-striped mt-3">
                    <thead class="text-center table-primary">
                        <tr>
                            <th scope="col" class="border border-1 fs-5">Title</th>
                            <th scope="col" class="border border-1 fs-5">Salary</th>
                            <th scope="col" class="border border-1 fs-5">Rank</th>
                            <th scope="col" class="border border-1 fs-5">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @foreach($jobs as $job)
                        <tr>
                            <th scope="row" hidden>{{$job->id}}</th>
                            <td class="border border-1 fs-6">{{$job->job_title}}</td>
                            <td class="border border-1 fs-6">{{$job->salary}}</td>
                            <td class="border border-1 fs-6">{{$job->rank->rank_level}}</td>
                            <td>

                                <form action="{{route('dashboard.job-update', $job->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#updateJob{{$job->id}}">EDIT
                                    
                                    </button>
                                    @include('dashboard/staff/functions/job-department/edit-job')
                                </form>

                                <form action="{{route('dashboard.job-delete', $job->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmJobDelete{{$job->id}}">DELETE
                                    
                                    </button>
                                    @include('dashboard/staff/functions/job-department/delete-job')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row justify-content-between">
                    <h1 class="h1-page">Departments</h1>
                    <form action="/staff-create-department" method="POST" class="d-inline">
                        <div>
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createDepartment"> ADD DEPARTMENT</button>
                        </div>

                        @include('dashboard/staff/functions/job-department/new-department')
                    </form>
                </div>

                <table class="table table-striped mt-3">
                    <thead class="text-center table-primary">
                        <tr>
                            <th scope="col " class="border border-1 fs-5">Name</th>
                            <th scope="col " class="border border-1 fs-5">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @foreach ($depts as $dept)
                        <tr>
                            <th scope="row" hidden>{{$dept->id}}</th>
                            <td class="border border-1 fs-6">{{$dept->department_name}}</td>
                            <td>

                                <form action="{{route('dashboard.dept-update', $dept->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-custom1 " data-bs-toggle="modal" data-bs-target="#updateDept{{$dept->id}}">EDIT</button>
    
                                    @include('dashboard/staff/functions/job-department/edit-department')
                                </form>

                                <form action="{{route('dashboard.dept-delete', $dept->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeptDelete{{$dept->id}}">DELETE</button>
    
                                    @include('dashboard/staff/functions/job-department/delete-department')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@if (session('success'))
<script>
    toastr.options = {
        positionClass : "toast-top-center"
    };

    toastr.success('{{ session('success') }}');
</script>
@endif
</html>
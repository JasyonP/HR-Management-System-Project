<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff - Employees</title>
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

    <h1 class="h1-page">Employees</h1>

    {{-- Create Employee ------------------------------------------------------------------------------------------------------------------------------------------------------}}


    <div class="d-flex flex-row justify-content-between">

        <div class="d-flex justify-content-center align-items-center gap-2">
            
            <form action="/staff-create-employee" method="POST" class="d-inline" enctype="multipart/form-data">
                @csrf
        
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createModal">
                    ADD
                </button>
                @include('dashboard/staff/functions/employees/new-employee')
        
            </form>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-2">
            <form id="searchForm" action="{{route('dashboard.search-employee')}}" method="GET">
                <div class="input-group mt-2 ">
                    <input id="searchInput" type="search" name="search" class="form-control" value="{{ request()->input('search') }}"  placeholder="Search" required>
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
    
        </div>
    </div>
     {{----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

     @if($empdocs->isEmpty())
     <div class="d-flex justify-content-center align-items-center h-100">
         <div class="text-center mt-5">
             <p>No records found.</p>
         </div>
     </div>
     @else

     {{-- List of Employees -------------------------------------------------------------------------------------------------------------------------------------------------------------}}
        <div class="d-flex justify-content align-items-center h-100 w-100">

            <table class="table table-striped mt-2 table-hover" >
                <thead>
                <tr class="text-center table-primary">
                    <th scope="col" class="border border-1 fs-5">Profile</th>    
                    <th scope="col" class="border border-1 fs-5">Name</th>                   
                    <th scope="col" class="border border-1 fs-5">Workload</th>
                    <th scope="col" class="border border-1 fs-5">Employment Status</th>
                    <th scope="col" class="border border-1 fs-5">Job </th>
                    <th scope="col" class="border border-1 fs-5">Department</th>
                    <th scope="col" class="border border-1 fs-5">Added by</th>
                    <th scope="col" class="border border-1 fs-5">Action</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($empdocs as $empdoc)
                        
                <tr class="text-center align-middle">
                    <th scope="row" hidden>{{$empdoc->id}}</th>
                    <td>
                        <img src="{{asset($empdoc->profile)}}" style="width:70px; height:70px;" alt="">
                    </td>
                    <td class="border border-1 fs-6">{{$empdoc->first_name}} {{$empdoc->last_name}}</td>
                    <td class="border border-1 fs-6">{{$empdoc->work_status}}</td>
                    <td class="border border-1 fs-6">{{$empdoc->employment_status}}</td>
                    <td class="border border-1 fs-6">{{$empdoc->job->job_title}}</td>
                    <td class="border border-1 fs-6">{{$empdoc->department->department_name}}</td>
                    <td class="border border-1 fs-6">{{$empdoc->staff->first_name}} {{$empdoc->staff->last_name}}</td>

                    <td>


                        <div class="modals">

                            <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#viewEmployee{{$empdoc->id}}">VIEW</button>

                            @include('dashboard/staff/functions/employees/view-employee')

                            <form action="{{route('employee.docs', $empdoc->id)}}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-custom1" >DOCUMENTS</button>
                            </form>

                            <form action="{{route('dashboard.employees-update', $empdoc->id)}}" method="POST" class="d-inline" enctype="multipart/form-data">
                                @csrf
                                <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#updateEmployee{{$empdoc->id}}">EDIT</button>

                                @include('dashboard/staff/functions/employees/edit-employee')
                            </form>

                            <form action="{{route('dashboard.employees-delete', $empdoc->id)}}" method="POST" class="d-inline" >
                                @csrf
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{$empdoc->id}}">DELETE</button>

                                @include('dashboard/staff/functions/employees/delete-employee')
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
               
                </tbody>
            </table>
            @endif
    </div>

    {{ $empdocs->appends(['search' => request()->input('search')])->links() }}

    @endsection
    
</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');

        // Add input event listener to dynamically update URL
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.trim(); // Trim whitespace
            const currentUrl = new URL(window.location.href);

            // Update search query parameter in URL
            if (searchValue) {
                currentUrl.searchParams.set('search', searchValue);
            } else {
                currentUrl.searchParams.delete('search');

                // Redirect to /staff/medicines if search input is empty
                window.location.href = '/user/staff/employees-list';
                return; // Stop further execution
            }

            // Redirect to updated URL
            window.history.replaceState({}, '', currentUrl);
        });
    });
</script>

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
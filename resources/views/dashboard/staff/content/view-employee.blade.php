<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    @extends('dashboard\staff\layouts\dashboard')

    @section('content')

    <h1 class="h1-page">Employee</h1>

    <div class="container mt-3">

        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex justify-content-center align-items-center gap-2 ">
                {{-- <form action="/user/staff/employees-list" method="GET">
                    <button class="btn btn-primary mb-2">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                          </svg>
                          
                          GO BACK</button>
                </form> --}}

                <form action="/user/staff/employees-list" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-primary mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                    GO BACK
                </button>
              </form>
            </div>
            
        </div>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr class=" text-center table-primary">
              <th class="fs-5">Profile</th>
              <th class="fs-5">Name</th>
              <th class="fs-5">Workload</th>
              <th class="fs-5">Employment Status</th>
              <th class="fs-5">Job</th> 
              <th class="fs-5">Department</th>
              <th class="fs-5">Added by</th>
            </tr>
          </thead>
          <tbody>
            <tr class="text-center align-middle">
                <td>
                    <img src="{{asset($employeeid->profile)}}" style="width:70px; height:70px;" alt="">
                </td>
              <td class="border border-1 fs-6">{{$employeeid->first_name}} {{$employeeid->last_name}}</td>
              <td class="border border-1 fs-6">{{$employeeid->work_status}}</td>
              <td class="border border-1 fs-6">{{$employeeid->employment_status}}</td>
              <td class="border border-1 fs-6">{{$employeeid->job->job_title}}</td>
              <td class="border border-1 fs-6">{{$employeeid->department->department_name}}</td>
              <td class="border border-1 fs-6">{{$employeeid->staff->first_name}} {{$employeeid->staff->last_name}}</td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>

      <div class="container">

        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr class="table-primary text-center">
                <tr class="table-primary text-center">
                    <th class="fs-5" colspan="2">Documents</th> <!-- Top row with border -->
                </tr>
                <tr class="table-primary text-center">
                    <th class="fs-5">Name</th>
                    <th class="fs-5">Action</th>
                </tr>
            </tr>
          </thead>
          <tbody>
            @foreach ($documents as $docs)
            <tr class="text-center align-middle">
              <td class="border border-1 fs-6">{{$docs->name}}</td>
              <td >
                    <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#viewDocs{{$docs->id}}">VIEW</button>

                    @include('dashboard/employee/functions/employee-docs/view-docs')
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $documents->appends(['search' => request()->input('search')])->links() }}
    @endsection
    
</body>

<script>
  function goBack() {
      window.history.back();
  }
</script

</html>
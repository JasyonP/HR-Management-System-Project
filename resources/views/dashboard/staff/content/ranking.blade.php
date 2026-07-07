<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff - Ranking</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    @extends('dashboard\staff\layouts\dashboard')

    @section('content')

    <h1 class="h1-page">Ranking</h1>

    <div class="d-flex flex-row justify-content-between">

        <div class="d-flex justify-content-center align-items-center gap-2">

            <form method="GET" action="{{ route('rankPage') }}">
                <div class="input-group">
                    <select name="department_id" id="department_id" class="form-select" required>
                        <option value="all" {{ ($departmentId === 'all') ? 'selected' : '' }}>Select as All</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ ($departmentId == $department->id) ? 'selected' : '' }}>
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @if($employees->isEmpty())
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center mt-5">
            <p>No records found.</p>
        </div>
    </div>
    @else

    <table class="table table-striped mt-2">
        <thead>
            <tr class="text-center table-primary">
                <th scope="col" class="border border-1 fs-4">Name</th>
                <th scope="col" class="border border-1 fs-4">Job</th>
                <th scope="col" class="border border-1 fs-4">Department</th>
                {{-- <th>Rank ID</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr class="text-center align-middle">
                <td class="border border-1 fs-5">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td class="border border-1 fs-5">{{ $employee->job->job_title }}</td>
                <td class="border border-1 fs-5">{{ $employee->department->department_name }}</td>
                {{-- <td>{{ $employee->id }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Pagination links -->
    {{ $employees->links() }}

    @endsection
</body>
</html>

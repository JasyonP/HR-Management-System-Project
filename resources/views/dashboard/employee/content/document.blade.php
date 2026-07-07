<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee - Documents</title>
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

    @extends('dashboard\employee\layouts\dashboard')

    @section('content')

    <h1 class="h1-page">Documents</h1>

    <div>
        <form action="/employee-create-docs" method="POST" class="d-inline" enctype="multipart/form-data">
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#newDocs">ADD
            
            </button>

            @include('dashboard/employee/functions/employee-docs/new-docs')
        </form>
    </div>

    
    @if($documents->isEmpty())
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center mt-5">
            <p>Empty.</p>
        </div>
    </div>
    @else


    <table class="table mt-2 table-striped table-hover" >
        <thead>
            <tr class="text-center table-primary">
                <th scope="col" class="border border-1 fs-5">Document Name</th>                   
                <th scope="col" class="border border-1 fs-5">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($documents as $docs)

            <tr class="text-center align-middle">
                <th scope="row" hidden>{{$docs->id}}</th>
                    <td>{{$docs->name}}</td>
                    <td>
                            <div>
                                
                                {{-- <a href="{{ asset($docs->document) }}" download="{{ $docs->name }}" class="btn btn-success" onclick="return confirmDownload('{{ $docs->name }}')">DOWNLOAD</a> --}}
                              
                                    <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#viewDocs{{$docs->id}}">VIEW</button>

                                    @include('dashboard/employee/functions/employee-docs/view-docs')

                                <form action="{{route('dashboard.docs-edit', $docs->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-custom1" data-bs-toggle="modal" data-bs-target="#editDocs{{$docs->id}}">EDIT</button>

                                    @include('dashboard/employee/functions/employee-docs/edit-docs')
                                </form>
                                   
                                <form action="{{route('dashboard.docs-delete', $docs->id)}}" method="POST" class="d-inline" >
                                    @csrf
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteDocs{{$docs->id}}">DELETE</button>

                                    @include('dashboard/employee/functions/employee-docs/delete-docs')
                                </form>
                            </div>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{ $documents->appends(['search' => request()->input('search')])->links() }}
</body>

<script>
    function confirmDownload(documentName) {
        return confirm('Are you sure you want to download ' + documentName + '?');
    }
    </script>
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
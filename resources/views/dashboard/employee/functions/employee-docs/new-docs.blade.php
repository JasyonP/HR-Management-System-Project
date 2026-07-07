<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="modal fade" id="newDocs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">New Document</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                        @csrf     
                        
                            <div class="col">
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" required >
                            </div>

                            <div class="col mt-3">
                                <input type="file" name="document" id="document" class="form-control" required >
                            </div>

                            <div class="col mt-3">
                                <input type="text" name="employee_id" id="employee_id" value="{{$employeeID}}" class="form-control" hidden>
                            </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="sumbit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</body>
</html>
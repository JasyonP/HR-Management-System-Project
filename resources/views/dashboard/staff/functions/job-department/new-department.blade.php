<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="modal fade" id="createDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">New Department</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">

                        @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="" class="d-flex justify-content-start fw-bold">Name:</label>
                                    <input type="text" name="department_name" id="department_name" class="form-control" required >
                                </div>
                        </div>
                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="sumbit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
 </div>
</body>
</html>
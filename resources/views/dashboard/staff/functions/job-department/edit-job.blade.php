<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="modal fade" id="updateJob{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">Edit Job</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">

                        @csrf
                            <div class="col">
                                <label for="" class="d-flex justify-content-start fw-bold">Title:</label>
                                <input type="text" name="job_title" id="job_title" value="{{$job->job_title}}" class="form-control" required >
                            </div>
                        
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="" class="d-flex justify-content-start fw-bold">Salary:</label>
                                    <input type="text" name="salary" id="salary" value="{{$job->salary}}" class="form-control" required >
                                </div>
                           

                                <div class="col">
                                    <label for="" class="d-flex justify-content-start fw-bold">Rank:</label>
                                    <select class="form-select" name="rank_id" id="job_id" class="form-control"required>
                                        @foreach($ranks as $rank)
                                        <option value="{{$rank->id}}" disabled selected hidden>{{$rank->rank_level}}</option>
                                        <option value="{{$rank->id}}">{{$rank->rank_level}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
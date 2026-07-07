<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Custom CSS to adjust modal width */
        .custom-modalview {
            max-width: 70%; /* Adjust the width as per your requirement */
            max-height: 20%; /* Adjust the width as per your requirement */
            /* max-height: auto; */
        }

        .modal-body img {
            max-width: 100%;
            max-height: 100%;
        }
        
    </style>
    
</head>
<body>
    <div class="modal fade" id="viewDocs{{$docs->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered custom-modalview">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="exampleModalLabel">{{$docs->name}} | <a href="{{asset ($docs->document)}}" download>Click here to download</a></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @php
                    $fileExtension = pathinfo($docs->document, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                    <img src="{{ asset($docs->document) }}" alt="{{ $docs->name }}" style="width: 30%">
                    @elseif(in_array($fileExtension, ['doc', 'docx']))
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{asset($docs->document)}}" frameborder="0"></iframe>
                    @else
                    <iframe src="{{asset ($docs->document)}}" style="width: 100%;height: 90vh; border: none;"></iframe>
                    @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
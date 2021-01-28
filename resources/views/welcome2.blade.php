<!DOCTYPE html>
<html>
<head>
    <title>PHP Dropzone File Upload on Button Click Example</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    {{--<link rel="stylesheet" href="{{ asset('dist/min/basic.min.css.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('dist/min/dropzone.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }

        .dropzone .dz-preview .dz-error-message {
            top: 150px;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('list') }}" class="btn btn-success" style="margin-bottom: 10px">List</a>

            <h2>PHP Dropzone File Upload on Button Click Example</h2>

            <form name="form" action="{{ route('upload') }}" method="post" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input name="phone" type="number" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter phone number">
                </div>
            </form>

            <button type="submit" class="btn btn-primary" style="margin-top: 10px" id="uploadFile">Upload Files</button>
        </div>
    </div>
</div>

<script type="text/javascript">

    let dropZone;

    Dropzone.options.dropzone = {
        url: '{{ route('upload') }}',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        dictFileTooBig: 'fsdfdsf',
        init: function () {
            dropZone = this; // Makes sure that 'this' is understood inside the functions below.

            // $('#uploadFile').click(function () {
            //     dropZone.processQueue();
            // })

            // for Dropzone to process the queue (instead of default form behavior):
            // document.getElementById("uploadFile").addEventListener("click", function(e) {
            //     // Make sure that the form isn't actually being sent.
            //     // e.preventDefault();
            //     // e.stopPropagation();
            // });

            //send all the form data along with the files:
            this.on("maxfilesexceeded", function (file) {
                this.removeFile(file);
            });

            // this.on("success", function (errorMessage) {
            //     console.log(errorMessage)
            //     console.log('rrorororor')
            // });
        }
    }

    $('#uploadFile').click(function () {

        let dropzoneFiles = dropZone.files,
            imageFiles = []

        // filter only success image files
        Object.keys(dropzoneFiles).filter(function (key) {
            if (dropzoneFiles[key].status === 'queued') {
                imageFiles.push(dropzoneFiles[key])
            } else {
                dropZone.removeFile(dropzoneFiles[key]);
            }
        })

        let form = document.getElementById('dropzone')

        let fd = new FormData(form);
        fd.append('files[]', imageFiles[0])
        fd.append('files[]', imageFiles[1])

        axios.post('{{ route('upload') }}', fd)
            .then(res => {
                console.log(res.data)
            })
            .catch(error => {
                $.each(error.response.data.errors, function (k, error) {
                    console.log(error[0])
                });
            })
    })

</script>

</body>
</html>

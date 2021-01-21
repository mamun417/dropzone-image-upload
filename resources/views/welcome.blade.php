<!DOCTYPE html>
<html>
<head>
    <title>PHP Dropzone File Upload on Button Click Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>PHP Dropzone File Upload on Button Click Example</h2>
            <form name="form" action="{{ route('upload') }}" method="post" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">

                @csrf
                <input type="text" name="name" value="">
                <input type="email" name="email" value="">
                <input type="text" name="phone" value="">
                <input type="text" name="address" value="">

                <div>
                    <h3>Upload Multiple Image By Click On Box</h3>
                </div>
            </form>
            <button id="uploadFile">Upload Files</button>
        </div>
    </div>
</div>

<script type="text/javascript">

    Dropzone.options.dropzone = {
        url: '{{ route('upload') }}',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
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
            // this.on("sending", function(data, xhr, formData) {
            //     formData.append("firstname", 'Abdullah Al Mamun');
            // });

            // this.on("success", function (errorMessage) {
            //     console.log(errorMessage)
            //     console.log('rrorororor')
            // });
        }
    }

    $('#uploadFile').click(function () {

        let form = document.getElementById('dropzone')

        console.log(dropZone.files)

        let fd = new FormData(form);
        fd.append('name', 'lll')
        fd.append('files[]', dropZone.files[0])
        fd.append('files[]', dropZone.files[1])

        axios.post('{{ route('upload') }}', fd)
            .then(res => {
                console.log(res)
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

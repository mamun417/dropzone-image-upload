<a href="{{ route('data.index') }}" class="btn btn-dark" style="margin-bottom: 10px">List</a>
<a href="{{ route('data.create') }}" class="btn btn-dark" style="margin-bottom: 10px">Add New</a>

<h2>PHP Dropzone File Upload on Button Click Example</h2>

<form name="form" action="{{ route('data.store') }}" method="post" enctype="multipart/form-data"
      class="dropzone shadow p-3 bg-white rounded" id="dropzone">
    @csrf

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter name"
                       value="{{ @$data->name }}">

                <small class="text-danger error_msg"></small>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter email"
                       value="{{ @$data->email }}">

                <small class="text-danger error_msg"></small>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input name="phone" type="number" class="form-control" id="exampleInputEmail1"
               aria-describedby="emailHelp"
               placeholder="Enter phone number"
               value="{{ @$data->phone }}">

        <small class="text-danger error_msg"></small>
    </div>

    @isset($edit)
        <div class="form-group">
            <label for="exampleInputEmail1">Images</label>

            <div class="row">
                @foreach($data->images as $image)
                    <div class="col-sm-2">
                        <div>
                            <img class="preview-image shadow mb-2 bg-white rounded" src="{{ $image->url }}" alt="">
                        </div>
                        <div class="text-center">
                            <button onclick="imageRemove('{{ $image->id }}')" type="button"
                                    class="btn btn-sm btn-danger">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endisset

</form>

<button type="submit" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 100px" id="uploadFile">
    {{ isset($edit) ? 'Update' : 'Submit' }}
</button>

<span id="imageError" class="text-danger"></span>

@push('script')
    <script type="text/javascript">

        let dropZone,
            maxFile = 5;

        Dropzone.options.dropzone = {
            {{--url: '{{ route('data.store') }}',--}}
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: maxFile,
            maxFiles: maxFile,
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
                    $('#imageError').html(`You can not upload more than ${maxFile} file.`);
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
            Object.keys(dropzoneFiles).forEach(function (key) {
                if (dropzoneFiles[key].status === 'queued') {
                    imageFiles.push(dropzoneFiles[key])
                } else {
                    dropZone.removeFile(dropzoneFiles[key]);
                }
            })

            let form = document.getElementById('dropzone')

            let fd = new FormData(form);

            imageFiles.forEach(function (file, key) {
                fd.append('files[]', file)
            })

            axios.post('{{ route('data.store') }}', fd)
                .then(res => {
                    location.href = res.data.redirect_url
                    console.log(res.data)
                })
                .catch(error => {

                    $('.error_msg').html('');

                    if (error.response.data.errors) {
                        $.each(error.response.data.errors, function (input, error) {
                            $(`input[name=${input}]`).next('.error_msg').html(error[0]);
                        });
                    }
                })
        })

        function imageRemove(image_id) {
            axios.post('{{ route('data.image-remove', '') }}/' + image_id,)
                .then(function (res) {
                    console.log(res.data)
                })
        }
    </script>
@endpush

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
            border: none;
            /*border: 2px dashed #0087F7;*/
            /*border-radius: 5px;*/
            /*background: white;*/
        }

        .dropzone .dz-preview .dz-error-message {
            top: 150px;
        }

        .preview-image {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-12">
            @include('element', ['edit' => true])
        </div>
    </div>
</div>

@stack('script')

</body>
</html>

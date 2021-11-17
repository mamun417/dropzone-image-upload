<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

<div class="container" style="margin-top: 80px">
    <h3 class="text-center">Image upload with dropzone</h3>
    <a href="{{ route('data.create') }}" class="btn btn-dark float-right"
       style="margin-bottom: 10px">
        Add New
    </a>

    <a href="{{ route('crop-image-upload') }}" class="btn btn-dark float-right" style="margin-bottom: 10px;margin-right: 10px">
        Add Crop Image
    </a>

    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th class="text-center" scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($all_data as $key => $data)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ ucfirst($data->name) }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td class="text-center">
                    <a class="btn btn-sm btn-info" href="{{ route('data.edit', $data->id) }}">Edit</a>
                    <a class="btn btn-sm btn-danger" href="">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

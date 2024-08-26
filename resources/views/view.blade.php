<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @if(Session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="container">
        <h1>Studend's Record!</h1>
    </div>
    <tr>
        <form action="{{route('view')}}" method="get">
            <input type="search" name="search" id="search" placeholder="search" class="form-control w-25 m-3">
            <input type="submit" value="search" class="btn btn-success btn-hover m-1 btn-sm">
            <a href="{{route('view')}}" class="btn btn-danger btn-hover btn-sm">Back</a>
        </form>
    </tr>
    <tr>
        <a href="{{url('/form')}}" class="btn btn-info btn-hover m-3 float-end">Add Data</a>
    </tr>
    @if($message)
    <div class="alert alert-warning">
        {{ $message }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">S.No.</th> -->
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Qualification</th>
                <th scope="col">File</th>
            </tr>
        </thead>
        <tbody>

            @foreach($data as $val)
            <tr>
                <td>{{$val->name}}</td>
                <td>{{$val->email}}</td>
                <td>{{$val->address}}</td>
                <td>{{$val->qualification}}</td>
                <td>
                    @php
                    $filenames = json_decode($val->file);
                    @endphp
                    @if(is_array($filenames) && !empty($filenames))
                    @foreach($filenames as $filename)
                    <div style="display:inline-block; margin: 5px;">
                        <img src="{{ asset('storage/upload/' . $filename) }}" height="100px" width="120px" alt="Image">
                    </div>
                    @endforeach
                    @else
                    <p>No images available</p>
                    @endif
                </td>
                <td>
                    <a href="{{url('/edit',$val->id)}}" class="btn btn-hover btn-success btn-sm">Edit</a>
                    <a href="{{url('/delete',$val->id)}}" class="btn btn-hover btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
        <div class="row">
            {{$data->links('pagination::bootstrap-5')}}
        </div>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
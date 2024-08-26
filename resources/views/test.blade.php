<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UserData</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
            height: auto;
            width: 600px;
            margin-bottom: 10px;
            padding: 5px;
            background: #fff;
            border: solid grey 2px;
        }

        .box {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Enter Your Detail's</h1>
    </div>
    <div class="container">
        <form action="{{ !empty($student->id) ? url('/update/' . $student->id) : url('/formdata') }}" method="post" class="card-p-4" enctype="multipart/form-data">
            <input type="hidden" value="{{ !empty($student->id) ? $student->id : '' }}" name="student_id">

            @csrf
            <div class="form-group bg-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{old('name',$student->name ?? '')}}" id="name" spellcheck="true" class="form-control">
            </div>
            <div class="form-group bg-3">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('address',$student->email ?? '')}}" id="email" class="form-control">
            </div>
            <div class="form-group bg-3">
                <label for="address">Address</label>
                <input type="text" name="address" value="{{old('address',$student->address ?? '')}}" id="address" spellcheck="true" class="form-control">
            </div>
            <div class="form-group bg-3">
                <label for="Qualification">Qualification</label>
                <input type="text" name="qualification" value="{{old('qualification',$student->qualification ?? '')}}" id="qualification" spellcheck="true" class="form-control">
            </div>
            <div class="form-group bg-3">
                <label for="image">Image</label>
                <input type="file" accept="*images/" name="file[]" multiple value="{{old('file',$student->file ?? '')}}" id="file" class="form-control">
            </div>
            <div class="box"> <a href="{{url('/view')}}" class="btn btn-danger btn-hover">Back</a>

                <input type="submit" value="submit" class="btn btn-hover btn-primary mt-6 float-end">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
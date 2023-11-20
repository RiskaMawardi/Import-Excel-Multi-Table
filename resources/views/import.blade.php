<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Import File Excel</title>
</head>

<body>
    <h1></h1>
    <div class="container">
        <h3 align="center">Import Excel File</h3><br />@if(count($errors) > 0)<div
            class="alert alert-danger">Upload Validation Error<br><br>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>@endif @if($message = Session::get('success'))<div class="alert alert-success alert-block"><button
                type="button" class="close" data-dismiss="alert">×</button><strong>{{ $message }}</strong></div>@endif
        <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">{{ csrf_field() }}
            <div class="form-group">
                <table class="table">
                    <tr>
                        <td width="40%" align="right"><label>Select File for Upload</label></td>
                        <td width="30"><input type="file" name="select_file" /></td>
                        <td width="30%" align="left"><input type="submit" name="upload" class="btn btn-primary"
                                value="Upload"></td>
                    </tr>
                    <tr>
                        <td width="40%" align="right"></td>
                        <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                        <td width="30%" align="left"></td>
                    </tr>
                </table>
            </div>
        </form>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

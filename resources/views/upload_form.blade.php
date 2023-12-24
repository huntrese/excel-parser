<!DOCTYPE html>
<html>
<head>
    <title>Upload Excel</title>
</head>
<body>
    <form method="post" action="{{ route('upload.process') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>

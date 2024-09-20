<!DOCTYPE html>
<html>
<head>
    <title>PDF to Image</title>
</head>
<body>
    <h1>Upload PDF and Convert to Image</h1>

    <form action="/convert-pdf" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf" accept="application/pdf">
        <button type="submit">Convert PDF to Image</button>
    </form>
</body>
</html>

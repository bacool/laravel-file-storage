<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Storage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>File Upload</h2>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="file" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <h3 class="mt-4">Uploaded Files</h3>
    <ul id="fileList" class="list-group">
        @foreach($files as $file)
            <li class="list-group-item d-flex justify-content-between">
                {{ $file->filename }}
                <button class="btn btn-danger btn-sm" onclick="deleteFile({{ $file->id }})">Delete</button>
            </li>
        @endforeach
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('upload') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function () { location.reload(); }
        });
    });

    function deleteFile(id) {
        $.ajax({
            url: "/delete/" + id,
            type: "DELETE",
            data: { _token: "{{ csrf_token() }}" },
            success: function () { location.reload(); }
        });
    }
</script>
</body>
</html>

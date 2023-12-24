<!DOCTYPE html>
<html>
<head>
    <title>Timetable Upload</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .upload-container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="csvFile" name="csv_files[]" accept=".csv" multiple>
                <label class="custom-file-label" id="csvFileLabel" for="csvFile">Choose CSV files</label>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <div id="uploadResult" class="mt-3"></div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
    
            const files = document.getElementById('csvFile').files;
            if (files.length === 0) {
                alert('Please select at least one file.');
                return;
            }
    
            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('csv_files[]', files[i]);
            }
    
            // Send the form data to the backend
            fetch('{{ route("excel.upload") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Display the upload result from the backend
                displayUploadResult(data, files);
            })
            .catch(error => console.error('Error:', error));
        });
    
        function displayUploadResult(data, files) {
            const uploadResultDiv = document.getElementById('uploadResult');
            uploadResultDiv.innerHTML = ''; // Clear previous results
    
            // Display the upload result message
            const fileNames = Array.from(files).map(file => file.name).join(', ');
            document.getElementById('csvFileLabel').innerText = fileNames;
    
            if (data.success) {
                uploadResultDiv.innerText = data.message;
            } else {
                uploadResultDiv.innerText = 'There was an error uploading the files.';
            }
        }
    </script>
</body>
</html>

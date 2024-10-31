@extends('layouts.app')

<style>
    /* Container */
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.title {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Button Styles */
.btn-upload,
.btn-submit {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-upload:hover,
.btn-submit:hover {
    background-color: #45a049;
}

/* Form Styling */
.form-upload {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-label {
    font-size: 16px;
    color: #555;
}

.form-input {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s;
}

.form-input:focus {
    border-color: #4CAF50;
}

/* File List */
.file-list {
    list-style: none;
    padding: 0;
}

.file-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.file-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.file-name {
    font-size: 18px;
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s;
}

.file-name:hover {
    color: #0056b3;
}

.btn-edit,
.btn-delete {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-edit {
    background-color: #ffc107;
    color: #fff;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-delete {
    background-color: #dc3545;
    color: #fff;
}

.btn-delete:hover {
    background-color: #c82333;
}

.delete-form {
    display: inline;
    margin: 0;
}

.error-message {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
}

.image-preview {
    max-width: 100%;
    height: auto;
    margin-top: 15px;
    display: none; /* Hidden by default, shown only if an image is selected */
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

</style>

@section('content')
<div class="container">
    <h2 class="title">Upload New File</h2>
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="form-upload">
        @csrf
        <label for="file" class="form-label">Choose File</label>
        <input type="file" name="file" id="file" class="form-input" required onchange="previewImage(event)">

        <img id="imagePreview" class="image-preview" alt="Image Preview">

        @if ($errors->has('file'))
            <span class="error-message">{{ $errors->first('file') }}</span>
        @endif

        <button type="submit" class="btn-submit">Upload</button>
    </form>
</div>


<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            imagePreview.src = '';
        }
    }
</script>

@endsection

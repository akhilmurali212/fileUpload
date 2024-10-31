@extends('layouts.app')

<style>
    /* Container styling */
    .file-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .file-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-download {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
        margin-top: 15px;
    }

    .btn-download:hover {
        background-color: #45a049;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
        margin-bottom: 15px;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }

    /* Image Preview Styling */
    .image-preview {
        max-width: 100%;
        height: auto;
        margin-top: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

@section('content')
<div class="file-container">
    <a href="{{ route('files.index') }}" class="btn-back">Back to Files</a> <!-- Back Button -->
    <h2 class="file-title">{{ $file->name }}</h2>

    <!-- Image Preview -->
    @if (in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('storage/' . $file->file_path) }}" alt="Image Preview" class="image-preview">
    @endif

    <a href="{{ asset('storage/' . $file->file_path) }}" download class="btn-download">Download</a>
</div>
@endsection

@extends('layouts.app')
 

<style>
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

.btn-upload {
    display: inline-block;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-upload:hover {
    background-color: #45a049;
}

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

.btn-edit, .btn-delete {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-edit {
    background-color: #ffc107;
    color: #fff;
    text-decoration: none;
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

</style>

@section('content')
<div class="container">
    <h2 class="title">Files</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('files.create') }}" class="btn-upload">Upload New File</a>
    <ul class="file-list">
        @foreach($files as $file)
            <li class="file-item">
                <div class="file-info">
                    <a href="{{ route('files.show', $file->id) }}" class="file-name">{{ $file->name }}</a>
                    <a href="{{ route('files.edit', $file->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>



@endsection

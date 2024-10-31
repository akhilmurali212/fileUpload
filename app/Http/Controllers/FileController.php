<?php

namespace App\Http\Controllers;


use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = FileUpload::all();
        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        FileUpload::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $file)
    {
        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $file)
    {

        // dd($file);
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $file)
    {
        $request->validate([
            'file' => 'file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($file->file_path);
            $path = $request->file('file')->store('uploads', 'public');
            $file->update([
                'name' => $request->file('file')->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

        return redirect()->route('files.index')->with('success', 'File updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileUpload $file)
    {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}

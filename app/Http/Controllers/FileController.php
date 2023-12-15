<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function viewFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:docx|max:2048', // Adjust the validation rules as needed
        ]);
        if ($request->hasFile('file')) {

            $docxFile = $request->file('file');
            $name = $docxFile->getClientOriginalName();

            $docxFile->move(public_path().'/storage/directory', $name);    
        }
    }
}

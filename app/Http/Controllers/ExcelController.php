<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ExcelController extends Controller
{
    public function index()
    {
        return view('excel_index');
    }

    public function upload(Request $request)
    {
        $availableVariants = ['Groups and Subjects (FAF Hack) - Cabinete.csv', 'Groups and Subjects (FAF Hack) - Grupe.csv', 'Groups and Subjects (FAF Hack) - Profesori.csv', 'Groups and Subjects (FAF Hack) - Subiecte.csv'];
        $folderPath = public_path('csv_folder');

        if ($request->hasFile('csv_files')) {
            $csvFiles = $request->file('csv_files');
            $validFiles = [];
            $invalidFiles = [];

            foreach ($csvFiles as $file) {
                $fileName = $file->getClientOriginalName();

                if (in_array($fileName, $availableVariants)) {
                    $file->move($folderPath, $fileName);
                    $validFiles[] = $folderPath . '/' . $fileName;
                } else {
                    $invalidFiles[] = $fileName;
                }
            }

            // If there are invalid files, return them to the view
            if (!empty($invalidFiles)) {
                return back()->with('invalidFiles', $invalidFiles);
            }
            $response = Http::post('http://localhost:5000/upload');            
        }

        return back()->with('error', 'No files uploaded.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use App\Imports\ImportExcel;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ExportUsers()
    {
        return Excel::download(new ExportExcel(), 'users.xlsx');
    }
    public function ImportUsers(Request $request)
    {
        // validate the request pramaeters and check if the file upload has valid extension
        $request->validate([
            'file_input' => 'required|mimes:xlsx,xls',
        ]);
        // import the file
        Excel::import(new ImportExcel(), $request->file('file_input'));

        return back()->with('success', 'Users imported successfully.');
    }
}

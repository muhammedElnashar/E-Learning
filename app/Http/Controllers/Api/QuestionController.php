<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ExamImport;
use App\Imports\TestImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function store(Request $request) {
        $file = $request->file("excel_file");
        Excel::import(new TestImport, $file, null, \Maatwebsite\Excel\Excel::CSV);
    }
}

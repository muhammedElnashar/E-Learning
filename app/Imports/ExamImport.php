<?php

namespace App\Imports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ExamImport implements ToCollection
{
    public function collection(Collection $rows)
    {
    }
}

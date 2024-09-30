<?php

namespace App\Imports;

use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;

class ExamImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Test([
            "question" =>$row["question"],
            "answer" =>$row["answer"],
        ]);
    }
}

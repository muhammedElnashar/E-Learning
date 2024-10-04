<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;

class TestImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $test=Test::Where('deleted_at',null)->latest('created_at')->first();
        return new Question([
            "test_id"=>$test->id,
            "question_text" =>$row[0],
        ]);

    }
}

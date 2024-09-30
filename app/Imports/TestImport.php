<?php

namespace App\Imports;

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
            "question" =>$row[0],
            "answer" =>$row[1],
            "test_id"=>$test->id
        ]);
    }
}

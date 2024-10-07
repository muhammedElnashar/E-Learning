<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ExamImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $test=Test::Where('deleted_at',null)->latest('created_at')->first();

        foreach ($rows as $index => $row) {
            Answer::create([
                'question_id' => $test->questions[$index]->id,
                'answer_text' => $row[1],
                'is_correct'  => $row[2] == 'true' ? 1 : 0,

            ]);
            if (!empty($row[3])) {
                Answer::create([
                    'question_id' => $test->questions[$index]->id,
                    'answer_text' => $row[3],
                    'is_correct'  => $row[4] == 'true' ? 1 : 0,
                ]);
            }

            if (!empty($row[5])) {
                Answer::create([
                    'question_id' => $test->questions[$index]->id,
                    'answer_text' => $row[5],
                    'is_correct'  => $row[6] == 'true' ? 1 : 0,
                ]);
            }

            if (!empty($row[7])) {
                Answer::create([
                    'question_id' => $test->questions[$index]->id,
                    'answer_text' => $row[7],
                    'is_correct'  => $row[8] == 'true' ? 1 : 0,
                ]);
            }
        }
    }
}

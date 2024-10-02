<?php

namespace App\Imports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ExamImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Answer::create([
                'question_id' => $row[1],
                'answer_text' => $row[2],
                'is_correct'  => $row[3] == 'true' ? 1 : 0,
            ]);
            if (!empty($row[4])) {
                Answer::create([
                    'question_id' => $row[1],
                    'answer_text' => $row[4],
                    'is_correct'  => $row[5] == 'true' ? 1 : 0,
                ]);
            }

            if (!empty($row[6])) {
                Answer::create([
                    'question_id' => $row[1],
                    'answer_text' => $row[6],
                    'is_correct'  => $row[7] == 'true' ? 1 : 0,
                ]);
            }

            if (!empty($row[8])) {
                Answer::create([
                    'question_id' => $row[1],
                    'answer_text' => $row[8],
                    'is_correct'  => $row[9] == 'true' ? 1 : 0,
                ]);
            }
        }
    }
}

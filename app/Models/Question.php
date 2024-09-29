<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes; // Use SoftDeletes trait if you want to support soft deleting questions.

    // Define the table if your table name is not plural 'questions'.
    protected $table = 'questions'; 

    // Specify the fields that can be mass assigned
    protected $fillable = [
        'question_text',
        'test_id', // Foreign key to the test table
    ];

    /**
     * Define the relationship with the Test model.
     * A question belongs to one test.
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}

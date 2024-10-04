<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question; 

class Test extends Model
{
    protected $fillable = ['title', 'description', 'is_free'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TeacherRating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'teacher_id', 'rating'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
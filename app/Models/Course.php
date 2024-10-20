<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'is_free',
        'instructor_id',
        'playlist_id',
        'thumbnail',
        'course_type',
        'live_platform',
        'live_link',
        'live_schedule',
        'live_details',
        'category_id'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function instructor()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id');
    }
}

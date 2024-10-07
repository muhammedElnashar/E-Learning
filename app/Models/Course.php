<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;


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
    ];
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

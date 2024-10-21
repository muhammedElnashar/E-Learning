<?php

namespace App\Models\Api;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $fillable=['name','description','image'];
function course()
{
    $this->hasMany(Course::class,'category_id','id');
}
}

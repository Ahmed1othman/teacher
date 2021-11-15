<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='categories';
    protected $guarded=[];
    public $appends=['image'];

    public function getImageAttribute()
    {
        return $this->attributes['photo'] != null ? asset('storage/categories/'.$this->attributes['photo'] ) : null;
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\User', 'teacher_categories', 'category_id', 'user_id');
    }

}

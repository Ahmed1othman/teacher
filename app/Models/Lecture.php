<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='lectures';
    protected $guarded=[];
    public $appends=['image'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function getImageAttribute()
    {
        return $this->attributes['photo'] != null ? asset('storage/lectures/'.$this->attributes['photo'] ) : null;
    }
}

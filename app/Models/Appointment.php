<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='appointments';
    protected $guarded=[];


    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function studentes()
    {
        return $this->belongsToMany('App\Models\User', 'books', 'appointment_id', 'user_id');

        return $this->hasMany('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='books';
    protected $guarded=[];

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function students()
    {
        return $this->hasMany('App\Models\User', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;


class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='cities';
    protected $guarded=[];
    public $appends=['name'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    


    public function getNameAttribute()
    {

        if(App::isLocale('en'))
        {
            return $this->attributes['name_en'] ?? $this->attributes['name_ar'];

        }
        else{
            return $this->attributes['name_ar'] ?? $this->attributes['name_en'];

        }

    }
}


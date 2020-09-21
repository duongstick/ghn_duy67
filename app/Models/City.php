<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   protected $table = 'province';
   protected $fillable = ['name','code'];
   public $timestamps = false;
   public function districts(){
       return $this->hasMany(District::class,'province_id','id');
   }
    public function wards(){
        return $this->hasMany(Ward::class,'province_id','id');
    }
}

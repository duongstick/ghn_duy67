<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = ['name','prefix','province_id'];
    public $timestamps = false;

    public function province(){
        return $this->belongsTo(City::class,'province_id');
    }
    public function wards(){
        return $this->hasMany(Ward::class,'district_id','id');
    }
}

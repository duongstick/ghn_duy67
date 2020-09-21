<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'ward';
    protected $fillable = ['name','prefix','province_id','district_id'];
    public $timestamps = false;
    public function province(){
        return $this->belongsTo(City::class,'province_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}

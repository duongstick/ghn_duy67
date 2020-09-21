<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['customer_id','money','weight','from','to','status','notes','type','is_express','cod_price','staff_id','seller_id','seller_rate','customer_rate','transport_id','code'];

    public function customer(){
        return $this->hasOne(User::class,'id','customer_id');
    }
    public function staff(){
        return $this->hasOne(User::class,'id','staff_id');
    }
    public function seller(){
        return $this->hasOne(User::class,'id','seller_id');
    }
    public function transport(){
        return $this->hasOne(Transport::class,'id','transport_id');
    }

}

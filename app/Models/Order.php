<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function codes(){

        return $this->belongsTo(Code::class,'code_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

}

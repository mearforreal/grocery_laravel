<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'code_percentage'

    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

}

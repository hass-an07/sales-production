<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recivedproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'dept_id',
        'reciver_name',
        'product_code',
        'product_name',
        'product_price',
        'product_qty',
        'net_amount',
    ];
    public function department(){
        return $this->belongsTo(department::class,'dept_id','id');
    }
}

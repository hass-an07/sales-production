<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenseregistration extends Model
{
    use HasFactory;
    protected $fillable =[
        'ex_code',
        'ex_name',
        'status'
    ];
}

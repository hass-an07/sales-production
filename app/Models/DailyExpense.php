<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'ex_code',
        'ex_name',
        'amount',
    ];
}

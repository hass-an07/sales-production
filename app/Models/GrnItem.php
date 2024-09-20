<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrnItem extends Model
{
    use HasFactory;
    protected $fillable = ['grn_id', 'material', 'quantity', 'price', 'total'];

    public function grn()
    {
        return $this->belongsTo(Grn::class);
    }
}

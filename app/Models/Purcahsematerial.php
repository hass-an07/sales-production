<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purcahsematerial extends Model
{
    protected $table = 'purchasematerials';
    use HasFactory;

    public function materialType()
{
    return $this->belongsTo(MaterialType::class, 'material_type');
}

}

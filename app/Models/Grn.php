<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    // Define the relationship with Worker (assuming a GRN belongs to one Worker)
    public function worker()
    {
        return $this->belongsTo(Worker::class,'supplier_id','id');
    }

    // Define the relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    // Grn.php (Model)
// public function items()
// {
//     return $this->hasMany(GrnItem::class, 'grn_id');
// }

}

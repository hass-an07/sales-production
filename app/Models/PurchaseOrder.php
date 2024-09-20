<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'company_id',
        'po_number',
        'from_id',
        'name',
        'for_id',
        'material_type',
        'material',
        'quantity',
        'list_po_no',
        'created_by', // or 'updated_by' if it's for updates
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function from()
    {
        return $this->belongsTo(Department::class);
    }

    public function for()
    {
        return $this->belongsTo(Department::class);
    }

    public function purcahsematerial()
{
    return $this->belongsTo(Purcahsematerial::class, 'po_number_id', 'po_number');
}

}

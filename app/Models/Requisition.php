<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by', 
        'date', 
        'time', 
        'company_id', 
        'requisition', 
        'status', 
        'store', 
        'dept_id', 
        'receiver', 
        'material_ty_id', 
        'material', 
        'qty', 
        'price', 
        'total', 
        'issue_for_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'dept_id');
    }
}

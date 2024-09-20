<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outward extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'outward',
        'g_pass_no',
        'date',
        'time',
        'vehicle',
        'worker_id',
        'through',
        'dept_id',
        'materialType_id',
        'material_id',
        'weightType_id',
        'qty',
        'username',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}

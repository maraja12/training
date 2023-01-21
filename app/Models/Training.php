<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'gender',
        'coach_id',
        'equipment_id',
    ];

    public function coach(){
        return $this->belongsTo(Coach::class);
    }

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}

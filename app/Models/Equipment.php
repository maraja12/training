<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'storage',
        'usage',
    ];

    public function trainings(){
        return $this->hasMany(Training::class);
    }
}

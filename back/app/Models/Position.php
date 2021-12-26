<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'position_name',
    ];

    public $table = 'positions';

    public function Alumni(){
        return $this->belongsToMany(Alumni::class);
    }
}

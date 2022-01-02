<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable =[
        'Title'
    ];
    public $table = 'skills';

    public function Alumni(){
        return $this->belongsToMany(Alumni::class);
    }
}

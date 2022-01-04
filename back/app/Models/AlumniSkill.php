<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniSkill extends Model
{
    use HasFactory;
    protected $fillable=[
        'alumni_id',
        'skill_id',
    ];
    public $table = 'alumni_skills';
}

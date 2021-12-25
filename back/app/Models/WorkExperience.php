<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $fillable=[
        'alumni_id',
        'company_id',
        'position_id',
        'start_year',
        'end_year'
    ];
}

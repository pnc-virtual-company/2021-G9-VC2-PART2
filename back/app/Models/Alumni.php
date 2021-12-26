<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone_number',
        'gender',
        'batch',
        'major',
        'profile',
        'status',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsToMany(Company::class);
    }
    public function position(){
        return $this->belongsToMany(Position::class);
    }
    
    public $table = 'alumnis';

}

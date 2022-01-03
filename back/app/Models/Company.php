<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'address',
        'logo',
        'domain'
    ];

    public function Alumni(){
        return $this->belongsToMany(Alumni::class);
    }


    public $table = 'companies';
}

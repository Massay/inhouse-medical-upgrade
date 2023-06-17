<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'no',
        'department',
        'email',
        'job_title',
        'address'
    ];

    public function relatives(){
         return $this->hasMany(Relative::class);
    }

    public function visits(){
         return $this->hasMany(Visit::class);
    }

    public function visits_top_10(){
        return $this->hasMany(Visit::class)->with('clinic')->latest()->take(10);
   }
}

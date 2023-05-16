<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentType extends Model
{
    use HasFactory;

    protected $fillable = ['policy_id','name','start_date','end_date','perPerson','max_credit_limit'];

    public function policy(){
         return $this->belongsTo(Policy::class);
    }

}

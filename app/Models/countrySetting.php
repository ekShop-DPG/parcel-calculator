<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countrySetting extends Model
{
    use HasFactory;
    protected $guard=[];

    // public function companies(){
    //     return $this->hasMany(Company::class,'country_id','id');
    // }
    // public function countries(){
    //     return $this->hasMany(Country::class,'company_id','id');
    // }
}

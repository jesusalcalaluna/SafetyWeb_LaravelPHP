<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies_and_departments;

class People extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sap', 'position', 'companie_and_department_id'];

    public function company_and_department(){

        return $this->hasOne(Companies_and_departments::class, 'id', 'companie_and_department_id');

    }

    public function user(){
        return $this->hasOne(User::class, 'people_id', 'id');
    }

    public function unsafe_condition_records(){
        return $this->hasMany(Unsafe_conditions_record::class, 'people_id', 'id');
    }
    
    public function companion_care_records(){
        return $this->hasMany(Companion_care_record::class, 'people_id', 'id');
    }
}

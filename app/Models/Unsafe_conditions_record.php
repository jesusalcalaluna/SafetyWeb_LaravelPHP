<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type_condition;
use App\Models\People;
use App\Models\Companies_and_departments;

class Unsafe_conditions_record extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'status',
            'condition_detected',
            'type_condition_id',
            'detection_origin',
            'deadline',
            'department_id',
            'responsable_id',
            'area',
            'probability',
            'impact',
            'frequency',
            'risk',
            'risk_type',
            'attention_priority',
            'scope',
            'notice_number',
            'person_id',
    ];

    public function type_condition(){
        return $this->hasOne(Type_condition::class, 'id', 'type_condition_id');
    }
    public function responsable(){
        return $this->hasOne(People::class, 'id', 'responsable_id');
    }
    public function department(){
        return $this->hasOne(Companies_and_departments::class, 'id', 'department_id');
    }
    public function reporter(){
        return $this->hasOne(People::class, 'id', 'person_id');
    }
}

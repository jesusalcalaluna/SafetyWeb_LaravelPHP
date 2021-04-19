<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion_care_record extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companion_to_care_name',
        'company_department_name',
        'position_name',

        'turn',
        'shift_supervisor',
        'description',
        'corr_prev_pos',

        'behavior_group_id',
        'acts_types_id',
        
        'sif',
        'gold_rules_id',

        'detection_source',
        'department_where_happens_id',
        'specific_area',
        'people_id',
        ];

    public function companionToCare(){

        return $this->hasMany(People::class, 'id', 'companion_to_care_id');
    }

    public function behavior_group(){

        return $this->hasMany(Behaviors_group::class, 'id', 'behavior_group_id');
    }

    public function acts_types(){

        return $this->hasMany(Acts_type::class, 'id', 'acts_types_id');
    }

    public function gold_rules(){

        return $this->hasMany(Gold_rule::class, 'id', 'gold_rules_id');

    }

    public function department_where_happens(){

        return $this->hasMany(Companies_and_departments::class, 'id', 'department_where_happens_id');
    }

    public function people(){

        return $this->hasMany(People::class, 'id', 'people_id');
    }
}

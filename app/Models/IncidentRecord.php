<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classification',
        'sif',
        'event_date',
        'description',
        'department_id',

        'spesific_area',
        'incident_id',

        'incident_reason',
        'reason_description',
        'involbed_people_names',
        'solution_description',
        'people_id',

    ];

    public function incident(){
        return $this->hasOne(Incident::class, 'id', 'incident_id');
    }
    public function department(){
        return $this->hasOne(Companies_and_departments::class, 'id', 'department_id');
    }
    public function reporter(){
        return $this->hasOne(People::class, 'id', 'people_id');
    }
}

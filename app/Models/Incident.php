<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['incident_name', 'incident_type_id',];

    public function incident_type(){
        return $this->hasOne(IncidentType::class, 'id', 'incident_type_id');
    }
}

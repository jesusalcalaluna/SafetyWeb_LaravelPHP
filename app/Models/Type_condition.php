<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_condition extends Model
{
    use HasFactory;

    public function condition_group(){
        return $this->hasOne(Condition_group::class, 'id', 'condition_group_id');
    }
}

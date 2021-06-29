<?php

namespace App\Exports;

use App\Models\Unsafe_conditions_record;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class UnsafeConditionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('unsafe_conditions_records')
        ->join('type_conditions', 'type_conditions.id','=', 'unsafe_conditions_records.type_condition_id')
        ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
        ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
        ->join('companies_and_departments as  department','department.id','=', 'unsafe_conditions_records.department_id')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->select('unsafe_conditions_records.id', 
                'unsafe_conditions_records.created_at', 
                'unsafe_conditions_records.condition_detected', 
                'condition_groups.group_name', 
                'type_conditions.action_name', 
                'unsafe_conditions_records.detection_origin', 
                'unsafe_conditions_records.deadline', 
                'people_responsable.name', 
                'department.name', 
                'unsafe_conditions_records.area', 
                'unsafe_conditions_records.status', 
                'unsafe_conditions_records.probability', 
                'unsafe_conditions_records.frequency', 
                'unsafe_conditions_records.impact', 
                'unsafe_conditions_records.risk', 
                'unsafe_conditions_records.risk_type', 
                'unsafe_conditions_records.attention_priority', 
                'unsafe_conditions_records.scope', 
                'unsafe_conditions_records.notice_number', 
                'people.name', 
                'companies_and_departments.name', 
                'people.position')
        ->get();
    }
}

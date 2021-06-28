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
        return DB::table('Unsafe_conditions_records')
        ->join('type_conditions', 'type_conditions.id','=', 'Unsafe_conditions_records.type_condition_id')
        ->join('condition_groups', 'condition_groups.id', '=', 'type_conditions.condition_group_id')
        ->join('people as people_responsable', 'people_responsable.id', '=', 'unsafe_conditions_records.responsable_id',)
        ->join('companies_and_departments as  department','department.id','=', 'Unsafe_conditions_records.department_id')
        ->join('people', 'people.id', '=', 'unsafe_conditions_records.people_id')
        ->join('companies_and_departments','companies_and_departments.id','=', 'people.companie_and_department_id')
        ->select('Unsafe_conditions_records.id', 'Unsafe_conditions_records.created_at', 'Unsafe_conditions_records.condition_detected', 'condition_groups.group_name', 'type_conditions.action_name', 'Unsafe_conditions_records.detection_origin', 'Unsafe_conditions_records.deadline', 'people_responsable.name', 'department.name', 'Unsafe_conditions_records.area', 'Unsafe_conditions_records.status', 'Unsafe_conditions_records.probability', 'Unsafe_conditions_records.frequency', 'Unsafe_conditions_records.impact', 'Unsafe_conditions_records.risk', 'Unsafe_conditions_records.risk_type', 'Unsafe_conditions_records.attention_priority', 'Unsafe_conditions_records.scope', 'Unsafe_conditions_records.notice_number', 'people.name', 'companies_and_departments.name', 'people.position')
        ->get();
    }
}

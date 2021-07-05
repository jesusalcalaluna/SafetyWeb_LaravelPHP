<?php

namespace App\Exports;

use App\Models\Unsafe_conditions_record;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Collection;

class CollectionExport implements FromCollection
{
    protected $collection;

    public function __construct( Collection $collection)
    {
        $this->collection = $collection;
    }

    public function collection(): Collection
    {
        return $this->collection;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    //public function collection()
    //{
    //    return
    //}
}

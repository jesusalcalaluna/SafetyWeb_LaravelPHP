@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">
        
        <div class="col-12">
            <div class="card mb-30">
                <div class="card-body pt-30">
                    <h4 class="font-20 ">Registros Cuidado del compañero</h4>
                </div>
                <div class="table-responsive">
                    <!-- Invoice List Table -->
                    <table class="text-nowrap table-bordered dh-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Compañia/Departamento</th>
                                <th>Posición</th>
                                <th>Sup. en turno</th>
                                <th>Turno</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Grp. Comportamiento</th>
                                <th>Tipo de acto</th>
                                <th>SIF</th>
                                <th>Regla de Oro</th>
                                <th>Origen</th>
                                <th>Departamento</th>
                                <th>Area Especifica</th>
                                <th>Dep/Comp. del Observador </th>
                                <th>Nom. del Observador</th>
                                <th>Fecha de Registro</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($companion_care_record)
                            @foreach ($companion_care_record as $item)
                            <tr>
                                <td>{{$item->companion_to_care}}</td>
                                <td>{{$item->company_department[0]->name}}</td>
                                <td>{{$item->position[0]->name}}</td>
                                <td>{{$item->shift_supervisor}}</td>
                                <td>{{$item->turn}}</td>
                                <td>{{$item->description}}</td>
                                <td class="@if($item->corr_prev_pos == "CORRECTIVO") bg-danger @endif @if($item->corr_prev_pos == "PREVENTIVO") bg-warning text-dark @endif @if($item->corr_prev_pos == "POSITIVO") bg-success @endif">{{$item->corr_prev_pos}}</td>

                                <td>{{$item->behavior_group[0]->group_name}}</td>
                                <td>{{$item->acts_types[0]->type_name}}</td>

                                <td>{{$item->sif}}</td>
                                <td>{{$item->gold_rules[0]->rule_name}}</td>

                                <td>{{$item->detection_source}}</td>
                                <td>{{$item->department_where_happens[0]->name}}</td>
                                <td>{{$item->specific_area}}</td>
                                <td>{{$item->informant_department_company[0]->name}}</td>
                                <td>{{$item->people[0]->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td><a href="invoice-details.html" class="details-btn">View Details <i class="icofont-arrow-right"></i></a></td>
                            </tr>
                            @endforeach
                            @endisset
                            
                        </tbody>
                    </table>
                    <!-- End Invoice List Table -->
                </div>
            </div>    
        </div>

    </div>
</div>
@endsection
@section('footer')
    
@endsection
@section('js')

@endsection
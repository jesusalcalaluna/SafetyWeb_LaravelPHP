<!--Table  Cultura de seguridad -->
<div class="col-xl-5">
    <!-- Invoice List Table -->
    <table class="text-nowrap dh-table" id="table">
        <thead>
            <tr>
                <th class="v">DEPARTAMENTO</th>
                <th>DET</th>
                <th>TRAT</th>
                <th>ATENCION</th>
                <th>DETECTADAS <br/> por el <br/> Area</th>
                <th>PARTICIPACION</th>
                <th>INSEGURO</th>
                <th>SEGURO</th>
                <th>INSEGURO</th>
                <th>CC EN EL AREA</th>
                <th>CC POR EL AREA</th>
                <th>PARTICIPACION</th>
            </tr>
        </thead>
        <tbody>
            @isset($people)
            @foreach ($people as $item)
            
            <tr>
                <td>{{$item->sap}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->company_and_department->name}}</td>
                <td>{{$item->position}}</td>

                @if (count($item->companion_care_records) )
                <td class="bg-success">{{count($item->companion_care_records)}}</td>
                @else
                <td class="bg-danger">{{count($item->companion_care_records)}}</td>
                @endif 

                @if (count($item->unsafe_condition_records) )
                <td class="bg-success">{{count($item->unsafe_condition_records)}}</td>
                @else
                <td class="bg-danger">{{count($item->unsafe_condition_records)}}</td>
                @endif

                <td>
                    <!-- Edit Invoice Button -->
                    <div class="invoice-header-right d-flex align-items-start justify-content-around justify-content-sm-start mt-3 mt-sm-0">

                        <!-- Edit Invoice Button -->
                        <div class="edit-invoice-btn pr-1">
                        <a href="{{ route('updateperson', [$item->id]) }}" class="btn-circle">
                            <img src="{{ asset('assets/img/svg/writing.svg') }}" alt="" class="svg">
                        </a>
                        </div>
                        <div>
                            <form method="POST" action="{{route('deactivatePerson')}}">
                                <input hidden="true" value="{{$item->id}}" name="id">
                                <a onclick="deactivatePersonAlert(this);" class="btn-circle ">
                                <img src="{{ asset('assets/img/svg/delete.svg') }}" alt="" class="svg">
                            </a>
                            </form>
                        </div>
                        <!-- End Edit Invoice Button -->
                    </div>
                </td>
            </tr>
                                
            @endforeach
            @endisset
        </tbody>
    </table>
    <!-- End Invoice List Table -->
</div>
            
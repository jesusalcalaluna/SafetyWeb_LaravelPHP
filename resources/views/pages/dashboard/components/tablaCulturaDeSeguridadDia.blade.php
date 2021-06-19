<!--Table  Cultura de seguridad -->
<div class="col-12">
    <div class="card mb-30">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h4 class="font-20">Lista del Personal Externo</h4>

                <div class="d-flex flex-wrap">
                    <!-- search -->
                    <div class="mr-20 mt-3 mt-sm-0">
                        <div  class="search-form">
                            <div class="theme-input-group">
                               <input type="text" class="theme-input-style" id="search"  placeholder="Busca aqui..." >

                               <button id="btnSearch" type="button" onclick="search();"> <img src="../../../assets/img/svg/search-icon.svg" alt=""  class="svg"></button>
                            </div>
                        </div>
                    </div>
                    <!-- End search -->
                </div>
                
            </div>
        </div>
        <div class="table-responsive">
            <!-- Invoice List Table -->
            <table class="text-nowrap dh-table" id="table">
                <thead>
                    <tr>
                        <th>DEPARTAMENTO</th>

                        <th>DET</th>
                        <th>TRAT</th>
                        <th>ATENCION</th>
                        <th>DETECTADAS <br/> por el <br/> Area</th>
                        <th>PARTICIPACION</th>

                        <th>INSEGURO</th>
                        <th>SEGURO</th>
                        <th>CC EN EL AREA</th>
                        <th>CC POR EL AREA</th>
                        <th>PARTICIPACION</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @isset($culturaDeSeguridad)
                    @foreach ($culturaDeSeguridad as $item)
                    <tr>
                    <td>{{ $item["Departamento"] }}</td>     
                    <td>{{ $item["DET"] }}</td> 
                    <td>{{ $item["TRAT"] }}</td> 
                    <td>{{ $item["Atencion"] }}</td> 
                    <td>{{ $item["DetectadosArea"] }}</td> 
                    <td>{{ $item["ParticipacionCI"] }}</td> 
                    <td>{{ $item["Inseguro"] }}</td> 
                    <td>{{ $item["Seguro"] }}</td> 
                    <td>{{ $item["TotalCuidadosArea"] }}</td> 
                    <td>{{ $item["CuidadosPorElArea"] }}</td> 
                    <td>{{ $item["ParticipacionCC"] }}</td>  
                </tr>              
                    @endforeach
                    @endisset
                
                </tbody>
            </table>
            <!-- End Invoice List Table -->
        </div>
    </div>   
</div>
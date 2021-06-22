<!--Table  Cultura de seguridad -->
<div class="col-12">
    <div class="card mb-30">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h4 class="font-20">Cultura de Seguridad</h4>

                <div class="d-flex align-items-center">
                    <div class="">
                       <h4 id="selectCultura" class="mb-3">Hoy</h4>
                   </div>
                      <!-- Dropdown Button -->
                      <div class="dropdown-button">
                          <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                              <div class="menu-icon style--two mr-0">
                              <span></span>
                              <span></span>
                              <span></span>
                              </div>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a onclick="culturaChangueHoy(this);">Hoy</a>
                              <a onclick="culturaChangueAyer(this);">Ayer</a>
                              <a onclick="culturaChangueMes(this);">Mes</a>
                              <a onclick="culturaChangueAño(this);">Año</a>
                          </div>
                      </div>
                      <!-- End Dropdown Button -->
                  </div>
                
            </div>
        </div>
        <div class="table-responsive" style="display: none;" id="CulturaAyer">
            <!-- Invoice List Table -->
            <table class="text-nowrap dh-table" id="table">
                <thead>
                    <tr>
                        <th>DEPARTAMENTO</th>

                        <th>DET</th>
                        <th>TRAT</th>
                        <th>ATENCION</th>
                        <th>DETECTADAS <br/> POR EL <br/> AREA</th>
                        <th>%PARTI</th>

                        <th>INSEGURO</th>
                        <th>SEGURO</th>
                        <th>CC EN EL AREA</th>
                        <th>CC POR EL AREA</th>
                        <th>%PARTI</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @isset($culturaDeSeguridadA)
                    @foreach ($culturaDeSeguridadA as $item)
                    <tr>
                    <td>{{ $item["Departamento"] }}</td>     
                    <td>{{ $item["DET"] }}</td> 
                    <td>{{ $item["TRAT"] }}</td> 
                    <td>%{{ $item["Atencion"] }}</td> 
                    <td>{{ $item["DetectadosArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCI"] }}</td> 
                    <td>{{ $item["Inseguro"] }}</td> 
                    <td>{{ $item["Seguro"] }}</td> 
                    <td>{{ $item["TotalCuidadosArea"] }}</td> 
                    <td>{{ $item["CuidadosPorElArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCC"] }}</td>  
                </tr>              
                    @endforeach
                    @endisset
                
                </tbody>
            </table>
            <!-- End Invoice List Table -->
        </div>

        <div class="table-responsive"  id="CulturaHoy">
            <!-- Invoice List Table -->
            <table class="text-nowrap dh-table" id="table">
                <thead>
                    <tr>
                        <th>DEPARTAMENTO</th>

                        <th>DET</th>
                        <th>TRAT</th>
                        <th>ATENCION</th>
                        <th>DETECTADAS <br/> POR EL <br/> AREA</th>
                        <th>%PARTI</th>

                        <th>INSEGURO</th>
                        <th>SEGURO</th>
                        <th>CC EN EL AREA</th>
                        <th>CC POR EL AREA</th>
                        <th>%PARTI</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @isset($culturaDeSeguridadD)
                    @foreach ($culturaDeSeguridadD as $item)
                    <tr>
                    <td>{{ $item["Departamento"] }}</td>     
                    <td>{{ $item["DET"] }}</td> 
                    <td>{{ $item["TRAT"] }}</td> 
                    <td>{{ $item["Atencion"] }}</td> 
                    <td>{{ $item["DetectadosArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCI"] }}</td> 
                    <td>{{ $item["Inseguro"] }}</td> 
                    <td>{{ $item["Seguro"] }}</td> 
                    <td>{{ $item["TotalCuidadosArea"] }}</td> 
                    <td>{{ $item["CuidadosPorElArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCC"] }}</td>  
                </tr>              
                    @endforeach
                    @endisset
                
                </tbody>
            </table>
            <!-- End Invoice List Table -->
        </div>

        <div class="table-responsive" style="display: none;" id="CulturaMes">
            <!-- Invoice List Table -->
            <table class="text-nowrap dh-table" id="table">
                <thead>
                    <tr>
                        <th>DEPARTAMENTO</th>

                        <th>DET</th>
                        <th>TRAT</th>
                        <th>ATENCION</th>
                        <th>DETECTADAS <br/> POR EL <br/> AREA</th>
                        <th>%PARTI</th>

                        <th>INSEGURO</th>
                        <th>SEGURO</th>
                        <th>CC EN EL AREA</th>
                        <th>CC POR EL AREA</th>
                        <th>%PARTI</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @isset($culturaDeSeguridadM)
                    @foreach ($culturaDeSeguridadM as $item)
                    <tr>
                    <td>{{ $item["Departamento"] }}</td>     
                    <td>{{ $item["DET"] }}</td> 
                    <td>{{ $item["TRAT"] }}</td> 
                    <td>{{ $item["Atencion"] }}</td> 
                    <td>{{ $item["DetectadosArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCI"] }}</td> 
                    <td>{{ $item["Inseguro"] }}</td> 
                    <td>{{ $item["Seguro"] }}</td> 
                    <td>{{ $item["TotalCuidadosArea"] }}</td> 
                    <td>{{ $item["CuidadosPorElArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCC"] }}</td>  
                </tr>              
                    @endforeach
                    @endisset
                
                </tbody>
            </table>
            <!-- End Invoice List Table -->
        </div>

        <div class="table-responsive" style="display: none;" id="CulturaAño">
            <!-- Invoice List Table -->
            <table class="text-nowrap dh-table" id="table">
                <thead>
                    <tr>
                        <th>DEPARTAMENTO</th>

                        <th>DET</th>
                        <th>TRAT</th>
                        <th>ATENCION</th>
                        <th>DETECTADAS <br/> POR EL <br/> AREA</th>
                        <th>%PARTI</th>

                        <th>INSEGURO</th>
                        <th>SEGURO</th>
                        <th>CC EN EL AREA</th>
                        <th>CC POR EL AREA</th>
                        <th>%PARTI</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @isset($culturaDeSeguridadY)
                    @foreach ($culturaDeSeguridadY as $item)
                    <tr>
                    <td>{{ $item["Departamento"] }}</td>     
                    <td>{{ $item["DET"] }}</td> 
                    <td>{{ $item["TRAT"] }}</td> 
                    <td>{{ $item["Atencion"] }}</td> 
                    <td>{{ $item["DetectadosArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCI"] }}</td> 
                    <td>{{ $item["Inseguro"] }}</td> 
                    <td>{{ $item["Seguro"] }}</td> 
                    <td>{{ $item["TotalCuidadosArea"] }}</td> 
                    <td>{{ $item["CuidadosPorElArea"] }}</td> 
                    <td>%{{ $item["ParticipacionCC"] }}</td>  
                </tr>              
                    @endforeach
                    @endisset
                
                </tbody>
            </table>
            <!-- End Invoice List Table -->
        </div>
    </div>   
</div>

<script>
    
    function culturaChangueHoy(params) {
        $("#selectCultura").text("Hoy");
        $("#CulturaHoy").show(0);
        $("#CulturaAyer").hide(0);
        $("#CulturaMes").hide(0);
        $("#CulturaAño").hide(0);

    }
    function culturaChangueAyer(params) {
        $("#selectCultura").text("Ayer");
        $("#CulturaHoy").hide(0);
        $("#CulturaAyer").show(0);
        $("#CulturaMes").hide(0);
        $("#CulturaAño").hide(0);
    }
    function culturaChangueMes(params) {
        $("#selectCultura").text("Mes");
        
        $("#CulturaMes").show(0);
        $("#CulturaAño").hide(0);
        $("#CulturaHoy").hide(0);
        $("#CulturaAyer").hide(0);
    }
    function culturaChangueAño(params) {
        $("#selectCultura").text("Año");
        
        $("#CulturaAño").show(0);
        $("#CulturaHoy").hide(0);
        $("#CulturaAyer").hide(0);
        $("#CulturaMes").hide(0);
    }
</script>
<div class="row">



    <div class="col-xl-5">
        <!-- Card -->
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="">
                        <h4 class="mb-2">Participacion Interna</h4>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="mb-3">Hoy</h4>
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
                                <a onclick="chartschange(this);">Hoy</a>
                                <a onclick="chartschange1(this);">Mes</a>
                                <a onclick="chartschange2(this);">Año</a>
                            </div>
                        </div>
                        <!-- End Dropdown Button -->
                    </div>


                </div>
                <div id="test1">Hoy<div id="apex_bar-chart2"  class="chart"></div></div>
                <div id="test2" style="display: none;">Mes<div id="apex_bar-chart1"  class="chart"></div></div>
                <div id="test3" style="display: none;">Año<div id="apex_bar-chart" class="chart"></div></div>



            </div>
        </div>
        <!-- End Card -->
    </div>

    <div class="col-xl-5">
        <!-- Card -->
        <div class="card mb-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="">
                        <h4 class="mb-2">Participacion Externa</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 id="" class="mb-3">Hoy</h4>
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
                                <a onclick="chartschangeExterno(this);">Hoy</a>
                                <a onclick="chartschangeExterno1(this);">Mes</a>
                                <a onclick="chartschangeExterno2(this);">Año</a>
                            </div>
                        </div>
                        <!-- End Dropdown Button -->
                    </div>


                </div>
                <div id="testExterno1">Hoy<div id="apex_bar-chartExterno2"  class="chart"></div></div>
                <div id="testExterno2" style="display: none;">Mes<div id="apex_bar-chartExterno1"  class="chart"></div></div>
                <div id="testExterno3" style="display: none;">Año<div id="apex_bar-chartExterno" class="chart"></div></div>



            </div>
        </div>
        <!-- End Card -->
    </div>
</div>

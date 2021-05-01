@extends('layouts.app2')
@section('css')
<link rel="stylesheet" href="{{ asset('css/css page/piramid.css')}}">
@endsection
@section('content')
    @include('components.index.slider')


    <section class="home-ceo">
        <div class="container">
            <div class="row ceo">
                <div class="col-md-6">
                    <div class="piramid_body">
                        <img src="/images/piramide.png" alt="">
                        <div class="lti">10</div>
                        <div class="lti-2">10</div>
                        <div class="mdi">10</div>
                        <div class="mdi-2">10</div>
                        <div class="mmti">10</div>
                        <div class="mmti-2">10</div>
                        <div class="fai">10</div>
                        <div class="fai-2">10</div>
                        <div class="sif">10</div>
                        <div class="incidentes-2">10</div>
                        <div class="seguros">{{$seguros}}</div>
                        <div class="inseguros">{{$inseguros}}</div>
                        <div class="detectadas">{{$detectadas}}</div>
                        <div class="atendidas">{{$atendidas}}</div>
                        <div class="avance">%{{$avance}}</div>
                        <div class="p-participacion-cc">100</div>
                        <div class="p-participacion-ci">100</div>
                        <div class="monitoreos">100</div>
                        <div class="owd">100</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ceo-details">
                        <h2 class="ceo-title color-title"> WORD FROM CEO </h2>
                        <h4 class="ceo-subtitle subtitle"> READ THE MESSAGE FROM OUR CEO </h4>
                        <p> Proactively incubate enterprise total linkage without sustainable leadership skills. Monotonectally strategize user-centric interfaces whereas low-risk high-yield materials. Efficiently syndicate web-enabled portals for principle centered partnerships.
                        </p>
                        <p>Proactively whiteboard revolutionary processes after scalable testing procedures. Holisticly reinvent seamless after business.</p>
                        <h4 class="ceo-sign"> <img src="images/ceo-sign.png" alt="signature" /> </h4>
                        <p class="ceo-name">Gregory Walker, CEO</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div></div>
    <div class="piramid_body">
        <img src="/images/piramide.png" alt="">
        <div class="lti">10</div>
        <div class="lti-2">10</div>
        <div class="mdi">10</div>
        <div class="mdi-2">10</div>
        <div class="mmti">10</div>
        <div class="mmti-2">10</div>
        <div class="fai">10</div>
        <div class="fai-2">10</div>
        <div class="sif">10</div>
        <div class="incidentes-2">10</div>
        <div class="seguros">{{$seguros}}</div>
        <div class="inseguros">{{$inseguros}}</div>
        <div class="detectadas">{{$detectadas}}</div>
        <div class="atendidas">{{$atendidas}}</div>
        <div class="avance">%{{$avance}}</div>
        <div class="p-participacion-cc">%{{$participacion_cc}}</div>
        <div class="p-participacion-ci">%{{$participacion_ci}}</div>
        <div class="monitoreos">%{{$p_monitoreos}}</div>
        <div class="owd">%{{$p_owd}}</div>
    </div>
    
@endsection
@extends('layouts.app2')
@section('css')
<link rel="stylesheet" href="{{ asset('css/css page/piramid.css')}}">
@endsection
@section('content')
    @include('components.index.slider')

    <div class="piramid_body">
        <img src="/images/piramide.png" alt="">
        <div class="lti">{{$incidentes_lti_sif}}</div>
        <div class="lti-2">{{$incidentes_lti}}</div>
        <div class="mdi">{{$incidentes_mdi_sif}}</div>
        <div class="mdi-2">{{$incidentes_mdi}}</div>
        <div class="mmti">{{$incidentes_mti_sif}}</div>
        <div class="mmti-2">{{$incidentes_mti}}</div>
        <div class="fai">{{$incidentes_fai_sif}}</div>
        <div class="fai-2">{{$incidentes_fai}}</div>
        <div class="sif">{{$incidentes_sif}}</div>
        <div class="incidentes-2">{{$incidentes}}</div>
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
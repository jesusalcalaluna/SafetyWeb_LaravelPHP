@extends('layouts.app2')
@section('css')
<link rel="stylesheet" href="{{ asset('css/css page/piramid.css')}}">
@endsection
@section('content')
    @include('components.index.slider')

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
        <div class="p-participacion-cc">100</div>
        <div class="p-participacion-ci">100</div>
        <div class="monitoreos">100</div>
        <div class="owd">100</div>
    </div>
    
@endsection
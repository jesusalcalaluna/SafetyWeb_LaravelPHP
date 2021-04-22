@extends('layouts.app2')
@section('css')
<link rel="stylesheet" href="{{ asset('css/css page/piramid.css')}}">
@endsection
@section('content')
    @include('components.index.slider')
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
        <div class="seguros">10</div>
        <div class="inseguros">10</div>
        <div class="detectadas">10</div>
        <div class="atendidas">10</div>
        <div class="avance">10</div>
        <div class="p-participacion-cc">10</div>
        <div class="p-participacion-ci">10</div>
        <div class="monitoreos">10</div>
        <div class="owd">10</div>
    </div>
@endsection
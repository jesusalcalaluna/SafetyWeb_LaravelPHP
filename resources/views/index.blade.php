@extends('layouts.app2')
@section('css')
<link rel="stylesheet" href="{{ asset('css/css page/piramid.css')}}">
    
@endsection
@section('content')
    @include('components.index.slider')

    <div class="piramid_body">
        <div class="lti"></div>
    </div>


@endsection
@extends('layouts.app_dashboard')

@section('css')
   <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
   <link rel="stylesheet" href="assets/plugins/datepicker/datepicker.min.css">
   <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
@endsection

@section('navbar')
    
    @include('globals.dashboard.navbar')
    @auth
    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        @include('globals.dashboard.sidebar')
    @endif
    @endauth
    
    
    
@endsection
@section('content')



@endsection
@section('footer')
    
@endsection

@section('js')

@endsection
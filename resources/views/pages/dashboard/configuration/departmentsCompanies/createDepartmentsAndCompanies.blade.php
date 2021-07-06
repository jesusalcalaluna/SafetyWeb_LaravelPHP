@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')
<div class="main-content">

    <div class="container-fluid">

        <div class="form-element input-sizing">
            <h4 class="font-20 mb-4">Crear Compañia o Departamento</h4>

            <!-- Form -->
            <form action="{{ route('companiesDepartmentsCreate')}}" method="POST">
                @csrf
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label for="name" class="mb-2 bold">Nombre</label>
                    <input type="text" class="theme-input-style" id="name" placeholder="Nombre del Departamento o Compañia..." name="name">
                </div>
                <!-- End Form Group -->
                <!-- Form Group -->
                <div class="form-group mb-4">
                    <label class="mb-3 d-block font-14 bold">Origen</label>

                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="INTERNO" name="origin" value="INTERNO">
                            <label for="INTERNO"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="INTERNO">INTERNO</label>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!-- Custom Radio -->
                        <div class="custom-radio mr-3">
                            <input type="radio" id="EXTERNO" name="origin" value="EXTERNO">
                            <label for="EXTERNO"></label>
                        </div>
                        <!-- End Custom Radio -->

                        <label for="EXTERNO">EXTERNO</label>
                    </div>
                </div>
                <!-- End Form Group -->
                <!-- Button Group -->
                <div class="button-group pt-2">
                    <button type="submit" class="btn long">Registrar</button>
                    <a href="{{ url()->previous() }}"  class="link-btn bg-transparent ml-3 soft-pink">Cancelar</a>
                </div>
                <!-- End Button Group -->
            </form>
            <!-- End Form -->
        </div>


    </div>

</div>
@endsection
@section('footer')

@endsection
@section('js')
<script type="text/JavaScript">
</script>
@endsection

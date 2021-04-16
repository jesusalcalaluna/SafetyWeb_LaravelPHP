@extends('layouts.app_dashboard')

@section('navbar')
    @include('globals.dashboard.navbar')
    @include('globals.dashboard.sidebar')
@endsection
@section('content')

    
    <!-- Main Content -->
    <div class="main-content d-flex flex-column flex-md-row">
        <div class="mb-4 mb-md-0">
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-xl-12 mb-30 mb-xl-0">
                <!-- Card -->
                <div class="card h-100">
                    <div class="card-body p-30">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="personal">
                                <div class="d-flex align-items-center mb-3">
                                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="mr-2"><img src="../../../assets/img/svg/angle-left.svg" alt="" class="svg"></a>
                                    <h4 class="regular mr-3 font-20 ">Informacion Personal</h4>
                                </div>

                                <form @if (Route::current()->getName() == 'newPerson') action="{{ route('newPerson')}}"  @else action="{{ route('newPersonExtern')}}" @endif  method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6">
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="name" class="mb-2 font-14 bold">Name</label>
                                                <input type="text" id="name" class="theme-input-style" placeholder="Nombre de la persona..." name="name">
                                            </div>
                                            <!-- End Form Group -->
                                            
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="sap" class="mb-2 font-14 bold">SAP</label>
                                                <input type="text" id="sap" class="theme-input-style" placeholder="Si es Externo deja vacio este campo..." name="sap">
                                            </div>
                                            <!-- End Form Group -->
                                            
                                            <!-- Form Group -->
                                            <div class="form-group mb-20">
                                                <label for="position" class="mb-2 font-14 bold">Puesto</label>
                                                <input type="text" id="position" class="theme-input-style" placeholder="Nombre del puesto de la persona..." name="position">
                                            </div>
                                            <!-- End Form Group -->
                                            <!-- Form Group Department -->
                                            <div class="form-group mb-4">
                                                <label for="companie_and_department_id" class="mb-2 bold d-block">Departamento</label>
                                                <div class="custom-select style--two">
                                                    <select class="theme-input-style" id="companie_and_department_id" name="companie_and_department_id">
                                                        @isset($departments)
                                                        @foreach ($departments as $item)
                                                        @if (Auth::user()->role->role_name == "ADMINISTRADOR")
                                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                                        @else
                                                        @if(Auth::user()->person->company_and_department->id == $item->id)
                                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- End Form Group -->

                                            
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-group mt-30 mt-xl-n5">
                                                <button type="submit" class="btn">Guardar</button>
                                                <a href="{{ url()->previous() }}"  class="link-btn bg-transparent ml-3 soft-pink">Cancelar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>

            </div>
        </div>
    </div>
    <!-- End Main Content -->

@endsection
@section('footer')
    
@endsection
@section('js')

@endsection
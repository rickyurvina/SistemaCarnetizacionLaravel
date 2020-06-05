@extends('identification.layouts.app')
@section('title','Foto Estudiante')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'picture.index','btnText'=>'Panel de Control','textTitle'=>'Subir Nueva Foto'])
    <div>
        @include('identification.pictures._form',['btnText'=>'Guardar','btnRoute'=>'picture.store'])
    </div>
    </div>
    </div>
    </div>
@endsection

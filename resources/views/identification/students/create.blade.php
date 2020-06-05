@extends('identification.layouts.app')
@section('title','Crear Estudiante')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'student.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Estudiante'])
    <div>
        @include('identification.students._form',['btnText'=>'Guardar','btnRoute'=>'student.store'])
    </div>
    </div>
    </div>
    </div>
@endsection

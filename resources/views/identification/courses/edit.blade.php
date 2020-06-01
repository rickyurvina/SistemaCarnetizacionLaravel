@extends('identification.layouts.app')
@section('title','Editar Cursos')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Editar Curso'])
    <div>
        @include('identification.courses._form',['btnText'=>'Actualizar','btnRoute'=>'course.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

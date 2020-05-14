@extends('identification.layouts.app')
@section('title',' Crear Cursos')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Curso'])
     <div>
        @include('identification.courses._form',['btnText'=>'Guardar','btnRoute'=>'course.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

@extends('identification.layouts.app')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Curso Educatviva'])
     <div>
        @include('identification.courses._form',['btnText'=>'Guardar','btnRoute'=>'course.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

@extends('identification.layouts.app')
@section('content')
     @include('identification.institutions.educational.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nueva Institución Educatviva'])
     <div>
        @include('identification.institutions.educational._form',['btnText'=>'Guardar','btnRoute'=>'institution.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

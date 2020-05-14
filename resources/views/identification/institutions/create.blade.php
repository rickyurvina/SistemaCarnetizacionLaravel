@extends('identification.layouts.app')
@section('title','Crear Institución')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nueva Institución'])
     <div>
        @include('identification.institutions._form',['btnText'=>'Guardar','btnRoute'=>'institution.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

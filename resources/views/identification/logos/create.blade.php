@extends('identification.layouts.app')
@section('title',' Crear Logo')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'logo.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Logo'])
     <div>
        @include('identification.logos._form',['btnText'=>'Guardar','btnRoute'=>'logo.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

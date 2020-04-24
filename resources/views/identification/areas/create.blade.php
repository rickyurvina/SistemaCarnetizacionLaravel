@extends('identification.layouts.app')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'area.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nueva Area'])
     <div>
        @include('identification.areas._form',['btnText'=>'Guardar','btnRoute'=>'area.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

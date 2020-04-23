@extends('identification.layouts.app')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'person.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Usuario'])
     <div>
        @include('identification.people._form',['btnText'=>'Guardar','btnRoute'=>'person.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

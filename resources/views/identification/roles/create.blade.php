@extends('identification.layouts.app')
@section('title',' Crear Roles')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'role.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Role'])
     <div>
        @include('identification.roles._form',['btnText'=>'Guardar','btnRoute'=>'role.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

@extends('identification.layouts.app')
@section('title',' Crear Users')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'user.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Usuario del Sistema'])
    <div>
        @include('identification.users._form',['btnText'=>'Guardar','btnRoute'=>'user.store'])
    </div>
    </div>
    </div>
    </div>
@endsection

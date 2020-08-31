@extends('identification.layouts.app')
@section('title',' Editar Usuarios')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'user.index','btnText'=>'Panel de Control','textTitle'=>'Editar User'])
    <div>
        @include('identification.users._form',['btnText'=>'Actualizar','btnRoute'=>'user.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

@extends('identification.layouts.app')
@section('title',' Editar Role')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'role.index','btnText'=>'Panel de Control','textTitle'=>'Editar Role'])
    <div>
        @include('identification.roles._form',['btnText'=>'Actualizar','btnRoute'=>'role.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

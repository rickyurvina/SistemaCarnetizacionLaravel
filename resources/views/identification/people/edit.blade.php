@extends('identification.layouts.app')
@section('title','Editar Usuarios')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'person.index','btnText'=>'Panel de Control','textTitle'=>'Editar Usuario'])
            <div>
                @include('identification.people._form',['btnText'=>'Actualizar','btnRoute'=>'person.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

@extends('identification.layouts.app')
@section('title','Editar Foto Estudiante')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'picture.index','btnText'=>'Panel de Control','textTitle'=>'Editar Foto'])
    <div>
        @include('identification.pictures._form',['btnText'=>'Actualizar','btnRoute'=>'picture.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

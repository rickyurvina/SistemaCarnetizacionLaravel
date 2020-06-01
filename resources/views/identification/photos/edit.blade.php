@extends('identification.layouts.app')
@section('title','Editar Foto Usuario')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'photo.index','btnText'=>'Panel de Control','textTitle'=>'Editar Foto'])
    <div>
        @include('identification.photos._form',['btnText'=>'Actualizar','btnRoute'=>'photo.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

@extends('identification.layouts.app')
@section('title','Editar Logo')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'logo.index','btnText'=>'Panel de Control','textTitle'=>'Editar Logo'])
    <div>
        @include('identification.logos._form',['btnText'=>'Actualizar','btnRoute'=>'logo.update','txtMethod'=>'PATCH'])
    </div>
    </div>
    </div>
    </div>
@endsection

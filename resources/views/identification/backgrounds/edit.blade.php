@extends('identification.layouts.app')
@section('title','Editar Fondo')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'background.index','btnText'=>'Panel de Control','textTitle'=>'Editar Fondo'])
            <div>
                @include('identification.backgrounds._form',['btnText'=>'Actualizar','btnRoute'=>'background.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

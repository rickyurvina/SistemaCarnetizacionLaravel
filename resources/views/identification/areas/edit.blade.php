@extends('identification.layouts.app')
@section('title',' Editar Áreas')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'area.index','btnText'=>'Panel de Control','textTitle'=>'Editar Area'])
            <div>
                @include('identification.areas._form',['btnText'=>'Actualizar','btnRoute'=>'area.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

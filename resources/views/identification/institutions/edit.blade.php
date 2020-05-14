@extends('identification.layouts.app')
@section('title','Editar Institución')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Editar Institución'])
            <div>
                @include('identification.institutions._form',['btnText'=>'Actualizar','btnRoute'=>'institution.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

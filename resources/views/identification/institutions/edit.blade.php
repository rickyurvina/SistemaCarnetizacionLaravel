@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Editar Institución Educativa'])
            <div>
                @include('identification.institutions._form',['btnText'=>'Actualizar','btnRoute'=>'institution.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

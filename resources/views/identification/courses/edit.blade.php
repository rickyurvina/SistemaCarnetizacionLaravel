@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Editar Institución Educativa'])
            <div>
                @include('identification.courses._form',['btnText'=>'Actualizar','btnRoute'=>'course.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

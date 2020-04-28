@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'student.index','btnText'=>'Panel de Control','textTitle'=>'Editar Estudiante'])
            <div>
                @include('identification.students._form',['btnText'=>'Actualizar','btnRoute'=>'student.update','txtMethod'=>'PATCH'])
            </div>
        </div>
    </div>
</div>
@endsection

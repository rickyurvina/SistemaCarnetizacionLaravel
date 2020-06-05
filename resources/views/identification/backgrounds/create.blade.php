@extends('identification.layouts.app')
@section('title',' Crear Fondo')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'background.index','btnText'=>'Panel de Control','textTitle'=>'Crear Nuevo Fondo'])
    <div>
        @include('identification.backgrounds._form',['btnText'=>'Guardar','btnRoute'=>'background.store'])
    </div>
    </div>
    </div>
    </div>
@endsection

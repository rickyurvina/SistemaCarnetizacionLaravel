@extends('identification.layouts.app')
@section('title','Foto Usuario')
@section('content')
     @include('identification.layouts.top-content',['routeText'=>'photo.index','btnText'=>'Panel de Control','textTitle'=>'Subir Nueva Foto'])
     <div>
        @include('identification.photos._form',['btnText'=>'Guardar','btnRoute'=>'photo.store'])
     </div>
     </div>
     </div>
     </div>
@endsection

@extends('identification.layouts.app')
@section('content')
@include('identification.institutions.educational.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])

               <div>
                <br/>
                <p>Nombre: {{$institution->INS_NOMBRE}}</p>
                <p>Direccion: {{$institution->INS_DIRECCION}}</p>
                <p>Telefono: {{$institution->INS_TELEFONO}}</p>
                <p>Celular: {{$institution->INS_CELULAR}}</p>
                <p>Creada el: {{$institution->created_at->format('d/m/Y')}}</p>
                <p>Ultima modificacion el: {{$institution->updated_at->format('d/m/Y')}}</p>
                <a href="{{route('institution.edit',$institution)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-institution').
                       submit()"
                   ><i class="fa fa-trash-o"></i> Delete </a>
                   <form
                       class="d-none"
                       id="delete-institution"
                       method="POST"
                       action="{{route('institution.destroy',$institution)}}">
                       @csrf @method('DELETE')
                   </form>

               </div>
        </div>
    </div>
</div>
@endsection

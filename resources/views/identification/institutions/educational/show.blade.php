@extends('identification.layouts.app')
@section('content')
@include('identification.institutions.educational.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                <p>{{__('Name')}}: {{$institution->INS_NOMBRE}}</p>
                <p>{{__('Direction')}}: {{$institution->INS_DIRECCION}}</p>
                <p>{{__('Phone')}}: {{$institution->INS_TELEFONO}}</p>
                <p>{{__('CellPhone')}}: {{$institution->INS_CELULAR}}</p>
                   <p>{{__('Type')}}: {{$institution->INS_TIPO}}</p>
                <p>{{__('Created_at')}} {{$institution->created_at->format('d/m/Y')}}</p>
                <p>{{__('Updated_at')}}{{$institution->updated_at->format('d/m/Y')}}</p>
                <a href="{{route('institution.edit',$institution)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-institution').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{_('Delete')}}</a>
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

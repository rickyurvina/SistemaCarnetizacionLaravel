@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'person.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Persona'])
               <div>
                <br/>
                <p>{{__('Identification card')}}: {{$person->PER_CEDULA}}</p>
                <p>{{__('Name')}}: {{$person->PER_NOMBRES}}</p>
                <p>{{__('LastName')}}: {{$person->PER_APELLIDOS}}</p>
                <p>{{__('Sex')}}: {{$person->PER_SEXO}}</p>
                <p>{{__('Age')}}: {{\Carbon\Carbon::parse($person->PER_FECHANACIMIENTO)->age}} Años</p>
                <p>{{__('Blood type')}}: {{$person->PER_TIPOSANGRE}}</p>
                <p>{{__('Email')}}: {{$person->PER_CORREO}}</p>
                <p>{{__('Direction')}}: {{$person->PER_DIRECCION}}</p>
                <p>{{__('Phone')}}: {{$person->PER_NUMERO}}</p>
                <p>{{__('CellPhone')}}: {{$person->PER_CELULAR}}</p>
                <p>{{__('Institution')}}:  {{$person->institution->INS_NOMBRE}}</p>
                <p>{{__('Created_at')}} {{$person->created_at->format('d/m/Y')}}</p>
                <p>{{__('Updated_at')}}{{$person->updated_at->format('d/m/Y')}}</p>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('person.edit',$person)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-person').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-person"
                       method="POST"
                       action="{{route('person.destroy',$person)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

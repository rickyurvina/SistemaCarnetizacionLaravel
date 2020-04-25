@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'person.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Persona'])
               <div>
                <br/>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('Identification card')}}</th>
                           <th>{{__('Name')}}</th>
                           <th>{{__('LastName')}}</th>
                           <th>{{__('Sex')}}</th>
                           <th>{{__('Age')}}</th>
                           <th>{{__('Blood type')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>
                               <a>{{$person->PER_CEDULA}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_NOMBRES}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_APELLIDOS}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_SEXO}}</a>
                           </td>
                           <td>
                               <a>{{\Carbon\Carbon::parse($person->PER_FECHANACIMIENTO)->age}} Años</a>
                           </td>
                           <td>
                               <a>{{$person->PER_TIPOSANGRE}}</a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('Email')}}</th>
                           <th>{{__('Direction')}}</th>
                           <th>{{__('Phone')}}</th>
                           <th>{{__('CellPhone')}}</th>
                           <th>{{__('Institution')}}</th>
                           <th>{{__('Area')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>
                               <a> {{$person->PER_CORREO}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_DIRECCION}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_NUMERO}}</a>
                           </td>
                           <td>
                               <a> {{$person->PER_CELULAR}}</a>
                           </td>
                           <td>
                               <a href="{{route('institution.show',$person->institution_id)}}">
                                   {{$person->institution->INS_NOMBRE}}
                               </a>
                           </td>
                           <td>
                               <a href="{{route('area.show',$person->area_id)}}">
                                   {{$person->area->ARE_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
               </div>
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

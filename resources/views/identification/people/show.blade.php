@extends('identification.layouts.app')
@section('title','Ver Usuario')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'person.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Usuario'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                   <table id="datatable"
                          class="table table-sm">
                       <thead>
                       <tr>
                           @foreach($photos as $photo)
                               <th>
                                   <a href="{{route('photo.show',$photo)}}">
                                       {{__('Photo')}}
                                   </a>
                               </th>
                           <td>
                               <a href="{{route('photo.show',$photo)}}">
                                   <img width="100px" src="{{asset('images/PeoplePhotos/'.$photo->nombre)}}">
                               </a>
                           </td>
                           @endforeach
                       </tr>
                       <tr>
                           <th>{{__('Identification card')}}</th>
                           <td>
                               <a>{{$person->PER_CEDULA}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Names')}}</th>
                           <td>
                               <a> {{$person->PER_NOMBRES}}</a>
                           </td>
                       </tr>
                       <tr><th>{{__('LastName')}}</th>
                           <td>
                               <a> {{$person->PER_APELLIDOS}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Sex')}}</th>
                           <td>
                               <a> {{$person->PER_SEXO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Age')}}</th>
                           <td>
                               <a>{{\Carbon\Carbon::parse($person->PER_FECHANACIMIENTO)->age}} Años</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Blood type')}}</th>
                           <td>
                               <a>{{$person->PER_TIPOSANGRE}}</a>
                           </td>
                       </tr>
                       <tr> <th>{{__('Email')}}</th>
                           <td>
                               <a> {{$person->PER_CORREO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Direction')}}</th>
                           <td>
                               <a> {{$person->PER_DIRECCION}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Phone')}}</th>
                           <td>
                               <a> {{$person->PER_NUMERO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('CellPhone')}}</th>
                           <td>
                               <a> {{$person->PER_CELULAR}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Institution')}}</th>
                           <td>
                               <a href="{{route('institution.show',$person->institution_id)}}">
                                   {{$person->institution->INS_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Area')}}</th>
                           <td>
                               <a href="{{route('area.show',$person->area_id)}}">
                                   {{$person->area->ARE_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       </thead>
                   </table>
               </div>
                <div class="btn-group btn-group-xs">
                <a href="{{route('person.edit',$person)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                    @if(auth()->user()->hasRoles(['admin']))
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
                        @endif()
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

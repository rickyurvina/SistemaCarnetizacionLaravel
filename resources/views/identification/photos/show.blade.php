@extends('identification.layouts.app')
@section('title','Ver Foto')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'photo.index','btnText'=>'Panel de Control','textTitle'=>'Detalles Foto Usuario'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-bordered">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <td>
                                   <img width="100px" src="{{asset('images/PeoplePhotos/'.$photo->nombre)}}">
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('User')}}</th>
                               <td>
                                   <a href="{{route('person.show',$photo->people->id)}}">
                                       {{$photo->people->PER_NOMBRES}} {{$photo->people->PER_APELLIDOS}}
                                   </a>
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Created_at')}}</th>
                               <td>
                                   <a>
                                       <p>{{$photo->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Updated_at')}}</th>
                               <td >
                                   <a>
                                       <p>{{$photo->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </thead>
                       </table>
                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('photo.edit',$photo)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                       @if(auth()->user()->hasRoles(['admin']))
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-photo').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-photo"
                       method="POST"
                       action="{{route('photo.destroy',$photo)}}">
                       @csrf @method('DELETE')
                   </form>
                           @endif()
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

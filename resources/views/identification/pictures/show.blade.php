@extends('identification.layouts.app')
@section('title','Ver Foto')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'picture.index','btnText'=>'Panel de Control','textTitle'=>'Detalles'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-bordered">
                           <thead>
                           <tr>
                               <th>{{__('Photo')}}</th>
                               <td>
                                   <img width="100px" src="{{asset('images/StudentsPhotos/'.$picture->nombre)}}">
                               </td>
                           </tr>
                           <tr> <th>{{__('Student')}}</th>
                               <td>
                                   <a href="{{route('student.show',$picture->student->id)}}">
                                       {{$picture->student->EST_NOMBRES}} {{$picture->student->EST_APELLIDOS}}
                                   </a>
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Created_at')}}</th>
                               <td>
                                   <a>
                                       <p>{{$picture->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Updated_at')}}</th>
                               <td >
                                   <a>
                                       <p>{{$picture->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </thead>
                       </table>
                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('picture.edit',$picture)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                       @if(auth()->user()->hasRoles(['admin']))

                       <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-picture').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-picture"
                       method="POST"
                       action="{{route('picture.destroy',$picture)}}">
                       @csrf @method('DELETE')
                   </form>
                           @endif()
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

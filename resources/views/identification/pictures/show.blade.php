@extends('identification.layouts.app')
@section('title','Ver Foto')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'picture.index','btnText'=>'Panel de Control','textTitle'=>'Detalles'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <th>{{__('Type')}}</th>
                               <th>{{__('Student')}}</th>
                               <th>{{__('Created_at')}}</th>
                               <th>{{__('Updated_at')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>
                                   <a>{{$picture->nombre}}</a>
                               </td>
                               <td>
                                   <a> {{$picture->tipo}}</a>
                               </td>
                               <td>
                                   <a href="{{route('student.show',$picture->student->id)}}">
                                       {{$picture->student->EST_NOMBRES}} {{$picture->student->EST_APELLIDOS}}
                                   </a>
                               </td>
                               <td>
                                   <a>
                                       <p>{{__('Created_at')}} {{$picture->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                               <td >
                                   <a>
                                       <p>{{__('Updated_at')}}{{$picture->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </tbody>
                       </table>
                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('picture.edit',$picture)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
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
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Curso'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <th>{{__('Parallel')}}</th>
                               <th>{{__('Institution')}}</th>
                               <th>{{__('Created_at')}}</th>
                               <th>{{__('Updated_at')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>
                                   <a>{{$course->CUR_NOMBRE}}</a>
                                   <br />
                                   <small>
                                       {{__('Created_at')}} {{$course->created_at->format('d/m/Y')}}
                                   </small>
                               </td>
                               <td>
                                   <a> {{$course->CUR_PARALELO}}</a>
                               </td>
                               <td class="project_progress">
                                   <a href="{{route('institution.show',$course->institution->id)}}">
                                       {{$course->institution->INS_NOMBRE}}
                                   </a>
                               </td>
                               <td class="project_progress">
                                   <a>
                                       <p>{{__('Created_at')}} {{$course->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                               <td class="project_progress">
                                   <a>
                                       <p>{{__('Updated_at')}}{{$course->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </tbody>
                       </table>
                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('course.edit',$course)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-course').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-course"
                       method="POST"
                       action="{{route('course.destroy',$course)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

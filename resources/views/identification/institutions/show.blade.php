@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <table id="datatable"
                              class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <th>{{__('Direction')}}</th>
                               <th>{{__('Phone')}}</th>
                               <th>{{__('CellPhone')}}</th>
                               <th>{{__('Type')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                      @foreach($courses as $course)
                       <tr>
                           <td>
                               <a>{{$course->INS_NOMBRE}}</a>
                               <br />
                               <small>
                                   {{__('Created_at')}} {{$course->created_at->format('d/m/Y')}}
                               </small>
                           </td>
                           <td>
                               <a> {{$course->INS_DIRECCION}}</a>
                           </td>
                           <td class="project_progress">
                               <a> {{$course->INS_TELEFONO}}</a>
                           </td>
                           <td>
                               <a> {{$course->INS_CELULAR}}</a>
                           </td>
                           <td>
                               <a> {{$course->INS_TIPO}}</a>
                           </td>
                       </tr>
                      @endforeach
                       <div class="card-box table-responsive">
                           <table id="datatable" class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>
                                {{__('Name of Course')}}
                            </th>
                            <th>
                                {{__('Parallel of Course')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($course->course as $cur)
                            <tr>
                                <td>
                                    <a href="{{route('course.show',$cur)}}">
                                        {{$cur->CUR_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{$cur->CUR_PARALELO}}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <h1>{{__('There are no registered courses for this institution')}}</h1>
                        @endforelse
                        </tbody>
                    </table>
                       </div>
                   <div class="btn-group btn-group-xs">
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
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
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
</div>
@endsection

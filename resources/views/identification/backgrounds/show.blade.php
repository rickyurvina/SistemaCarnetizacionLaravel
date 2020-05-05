@extends('identification.layouts.app')
@section('title',' Ver Fondo')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'background.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Fondo'])
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
                               <th>{{__('Institution')}}</th>
                               <th>{{__('Created_at')}}</th>
                               <th>{{__('Updated_at')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>
                                   <a>{{$background->FON_NOMBRE}}</a>
                               </td>
                               <td>
                                   <a> {{$background->FON_TIPO}}</a>
                               </td>
                               <td>
                                   <a href="{{route('institution.show',$background->institution->id)}}">
                                       {{$background->institution->INS_NOMBRE}}
                                   </a>
                               </td>
                               <td>
                                   <a>
                                       <p>{{__('Created_at')}} {{$background->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                               <td >
                                   <a>
                                       <p>{{__('Updated_at')}}{{$background->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </tbody>
                       </table>
{{--                       @foreach($students as $student)--}}
{{--                           @endforeach--}}
{{--                       <div class="card-box table-responsive">--}}
{{--                       <table id="datatable"--}}
{{--                              class="table table-striped projects">--}}
{{--                           <thead>--}}
{{--                           <tr>--}}
{{--                               <th>{{__('Identification card')}}</th>--}}
{{--                               <th>{{__('Name')}}</th>--}}
{{--                               <th>{{__('LastName')}}</th>--}}
{{--                               <th>{{__('Email')}}</th>--}}
{{--                               <th>{{__('Code')}}</th>--}}
{{--                               <th>{{__('Actions')}}</th>--}}
{{--                           </tr>--}}
{{--                           </thead>--}}
{{--                           <tbody>--}}
{{--                           @foreach($student->student as $stu)--}}
{{--                           <tr>--}}
{{--                               <td>--}}
{{--                                   <a href="{{route('student.show',$stu->id)}}">--}}
{{--                                   {{$stu->EST_CEDULA}}--}}
{{--                                   </a>--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   {{$stu->EST_NOMBRES}}--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   {{$stu->EST_APELLIDOS}}--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   {{$stu->EST_CORREO}}--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   {{$stu->EST_CODIGO}}--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   <a href="{{route('student.show',$stu->id)}}"--}}
{{--                                      class="btn btn-primary btn-xs">--}}
{{--                                       <i class="fa fa-search"></i>--}}
{{--                                       {{__('View')}}--}}
{{--                                   </a>--}}
{{--                               </td>--}}
{{--                           @endforeach--}}
{{--                           </tr>--}}
{{--                           </tbody>--}}
{{--                       </table>--}}
{{--                       </div>--}}

                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('background.edit',$background)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-background').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-background"
                       method="POST"
                       action="{{route('background.destroy',$background)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

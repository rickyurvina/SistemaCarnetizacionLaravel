@extends('identification.layouts.app')
@section('title','Ver Estudiante')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'student.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Estudiante'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                   <table id="datatable"
                          class="table table-sm">
                       <thead>
                       <tr>
                           @foreach($picture as $pic)
                           <th>
                               <a href="{{route('picture.show',$pic)}}">

                               {{__('Photo')}}
                               </a>
                           </th>
                           <td>
                                   <a href="{{route('picture.show',$pic)}}">
                                   <img  width="100px"  src="{{asset('images/StudentsPhotos/'.$pic->nombre)}}">
                                   </a>
                               @endforeach
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Identification card')}}
                           <td>
                               <a>{{$student->EST_CEDULA}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Name')}}</th>
                           <td>
                               <a> {{$student->EST_NOMBRES}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('LastName')}}</th>
                           <td>
                               <a> {{$student->EST_APELLIDOS}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Sex')}}</th>
                           <td>
                               <a> {{$student->EST_SEXO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Age')}}</th>
                           <td>
                               <a>{{\Carbon\Carbon::parse($student->EST_FECHANACIMIENTO)->age}} Años</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Blood type')}}</th>
                           <td>
                               <a>{{$student->EST_TIPOSANGRE}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Email')}}</th>
                           <td>
                               <a> {{$student->EST_CORREO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Direction')}}</th>
                           <td>
                               <a> {{$student->EST_DIRECCION}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Phone')}}</th>
                           <td>
                               <a> {{$student->EST_NUMERO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('CellPhone')}}</th>
                           <td>
                               <a> {{$student->EST_CELULAR}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Code')}}</th>
                           <td>
                               <a> {{$student->EST_CODIGO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Enrollment')}}</th>
                           <td>
                               <a> {{$student->EST_MATRICULA}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Signed up')}}</th>
                           <td>
                               <a> {{$student->EST_INSCRITO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('No Enrollment')}}</th>
                           <td>
                               <a> {{$student->EST_NROMATRICULA}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Retired')}}</th>
                           <td>
                               <a> {{$student->EST_RETIRADO}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Scholarship')}}</th>
                           <td>
                               <a> {{$student->EST_BECA}}</a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Institution')}}</th>
                           <td>
                               <a href="{{route('institution.show',$student->institution_id)}}">
                                   {{$student->institution->INS_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       <tr>
                           <th>{{__('Course')}}</th>
                           <td>
                               <a href="{{route('course.show',$student->course_id)}}">
                                   {{$student->course->CUR_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       </thead>
                       <tbody>
                       <tr> </tr>
                       </tbody>
                   </table>
                   </div>
               </div>
                <div class="btn-group btn-group-xs">
                    <a href="{{route('student.edit',$student)}}"
                       class="btn btn-outline-info btn-xs">
                        <i class="fa fa-pencil"></i>
                        {{__('Edit')}}
                    </a>
                    @if(!empty($pic))
                <a href="{{route('picture.edit',$pic)}}"
                   class="btn btn-outline-success btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit Photo')}}
                </a>
                    @endif
                    @if(auth()->user()->isAdmin())
                    <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-student').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-studentn"
                       method="POST"
                       action="{{route('student.destroy',$student)}}">
                       @csrf @method('DELETE')
                   </form>
                        @endif()
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

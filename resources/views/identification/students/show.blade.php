@extends('identification.layouts.app')
@section('title','Ver Estudiante')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'student.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Estudiante'])
               <div>
                <br/>
                   <div>
                       <h1>Foto</h1>
                       @foreach($picture as $pic)
                           <img width="100px" src="{{asset('images/StudentsPhotos/'.$pic->nombre)}}">
                       @endforeach
                   </div>
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
                           <th>{{__('Email')}}</th>
                           <th>{{__('Direction')}}</th>
                           <th>{{__('Phone')}}</th>
                           <th>{{__('CellPhone')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>
                               <a>{{$student->EST_CEDULA}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_NOMBRES}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_APELLIDOS}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_SEXO}}</a>
                           </td>
                           <td>
                               <a>{{\Carbon\Carbon::parse($student->EST_FECHANACIMIENTO)->age}} Años</a>
                           </td>
                           <td>
                               <a>{{$student->EST_TIPOSANGRE}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_CORREO}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_DIRECCION}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_NUMERO}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_CELULAR}}</a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('Code')}}</th>
                           <th>{{__('Enrollment')}}</th>
                           <th>{{__('Signed up')}}</th>
                           <th>{{__('No Enrollment')}}</th>
                           <th>{{__('Retired')}}</th>
                           <th>{{__('Scholarship')}}</th>
                           <th>{{__('Institution')}}</th>
                           <th>{{__('Course')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>

                           <td>
                               <a> {{$student->EST_CODIGO}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_MATRICULA}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_INSCRITO}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_NROMATRICULA}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_RETIRADO}}</a>
                           </td>
                           <td>
                               <a> {{$student->EST_BECA}}</a>
                           </td>

                           <td>
                               <a href="{{route('institution.show',$student->institution_id)}}">
                                   {{$student->institution->INS_NOMBRE}}
                               </a>
                           </td>
                           <td>
                               <a href="{{route('course.show',$student->course_id)}}">
                                   {{$student->course->CUR_NOMBRE}}
                               </a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
               </div>
                <div class="btn-group btn-group-xs">
                <a href="{{route('student.edit',$student)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
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
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

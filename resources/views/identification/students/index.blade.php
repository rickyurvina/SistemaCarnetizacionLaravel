@extends('identification.layouts.app')
@section('title','Estudiantes')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'student.create','btnText'=>'Crear','textTitle'=>'Estudiantes'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        @if(auth()->user()->hasRoles(['admin']))
                        {{Form::open(['route'=>'student.index','method'=>'GET'])}}
                         <div class="input-group">
                             {{Form::text('EST_CEDULA', null,['class'=>'form-control','placeholder'=>'Cédula del estudiante'])}}
                                <select class="custom-select custom-select-sm"
                                        name="institution_id"
                                        id="institution_id">
                                    <option value=""
                                        selected> {{__('Search by Institution')}}
                                    </option>
                                    @foreach($institutions as $institution )
                                            <option value="{{$institution->id}}">
                                                {{$institution->INS_NOMBRE}}
                                            </option>
                                    @endforeach
                                </select>
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-xs" >{{__('Search')}}</button>
                            </span>
                             @endif()
                         </div>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of students')}}
                        <a href="{{route('student.index')}}"
                               class="btn btn-link btn-xs">
                        </a> {{$students->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Identification card')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('LastName')}}</th>
                            <th>{{__('Age')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('CellPhone')}}</th>
                            <th>{{__('Code')}}</th>
                            <th>{{__('Institution')}}</th>
                            <th>{{__('Course')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>
                                    <a>{{$student->EST_CEDULA}}</a>
                                    <br />
                                    <small>
                                        {{__('Created_at')}} {{$student->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <a> {{$student->EST_NOMBRES}}</a>
                                </td>
                                <td>
                                    <a> {{$student->EST_APELLIDOS}}</a>
                                </td>
                                <td>
                                    <a>{{\Carbon\Carbon::parse($student->EST_FECHANACIMIENTO)->age}} Años</a>
                                </td>
                                <td>
                                    <a> {{$student->EST_CORREO}}</a>
                                </td>
                                <td>
                                    <a> {{$student->EST_CELULAR}}</a>
                                </td>
                                <td>
                                    <a> {{$student->EST_CODIGO}}</a>
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
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('student.show',$student)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('student.edit',$student)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                        @if(auth()->user()->hasRoles(['admin']))
                                        <form action="{{route('student.destroy',$student->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="sumbit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                            @endif()
                                    </div>
                                </td>
                            </tr>
                        @empty
                          <h1>{{__('There are no registered students')}}</h1>
                        @endforelse
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
        <!-- end project list -->
    </div>
</div>
</div>
</div>
    <!-- /page content -->
@endsection


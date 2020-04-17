@extends('identification.layouts.app')
@section('title','Institucion Educativa')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'course.create','btnText'=>'Crear','textTitle'=>'Cursos'])

        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'course.index','method'=>'GET'])}}
                        <div class="input-group">
                            {{Form::text('CUR_NOMBRE', null,['class'=>'form-control','placeholder'=>'Nombre del curso'])}}
                          <span class="input-group-btn">
                      <button type="submit" class="btn btn-default" >Buscar</button>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of courses')}} {{$courses->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
{{--                            <th style="width: 1%">#</th>--}}
                            <th style="width: 20%">{{__('Name')}}</th>
                            <th>{{__('Paralelo')}}</th>
                            <th>{{__('institution_id')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courses as $course)
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
                                    <a> {{$course->institution_id}}</a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('course.show',$course)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-folder"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('course.edit',$course)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                    <form action="{{route('course.destroy',$course->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="sumbit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                          <h1>{{__('There are no registered courses')}}</h1>
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


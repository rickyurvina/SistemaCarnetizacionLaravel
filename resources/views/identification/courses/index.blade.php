@extends('identification.layouts.app')
@section('title','Cursos')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'course.create','btnText'=>'Crear','textTitle'=>'Cursos'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                       @if(auth()->user()->isAdmin())
                        {{Form::open(['route'=>'course.index','method'=>'GET'])}}
                        <div class="input-group">
                                <select class="custom-select custom-select-sm"
                                        name="institution_id"
                                        id="institution_id">
                                    <option value="" selected>
                                        {{__('Search by Institution')}}
                                    </option>
                                    @foreach($institutions as $institution )
                                            <option value="{{$institution->id}}">
                                                {{$institution->INS_NOMBRE}}
                                            </option>
                                    @endforeach
                                </select>
                    <span class="input-group-btn">
                          <button
                              type="submit"
                              class="btn btn-xs" >{{__('Search')}}
                          </button>
                    </span>
                    </div>
                        {{Form::close()}}
                       @endif
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of courses')}}
                        <a href="{{route('course.index')}}"
                               class="btn btn-link btn-xs">
                        </a> {{$courses->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Parallel')}}</th>
                            <th>{{__('Institution')}}</th>
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
                                    <a href="{{route('institution.show',$course->institution->id)}}">
                                     {{$course->institution->INS_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('course.show',$course)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('course.edit',$course)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                </a>
                                        @if(auth()->user()->isAdmin())
                                        <form action="{{route('course.destroy',$course->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                            @endif
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
{{--    </div>--}}
</div>
</div>
</div>
    <!-- /page content -->
@endsection


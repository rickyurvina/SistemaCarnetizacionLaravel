@extends('identification.layouts.app')
@section('title','pictures')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'picture.create','btnText'=>'Crear','textTitle'=>'Fotos Estudiantes'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'picture.index','method'=>'GET'])}}
                        <div class="input-group">
                            @if(auth()->user()->hasRoles(['admin']))
                            {{Form::text('student_id', null,['class'=>'form-control','placeholder'=>'Cedula del Estudiante'])}}
                    <span class="input-group-btn">
                          <button
                              type="submit"
                              class="btn btn-xs" >{{__('Search')}}
                          </button>
                    </span>
                                @endif()
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of Photos')}}
                   {{$pictures->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Student')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pictures as $picture)
                            <tr>
                                <td>
                                    <img width="100px" src="{{asset('images/StudentsPhotos/'.$picture->nombre)}}">
                                    <br />
                                    <small>
                                        {{__('Created_at')}} {{$picture->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td class="project_progress">
                                    <a href="{{route('student.show',$picture->student_id)}}">
                                        {{$picture->student->EST_NOMBRES}} {{$picture->student->EST_APELLIDOS}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('picture.show',$picture)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                        <a href="{{route('picture.edit',$picture)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                        @if(auth()->user()->hasRoles(['admin']))
                                        <form action="{{route('picture.destroy',$picture->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                            @endif()
                                    </div>
                                </td>
                            </tr>
                        @empty
                          <h1>{{__('There are no registered photos')}}</h1>
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


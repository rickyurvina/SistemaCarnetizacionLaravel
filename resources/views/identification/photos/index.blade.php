@extends('identification.layouts.app')
@section('title','Photos')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'photo.create','btnText'=>'Crear','textTitle'=>'Fotos Usuarios Organizaciones'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'photo.index','method'=>'GET'])}}
                        <div class="input-group">
                            {{Form::text('people_id', null,['class'=>'form-control','placeholder'=>'Cedula del usuario'])}}
                    <span class="input-group-btn">
                          <button
                              type="submit"
                              class="btn btn-xs" >{{__('Search')}}
                          </button>
                    </span>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of Photos')}}
                   {{$photos->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('person')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($photos as $photo)
                            <tr>
                                <td>
                                    <a>{{$photo->nombre}}</a>
                                    <br />
                                    <small>
                                        {{__('Created_at')}} {{$photo->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <a> {{$photo->tipo}}</a>
                                </td>
                                <td class="project_progress">
                                    <a href="{{route('person.show',$photo->people_id)}}">
                                        {{$photo->people->PER_NOMBRES}} {{$photo->people->PER_APELLIDOS}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('photo.show',$photo)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('photo.edit',$photo)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                    <form action="{{route('photo.destroy',$photo->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
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


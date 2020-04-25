@extends('identification.layouts.app')
@section('title','Institucion Educativa')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'area.create','btnText'=>'Crear','textTitle'=>'Areas-Organizaciones'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'area.index','method'=>'GET'])}}
                        <div class="input-group">
                            {{Form::text('ARE_NOMBRE', null,['class'=>'form-control','placeholder'=>'Nombre del Área'])}}
                            <span class="input-group-btn">
                      <button type="submit" class="btn btn-default" >{{__('Search')}}</button>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of areas')}} {{$areas->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($areas as $area)
                            <tr>
                                <td>
                                    <a>{{$area->ARE_NOMBRE}}</a>
                                    <br />
                                    <small>
                                        {{__('Created_at')}} {{$area->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <a> {{$area->ARE_DESCRIPCCION}}</a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('area.show',$area)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-folder"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('area.edit',$area)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                </a>
                                    <form action="{{route('area.destroy',$area->id)}}" method="POST">
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
                          <h1>{{__('There are no registered areas')}}</h1>
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


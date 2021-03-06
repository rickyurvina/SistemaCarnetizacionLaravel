@extends('identification.layouts.app')
@section('title','Instituciones')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'institution.create','btnText'=>'Crear','textTitle'=>'Instituciones-Organizaciones'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    {{Form::open(['route'=>'institution.index','method'=>'GET'])}}
                    <div class="input-group">
                        {{Form::text('INS_NOMBRE', null,['class'=>'form-control','placeholder'=>'Nombre de la Institución'])}}
                        <select class="custom-select custom-select-sm"
                                name="institution_id"
                                id="institution_id">
                            <option value="" selected>
                                --{{__('Select One')}}--
                            </option>
                            <option value="Institución Educativa">
                                {{__('Institution Educative')}}
                            </option>
                            <option value="Organización">
                                {{__('Organisation')}}
                            </option>
                        </select>
                        <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">{{__('Search')}}</button>
                    </span>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="card-box table-responsive">
                <p>{{__('List of institutions')}}
                    {{$institutions->appends(request()->query())->links()}}</p>
                <!-- start project list -->
                <table id="datatable"
                       class="table table-striped projects">
                    <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Direction')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('CellPhone')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($institutions as $institution)
                        <tr>
                            <td width="250px">
                                <a>{{$institution->INS_NOMBRE}}</a>
                                <br/>
                                <small>
                                    {{__('Created_at')}} {{$institution->created_at->format('d/m/Y')}}
                                </small>
                            </td>
                            <td width="200px">
                                <a> {{$institution->INS_DIRECCION}}</a>
                            </td>
                            <td width="100px">
                                <a> {{$institution->INS_TELEFONO}}</a>
                            </td>
                            <td width="100px">
                                <a> {{$institution->INS_CELULAR}}</a>
                            </td>
                            <td width="200px">
                                <a> {{$institution->INS_TIPO}}</a>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('institution.show',$institution)}}"
                                       class="btn btn-primary btn-xs">
                                        <i class="fa fa-search"></i>
                                        {{__('View')}}
                                    </a>
                                    <a href="{{route('institution.edit',$institution)}}"
                                       class="btn btn-info btn-xs">
                                        <i class="fa fa-pencil"></i>
                                        {{__('Edit')}}
                                    </a>
                                    <form action="{{route('institution.destroy',$institution->id)}}" method="POST">
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
                        <h1>{{__('There are no registered institutions')}}</h1>
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


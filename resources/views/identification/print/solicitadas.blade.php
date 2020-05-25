@extends('identification.layouts.app')
@section('title','Usuarios Organizaciones')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'person.create','btnText'=>'Crear','textTitle'=>'Usuarios Organizaciones'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    {{Form::open(['route'=>'requested','method'=>'GET'])}}
                    <div class="input-group">
{{--                            {{Form::text('P', null,['class'=>'form-control','placeholder'=>'Cédula del Usuario'])}}--}}
                            <select class="custom-select custom-select-sm"
                                    name="institution_id"
                                    id="select-institution">
                                <option value=""
                                        selected> {{__('Search by Institution')}}
                                </option>
                                @foreach($institutions as $institution )
                                    <option value="{{$institution->id}}">
                                        {{$institution->INS_NOMBRE}}
                                    </option>
                                @endforeach
                            </select>
                        <select class="custom-select custom-select-sm col-md-6 col-sm-6 "
                                name="course_id" id="select-course"
                                >
                            <option value="" selected>Seleccione Curso</option>
                          @foreach($course as $id =>$name )
                                    <option value="{{$id}}">
                                        {{$name}}
                                    </option>
                            @endforeach
                        </select>
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-xs" >{{__('Search')}}</button>
                            </span>
                    </div>

                </div>
{{--                <div class="card-box table-responsive">--}}

{{--                    <p>{{__('List of people')}}--}}
{{--                 {{$people->fragment('foo')->links()}}</p>--}}
{{--                    <!-- start project list -->--}}
{{--                    <table id="datatable"--}}
{{--                           class="table table-striped projects">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>{{__('Identification card')}}</th>--}}
{{--                            <th>{{__('Name')}}</th>--}}
{{--                            <th>{{__('LastName')}}</th>--}}
{{--                            <th>{{__('Code')}}</th>--}}
{{--                            <th>{{__('Impresos')}}</th>--}}
{{--                            <th>{{__('Fecha Solicitud')}}</th>--}}
{{--                            <th>{{__('Actions')}}</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($people as $person)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <a>{{$person->PER_CEDULA}}</a>--}}
{{--                                    <br />--}}
{{--                                    <small>--}}
{{--                                        {{__('Created_at')}} {{$person->created_at->format('d/m/Y')}}--}}
{{--                                    </small>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a> {{$person->PER_NOMBRES}}</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a> {{$person->PER_APELLIDOS}}</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a>{{\Carbon\Carbon::parse($person->PER_FECHANACIMIENTO)->age}} Años</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a> {{$person->PER_CELULAR}}</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{route('institution.show',$person->institution_id)}}">--}}
{{--                                        {{$person->institution->INS_NOMBRE}}--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{route('area.show',$person->area_id)}}">--}}
{{--                                        {{$person->area->ARE_NOMBRE}}--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>--}}

{{--                                    <div class="btn-group btn-group-sm">--}}
{{--                                        <a href="#"--}}
{{--                                           class="btn btn-primary btn-xs">--}}
{{--                                            <i class="fa fa-search"></i>--}}
{{--                                            {{__('Ver Carnet')}}--}}
{{--                                        </a>--}}
{{--                                        <a href="#"--}}
{{--                                           class="btn btn-primary btn-xs">--}}
{{--                                            <i class="fa fa-search"></i>--}}
{{--                                            {{__('Aprobar Impresion')}}--}}
{{--                                        </a>--}}
{{--                                        <a href="#"--}}
{{--                                           class="btn btn-primary btn-xs">--}}
{{--                                            <i class="fa fa-search"></i>--}}
{{--                                            {{__('Cancelar Impresion')}}--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <h1>{{__('There are no registered people')}}</h1>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
                    {{Form::close()}}
{{--                </div>--}}
            </div>
        </div>

        <!-- end project list -->
    </div>
    </div>
    </div>
    </div>
    <!-- /page content -->
@endsection


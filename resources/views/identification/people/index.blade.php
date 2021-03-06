@extends('identification.layouts.app')
@section('title','Usuarios-Organizaciones')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'person.create','btnText'=>'Crear','textTitle'=>'Usuarios Organizaciones'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    {{Form::open(['route'=>'person.index','method'=>'GET'])}}
                    <div class="input-group">
                        @if(auth()->user()->hasRoles(['admin']))
                            {{Form::text('PER_CEDULA', null,['class'=>'form-control','placeholder'=>'Cédula del Usuario'])}}
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
                              <button type="submit" class="btn btn-xs">{{__('Search')}}</button>
                            </span>
                        @endif()
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of people')}}
                        @if(auth()->user()->hasRoles(['representanteOrganizacion']))
                            <a href="solicitud" class="btn btn-outline-success btn-xs">
                                {{__('Solicitar Impresion')}}<i class="fa fa-check"></i>
                            </a>
                        @endif
                        {{$people->appends(request()->query())->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Identification card')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('LastName')}}</th>
                            <th>{{__('Age')}}</th>
                            <th>{{__('CellPhone')}}</th>
                            <th>{{__('Institution')}}</th>
                            <th>{{__('Area')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($people as $person)
                            <tr>
                                <td>
                                    <a>{{$person->PER_CEDULA}}</a>
                                    <br/>
                                    <small>
                                        {{__('Created_at')}} {{$person->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <a> {{$person->PER_NOMBRES}}</a>
                                </td>
                                <td>
                                    <a> {{$person->PER_APELLIDOS}}</a>
                                </td>
                                <td>
                                    <a>{{\Carbon\Carbon::parse($person->PER_FECHANACIMIENTO)->age}} Años</a>
                                </td>
                                <td>
                                    <a> {{$person->PER_CELULAR}}</a>
                                </td>
                                <td>
                                    <a href="{{route('institution.show',$person->institution_id)}}">
                                        {{$person->institution->INS_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('area.show',$person->area_id)}}">
                                        {{$person->area->ARE_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{route('print_person',$person)}}"
                                               class="btn btn-outline-success btn-xs">
                                                <i class="fa fa-print"></i>
                                                {{__('View Carnet')}}
                                            </a>
                                            <a href="{{route('person.show',$person)}}"
                                               class="btn btn-primary btn-xs">
                                                <i class="fa fa-search"></i>
                                                {{__('View')}}
                                            </a>
                                            <a href="{{route('person.edit',$person)}}"
                                               class="btn btn-info btn-xs">
                                                <i class="fa fa-pencil"></i>
                                                {{__('Edit')}}
                                                {{Form::close()}}
                                            </a>
                                            <form action="{{route('person.destroy',$person->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="sumbit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash-o"></i>
                                                    {{__('Delete')}}
                                                </button>
                                            </form>
                                    </div>
                                    @endif()
                                </td>
                            </tr>
                        @empty
                            <h1>{{__('There are no registered people')}}</h1>
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


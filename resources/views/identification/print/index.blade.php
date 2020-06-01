@extends('identification.layouts.app')
@section('title','Solicitadas')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'solicitadas.index','btnText'=>'Panel De Control','textTitle'=>'Solicitadas'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    {{Form::open(['route'=>'solicitadas.index','method'=>'GET'])}}
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
                              class="btn btn-xs">{{__('Search')}}
                          </button>
                    </span>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of solicitadass')}}
                        {{$solicitadas->appends(request()->query())->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Cedula')}}</th>
                            <th>{{__('Number Of Requested')}}</th>
                            <th>{{__('Institution')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($solicitadas as $solicitada)
                            <tr>
                                <td>
                                    <a>{{$solicitada->cedula}}</a>
                                    <br/>
                                    <small>
                                        {{__('Created_at')}} {{$solicitada->created_at->format('d/m/Y')}}
                                    </small>
                                </td>
                                <td>
                                    <a> {{$solicitada->tipo}}</a>
                                </td>
                                <td class="project_progress">
                                    <a href="{{route('institution.show',$solicitada->institution->id)}}">
                                        {{$solicitada->institution->INS_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#"
                                           class="btn btn-outline-success btn-xs">
                                            <i class="fa fa-print"></i>
                                            {{__('View Carnet')}}
                                        </a>
                                        <a href="{{route('solicitadas.edit',$solicitada)}}"
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-print"></i>
                                            {{__('Aprobar Solicitud')}}
                                            {{Form::close()}}
                                        </a>
                                        <form action="{{route('solicitadas.destroy',$solicitada->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-print"></i>
                                                {{__('Cancel Print')}}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <h1>{{__('There are no registered solicitadas')}}</h1>
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


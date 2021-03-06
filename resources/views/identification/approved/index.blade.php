@extends('identification.layouts.app')
@section('title','Solicitadas')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'aprobadas.index','btnText'=>'Panel De Control','textTitle'=>'Solicitadas'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    {{Form::open(['route'=>'aprobadas.index','method'=>'GET'])}}
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
                    <p>{{__('List of approved')}}
                        {{$aprobadas->appends(request()->query())->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('Identification card')}}</th>
                            <th>{{__('Institution')}}</th>
                            <th>{{__('Requested on')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($aprobadas as $aprobada)
                            <tr>
                                <td class="project_progress">
                                    {{$aprobada->solicitadas->cedula}}
                                </td>
                                <td class="project_progress">
                                    <a href="{{route('institution.show', $aprobada->institution_id)}}">
                                        {{$aprobada->institution->INS_NOMBRE}}
                                    </a>
                                </td>
                                <td>
                                    {{$aprobada->created_at->format('d/m/Y H:i:s')}}
                                </td>
                                <td>
                                    {{Form::close()}}
                                    <div class="btn-group btn-group-sm">
                                        <form action="{{route('aprobadas.destroy',$aprobada->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-print"></i>
                                                {{__('Delete')}}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <h1>{{__('There are no registered approved')}}</h1>
                        @endforelse
                        </tbody>
                    </table>
                    @if(!empty($count))
                        <div>
                            <p>La institución {{$aprobada->institution->INS_NOMBRE}} tiene {{$count}} solicitudes de
                                impresión aprobadas</p>
                        </div>
                    @endif()
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


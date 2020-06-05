@extends('identification.layouts.app')
@section('title',' Ver Área')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'area.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Área'])
    <div>
        <br/>
        <div class="card-box table-responsive">
            <table id="datatable"
                   class="table d-sm-table-row">
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <td>
                        <a>{{$area->ARE_NOMBRE}}</a>
                    </td>
                </tr>
                <tr>
                    <th>{{__('Description')}}</th>
                    <td>
                        <a> {{$area->ARE_DESCRIPCCION}}</a>
                    </td>
                </tr>
                <tr>
                    <th>{{__('Created_at')}}</th>
                    <td>
                        <a>{{$area->created_at->format('d/m/Y')}}</a>
                    </td>
                </tr>
                <tr>
                    <th>{{__('Updated_at')}}</th>
                    <td>
                        <a>{{$area->updated_at->format('d/m/Y')}}</a>
                    </td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="btn-group btn-group-xs">
        <a href="{{route('area.edit',$area)}}"
           class="btn btn-info btn-xs">
            <i class="fa fa-pencil"></i>
            {{__('Edit')}}
        </a>
        <a href="#"
           class="btn btn-danger btn-xs"
           onclick="document.
                    getElementById('delete-area').
                       submit()"
        ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
        <form
            class="d-none"
            id="delete-area"
            method="POST"
            action="{{route('area.destroy',$area)}}">
            @csrf @method('DELETE')
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

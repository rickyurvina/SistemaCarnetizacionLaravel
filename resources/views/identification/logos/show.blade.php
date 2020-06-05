@extends('identification.layouts.app')
@section('title',' Ver Logos')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'logo.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Logo'])
    <div>
        <br/>
        <div class="card-box table-responsive">
            <!-- start project list -->
            <table id="datatable"
                   class="table table-bordered">
                <thead>
                <tr>
                    <th>{{__('Logo')}}</th>
                    <td>
                        <img width="200px" src="{{asset('images/LogosPhotos/'.$logo->LOG_NOMBRE)}}">
                    </td>
                </tr>
                <tr>
                    <th>{{__('Institution')}}</th>
                    <td>
                        <a href="{{route('institution.show',$logo->institution->id)}}">
                            {{$logo->institution->INS_NOMBRE}}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>{{__('Created_at')}}</th>
                    <td>
                        <a>
                            <p>{{$logo->created_at->format('d/m/Y')}}</p>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>{{__('Updated_at')}}</th>
                    <td>
                        <a>
                            <p>{{$logo->updated_at->format('d/m/Y')}}</p>
                        </a>
                    </td>
                </tr>
                </thead>
            </table>
        </div>
        <div class="btn-group btn-group-xs">
            <a href="{{route('logo.edit',$logo)}}"
               class="btn btn-info btn-xs">
                <i class="fa fa-pencil"></i>
                {{__('Edit')}}
            </a>
            <a href="#"
               class="btn btn-danger btn-xs"
               onclick="document.
                    getElementById('delete-logo').
                       submit()"
            ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
            <form
                class="d-none"
                id="delete-logo"
                method="POST"
                action="{{route('logo.destroy',$logo)}}">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

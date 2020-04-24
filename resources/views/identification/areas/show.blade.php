@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'area.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                <p>{{__('Name')}}: {{$area->ARE_NOMBRE}}</p>
                <p>{{__('Description')}}: {{$area->ARE_DESCRIPCCION}}</p>
                <p>{{__('Created_at')}} {{$area->created_at->format('d/m/Y')}}</p>
                <p>{{__('Updated_at')}}{{$area->updated_at->format('d/m/Y')}}</p>
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

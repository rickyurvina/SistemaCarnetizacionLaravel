@extends('identification.layouts.app')
@section('title',' Ver Área')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'area.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('Name')}}</th>
                           <th>{{__('Description')}}</th>
                           <th>{{__('Created_at')}}</th>
                           <th>{{__('Updated_at')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>
                             <a>{{$area->ARE_NOMBRE}}</a>
                           </td>
                           <td>
                               <a> {{$area->ARE_DESCRIPCCION}}</a>
                           </td>
                           <td>
                               <a>{{$area->created_at->format('d/m/Y')}}<</a>
                           </td>
                           <td>
                               <a>{{$area->updated_at->format('d/m/Y')}}</a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
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

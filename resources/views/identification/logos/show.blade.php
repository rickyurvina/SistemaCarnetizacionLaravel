@extends('identification.layouts.app')
@section('title',' Ver Logos')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'logo.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Logo'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <th>{{__('Type')}}</th>
                               <th>{{__('Institution')}}</th>
                               <th>{{__('Created_at')}}</th>
                               <th>{{__('Updated_at')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>
                                   <a>{{$logo->LOG_NOMBRE}}</a>
                               </td>
                               <td>
                                   <a> {{$logo->LOG_TIPO}}</a>
                               </td>
                               <td>
                                   <a href="{{route('institution.show',$logo->institution->id)}}">
                                       {{$logo->institution->INS_NOMBRE}}
                                   </a>
                               </td>
                               <td>
                                   <a>
                                       <p>{{__('Created_at')}} {{$logo->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                               <td >
                                   <a>
                                       <p>{{__('Updated_at')}}{{$logo->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </tbody>
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

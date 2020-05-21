@extends('identification.layouts.app')
@section('title',' Ver Fondo')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'background.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Fondo'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <!-- start project list -->
                       <table id="datatable"
                              class="table table-bordered">
                           <thead align="center">
                           <tr>
                               <th>{{__('Fondo Frontal')}}</th>
                               <td>
                                   <img width="200px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE)}}">

                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Fondo Posterior')}}</th>
                               <td>
                                   <img width="200px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE2)}}">

                               </td>
                           </tr>
                             <tr>
                                 <th>{{__('Institution')}}</th>
                                 <td>
                                     <a href="{{route('institution.show',$background->institution->id)}}">
                                         {{$background->institution->INS_NOMBRE}}
                                     </a>
                                 </td>
                             </tr>
                           <tr>
                               <th>{{__('Created_at')}}</th>
                               <td>
                                   <a>
                                       <p>{{$background->created_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           <tr>
                               <th>{{__('Updated_at')}}</th>
                               <td >
                                   <a>
                                       <p>{{$background->updated_at->format('d/m/Y')}}</p>
                                   </a>
                               </td>
                           </tr>
                           </thead>
                       </table>
                   </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('background.edit',$background)}}"
                   class="btn btn-info btn-xs" >
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-background').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-background"
                       method="POST"
                       action="{{route('background.destroy',$background)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

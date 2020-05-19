@extends('identification.layouts.app')
@section('title','Ver Institución')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'institution.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                   <div class="card-box table-responsive">
                       <h1>Fondo</h1>
                       @foreach($backgrounds as $background)
                       @endforeach
                       <table id="datatable" class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Logo')}}</th>
                               <th>{{__('Front Background')}}</th>
                               <th>{{__('Back Background')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($logos as $logo)
                           <tr>
                               <td>
                                   <img width="100px" src="{{asset('images/logosPhotos/'.$logo->LOG_NOMBRE)}}">

                               </td>
                               <td>
                                   <img width="100px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE)}}">
                               </td>
                               <td>
                                   <img width="100px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE2)}}">
                               </td>
                           </tr>
                           @endforeach
                           </tbody>
                       </table>
                       <table id="datatable"
                              class="table table-striped projects">
                           <thead>
                           <tr>
                               <th>{{__('Name')}}</th>
                               <th>{{__('Direction')}}</th>
                               <th>{{__('Phone')}}</th>
                               <th>{{__('CellPhone')}}</th>
                               <th>{{__('Type')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                      @foreach($courses as $course)
                       <tr>
                           <td>
                               <a>{{$course->INS_NOMBRE}}</a>
                               <br />
                               <small>
                                   {{__('Created_at')}} {{$course->created_at->format('d/m/Y')}}
                               </small>
                           </td>
                           <td>
                               <a> {{$course->INS_DIRECCION}}</a>
                           </td>
                           <td class="project_progress">
                               <a> {{$course->INS_TELEFONO}}</a>
                           </td>
                           <td>
                               <a> {{$course->INS_CELULAR}}</a>
                           </td>
                           <td>
                               <a> {{$course->INS_TIPO}}</a>
                           </td>
                       </tr>
                           </tbody>
                       </table>
                       <div class="item form-group">
                           <label class="col-form-label">
                               {{__('Mission')}}
                           </label>
                           <div class="col-md-5 col-sm-5 ">
                                 <textarea
                                     readonly
                                     class="form-control border-0 bg-light shadow-sm"
                                     cols="30"
                                     rows="10"
                                 >{{$institution->INS_MISION}}</textarea>
                               <span class="fa fa-comments-o form-control-feedback right"
                                     aria-hidden="true"></span>
                           </div>
                           <label class="col-form-label">
                               {{__('Vision')}}
                           </label>
                           <div class="col-md-5 col-sm-5 ">
                                 <textarea
                                     readonly
                                     class="form-control border-0 bg-light shadow-sm"
                                     cols="30"
                                     rows="10"
                                 >{{$institution->INS_VISION}}</textarea>
                               <span class="fa fa-comments-o form-control-feedback right"
                                     aria-hidden="true"></span>
                           </div>
                       </div>
                       @if($course->INS_TIPO=='Organización')
                          @else
                           <div class="card-box table-responsive">
                               <table id="datatable" class="table table-striped projects">
                                   <thead>
                                   <tr>
                                       <th>
                                           {{__('Name of Course')}}
                                       </th>
                                       <th>
                                           {{__('Parallel of Course')}}
                                       </th>
                                   </tr>
                                   </thead>
                                   @forelse($course->course as $cur)
                                       <tbody>
                                       <tr>
                                           <td>
                                               <a href="{{route('course.show',$cur)}}">
                                                   {{$cur->CUR_NOMBRE}}
                                               </a>
                                           </td>
                                           <td>
                                               <a>
                                                   {{$cur->CUR_PARALELO}}
                                               </a>
                                           </td>
                                       </tr>
                                       @empty
                                           <h2>{{__('There are no courses registred')}}</h2>
                                       @endforelse
                                       </tbody>
                               </table>
                           </div>
                       @endif
                       @endforeach
                   <div class="btn-group btn-group-xs">
                <a href="{{route('institution.edit',$institution)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-institution').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-institution"
                       method="POST"
                       action="{{route('institution.destroy',$institution)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

@extends('identification.layouts.app')
@section('title',' Ver Área')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'user.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Uusario'])
               <div>
                <br/>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('ID')}}</th>
                           <th>{{__('Name')}}</th>
                           <th>{{__('Email')}}</th>
                           <th>{{__('Role')}}</th>
                           <th>{{__('Cedula')}}</th>
                       </tr>
                       </thead>
                       <tbody>

                           <tr>
                               <td>
                                   <a>{{$user->id}}</a>
                                   <br />
                                   <small>
                                       {{__('Created_at')}} {{$user->created_at->format('d/m/Y')}}
                                   </small>
                               </td>
                               <td>
                                   <a> {{$user->name}}</a>
                               </td>
                               <td>
                                   <a> {{$user->email}}</a>
                               </td>
                               <td>
                                   @foreach($user->roles as $role)
                                       {{$role->display_name}}
                                   @endforeach
                               </td>
                               <td>
                                   <a> {{$user->cedula}}</a>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('user.edit',$user)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-user').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-user"
                       method="POST"
                       action="{{route('user.destroy',$user)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

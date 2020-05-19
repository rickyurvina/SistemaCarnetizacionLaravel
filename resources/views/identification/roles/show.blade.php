@extends('identification.layouts.app')
@section('title',' Ver Role')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'role.index','btnText'=>'Panel de Control','textTitle'=>'Detalles del Role'])
               <div>
                <br/>
                   <table id="datatable"
                          class="table table-striped projects">
                       <thead>
                       <tr>
                           <th>{{__('Name')}}</th>
                           <th>{{__('DisplayName')}}</th>
                           <th>{{__('Description')}}</th>
                           <th>{{__('Created_at')}}</th>
                           <th>{{__('Updated_at')}}</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>
                               <a>{{$role->name}}</a>
                               <br />
                               <small>
                                   {{__('Created_at')}} {{$role->created_at->format('d/m/Y')}}
                               </small>
                           </td>
                           <td>
                               <a> {{$role->display_name}}</a>
                           </td>
                           <td>
                               <a> {{$role->description}}</a>
                           </td>
                           <td>
                               <a> {{$role->created_at}}</a>
                           </td>
                           <td>
                               <a> {{$role->updated_at}}</a>
                           </td>
                       </tr>
                       </tbody>
                   </table>
               </div>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('role.edit',$role)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-role').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{__('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-role"
                       method="POST"
                       action="{{route('role.destroy',$role)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection

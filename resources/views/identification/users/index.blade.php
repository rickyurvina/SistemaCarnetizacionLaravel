@extends('identification.layouts.app')
@section('title','Users')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'user.create','btnText'=>'Crear','textTitle'=>'Usuarios del Sistema'])
        <div class="row">
            <div class="col-sm-12">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                        {{Form::open(['route'=>'user.index','method'=>'GET'])}}
                        <div class="input-group">
                            {{Form::text('name', null,['class'=>'form-control','placeholder'=>'Cédula del Usuario'])}}
                            <span class="input-group-btn">
                      <button type="submit" class="btn btn-default" >{{__('Search')}}</button>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <p>{{__('List of users')}}
                        {{$users->fragment('foo')->links()}}</p>
                    <!-- start project list -->
                    <table id="datatable"
                           class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Cedula')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
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
{{--                                @foreach($user->roles as $role)--}}
{{--                                     {{$role->display_name}}--}}
{{--                                @endforeach--}}
                                    {{$user->roles->pluck('display_name')->implode(' - ')}}
                                </td>
                                <td>
                                    <a> {{$user->cedula}}</a>
                                </td>
                                <td>
                                  @can('edit',$user)
                                    <div class="btn-group btn-group-sm">
                                <a href="{{route('user.show',$user)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('user.edit',$user)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                    {{Form::close()}}
                                    @endcan
                                </a>
                                        @if(auth()->user()->isAdmin())
                                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="sumbit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                          <h1>{{__('There are no registered users')}}</h1>
                        @endforelse
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
        <!-- end project list -->
    </div>
</div>
</div>
</div>
    <!-- /page content -->
@endsection


@extends('identification.layouts.app')
@section('title','Roles')
@section('content')
    <!-- page content -->
    @include('identification.layouts.top-content',['routeText'=>'role.create','btnText'=>'Crear','textTitle'=>'User-Roles'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
            </div>
        </div>
        <div class="card-box table-responsive">
            <p>{{__('List of roles')}}
                {{$roles->appends(request()->query())->links()}}</p>
            <!-- start project list -->
            <table id="datatable"
                   class="table table-striped projects">
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('DisplayName')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>
                            <a>{{$role->name}}</a>
                            <br/>
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
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('role.show',$role)}}"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-search"></i>
                                    {{__('View')}}
                                </a>
                                <a href="{{route('role.edit',$role)}}"
                                   class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                    {{__('Edit')}}
                                </a>
                                <form action="{{route('role.destroy',$role->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="sumbit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>
                                        {{__('Delete')}}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <h1>{{__('There are no registered roles')}}</h1>
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


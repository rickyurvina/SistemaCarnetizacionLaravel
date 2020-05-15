@extends('identification.layouts.app')
@section('content')
    <div>
        <div class="text">
            <h3 class="center-margin pull-right">Bienvenido al Sistema de Carnetización</h3>
            <table id="datatable"
                   class="table table-striped projects">
                <thead>
                <tr>
{{--                    <th>{{__('ID')}}</th>--}}
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Role')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a> {{auth()->user()->name}}</a><br>
                        <small>
                            {{__('Created_at')}} {{auth()->user()->created_at->format('d/m/Y')}}
                        </small>
                    </td>
                    <td>
                        <a> {{auth()->user()->email}}</a>
                    </td>
                    <td>
                    @foreach(auth()->user()->roles as $role)
                            {{$role->display_name}}
                    @endforeach
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

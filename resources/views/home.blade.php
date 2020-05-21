@extends('identification.layouts.app')
@section('content')
{{--    <div>--}}
{{--        <div class="text col-sm-12">--}}
{{--            <h3 class="center-margin pull-right">Bienvenido al Sistema de Carnetización</h3>--}}
{{--            <div class="card-box table-responsive">--}}
{{--           --}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
        <div class="col-sm-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">

                </div>
            </div>
{{--            <div class="card-box table-responsive">--}}
                <table id="datatable"
                       class="table">
                    <thead>
                    <tr>
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
{{--        </div>--}}
{{--    </div>--}}
    <!-- end project list -->

@endsection

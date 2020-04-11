@extends('identification.layouts.app')
@section('title','Institucion Educativa')
@section('content')
    <!-- page content -->
    <h3>Panel de Control</h3>
    </div>
        <div class="title_right">
           <a href="{{route('institution.create')}}"
              class="btn btn-primary btn-xs pull-right">
               <i class="fa fa-folder">
               </i>
               Crear
           </a>
        </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Instituciones Educativas</h2>
                            @if(session()->has('info'))
                                <h1>{{session('info')}}</h1>
                            @endif
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="close-link">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <p>Listado de las Instituciones Educativas</p>
                                        <!-- start project list -->
                                        <table id="datatable" class="table table-striped projects">
                                            <thead>
                                            <tr>
                                                <th style="width: 1%">#</th>
                                                <th style="width: 20%">Nombre</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Celular</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($institutions as$institution)
                                                <tr>
                                                    <td>{{$institution->id}}</td>
                                                    <td>
                                                        <a>{{$institution->INS_NOMBRE}}</a>
                                                        <br />
                                                        <small>Created {{$institution->created_at->format('d/m/Y')}}</small>
                                                    </td>
                                                    <td>
                                                        <a> {{$institution->INS_DIRECCION}}</a>
                                                    </td>
                                                    <td class="project_progress">
                                                        <a> {{$institution->INS_TELEFONO}}</a>
                                                    </td>
                                                    <td>
                                                        <a> {{$institution->INS_CELULAR}}</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                No hay instituciones registradas.
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


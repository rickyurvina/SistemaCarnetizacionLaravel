@extends('identification.layouts.app')
@section('title','Institucion Educativa')
@section('content')
    <!-- page content -->
    @include('identification.institutions.educational.top-content',['routeText'=>'institution.create','btnText'=>'Crear','textTitle'=>'Instituciones Educatvias'])
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
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($institutions as $institution)
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
                                <td>
                                <a href="{{route('institution.show',$institution)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                <a href="{{route('institution.edit',$institution)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#"
                                       class="btn btn-danger btn-xs"
                                       onclick="document.
                                    getElementById('delete-institution').
                                       submit()"
                                    ><i class="fa fa-trash-o"></i> Delete </a>
                                    <form
                                        class="d-none"
                                        id="delete-institution"
                                        method="POST"
                                        action="{{route('institution.destroy',$institution)}}">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                          <h1> No hay instituciones registradas.</h1>
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


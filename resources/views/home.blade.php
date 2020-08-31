@extends('identification.layouts.app')
@section('content')
    @include('identification.layouts.top-content',['routeText'=>'student.index','btnText'=>'Panel de Control','textTitle'=>'Bienvenido al Sistema de Carnetización'])
    <div class="row">
        <div class="col-sm-12">
            <div class="title_right">
            </div>

            <div class="card-box table-responsive">
                <!-- start project list -->
                <table id="datatable"
                       class="table table-striped projects">
                    <thead>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Identification Card')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td id="id">
                            <a href="">{{auth()->user()->id}}</a>
                        </td>
                        <td>
                            <a>{{auth()->user()->name}}</a>
                            <br/>
                            <small>
                                {{__('Created_at')}} {{auth()->user()->created_at->format('d/m/Y')}}
                            </small>
                        </td>
                        <td>
                            <a> {{auth()->user()->email}}</a>
                        </td>
                        <td>
                            <a> {{auth()->user()->cedula}}</a>
                        </td>

                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="/profile"
                                   class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i>
                                    {{__('View Profile')}}
                                </a>
                                @if(!auth()->user()->isAdmin())
                                    <a href="{{route('soli')}}"
                                       class="btn btn-outline-success btn-xs">
                                        <i class="fa fa-print"></i>
                                        Solcitar Impresión
                                    </a>
                                @endif
                            </div>
                        </td>

                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @if(!auth()->user()->isAdmin())
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pasos a seguir</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">

                            <ul class="list-unstyled timeline widget">
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Paso 1</a>
                                            </h2>
                                            <div class="byline">
                                                <span>Ver Perfil</span>
                                            </div>
                                            <p class="excerpt">
                                                Al hacer clic en el boton "Ver Perfil" se abrirá una página con todos
                                                sus datos personales.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Paso 2</a>
                                            </h2>
                                            <div class="byline">
                                                <span>Verficar Datos Personales</span>
                                            </div>
                                            <p class="excerpt">Verificar si todos los datos ingresados son correctos,
                                                si algún dato esta incorrecto, dar clic en editar y corregir los datos
                                                que esten con error.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Paso 3</a>
                                            </h2>
                                            <div class="byline">
                                                <span>Solicitar Impresión</span>
                                            </div>
                                            <p class="excerpt">Dar clic sobre la opción de "Solicitar Impresión",
                                                en lo pronto que este listo su solicitud nos pondremos en contacto con
                                                el encargado de la institución para hacer la posterior entrega del
                                                carnet.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Verificación Fotografía/Instituci{on</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">

                            <ul class="list-unstyled timeline widget">
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Fotografía Erronea</a>
                                            </h2>
                                            <div class="byline">
                                                <span>Cambiar de fotografía</span>
                                            </div>
                                            <p class="excerpt">
                                                Si observa que su fotografía no es la deseada al pulsar Ver Perfil podrá editar su fotografía.
                                            </p>
                                        </div>
                                    </div>
                                </li>
{{--                                <li>--}}
{{--                                    <div class="block">--}}
{{--                                        <div class="block_content">--}}
{{--                                            <h2 class="title">--}}
{{--                                                <a>Registros Generales</a>--}}
{{--                                            </h2>--}}
{{--                                            <div class="byline">--}}
{{--                                                <span>Fotos Estudiantes/Usuarios</span>--}}
{{--                                            </div>--}}
{{--                                            <p class="excerpt">Al ingresar a Fotos Estudiantes/Usuarios, clic sobre--}}
{{--                                                editar y escoger una nueva fotografia y guardar.--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Verificación Institución</a>
                                            </h2>
                                            <div class="byline">
                                                <span>Institución Incorrecta</span>
                                            </div>
                                            <p class="excerpt">Si observa que su institucion curso/área son incorrectos,
                                                contactarse con el encargado de su Institución o enviar un correo a:
                                                soporte@cotedem.com
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif()
        </div>
        </div>
        </div>
        <!-- end project list -->
        </div>
        </div>
        </div>
        </div>

@endsection

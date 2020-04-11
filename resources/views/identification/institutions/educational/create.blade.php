@extends('identification.layouts.app')
@section('content')
    <h3>Registrar Institución Educativa</h3>
    <div class="title_right">
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registro <small>Formulario para registrar Instituciones Educativas</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('institution.store')}}">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Nombre
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input
                                    type="text"
                                    name="INS_NOMBRE"
                                    required="required"
                                    class="form-control"
                                    value="{{old('INS_NOMBRE')}}">
                                     {{$errors->first('INS_NOMBRE')}}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Dirección
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input
                                    type="text"
                                    name="INS_DIRECCION"
                                    required="required"
                                    class="form-control"
                                    value="{{old('INS_DIRECCION')}}">
                                    {{$errors->first('INS_DIRECCION')}}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Telefono
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input
                                    name="INS_TELEFONO"
                                    class="form-control"
                                    type="number"
                                    value="{{old('INS_TELEFONO')}}">
                                 {{$errors->first('INS_TELEFONO')}}
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Celular</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="INS_CELULAR" name="INS_CELULAR"  class="form-control" type="number" value="{{old('INS_CELULAR')}}">
                                {{$errors->first('INS_CELULAR')}}
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button
                                    type="submit"
                                    class="btn btn-success">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

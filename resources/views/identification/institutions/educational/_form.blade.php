<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $institution)}}">
    @csrf
    @method($txtMethod??'')
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
                value="{{old('INS_NOMBRE', $institution->INS_NOMBRE) }}">
            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
                value="{{old('INS_DIRECCION',$institution->INS_DIRECCION)}}">
            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            {{$errors->first('INS_DIRECCION')}}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            Teléfono
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                name="INS_TELEFONO"
                class="form-control"
                type="number"
                value="{{old('INS_TELEFONO',$institution->INS_TELEFONO )}}">
            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            {{$errors->first('INS_TELEFONO')}}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Celular</label>
        <div class="col-md-6 col-sm-6 ">
            <input id="INS_CELULAR"
                   name="INS_CELULAR"
                   class="form-control"
                   type="number"
                   value="{{old('INS_CELULAR', $institution->INS_CELULAR)}}">
            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            {{$errors->first('INS_CELULAR')}}
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <button
                type="submit"
                class="btn btn-success">
                {{$btnText}}
            </button>
        </div>
    </div>
</form>

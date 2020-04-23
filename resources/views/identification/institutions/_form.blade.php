<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $institution)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Name')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="INS_NOMBRE"
                required="required"
                class="form-control"
                value="{{old('INS_NOMBRE', $institution->INS_NOMBRE) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('INS_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Direction')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="INS_DIRECCION"
                required="required"
                class="form-control"
                value="{{old('INS_DIRECCION',$institution->INS_DIRECCION)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('INS_DIRECCION','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Phone')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                name="INS_TELEFONO"
                class="form-control"
                type="number"
                required="required"
                value="{{old('INS_TELEFONO',$institution->INS_TELEFONO )}}">
            <span class="fa fa-phone form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('INS_TELEFONO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
           {{__('CellPhone')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input id="INS_CELULAR"
                   name="INS_CELULAR"
                   class="form-control"
                   type="number"
                   required="required"
                   value="{{old('INS_CELULAR', $institution->INS_CELULAR)}}">
            <span class="fa fa-phone form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('INS_CELULAR','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Type')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
                        <p>
                            {{__('Institution Educative')}}:
                            <input
                                type="radio" class="radio-inline"
                                name="INS_TIPO" id="INS_TIPO"
                                value="{{__('Institution Educative')}}"
                                required
                                {{ old('INS_TIPO', $institution->INS_TIPO) == 'Institución Educativa' ? 'checked' : '' }}
                            />
                            {{__('Organisation')}}:
                            <input type="radio" class="radio-inline"
                                   name="INS_TIPO" id="INS_TIPO"
                                   value="{{__('Organisation')}}"
                                {{ old('INS_TIPO', $institution->INS_TIPO) == 'Organización' ? 'checked' : '' }}
                            />
                        </p>
            <span class="fa fa-check form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('INS_TIPO','<small class="alert-error">:message</small>')!!}
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

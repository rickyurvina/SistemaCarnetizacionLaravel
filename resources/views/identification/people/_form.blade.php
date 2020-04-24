<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $person)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Identification card')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="PER_CEDULA"
                required="required"
                class="form-control"
                value="{{old('PER_CEDULA', $person->PER_CEDULA)}}">
            <span class="fa fa-info form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_CEDULA','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Names')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="PER_NOMBRES"
                required="required"
                class="form-control"
                value="{{old('PER_NOMBRES',$person->PER_NOMBRES)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_NOMBRES','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('LastNames')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="PER_APELLIDOS"
                required="required"
                class="form-control"
                value="{{old('PER_APELLIDOS',$person->PER_APELLIDOS)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_APELLIDOS','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Date Of Birth')}}
            <span class="required">*</span>
        </label>
        <div class='col-sm-4'>
            <div class="form-group">
                <div class='form-group input-group date'
                >
                    {{ Form::date('PER_FECHANACIMIENTO', $person->PER_FECHANACIMIENTO, ['class'=>'form-control']) }}
                    <span class="input-group-addon">
                       <span class="fa fa-calendar-check-o"></span>
                    </span>
                    {!! $errors->first('PER_FECHANACIMIENTO','<small class="alert-error">:message</small>')!!}
                </div>
            </div>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Email')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="PER_CORREO"
                required="required"
                class="form-control"
                value="{{old('PER_CORREO',$person->PER_CORREO)}}">
            <span class="fa fa-inbox form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_CORREO','<small class="alert-error">:message</small>')!!}
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
                name="PER_DIRECCION"
{{--                required="required"--}}
                class="form-control"
                value="{{old('PER_DIRECCION',$person->PER_DIRECCION)}}">
            <span class="fa fa-location-arrow form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_DIRECCION','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Phone')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="number"
                name="PER_NUMERO"
{{--                required="required"--}}
                class="form-control"
                value="{{old('PER_NUMERO',$person->PER_NUMERO)}}">
            <span class="fa fa-phone form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_NUMERO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('CellPhone')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="number"
                name="PER_CELULAR"
{{--                required="required"--}}
                class="form-control"
                value="{{old('PER_CELULAR',$person->PER_CELULAR)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_CELULAR','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Blood type')}}
            <span class="required">*</span>
        </label>
        <select class="custom-select custom-select-sm col-md-6 col-sm-6 " name="PER_TIPOSANGRE" id="" required>
            {{--            <option selected></option>--}}
            {{--                @if(old('person', $person->PER_TIPOSANGRE)==$person->PER_TIPOSANGRE)--}}
            <option value="{{$person->PER_TIPOSANGRE}}" selected>
                {{$person->PER_TIPOSANGRE}}
            </option>
            {{--                @else--}}
            <option value="O negativo">
                O negativo
            </option>
            <option value="O positivo">
                O positivo
            </option>
            <option value="A negativo">
                A negativo
            </option>
            <option value="A positivo">
                A positivo
            </option>
            <option value="B negativo">
                B negativo
            </option>
            <option value="B positivo">
                B positivo
            </option>
            <option value="AB negativo">
                AB negativo
            </option>
            <option value="AB positivo">
                AB positivo
            </option>
            {{--                @endif--}}
        </select>
        {!! $errors->first('PER_TIPOSANGRE','<small class="alert-error">:message</small>')!!}
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6 " name="institution_id" id="" required>
                <option selected></option>
            @foreach($institution as $id =>$name )
                    @if(old('institution', $person->institution_id)==$id)
                    <option value="{{$id}}" selected>
                        {{$name}}
                    </option>
                        @else
                        <option value="{{$id}}">
                            {{$name}}
                        </option>
                    @endif
                @endforeach
            </select>
        {!! $errors->first('institution_id','<small class="alert-error">:message</small>')!!}
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Area')}}
            <span class="required">*</span>
        </label>
        <select class="custom-select custom-select-sm col-md-6 col-sm-6 " name="area_id" id="" required>
            <option selected></option>
            @foreach($area as $id =>$name )
                @if(old('area', $person->area_id)==$id)
                    <option value="{{$id}}" selected>
                        {{$name}}
                    </option>
                @else
                    <option value="{{$id}}">
                        {{$name}}
                    </option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('area_id','<small class="alert-error">:message</small>')!!}
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Sex')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <p>
                {{__('Male')}}:
                <input
                    type="radio" class="radio-inline"
                    name="PER_SEXO" id="PER_SEXO"
                    value="{{__('Male')}}"
                    required
                    {{ old('PER_SEXO', $person->PER_SEXO) == 'Masculino' ? 'checked' : '' }}
                />
                {{__('Female')}}:
                <input type="radio" class="radio-inline"
                       name="PER_SEXO" id="PER_SEXO"
                       value="{{__('Female')}}"
                    {{ old('PER_SEXO', $person->PER_SEXO) == 'Femenino' ? 'checked' : '' }}
                />
            </p>
            <span class="fa fa-check form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('PER_SEXO','<small class="alert-error">:message</small>')!!}
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


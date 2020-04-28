<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $student)}}"
>
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
                name="EST_CEDULA"
                required="required"
                class="form-control"
                value="{{old('EST_CEDULA', $student->EST_CEDULA)}}">
            <span class="fa fa-info form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_CEDULA','<small class="alert-error">:message</small>')!!}
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
                name="EST_NOMBRES"
                required="required"
                class="form-control"
                value="{{old('EST_NOMBRES',$student->EST_NOMBRES)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_NOMBRES','<small class="alert-error">:message</small>')!!}
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
                name="EST_APELLIDOS"
                required="required"
                class="form-control"
                value="{{old('EST_APELLIDOS',$student->EST_APELLIDOS)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_APELLIDOS','<small class="alert-error">:message</small>')!!}
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
                    {{ Form::date('EST_FECHANACIMIENTO', $student->EST_FECHANACIMIENTO, ['class'=>'form-control']) }}
                    <span class="input-group-addon">
                       <span class="fa fa-calendar-check-o"></span>
                    </span>
                    {!! $errors->first('EST_FECHANACIMIENTO','<small class="alert-error">:message</small>')!!}
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
                name="EST_CORREO"
                required="required"
                class="form-control"
                value="{{old('EST_CORREO',$student->EST_CORREO)}}">
            <span class="fa fa-inbox form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_CORREO','<small class="alert-error">:message</small>')!!}
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
                name="EST_DIRECCION"
{{--                required="required"--}}
                class="form-control"
                value="{{old('EST_DIRECCION',$student->EST_DIRECCION)}}">
            <span class="fa fa-location-arrow form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_DIRECCION','<small class="alert-error">:message</small>')!!}
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
                name="EST_NUMERO"
{{--                required="required"--}}
                class="form-control"
                value="{{old('EST_NUMERO',$student->EST_NUMERO)}}">
            <span class="fa fa-phone form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_NUMERO','<small class="alert-error">:message</small>')!!}
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
                name="EST_CELULAR"
{{--                required="required"--}}
                class="form-control"
                value="{{old('EST_CELULAR',$student->EST_CELULAR)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_CELULAR','<small class="alert-error">:message</small>')!!}
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Code')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="number"
                name="EST_CODIGO"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_CODIGOR',$student->EST_CODIGO)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_CODIGO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Enrollmente')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="EST_MATRICULA"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_MATRICULA',$student->EST_MATRICULA)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_MATRICULA','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Signed up')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="EST_INSCRITO"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_INSCRITO',$student->EST_INSCRITO)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_INSCRITO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('No Enrollment')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="number"
                name="EST_NROMATRICULA"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_NROMATRICULA',$student->EST_NROMATRICULA)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_MATRICULA','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Retired')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="EST_RETIRADO"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_RETIRADO',$student->EST_RETIRADO)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_RETIRADO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Scholarship')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="EST_BECA"
                {{--                required="required"--}}
                class="form-control"
                value="{{old('EST_BECA',$student->EST_BECA)}}">
            <span class="fa fa-phone-square form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_BECA','<small class="alert-error">:message</small>')!!}
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Blood type')}}
            <span class="required">*</span>
        </label>
        <select class="custom-select custom-select-sm col-md-6 col-sm-6 " name="EST_TIPOSANGRE" id="" required>
         <option value="{{$student->EST_TIPOSANGRE}}" selected>
                {{$student->EST_TIPOSANGRE}}
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
        </select>
        {!! $errors->first('EST_TIPOSANGRE','<small class="alert-error">:message</small>')!!}
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6 " name="institution_id" id="" required>
                <option selected></option>
            @foreach($institution as $ins )
                    @if(old('institution', $student->institution_id)==$ins->id)
                    <option value="{{$ins->id}}" selected>
                        {{$ins->INS_NOMBRE}}
                    </option>
                        @else
                        <option value="{{$ins->id}}">
                            {{$ins->INS_NOMBRE}}
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
        <select class="custom-select custom-select-sm col-md-6 col-sm-6 "
                name="course_id" id=""
                required>
            <option selected></option>
            @foreach($course as $id =>$name )
                @if(old('course', $student->course_id)==$id)
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
        {!! $errors->first('course_id','<small class="alert-error">:message</small>')!!}
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
                    name="EST_SEXO" id="EST_SEXO"
                    value="{{__('Male')}}"
                    required
                    {{ old('EST_SEXO', $student->EST_SEXO) == 'Masculino' ? 'checked' : '' }}
                />
                {{__('Female')}}:
                <input type="radio" class="radio-inline"
                       name="EST_SEXO" id="EST_SEXO"
                       value="{{__('Female')}}"
                    {{ old('EST_SEXO', $student->EST_SEXO) == 'Femenino' ? 'checked' : '' }}
                />
            </p>
            <span class="fa fa-check form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('EST_SEXO','<small class="alert-error">:message</small>')!!}
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


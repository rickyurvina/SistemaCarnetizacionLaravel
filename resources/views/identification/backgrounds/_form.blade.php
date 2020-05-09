<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $background)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Fondo Frontal')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="FON_NOMBRE"
                required="required"
                class="form-control"
                value="{{old('FON_NOMBRE', $background->FON_NOMBRE) }}">
            <span class="fa fa-picture-o  form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('FON_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Fondo Posterior')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="FON_NOMBRE2"
                required="required"
                class="form-control"
                value="{{old('FON_NOMBRE2', $background->FON_NOMBRE2)}}">
            <span class="fa fa-picture-o form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('FON_NOMBRE2','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Type')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="FON_TIPO"
                required="required"
                class="form-control"
                value="{{old('FON_TIPO',$background->FON_TIPO)}}">
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('FON_TIPO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="institution_id" id="institution_id" required>
                <option selected></option>
                @foreach($institution as $ins)
                    @if(old('institution', $background->institution_id)==$ins->id)
                    <option id="ins" value="{{$ins->id}}" selected>
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
    <div class="ln_solid"></div>
    <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
            <button
                type="submit"
                class="btn btn-success">
                <i class="fa fa-upload">
                </i>
                {{$btnText}}
            </button>
        </div>
    </div>
</form>

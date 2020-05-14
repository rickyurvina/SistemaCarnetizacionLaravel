<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $course)}}">
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
                name="CUR_NOMBRE"
                required="required"
                class="form-control"
                value="{{old('CUR_NOMBRE', $course->CUR_NOMBRE) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('CUR_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Parallel')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="CUR_PARALELO"
                required="required"
                class="form-control"
                value="{{old('CUR_PARALELO',$course->CUR_PARALELO)}}">
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('CUR_PARALELO','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="institution_id" id="" required>
                <option selected></option>
                @foreach($institution as $ins)
                    @if(old('institution', $course->institution_id)==$ins->id)
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

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
            {{$errors->first('CUR_NOMBRE')}}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Paralelo')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="CUR_PARALELO"
                required="required"
                class="form-control"
                value="{{old('CUR_PARALELO',$course->CUR_PARALELO)}}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {{$errors->first('CUR_PARALELO')}}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Institution_id')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                name="institution_id"
                class="form-control"
                type="number"
                required="required"
                value="{{old('institution_id',$course->institution_id )}}">
            <span class="fa fa-phone form-control-feedback right"
                  aria-hidden="true"></span>
            {{$errors->first('institution_id')}}
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

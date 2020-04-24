<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $area)}}">
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
                name="ARE_NOMBRE"
                required="required"
                class="form-control"
                value="{{old('ARE_NOMBRE', $area->ARE_NOMBRE) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('ARE_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Description')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
             <textarea
                 class="form-control border-0 bg-light shadow-sm"
                 cols="30"
                 rows="10"
                name="ARE_DESCRIPCCION"
                >{{old('ARE_DESCRIPCCION',$area->ARE_DESCRIPCCION)}}
             </textarea>
            <span class="fa fa-comments-o form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('ARE_DESCRIPCCION','<small class="alert-error">:message</small>')!!}
        </div>
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

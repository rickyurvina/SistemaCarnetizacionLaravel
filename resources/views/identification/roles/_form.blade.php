<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $role)}}">
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
                name="name"
                required="required"
                class="form-control"
                value="{{old('name', $role->name) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('name','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('DisplayName')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="display_name"
                required="required"
                class="form-control"
                value="{{old('display_name', $role->display_name) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('display_name','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Description')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="text"
                name="description"
                required="required"
                class="form-control"
                value="{{old('description', $role->description) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('description','<small class="alert-error">:message</small>')!!}
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

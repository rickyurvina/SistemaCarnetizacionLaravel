<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      enctype="multipart/form-data"
      action="{{route($btnRoute ?? '', $background)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">
            {{__('Front Background')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @if($background->FON_NOMBRE)
                <img width="100px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE)}}">
            @endif
            <input
                type="file"
                name="FON_NOMBRE"
                accept="image/*"
            >
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('FON_NOMBRE','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">
            {{__('Back Background')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @if($background->FON_NOMBRE2)
                <img width="100px" src="{{asset('images/BackgroundsPhotos/'.$background->FON_NOMBRE2)}}">
            @endif
            <input
                type="file"
                name="FON_NOMBRE2"
                accept="image/*"
            >
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('FON_NOMBRE2','<small class="alert-error">:message</small>')!!}
        </div>
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

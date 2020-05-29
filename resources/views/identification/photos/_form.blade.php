<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      enctype="multipart/form-data"
      action="{{route($btnRoute ?? '', $photo)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">
            {{__('Photo')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @if($photo->nombre)
                <img width="100px" src="{{asset('images/PeoplePhotos/'.$photo->nombre)}}">
            @endif
            <input
                type="file"
                name="nombre"
                accept="image/*"
            >
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('nombre','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('User')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="people_id" id="people_id" required>
                <option selected></option>
                @foreach($people as $person)
                    @if(old('people', $photo->people_id)==$person->id)
                    <option value="{{$person->id}}" selected>
                        {{$person->PER_NOMBRES}} {{$person->PER_APELLIDOS}}
                    </option>
                        @else
                        <option value="{{$person->id}}">
                            {{$person->PER_NOMBRES}} {{$person->PER_APELLIDOS}}
                        </option>
                    @endif
                @endforeach
            </select>
        {!! $errors->first('people_id','<small class="alert-error">:message</small>')!!}
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

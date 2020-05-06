<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $photo)}}">
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
                name="nombre"
                required="required"
                class="form-control"
                value="{{old('nombre', $photo->nombre) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('nombre','<small class="alert-error">:message</small>')!!}
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
                name="tipo"
                required="required"
                class="form-control"
                value="{{old('tipo',$photo->tipo)}}">
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('tipo','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('User')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="people_id" id="" required>
                <option selected></option>
{{--                @foreach($photos as $photo)--}}
{{--                    @if(old('people', $photo->people_id)==$photo->people_id)--}}
{{--                        <option value="{{$photo->people_id}}" selected>--}}
{{--                            {{$photo->people->PER_NOMBRES}} {{$photo->people->PER_APELLIDOS}}--}}

{{--                        </option>--}}
{{--                    @else--}}
{{--                        <option value="{{$photo->people_id}}">--}}
{{--                            {{$photo->people->PER_NOMBRES}} {{$photo->people->PER_APELLIDOS}}--}}

{{--                        </option>--}}
{{--                    @endif--}}
{{--                    @endforeach--}}
                @foreach($people as $person)
                    @if(old('people', $photo->people_id)==$person->id)
                    <option value="{{$person->id}}" selected>
                        {{$person->PER_NOMBRES}}
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
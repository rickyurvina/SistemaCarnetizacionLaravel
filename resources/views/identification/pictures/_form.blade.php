<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      enctype="multipart/form-data"
      action="{{route($btnRoute ?? '', $picture)}}">
    @csrf
    @method($txtMethod??'')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">
            {{__('Name')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @if($picture->nombre)
                <img width="100px" src="{{Storage::url($picture->nombre)}}">
            @endif
            <input
                type="file"
                name="nombre"
              >
                <span class="fa fa-book form-control-feedback right"
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
                value="{{old('tipo',$picture->tipo)}}">
            <span class="fa fa-book form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('tipo','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Student')}}
            <span class="required">*</span>
        </label>
            <select class="custom-select custom-select-sm col-md-6 col-sm-6"
                    name="student_id" id="student_id" required>
                <option selected></option>
                @foreach($students as $student)
                    @if(old('students', $picture->student_id)==$student->id)
                    <option value="{{$student->id}}" selected>
                        {{$student->EST_NOMBRES}}
                    </option>
                        @else
                        <option value="{{$student->id}}">
                            {{$student->EST_NOMBRES}} {{$student->EST_APELLIDOS}}
                        </option>
                    @endif
                @endforeach
            </select>
        {!! $errors->first('student_id','<small class="alert-error">:message</small>')!!}
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

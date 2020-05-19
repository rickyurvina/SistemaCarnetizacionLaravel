<form id="demo-form2"
      data-parsley-validate class="form-horizontal form-label-left"
      method="POST"
      action="{{route($btnRoute ?? '', $user->id)}}">
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
                value="{{old('name', $user->name) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('name','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Email')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="email"
                name="email"
                required="required"
                class="form-control"
                value="{{old('email', $user->email) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('email','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Cedula')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="number"
                name="cedula"
                required="required"
                class="form-control"
                value="{{old('cedula', $user->cedula) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('cedula','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
@unless($user->id)
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Password')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="password"
                name="password"
                required="required"
                class="form-control"
                value="{{old('password', $user->password) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
            {!! $errors->first('password','<small class="alert-error">:message</small>')!!}
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Confirm Password')}}
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input
                type="password"
                name="password_confirmation"
                required="required"
                class="form-control"
                value="{{old('password_confirmation', $user->password_confirmation) }}">
            <span class="fa fa-user form-control-feedback right"
                  aria-hidden="true"></span>
        </div>
@endunless
    </div>
    {!! $errors->first('password_confirmation','<small class="alert-error">:message</small>')!!}

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">
            {{__('Roles')}}
            <span class="required">*</span>
        </label>
        <div class="checkbox">
            @foreach($roles as $id => $name)
                <label for="">
                    <input type="checkbox"
                           value="{{$id}}"
                           {{$user->roles->pluck('id')->contains($id) ? 'checked' : ''}}
                           name="roles[]">
                    {{$name}}
                </label>
            @endforeach
                {!! $errors->first('roles','<small class="alert-error">:message</small>')!!}

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

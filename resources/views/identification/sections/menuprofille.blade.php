<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">

    @php
    $picture=\App\Http\Controllers\ServicesController::photo(auth()->user()->cedula);
    @endphp
        <img src="{{asset($picture)}}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>{{__('Welcome')}}</span>
        <h2>
            @auth
            {{auth()->user()->name}}
        @endauth
        </h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br />

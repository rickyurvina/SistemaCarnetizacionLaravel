<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
{{--        extraer desde la abse de datos--}}
        <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
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

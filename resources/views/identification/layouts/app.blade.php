<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/icono.ico" type="image/ico" />
    <title>@yield('title','COTEDEM')</title>
    @include('identification.links-scripts.links.linksapp')
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{route('home')}}" class="site_title"> <img src="{{asset('images/pr.png')}}" alt="..." class=""></a>
                    </div>
                    <div class="clearfix"></div>
                    @include('identification.sections.menuprofille')
                    <br />
                    @auth
                    @include('identification.sections.sidebar')
                        @endauth
                </div>
            </div>
        @include('identification.sections.topnavigation')
        <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            @include('identification.sections.footer')
        </div>
    </div>
</body>
@include('identification.links-scripts.scripts.appscripts')
</html>

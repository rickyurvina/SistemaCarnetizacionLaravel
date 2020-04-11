
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"> <img src="images/pr.png" alt="..." class=""></a>
                </div>
                <div class="clearfix"></div>
                @include('identification.sections.menuprofille')
                <br />
                @include('identification.sections.sidebar')
{{--                @include('identification.sections.footeroptions')--}}
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
@include('identification.links-scripts.scripts.appscripts')
</body>

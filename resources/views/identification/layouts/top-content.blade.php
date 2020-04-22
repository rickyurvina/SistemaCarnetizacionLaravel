<h3>Panel de Control</h3>
</div>
<div class="title_right">
    <a href="{{route($routeText ?? '')}}"
       class="btn btn-success btn-xs pull-right">
        <i class="fa fa-archive">
        </i>
        {{$btnText}}
    </a>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$textTitle}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                    <li>
                        <a class="close-link">
                            <i class="fa fa-close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            @include('partials.session-status')
            <div class="x_content">

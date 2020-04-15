<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>{{__('General')}}</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i>
                    {{__('Home')}}
                    <span
                        class="fa fa-chevron-down">
                    </span>
                </a>
                <ul class="nav child_menu">
                    <li>
                        <a
                            href="#">
                            {{__('Home')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-institution"></i>
                    {{__('Institutions Register')}}
                    <span
                        class="fa fa-chevron-down">
                    </span>
                </a>
                <ul class="nav child_menu">
                    <li><a
                            href="{{route('institution.index')}}">
                            {{__('Institutions')}}
                        </a>
                    </li>
                    <li><a href="#">
                            {{__('Representatives')}}
                        </a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-sheqel"></i>
                    {{__('Institutions Educatives')}}
                    <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="#">{{__('Courses')}}</a></li>
                    <li><a href="#">{{__('Students')}}</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-bar-chart"></i>
                    {{__('Organisations')}}
                    <span
                        class="fa fa-chevron-down">
                    </span>
                </a>
                <ul class="nav child_menu">
                    <li>
                        <a href="#">{{__('Users')}}</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-users"></i>
                    {{__('General Records')}}
                    <span
                        class="fa fa-chevron-down">
                    </span></a>
                <ul class="nav child_menu">
                    <li><a href="#">{{__('Background')}}</a></li>
                    <li><a href="#">{{__('Logos')}}</a></li>
                    <li><a href="#">{{__('System Users')}}</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-print"></i>
                    {{__('Print')}}
                    <span
                        class="fa fa-chevron-down">
                    </span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="#">{{__('Requested')}}</a></li>
                    <li><a href="#">{{__('Approved')}}</a></li>
                    <li><a href="#">{{__('Without Requesting')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

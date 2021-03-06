<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>{{__('General')}}</h3>
        <ul class="nav side-menu">
            {{--            Home--}}
            <li><a><i class="fa fa-home"></i>
                    {{__('Home')}}
                    <span
                        class="fa fa-chevron-down">
                    </span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="/"> {{__('Home')}} </a></li>
                </ul>
            {{--            Registro Institutciones--}}
            @if(auth()->user()->hasRoles(['admin']))
                <li><a><i class="fa fa-institution"></i>
                        {{__('Institutions Register')}}
                        <span
                            class="fa fa-chevron-down">
                    </span>
                    </a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('institution.index')}}">{{__('Institutions')}}</a>
                        </li>
                    </ul>
                </li>
            @endif()
            {{--            Instituciones Educativas--}}
            @if(auth()->user()->hasRoles(['admin','representanteEducativa']))
                <li><a><i class="fa fa-sheqel"></i>
                        {{__('Institutions Educatives')}}
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('student.index')}}">{{__('Students')}}</a></li>
                        <li><a href="{{route('course.index')}}">{{__('Courses')}}</a></li>
                    </ul>
                </li>
            @endif()
            {{--Organizaciones--}}
            @if(auth()->user()->hasRoles(['admin','representanteOrganizacion']))
                <li><a><i class="fa fa-bar-chart"></i>
                        {{__('Organisations')}}
                        <span
                            class="fa fa-chevron-down">
                    </span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            @if(auth()->user()->hasRoles(['admin','representanteOrganizacion']))
                                <a href="{{route('person.index')}}">{{__('Users')}}</a>
                            @endif
                        </li>
                        @if(auth()->user()->hasRoles(['admin']))
                            <li>
                                <a href="{{route('area.index')}}">{{__('Work Area')}}</a>
                            </li>
                        @endif()
                    </ul>
                </li>
            @endif()
            {{--            Fondos Logos y Fotos--}}
            @if(auth()->user()->hasRoles(['admin']))
                <li><a><i class="fa fa-users"></i>
                        {{__('General Records')}}
                        <span
                            class="fa fa-chevron-down">
                    </span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('background.index')}}">{{__('Background')}}</a></li>
                        <li><a href="{{route('logo.index')}}">{{__('Logos')}}</a></li>
                        <li><a href="{{route('photo.index')}}">{{__('Photos of People')}}</a></li>
                        <li><a href="{{route('picture.index')}}">{{__('Photos Students')}}</a></li>
                        <li><a href="{{route('user.index')}}">{{__('System Users')}}</a></li>
                        <li><a href="{{route('role.index')}}">{{'Roles'}}</a></li>
                    </ul>
                </li>
            @endif()
            {{--            Sistema de impresiones--}}
            @if(auth()->user()->isAdmin())
                <li><a><i class="fa fa-print"></i>
                        {{__('Print')}}
                        <span
                            class="fa fa-chevron-down">
                    </span>
                    </a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('solicitadas.index')}}">{{__('Requested')}}</a></li>
                        <li><a href="{{route('aprobadas.index')}}">{{__('Approved')}}</a></li>
                    </ul>
                </li>
            @endif()
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

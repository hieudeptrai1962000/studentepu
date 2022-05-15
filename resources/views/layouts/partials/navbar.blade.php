<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="" class=" hvr-bounce-to-right"><i
                            class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span>
                </a>
            </li>
            @if(Auth::check())
            <li>
                <a href="{{route('faculties.index')}}" class=" hvr-bounce-to-right"><i
                            class="fa fa-indent nav_icon"></i> <span
                            class="nav-label">Faculties</span></a>
            </li>
            <li>
                <a href="{{route('students.index')}}" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i>
                    <span
                            class="nav-label">Students</span> </a>
            </li>

            <li>
                <a href="{{route('classes.index')}}" class=" hvr-bounce-to-right"><i
                            class="fa fa-picture-o nav_icon"></i>
                    <span class="nav-label">Classes</span> </a>
            </li>
            <li>
                <a href="{{route('subjects.index')}}" class=" hvr-bounce-to-right"><i
                            class="fa fa-desktop nav_icon"></i> <span
                            class="nav-label">Subjects</span></a>

            </li>
{{--            <li>--}}
{{--                <a href="{{route('marks.index')}}" class=" hvr-bounce-to-right"><i class="fa fa-th nav_icon"></i> <span--}}
{{--                            class="nav-label">Mark</span> </a>--}}
{{--            </li>--}}
            @endif
        </ul>
    </div>
</div>

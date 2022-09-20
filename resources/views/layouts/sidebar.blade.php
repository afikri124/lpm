<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ url('/') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo_po.png')}}"
                    alt="" style="height: 50px;"><img class="img-fluid for-dark"
                    src="{{asset('assets/images/logo_po.png')}}" alt="" style="height: 50px;"></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar" id="toggle-sidebar-desktop"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ url('/') }}"><img class="img-fluid" style="height: 30px;"
                    src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ url('/') }}"><img class="img-fluid" style="height: 30px;"
                                src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">Menu</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='dashboard' ? 'active' : '' }} "
                            href="{{route('dashboard')}}">
                            <i data-feather="home"> </i><span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('AD'))
                    <li class="sidebar-list">
                    <label class="badge rounded-pill badge-primary" id="notif_schedules" title="Review Task"></label>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='schedules' ? 'active' : '' }} "
                            href="{{route('schedules')}}">
                            <i data-feather="calendar"> </i><span>Schedules</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('AU'))
                    <li class="sidebar-list">
                    <label class="badge rounded-pill badge-primary" id="notif_observations" title="Observation Task"></label>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='observations' ? 'active' : '' }} "
                            href="{{route('observations')}}">
                            <i data-feather="clipboard"> </i><span>Observations</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('LE'))
                    <li class="sidebar-list">
                    <label class="badge rounded-pill badge-primary" id="notif_mypo" title="Observation Task"></label>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='observations.me' ? 'active' : '' }} "
                            href="{{route('observations.me')}}">
                            <i data-feather="award"> </i><span>My PO</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('DE'))
                    <li class="sidebar-list">
                    <label class="badge rounded-pill badge-primary" id="notif_follow_ups"></label>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='follow_up' ? 'active' : '' }} "
                            href="{{route('follow_up')}}">
                            <i data-feather="user-check"> </i><span>Follow-Up</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('AD'))
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='recap' ? 'active' : '' }} "
                            href="{{route('recap')}}">
                            <i data-feather="pie-chart"> </i><span>Result recap</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/settings' ? 'active' : '' }}"
                            href="#"><i data-feather="settings"></i><span class="lan-3">settings</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{request()->route()->getPrefix() == '/settings' ? 'down' : 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ request()->route()->getPrefix() == '/settings' ? 'block;' : 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName()=='settings.users' ? 'active' : '' }}"
                                    href="{{route('settings.users')}}">Manage Users</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName()=='settings.categories' ? 'active' : '' }}"
                                    href="{{route('settings.categories')}}">Assessment Categories</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName()=='settings.criterias' ? 'active' : '' }}"
                                    href="{{route('settings.criterias')}}">Assessment Criteria</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName()=='settings.general' ? 'active' : '' }}"
                                    href="{{route('settings.general')}}">General Setting</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='documentation' ? 'active' : '' }} "
                            href="{{route('documentation')}}">
                            <i data-feather="file-text"> </i><span>Documentation</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>

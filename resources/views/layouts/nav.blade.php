<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url('dashboard') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="parent  {{ Request::is('configuration*') ? 'active' : '' }}"><a href="#"><i class="icon mdi mdi-face"></i><span>Configuration</span></a>
                            <ul class="sub-menu">

                                <li class="{{ Request::is('configuration/category') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/category') }}" class="menu-item">New Category</a>
                                </li>
                                <li class="{{ Request::is('configuration/cashier') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/cashier') }}" class="menu-item">New Cashier</a>
                                </li>
                                <li class="{{ Request::is('configuration/tollpoint') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/tollpoint') }}" class="menu-item">New Tollpoint</a>
                                </li>
<!--                                <li class="{{ Request::is('configuration/district') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/district') }}" class="menu-item">New District</a>
                                </li>-->

                                <li class="{{ Request::is('configuration/categories') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/categories') }}" class="menu-item">All Categories</a>
                                </li> <li class="{{ Request::is('configuration/cashiers') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/cashiers') }}" class="menu-item">All Cashiers</a>
                                </li> <li class="{{ Request::is('configuration/tollpoints') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/tollpoints') }}" class="menu-item">All Tollpoints</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ Request::is('reports') ? 'active' : '' }}"><a href="{{ url('reports') }}"><i class="icon mdi mdi-home"></i><span>Reports</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
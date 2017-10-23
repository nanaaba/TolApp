<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ url('dashboard') }}">
                                <i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        
                        </li>
                        
                        
                         <li class="parent  {{ Request::is('home*') ? 'active' : '' }}"><a href="#">
                                <i class="icon mdi mdi-home"></i><span>Analytics</span></a>
                            <ul class="sub-menu">

                               
                                <li class="{{ Request::is('home/trendanalysis') ? 'active' : '' }}">
                                    <a href="{{ url('home/trendanalysis') }}" class="menu-item">Trend Analysis</a>
                                </li>
                                <li class="{{ Request::is('home/performance') ? 'active' : '' }}">
                                    <a href="{{ url('home/performance') }}" class="menu-item">Custom Performance</a>
                                </li>

                                
                            </ul>
                        </li>
                        
                        
                        

                        <li class="parent  {{ Request::is('configuration*') ? 'active' : '' }}"><a href="#"><i class="icon mdi mdi-settings"></i><span>Settings</span></a>
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

                                <li class="{{ Request::is('configuration/categories') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/categories') }}" class="menu-item">All Categories</a>
                                </li> <li class="{{ Request::is('configuration/cashiers') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/cashiers') }}" class="menu-item">All Cashiers</a>
                                </li> <li class="{{ Request::is('configuration/tollpoints') ? 'active' : '' }}">
                                    <a href="{{ url('configuration/tollpoints') }}" class="menu-item">All Tollpoints</a>
                                </li>
                            </ul>
                        </li>

                       <li class="{{ Request::is('users*') ? 'active' : '' }}"><a href="{{ url('users') }}"><i class="icon mdi mdi-account"></i><span>User Management</span></a>
                        </li>



                        <li class="parent  {{ Request::is('reports*') ? 'active' : '' }}"><a href="#">
                                <i class="icon mdi mdi-home"></i><span>Reports</span></a>
                            <ul class="sub-menu">

                                <li class="{{ Request::is('reports/general') ? 'active' : '' }}">
                                    <a href="{{ url('reports/general') }}" class="menu-item">General Report</a>
                                </li>
                                <li class="{{ Request::is('reports/daily') ? 'active' : '' }}">
                                    <a href="{{ url('reports/daily') }}" class="menu-item">DayWise Report</a>
                                </li>
                                <li class="{{ Request::is('reports/monthly') ? 'active' : '' }}">
                                    <a href="{{ url('reports/monthly') }}" class="menu-item">Monthly Report</a>
                                </li>

                                <li class="{{ Request::is('reports/yearly') ? 'active' : '' }}">
                                    <a href="{{ url('reports/yearly') }}" class="menu-item">Yearly Report</a>
                                </li> 
                                <li class="{{ Request::is('reports/shift') ? 'active' : '' }}">
                                    <a href="{{ url('reports/shift') }}" class="menu-item">Shift Report</a>
                                </li> 
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
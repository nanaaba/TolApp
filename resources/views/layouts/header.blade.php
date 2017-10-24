    <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
<!--          <div class="navbar-header"><a href="#" class="navbar-brand"></a>
          </div>-->
          <div class="be-right-navbar">
          
            
              
            <ul class="nav navbar-nav navbar-right be-icons-nav">
              
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                      Welcome, {{session('name')}}
<!--                      <span class="icon mdi mdi-apps"></span>-->
                  </a>
                <ul class="dropdown-menu be-connections">
                  <li>
                      <a href="{{url('users/changepassword')}}" >Change Password</a>
                  </li>
                  <li>
                      <a href="{{url('logout')}}" >Logout</a>
                  </li>
                  <li>
                      <a href="#"> <span><strong>Last Login : {{session('lastlogin')}}</strong></span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
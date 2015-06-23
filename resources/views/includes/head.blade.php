<header class="row">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">{{ $site_name }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
    <!--    @yield('navbar')-->

        <li><a href="{{ url('/about') }}">About</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>

        <!--   end navabar -->
          
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
        
      <ul class="nav navbar-nav navbar-right">

           <?php  if (Auth::check()): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Seller Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/listings') }}">Manage Listings</a></li>
            <li><a href="{{ url('/listings/create') }}">New Listing</a></li>
            <li><a href="{{ url('/sales') }}">Sales History</a></li>
            <li><a href="{{ url('/purchases') }}">Purchase History</a></li>

          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->user_name}}<span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="{{ url('/auth/logout') }}">Log Out</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/user') }}">Edit Profile</a></li>
          </ul>
        </li>


       <?php   else: ?>
        <li><a href="{{ url('/auth/login') }}">Log In</a></li>
        <li><a href="{{ url('/auth/register') }}">Register</a></li>
         <?php  endif; ?>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    
 </header>
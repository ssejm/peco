
@include('includes.header')

<div id="main" class="row">
    <!-- sidebar content -->
    <div id="sidebar" class="col-md-4">
        @include('includes.sidebar')
    </div>

    <!-- main content -->
    <div id="content" class="col-md-8">
        @yield('content')
    </div>
</div>

@include('includes.footer')

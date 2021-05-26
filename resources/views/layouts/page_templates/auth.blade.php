<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
      <div class="row" style="position: relative; top: 60px;">
      <div class="col-md-6 mx-auto ">
          @include('layouts.alerts')
      </div>
    </div>
    
      
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>
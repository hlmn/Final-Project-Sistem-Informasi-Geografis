<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CalcGIS</title>
<!--     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css"> -->
    
  
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{url('/admindist/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/admindist/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('/admindist/css/jquery-ui.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://use.fontawesome.com/a50b71a92d.js"></script> -->

    <link rel="stylesheet" href="{{url('/admindist/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('/admindist/plugins/datatables/dataTables.bootstrap.css')}}">
    {{-- <link rel="stylesheet" href="{{url('/admindist/css/bootstrap-multiselect.css')}}" type="text/css"/> --}}

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/admindist/plugins/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{url('/admindist/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">


    <link rel="stylesheet" href="{{url('/admindist/dist/css/AdminLTE.min.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('/admindist/dist/css/skins/_all-skins.min.css')}}">
    {{-- <link rel="stylesheet" href="{{url('/admindist/dist/css/sweetalert.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.css" rel="stylesheet"/>

    
      @yield('gaya')

  </head>
  <body class="skin-red sidebar-mini" style="height: auto; min-height: 100%;">
    <!-- Site wrapper -->
    <div class="wrapper" style="height: auto; min-height: 100%;">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <span class="logo-mini"><b>CalcGIS</b></span>
          <span class="logo-lg"><b>Calc</b>GIS</span>
        </a>

      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        @if(!Auth::check())
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="{{route('login')}}" class="dropdown-toggle" >
                  {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> --}}
                  <span>Login</span>
                </a>
              </li>
            </ul>
          </div>
        @endif
      </nav>

      </header>

      <!-- =============================================== -->

      <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
          @if(Auth::check())
            <div class="user-panel">
              <div class="pull-left image">
                <img href="#" src="{{url('/admindist/dist/img/default-avatar.png')}}" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                <p><a>{{Auth::user()->name}}</a></p>
                <a ><i class="fa fa-circle text-success"></i> Online</a>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></i> Logout</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </div>
            </div>
          @else

          @endif
          {{-- <li>
            
          </li> --}}
          <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">PILIHAN MENU</li>

            
            <li id="aktifpolygon" class="treeview menu-open">
              <a href="#" class="warnain disableJs">
                <i class="fa fa-users"></i> <span>Polygon</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu" style="">
                <li class="" id="anakpolygon">
                  <a href="{{route('index.polygon')}}"><i class="fa fa-plus"></i> <span>Create</span></a>
                </li>
                @if(Auth::check())
                {{-- {{dd(Auth::user()->getShape())}} --}}
                  @foreach(Auth::user()->shapes->where('tipe', 'Polygon')->sortByDesc('created_at')->values() as $shape)
                    <li class="" id="anak{{$shape->id}}">
                      <a href="{{route('view.polygon', ['shape' => $shape->id])}}"><i class="fa fa-circle-o"></i> <span>{{$shape->id}}</span></a>
                    </li>
                  @endforeach
                @endif
              </ul>
            </li>
            <li id="aktifpolyline" class="treeview menu-open">
              <a href="#" class="warnain disableJs">
                <i class="fa fa-users"></i> <span>Polyline</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu" style="">
                <li class="" id="anakpolyline">
                  <a href="{{route('index.polyline')}}"><i class="fa fa-plus"></i> <span>Create</span></a>
                </li>
                @if(Auth::check())

                  @foreach(Auth::user()->shapes->where('tipe', 'Polyline')->sortByDesc('created_at')->values() as $shape)
                    <li class="" id="anak{{$shape->id}}">
                      <a href="{{route('view.polyline', ['shape' => $shape->id])}}"><i class="fa fa-circle-o"></i> <span>{{$shape->id}}</span></a>
                    </li>
                  @endforeach
                @endif
              </ul>
            </li>
            
           
            
            {{-- <li class="" id="aktifkompetisi">
              <a href="{{route('kompetisi')}}"><i class="fa fa-info-circle"></i> <span>Kompetisi</span></a>
            </li>
            <li class="" id="aktifgaleri">
              <a href="{{route('galeri')}}"><i class="fa fa-picture-o"></i> <span>Galeri Foto</span></a>
            </li> 
 --}}
            
            
            
          </ul>
        </section>
      </aside>

    <div class="content-wrapper" id="wrapper">
      {{-- <div class="content body" > --}}
        @yield('content')
      {{-- </div> --}}
      {{-- <section class="content" style="height: 100%">
        
      </section> --}}
    </div>

    <footer class="main-footer">
      {{-- <div class="pull-right"> --}}
        @yield('footer')
        
        {{-- <strong>Copyright &copy; 2017 <a href="/">Mechanical Competition</a>.</strong> All rights reserved. --}}

        
      {{-- </div> --}}
    </footer>

  </div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<script src="{{url('/admindist/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{url('/admindist/plugins/jQueryUI/jquery-ui.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('/admindist/js/moment.js')}}"></script>

<script src="{{url('/admindist/bootstrap/js/bootstrap.js')}}"></script>
{{-- <script type="text/javascript" src="{{url('/admindist/js/bootstrap-multiselect.js')}}"></script> --}}

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap.min.js"></script>
<script src="{{url('/admindist/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script src="{{url('/admindist/js/bootstrap-datetimepicker.min.js')}}"></script>
  
<!-- SlimScroll -->
<script src="{{url('/admindist/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('/admindist/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/admindist/dist/js/app.min.js')}}"></script>
<script src="{{url('/admindist/plugins/fullcalendar/fullcalendar.min.js')}}" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.2/socket.io.js"></script>
<!-- AdminLTE for demo purposes -->

  
<script src="{{url('/admindist/dist/js/demo.js')}}"></script>
{{-- <script src="{{url('/admindist/dist/js/sweetalert.min.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.js"></script>
@if(isset($active) || isset($page_title))
<script type="text/javascript">
  $(function () {
    $('#aktif{{$active}}').toggleClass('active');
  });
  $(function () {
    $('#anak{{$page_title}}').toggleClass('active');
  });
</script>
@endif
  @yield('js')
</body>
</html>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ url('backend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ url('backend/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ url('backend/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/style.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ url('backend/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- tinymce -->
    <script src="https://cdn.tiny.cloud/1/9kwmev7of6r1gwfblgyke70ptjc8153as3hzygkrfa2kc91n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- Datatable -->
    <link href="{{ url('backend/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/plugins/dataTables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/plugins/dataTables/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        .tox-tinymce-aux {
               position: relative !important;
               z-index: 10055;
           }
    </style>
</head>

<body class="font-sans antialiased">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header" >
                        <div class="dropdown profile-element" style="background-color: white; ">
                            <img alt="Farming City" width="300" height="200" class="ro.unded-circle" src="{{ url('frontend/images/FARMING1.jpg') }}"/>
                         
                        </div>
                        <div class="logo-element">
                            CTZ+
                        </div>
                    </li>
                    <li class="{{ sidebar_active() == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ url('dashboard') }}" ><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li class="{{ sidebar_active() == 'category' ? 'active' : '' }}">
                        <a href="{{ url('categories/list') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Categories</span></a>
                    </li>
                    <!-- <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="graph_flot.html">Flot Charts</a></li>
                            <li><a href="graph_morris.html">Morris.js Charts</a></li>
                            <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                            <li><a href="graph_chartjs.html">Chart.js</a></li>
                            <li><a href="graph_chartist.html">Chartist</a></li>
                            <li><a href="c3.html">c3 charts</a></li>
                            <li><a href="graph_peity.html">Peity Charts</a></li>
                            <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                        </ul>
                    </li> -->
                    <li class="{{ sidebar_active() == 'item' ? 'active' : '' }}">
                        <a href="{{ url('items/list') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Items</span>  </a>
                    </li>
                    <li class="{{ sidebar_active() == 'gallery' ? 'active' : '' }}">
                        <a href="{{ url('gallery/list') }}"><i class="fa fa-flask"></i> <span class="nav-label">Gallery</span></a>
                    </li>
                    <li class="{{ sidebar_active() == 'news' ? 'active' : '' }}">
                        <a href="{{ url('news/list') }}"><i class="fa fa-edit"></i> <span class="nav-label">News</span></a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom bg-white">
            @include('layouts.navigation')

            <div class="row w-100 m-0">
                <div class="col-lg-12">
                    <div class="min-h-screen bg-gray-100 wrapper wrapper-content w-100">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ url('backend/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/js/bootstrap.js') }}"></script>
    <!-- <script src="{{ url('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script> -->
    <script src="{{ url('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ url('backend/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ url('backend/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ url('backend/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ url('backend/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ url('backend/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <!-- <script src="{{ url('backend/js/plugins/peity/jquery.peity.min.js') }}"></script> -->
    <script src="{{ url('backend/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ url('backend/js/inspinia.js') }}"></script>
    <script src="{{ url('backend/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ url('backend/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- DataTable -->
    <script src="{{ url('backend/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ url('backend/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

    <!-- GITTER -->
    <script src="{{ url('backend/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ url('backend/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ url('backend/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ url('backend/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ url('backend/js/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ url('backend/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>

    <!-- custom scripts -->
    @yield('category_scripts')
    @yield('items_scripts')
    @yield('gallery_scripts')
    <script>
        // trigger loading
        jQuery.ajaxSetup({
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function(){
                $('#loader').hide();
            },
            success: function() {}
            });

        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                // toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

            }, 1300);


        });
    </script>
</body>
</html>

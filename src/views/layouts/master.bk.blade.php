<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link rel="stylesheet" href="{{SERVER}}/ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{SERVER}}/ext/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{SERVER}}/ext/ionicons-2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{SERVER}}/ext/cms-v1/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{SERVER}}/ext/cms-v1/css/skins/skin-blue.min.css">

        <link rel="stylesheet" href="{{SERVER}}/ext/sweetalert-master/dist/sweetalert.css">
        <link rel="stylesheet" href="{{SERVER}}/ext/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{SERVER}}/ext/datepicker/datepicker3.css">

        @yield('styles')
        @yield('raw-style')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    

    </head>
    <body class="skin-blue">
        
        <div class="wrapper">

            <!-- Header -->
            @include('cms-v1/layouts/header')

            <!-- Sidebar -->
            @include('cms-v1/layouts/sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('page-title')
                        <small>{{ $page_description or null }}</small>
                    </h1>
                    <!-- You can dynamically generate breadcrumbs here -->
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Here</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('cms-v1/layouts/_flash')
                    <!-- Your Page Content Here -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Footer -->
            @include('cms-v1/layouts/footer')

        </div><!-- ./wrapper -->


        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience -->
        <script src='{{SERVER}}/ext/jquery/jq.js'></script>
        <script src='{{SERVER}}/ext/bootstrap/js/bootstrap.min.js'></script>
        <script src='{{SERVER}}/ext/cms-v1/js/app.min.js'></script>
        <script src='{{SERVER}}/ext/sweetalert-master/dist/sweetalert.min.js'></script>
        <script src='{{SERVER}}/ext/select2/dist/js/select2.min.js'></script>
        <script src='{{SERVER}}/ext/datepicker/bootstrap-datepicker.js'></script>
        <script src='{{SERVER}}/ext/cms-v1/js/custom.js'></script>
        @yield('scripts')
        @yield('raw-script')
    </body>
</html>
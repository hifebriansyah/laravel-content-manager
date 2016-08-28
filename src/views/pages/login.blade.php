<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bower_components/adminLte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('/bower_components/adminLte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
        -->

    <link href="{{ asset('/bower_components/adminLte/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                Admin Area
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">

                <p class="login-box-msg">Input your credentials to access the CMS</p>

                @include('lcm::/layouts/_flash')

                {{ Form::open(['url' => url('lcm/gen/user/login'), 'method'=>'post']) }}
                    
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>

                {!! Form::close() !!}

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->


        <!-- jQuery 2.1.3 -->
        <script src="{{ asset ('/bower_components/adminLte/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset ('/bower_components/adminLte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ('/bower_components/adminLte/dist/js/app.min.js') }}" type="text/javascript"></script>

    </body>
</html>
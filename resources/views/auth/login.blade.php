<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PointOfSale | Log in</title>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('adminLte/plugins/iCheck/all.css')}}">
    {{--<!-- Bootstrap 4 -->--}}
    @if(app()->getlocale()=='ar')
    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminLte/plugins/font-awesome/css/font-awesome.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminLte/dist/css/adminlte.min.css')}}">
    <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{asset('adminLte/dist/css/bootstrap-rtl.min.css')}}">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{asset('adminLte/dist/css/custom-style.css')}}">
  <!--Font Family -->
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
      <style>
        h1,h2,h3,h4,h5,h6{
          font-family: 'Cairo', sans-serif !important ;
        }
      </style>
     @else

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @endif

</head>
<body class="hold-transition login-page">
<body class="login-page">

<div class="login-box">

    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div><!-- end of login lgo -->

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}

            @include('partials._errors')
            <div class="input-group mb-3 has-feedback">
             <input type="email" name="email" class="form-control" placeholder="@lang('site.email')" value="{{old('email')}}">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3 has-feedback">
          <input type="password" name="password" class="form-control" placeholder="@lang('site.password') ">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
          </div>
            <div class="form-group">
                <label style="font-weight: normal;"><input type="checkbox" name="remember"> @lang('site.remember_me')</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.login')</button>

        </form><!-- end of form -->

    </div><!-- end of login body -->

</div><!-- end of login-box -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminLte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminLte/plugins/fastclick/fastclick.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>

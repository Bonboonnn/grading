<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/download/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="dist/download/ionicons-2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>E-Grading System</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in with your correct account</p>
                
                <form name="login" id="login" action="pages/process/login" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="uname" placeholder="Username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="upass" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <h5 style="text-align: center; color: red; font-weight: bolder !important; font-size: 14px;" id="err-msg">
                        <!-- error message na di bon !-->
                    </h5>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
                
                <a href="#">I forgot my password</a>
                
            </div>
        </div>
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
        
        <script>
            setTimeout(function() {
                $('#err-msg').fadeOut('slow');
            }, 4500);
        </script>
    </body>
</html>
    


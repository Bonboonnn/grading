<?php
session_start();
define( 'SEND_TO_HOME', true );
require_once "pages/src/auth.php";
require_once "pages/src/faculty_auth.php";
?>
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
                
                <form id="login_form" action="pages/src/login" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="uname" placeholder="Username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="upass" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <select class="form-control" name="login_level" id='login_level'>
                            <option value="">Login Type</option>
                            <option value="1">Admin</option>
                            <option value="2">Faculty</option>
                            <option value='3'>Student</option>
                        </select>
                        
                    </div>
                    <h5 style="text-align: center; color: red; font-weight: bolder !important; font-size: 14px;" id="err_msg">
                        <!-- error message na di bon !-->
                    </h5>
                    <div class="row">
                        <!-- <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div> -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="glyphicon glyphicon-log-in"></i>  &nbsp&nbspSign In</button>
                        </div>
                    </div>
                </form>
                
                
            </div>
        </div>
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>
            var timeOuts = false;
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
            if(timeOuts != false){
                clearTimeout(timeOut);
            }
            $("#login_form").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "pages/src/login",
                    data: $("#login_form").serialize(),
                    success: function(e){
                        console.log(e);
                        let response = JSON.parse(e);
                        if(response.status == "error"){
                            $("#err_msg").html(response.message);
                        } else {
                            window.location.href = "pages/";
                        }
                    },
                    error: function(e){

                    },
                    complete: function(e){
                    setTimeout(function() {
                        $('#err_msg').fadeOut('slow');
                        setTimeout(function(){
                            $("#err_msg").html('');
                            $('#err_msg').fadeIn('slow');
                        }, 500);
                    }, 2000);
                    
                    }
                });
            });

            $("#login_level").on('change', function() {
                let level = $("#login_level").val();
                if(level == 3) {
                    window.location.href='student-login.php';
                }
            });

        </script>
    </body>
</html>
    


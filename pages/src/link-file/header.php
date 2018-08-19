<style>
    .main-header{
        position: fixed;
        width:100%;
    }
    .content-wrapper{
        margin-top:40px;
        height:calc(100vh - 40px);
        overflow-y: auto;
    }
    #table_filter {
        display:block !important;
        float:right;
        margin-right:10px;
    }
    #table_filter input {
        border-radius:10px !important;
        margin-left:5px;
    }
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>E-GS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size: 15px;"><b>E-Grading System</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../../../download.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo ucfirst($_SESSION['user_data']['user_fname'])." ".ucfirst($_SESSION['user_data']['user_lname']); ?></span>
                        <i class="fa fa-angle-down pull-right"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" onclick="edit_profile('<?php echo $_SESSION['user_data']['user_id'] ?>')"class="btn btn-default btn-flat">Change Credentials</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    function edit_profile(id){
        $("#addUpdateModal").modal('show');
        $.ajax({
            url: "get_user_details",
            method: "GET",
            data: {faculty_id: id},
            success: function(e){
                let response = JSON.parse(e);
                $.each(response, function(index, value){
                    $("#faculty_id").val(value.faculty_id);
                    $("#facNo").val(value.facNo);
                    $("#fname").val(value.fname);
                    $("#lname").val(value.lname);
                    $("#mname").val(value.mname);
                    $("#username").val(value.username);
                    $("#password").val(value.password);
                    $(".radios").filter(`[value=${value.faculty_level}]`).prop('checked', true);
                    if(value.course_id != undefined){
                        getCourses();
                        window.setTimeout(function(){
                            $("#courses option[value="+value.course_id+"]").attr('selected', 'selected')
                        }, 100);
                    }
                });
                
            }
        });
    }
</script>
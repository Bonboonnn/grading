<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../plugins/iCheck/icheck.min.js"></script>


<div class="modal fade" id="addUpdateModal"> 
    <div class="modal-dialog modal-lg">
        <form id="addUpdateForm">
            <input type="hidden" name="faculty_id" id="faculty_id" class="form-control creds" />
            <div class="modal-content">     
                <div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Faculty</h3>
                </div>
                <div class="modal-body" id="insertUpdateModalBody">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Faculty Id No.</label>
                                <input type="text" id="facNo" name="facNo" class="form-control creds" placeholder="Faculty Id No." required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" id="fname" name="fname" class="form-control creds" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" id="mname" name="mname" class="form-control creds" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" id="lname" name="lname" class="form-control creds" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Course</label>
                                <select name="course_id" id="courses" id="courses" class="form-control creds">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type='text' id="username" name="username" class="form-control creds" required placeholder='username'>
                            </div> 
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type='password' id="password" name="password" class="form-control creds" required placeholder='username'>
                            </div>
                        </div>
                        <?php if($_SESSION['user_data']['login_level'] == 1 ):  ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Level &nbsp&nbsp</label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" class="radios" value=2 checked>Faculty
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" class="radios" value=1>Admin
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:lightblue !important">
                    <button type="reset" class="btn btn-primary pull-left" id="fac_close_btn">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div> 
</div>

<form id="for_restore">
<input type="file" accept="application/x-sql" class="form-control" name="restore_db" id="restore_db" style="display:none" />
</form>
<div id="wait" style="display:none;position:absolute;top:25%;left:50%;padding:2px;z-index:99999"><img src='../../giphy.gif' width="100" height="100" /><br></div>


<!-- page script -->
<script>

    $("#fac_close_btn").on('click', function(){
        $(".creds").val("");
        $(".radios").filter('[value=2]').prop('checked', true);
        $("#addUpdateModal").modal('hide');
    });

    $("#addUpdateForm").on("submit", function(e){
        e.preventDefault();
        let formData = new FormData($("#addUpdateForm")[0]);
        let process_url ="";
        if($("#faculty_id").val() != "" && $("#faculty_id").val() != " ")
            process_url = "faculty/update_faculty";
        else {
            process_url = "faculty/add_faculty";
        }
        $.ajax({
            method: "POST",
            url: process_url,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(e){
                let response = JSON.parse(e);
                alert(response.message);
                if(response.status == "success"){
                    $(".form-control").val("");
                    $(".radios").filter('[value=2]').prop('checked', true);
                }
            },
            error: function(e){

            },
            complete: function(e){
                $('#table').dataTable().fnClearTable();
                $('#table').dataTable().fnDestroy();
                displayData();
                $("#addUpdateModal").modal('hide');
            }
        });
    });
    function backup(){
        if(confirm("Please confirm database backup")){
            $.ajax({
                url: "backup",
                method: "GET",
                beforeSend : function(){
                    $("#wait").css("display", "block");
                },
                success: function(e){
                    console.log(e);
                    let response = JSON.parse(e);
                    if(response.status == "success"){
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                    
                },
                error: function(){

                },
                complete: function(e){
                    $("#wait").css("display", "none");
                }
            });
        }
    }

    function edit_faculty(update_data){
        $("#addUpdateModal").modal('show');
        $("#faculty_id").val(update_data.faculty_id);
        $("#facNo").val(update_data.facNo);
        $("#fname").val(update_data.fname);
        $("#lname").val(update_data.lname);
        $("#mname").val(update_data.mname);
        $("#username").val(update_data.username);
        $("#password").val(update_data.password);
        $(".radios").filter(`[value=${update_data.level}]`).prop('checked', true);
        if(update_data.course_id != undefined){
            getCourses();
            window.setTimeout(function(){
                $("#courses option[value="+update_data.course_id+"]").attr('selected', 'selected')
            }, 100);
        }
    }

    function restore(){
        $("#restore_db").click();
        
        
        $("#restore_db").on('change', function(){
            let formData = new FormData($("#for_restore")[0]);
            $.ajax({
                method: "POST",
                url: "restore",
                data: formData,
                processData: false,
                contentType: false,
                cache:false,
                beforeSend : function(){
                    $("#wait").css("display", "block");
                },
                success: function(e){
                    console.log(e);
                    let response = JSON.parse(e);
                    if(response.status == "success"){
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                    
                },
                error: function(){

                },
                complete: function(e){
                    $("#wait").css("display", "none");
                }
            });
        });
    }
</script>
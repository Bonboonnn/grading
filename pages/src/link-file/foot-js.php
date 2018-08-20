<div class="modal fade" id="addUpdateModal"> 
  <div class="modal-dialog modal-lg">
    <form id="addUpdateForm">
      <input type="hidden" name="faculty_id" id="faculty_id" />
      <div class="modal-content">     
        <div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Faculty</h3></div>
        <div class="modal-body" id="insertUpdateModalBody">
          <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Faculty Id No.</label>
                <input type="text" id="facNo" name="facNo" class="form-control" placeholder="Faculty Id No." required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Middle Name</label>
                <input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name">
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name">
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Course</label>
                <select name="course_id" id="courses" id="courses" class="form-control">
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Username</label>
                <input type='text' id="username" name="username" class="form-control" required placeholder='username'>
              </div> 
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type='password' id="password" name="password" class="form-control" required placeholder='username'>
              </div>
            </div>
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

<!-- page script -->
<script>
    $("#fac_close_btn").on('click', function(){
        window.location.reload();
    });
</script>
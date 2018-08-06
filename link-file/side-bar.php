<style>
    .main-sidebar {
        position:fixed;
    }
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview side1" id="index.php">
                <a href="../pages/index.php">
                    <i class="fa fa-users"></i> 
                    <span>Students</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<div class="modal" id='insertUpdateModal'> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">     
            <div class="modal-header"><h3 style='margin:0px'>Add/Update</h3></div>
            <div class="modal-body" id='insertUpdateModalBody'>
                <div class='row'>
                    <div class='col-lg-6 col-md-6'>
                        <div class='form-group'>
                            <label>First Name</label>
                            <input type='text' name='fname' class='form-control' placeholder='Student First Name' required>
                        </div>
                    </div>
                    <div class='col-lg-6 col-md-6'>
                        <div class='form-group'>
                            <label>Middle Name</label>
                            <input type='text' name='fname' class='form-control' placeholder='Student Middle Name'>
                        </div>
                    </div>
                    <div class='col-lg-6 col-md-6'>
                        <div class='form-group'>
                            <label>LastName Name</label>
                            <input type='text' name='fname' class='form-control' placeholder='Student Middle Name'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:lightblue !important">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="next_()" id="next_btn">Save</button>
            </div> 
        </div>
    </div> 
</div>




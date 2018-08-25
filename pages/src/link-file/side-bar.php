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
            <?php if($_SESSION['user_data']['login_level'] == 1): ?>
            <li class="treeview side1" id="faculty">
                <a href="faculty">
                    <i class="fa fa-user-md"></i> 
                    <span>Faculty</span>
                </a>
            </li>

            <li class="treeview side1" id="index">
                <a href="student">
                    <i class="fa fa-child"></i> 
                    <span>Students</span>
                </a>
            </li> 

            <li class="treeview side1" id="subject">
                <a href="subject">
                    <i class="fa fa-folder"></i> 
                    <span>Subject</span>
                </a>
            </li>

            <li class="treeview side1" id="faculty-subject">
                <a href="faculty-subject">
                    <i class="fa fa-folder-open"></i> 
                    <span>Faculty Subject</span>
                </a>
            </li>
            
            <li class="treeview side1" id="student-subject">
                <a href="student-subject">
                    <i class="fa fa-folder-open-o"></i> 
                    <span>Student Subject</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="treeview side1" id="student-grade">
                <a href="student-grade">
                    <i class="fa fa-pencil-square-o"></i> 
                    <span>Student Grade</span>
                </a>
            </li>
            <?php if($_SESSION['user_data']['login_level'] == 1): ?>
            <li class="treeview side1" id="course">
                <a href="course">
                    <i class="fa fa-tasks"></i> 
                    <span>Course</span>
                </a>
            </li>

            <li class="treeview side1" id="class">
                <a href="class">
                    <i class="fa fa-users"></i> 
                    <span>Class</span>
                </a>
            </li>

             <li class="treeview side1" id="school-year">
                <a href="school-year">
                    <i class="fa fa-calendar-o"></i> 
                    <span>School Year</span>
                </a>
            </li>

            <li class="treeview side1" id="year-level">
                <a href="year-level">
                    <i class="fa fa-calendar"></i> 
                    <span>Year Level</span>
                </a>
            </li>

            <li class="treeview side1" id="backup">
                <a href="#" onclick="backup()">
                    <i class="fa fa-database"></i> 
                    <span>Backup Database</span>
                </a>
            </li>

            <li class="treeview side1" id="restore">
                <a href="#" onclick="restore()">
                    <i class="fa fa-upload"></i> 
                    <span>Restore Database</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

    <!DOCTYPE html>
<html>
	
    <head>
        <?php include_once "link-file/head.php"; ?>
        
        <?php include_once "link-file/foot-js.php"; ?>
		
		<style>
			.dataTables_filter {
				display: none;
			}
			
			.yes_print {
				display: none;
			}
		</style>
		
		<style type="text/css" media="print">
			.dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info {
				display: none;
			}
			
			.box {
				border-top: 1px solid white !important;
			}
			
			.yes_print {
				display: block;
			}
		</style>
		
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
                
            <?php include_once "link-file/header.php"; ?>
            
            <?php include_once "link-file/side-bar.php"; ?>
            <div class="content-wrapper">
				<section class="content-header"></section>
                <section class="content">
					<div class="row container-fluid">
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Student List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add student</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Student ID #</td>
									<th>Full Name</td>
									<th>Course</td>
									<th>Year Level</td>
									<th>Class</td>
									<th>Username</td>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody id="tbody">
								
							</tbody>
							<table>
						</div>
					</div>
				</section>
            </div>
		</div>
		<div class="modal fade" id="addModal"> 
			<div class="modal-dialog modal-lg">
				<form id="addForm">
					<input type="hidden" id="student_id" name="student_id" class="form-control" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Student</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Student Id No.</label>
										<input type="text" id="studentIdNo" name="studentIdNo" class="form-control" placeholder="Student Id No." required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" id="student_fname" name="student_fname" class="form-control" placeholder="First Name" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Middle Name</label>
										<input type="text" id="student_mname" name="student_mname" class="form-control" placeholder="Middle Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" id="student_lname" name="student_lname" class="form-control" placeholder="Last Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Course</label>
										<select name="course_id" id="course_id" class="form-control" required>
										
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Year Level</label>
										<select name="yearlevel_id" onchange="get_classes()" id="yearlevel_id" class="form-control" required>
											
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Year Class</label>
										<select name="class_id" id="class_id" class="form-control" required>
											<option value=''>Select Class</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Username</label>
										<input type='text' id="student_username" name="student_username" class="form-control" required placeholder='Username'>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type='password' id="student_password" name="student_password" class="form-control" required placeholder='Password'>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" id="stud_close_btn">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
    </body>
</html>
<script>
	$(function(){
		get_year_levels();
		get_courses();
		displayData();
		$("#stud_close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on("submit", function(e){
			e.preventDefault();
			let process_url = "";
			let student_id = $("#student_id").val();
			if(student_id != "" && student_id != " "){
				process_url = "student/update_student";
			} else {
				process_url = "student/add_student";
			}
			let formData = new FormData($("#addForm")[0]);
			$.ajax({
				method: "POST",
				url: process_url,
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(e) {
					let response = JSON.parse(e);
					if(response.status == "success"){
						alert(response.message);
					} else {
						alert(response.message);
					}
					$('#table').dataTable().fnClearTable();
					$('#table').dataTable().fnDestroy();
					displayData(); 
					$(".form-control").val("");
				}
			});
		})
	})
	function edit(data){
		get_year_levels();
		get_courses();
		$("#studentIdNo").val(data.studentIdNo);
		$("#student_fname").val(data.student_fname);
		$("#student_mname").val(data.student_mname);
		$("#student_lname").val(data.student_lname);
		$("#student_username").val(data.username);
		$("#student_password").val(data.password);
		$("#student_id").val(data.student_id);
		window.setTimeout(function(){
			$("#addModal").modal('show');
		},300);
		window.setTimeout(function(){
			$("#yearlevel_id option[value="+data.yearlevel_id+"]").attr('selected', 'selected');
			$("#course_id option[value="+data.course_id+"]").attr('selected', 'selected');
			get_classes();
			window.setTimeout(function(){
				$("#class_id option[value="+data.class_id+"]").attr("selected", "selected");
			},100);
		},200);
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "student/delete_student",
				data:{student_id:id},
				success: (e) => {
					let response = JSON.parse(e);
					if(response.status == "success"){
						alert(response.message);
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						displayData(); 
					} else {
						alert(response.message);
					}
				}
			});
		}
	}

	function get_courses(){
		$.ajax({
			url:"course/get_courses",
			method:"GET",
			success: (e)=>{
				let value = JSON.parse(e);
				$("#course_id").empty();
				$("#course_id").append("<option value=''>Select Course</option>");
				$.each(value, function(index, val){
					$("#course_id").append(
						`<option value=${val.course_id}>${val.courseName}</option>`
					);
				});
			}
		});
	}

	function get_year_levels(){
		$.ajax({
			url: "year-level/get_year_levels",
			method: "GET",
			success: (e)=>{
				let value = JSON.parse(e);
				$("#yearlevel_id").empty();
				$("#yearlevel_id").append("<option value=''>Select Year</option>");
				$.each(value, function(index, val){
					$("#yearlevel_id").append(
						`<option value=${val.yearlevel_id}>${val.yearLevel}</option>`
					);
				});
			}
		});
	}

	function get_classes(){
		let yearlevel_id = $("#yearlevel_id").val();
		$.ajax({
			url:"class/get_class_year",
			method:"GET",
			data: {yearlevel_id:yearlevel_id},
			success: (e)=>{
				var val = JSON.parse(e);
				$("#class_id").empty();
				$("#class_id").append("<option value=''>Select Class</option>");
				$.each(val, function(index, val){
					$("#class_id").append(
						`<option value=${val.class_id}>${val.classname}</option>`
					);
				});
			}
		});
	}
	function displayData() {
		$.ajax({
			url:"student/get_students",
			method:"GET",
			success:(e) => {
				let value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, val){
					let updateData = JSON.stringify({
						student_id: val.student_id,
						studentIdNo: val.studentIdNo,
						student_fname: val.student_fname,
						student_mname: val.student_mname,
						student_lname: val.student_lname,
						yearlevel_id: val.yearlevel_id,
						class_id: val.class_id,
						course_id: val.course_id,
						username: val.username,
						password: val.password
					});
					$("#tbody").append(
						`<tr>
							<td>${val.studentIdNo}</td>
							<td>${val.student_fname} ${val.student_mname} ${val.student_lname}</td>
							<td>${val.courseName}</td>
							<td>${val.yearLevel}</td>
							<td>${val.classname}</td>
							<td>${val.username}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick='deletez(${val.student_id})'><i class="fa fa-remove"></i></button>
							</td> 
						</tr>`
					)
				});
			},
			error: (e) => {

			},
			complete: (e) => {
				$("#table").dataTable({
					bSort:false
				});
			}
		});
	}
</script>
    
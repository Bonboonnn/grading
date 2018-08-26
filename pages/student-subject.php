
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Student Subject List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add student Subject</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Student ID</td>
									<th>Student</td>
									<th>Subject</td>
									<th>Faculty Name</td>
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
					<input type="hidden" class="form-control" name="student_subject_id" id="student_subject_id" />
					<div class="modal-content">     
					<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Student Subject</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Student</label>
										<select name="student_id" id="student_id" class="form-control" required>
											<option value=''>Select Student</option>
										</select>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Faculty</label>
										<select name="student_faculty_id" onchange="get_subjects()" id="student_faculty_id" class="form-control" required>
										</select>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Subject</label>
										<select name="studentSubject_id" id="studentSubject_id" class="form-control" required>
											<option value=''>Select Subject</option>
										</select>
									</div>
								</div>
								
							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" data-dismiss="modal" id="close_btn">Close</button>
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
		displayData();
		get_faculties();
		get_students();
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on('submit', function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			let student_subject_id = $("#student_subject_id").val();
			let process_url = "";
			if(student_subject_id != "" && student_subject_id != " "){
				process_url = "student-subject/update_student_subject";
			} else {
				process_url = "student-subject/add_student_subject";
			}
			$.ajax({
				url: process_url,
				method: "POST",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: (e)=>{
					let response = JSON.parse(e);
					if(response.status == "success") {
						alert(response.message);
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						displayData();
						$(".form-control").val("");
					} else {
						alert(response.message);
					}
				},
				error: (e)=>{

				},
				complete: (e)=>{
					
				}
			});
		});
	})

	function edit(data){
		$("#student_subject_id").val(data.student_subject_id);
		$("#student_id").val(data.student_id);
		$("#student_faculty_id option[value="+data.faculty_id+"]").attr('selected', 'selected');
		get_subjects();
		window.setTimeout(function(){
			$("#studentSubject_id option[value="+data.subject_id+"]").attr('selected', 'selected');
		},300);
		$("#addModal").modal("show");
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "student-subject/delete_student_subject",
				data: {student_subject_id: id},
				success: function(e){
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

	function get_students() {
		$.ajax({
			url: "student/get_students",
			url:"student/get_students",
			method:"GET",
			success:(e) => {
				let value = JSON.parse(e);
				$("#student_id").empty();
				$("#student_id").append("<option value=''>Select Student</option");
				$.each(value, function(index, val){
					$("#student_id").append(
						`<option value='${val.student_id}'>${val.student_fname} ${val.student_mname} ${val.student_lname}</option>`
					);
				});
			},
		});
	}

	function get_faculties(){
		$.ajax({
			url: "faculty/display_faculty",
			method: "GET",
			success: (e)=>{
				let value = JSON.parse(e);
				$("#student_faculty_id").empty();
				$("#student_faculty_id").append("<option val=''>Select Faculty</option>");
				$.each(value, function(index, val){
					$("#student_faculty_id").append(
						`<option value=${val.faculty_id}>${val.fname} ${val.mname} ${val.lname}</option>`
					);
				});
			}
		});
	}

	function get_subjects(){
		let id = $("#student_faculty_id").val();
		$.ajax({
			url: "student-subject/get_faculties",
			method: "GET",
			data:{faculty_id:id},
			success: (e)=>{
				let value = JSON.parse(e);
				$("#studentSubject_id").empty();
				$("#studentSubject_id").append("<option val=''>Select Subject</option>");
				$.each(value, function(index, val){
					$("#studentSubject_id").append(
						`<option value=${val.subject_id}>${val.subjectName}</option>`
					);
				});
			}
		});
	}

	function displayData() {
		$.ajax({
			url:"student-subject/get_student_subjects",
			method:"GET",
			success:(e) => {
				let value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, val){
					let updateData = JSON.stringify({
						subject_id: val.subject_id,
						faculty_id: val.faculty_id,
						student_id: val.student_id,
						student_subject_id: val.studentsubject_id
					});
					$("#tbody").append(
						`<tr>
							<td>${val.studentIdNo}</td>
							<td>${val.student_fname} ${val.student_mname} ${val.student_lname}</td>
							<td>${val.subjectName}</td>
							<td>${val.fname} ${val.mname} ${val.lname}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick='deletez(${val.studentsubject_id})'><i class="fa fa-remove"></i></button>
							</td> 
						</tr>`
					);
				});
				$("#table").dataTable({
					bSort: false
				});
			},
			error: (e) => {

			}
		});
	}
</script>
    
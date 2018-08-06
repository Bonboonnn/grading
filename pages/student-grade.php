
    <!DOCTYPE html>
<html>
	
    <head>
        <?php include_once "../link-file/head.php"; ?>
        
        <?php include_once "../link-file/foot-js.php"; ?>
		
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
                
            <?php include_once "../link-file/header.php"; ?>
            
            <?php include_once "../link-file/side-bar.php"; ?>
            <div class="content-wrapper">
				<section class="content-header"></section>
                <section class="content">
					<div class="row container-fluid">
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">student List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add student Subject</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>student Grade ID</th>
									<th>Student ID</th>
									<th>Subject</th>
									<th>Faculty ID</th>
									<th>Course</th>
									<th>School year</th>
									<th>Final Grade</th>
									<th>Remarks</th>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody id="tbody">
								<tr>
									<td>${data.studentGrade_id}</td>
									<td>${data.studentIdNo}</td>
									<td>${data.subjectName}</td>
									<td>${tada.faculty_id}</td>
									<td>${data.courseCode}</td>
									<td>${data.schoolYear}</td>
									<td>${data.finalGrade}</td>
									<td>${data.remarks}</td>
									<td class="text-center">
										<button class="btn btn-success" onclick="edit('1')">
											<i class="fa fa-edit"></i>
										</button>
									</td>
									<td class="text-center">
										<button class="btn btn-danger" onclick="deletez('1')">
											<i class="fa fa-remove"></i>
										</button>
									</td> 
								</tr>
							</tbody>
							<table>
						</div>
					</div>
				</section>
            </div>
		</div>
		<div class="modal" id="addModal"> 
			<div class="modal-dialog modal-lg">
				<form id="addForm">
					<div class="modal-content">     
					<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Student Subject</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Student</label>
										<select name="studentSubject_id" class="form-control" required>
											<option value=''>Select Student</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Subject</label>
										<select name="studentSubject_id" class="form-control" required>
											<option value=''>Select Subject</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Faculty</label>
										<select name="faculty_id" class="form-control" required>
											<option value=''>Select Faculty</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
    </body>
</html>
<script>
	$("table").dataTable();
	addForm.addEventListener("submit",(e)=>{
		e.preventDefault();
		ajax_({url:"",method:"post",formData:new FormData($("#addForm")[0])});
	},false);

	function edit(id){
		window.location.href="edit-student-subject.php?id="+id;
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			const formData = new formData();
			formData.append("id",id);
			ajax_({url:"",method:"post",formData});
		}
	}
	function ajax_(data){/*
		$.ajax({
			url:data.url,
			method:data.method,
			data:data.formData,
			processData:false,
			contentType:false
		});*/
	}

	function displayData() {
		$.ajax({
			url:"",
			method:"post",
			data:{request:"select"},
			success:(e) => {
				const data = JSON.parse(e);
				let element = "";
				data.forEach(value => {
					element += `<tr>
									<td>${data.studentSubject_id}</td>
									<td>${data.student_id}</td>
									<td>${data.subjectName}</td>
									<td>${data.fac_lname}, ${data.fac_fname} ${data.fac_mname}</td>
									<td class="text-center">
										<button class="btn btn-success" onclick="edit("${data.student_id}")">
											<i class="fa fa-edit"></i>
										</button></td>
									<td class="text-center"><button class="btn btn-danger" onclick="deletez("${data.student_id}")"><i class="fa fa-remove"></i></button></td> 
								</tr>`;
				});
			}
		});
	}
</script>
    
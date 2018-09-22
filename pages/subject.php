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
    <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
        <div class="wrapper">
                
            <?php include_once "link-file/header.php"; ?>
            
            <?php include_once "link-file/side-bar.php"; ?>
            <div class="content-wrapper">
				<section class="content-header"></section>
                <section class="content">
					<div class="row container-fluid">
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Subjects List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Subject</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table table-striped table-bordered" id="table">
							<thead class="bg-primary">
                                <tr>          
									<th>Subject Code</th>
									<th>Subject Name</th>
									<th>Unit(s)</th>
									<th>Year Level</th>
									<th>School Year</th>
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
					<input type="hidden" class="form-control" name="subject_id" id="subject_id" />
					<div class="modal-content">     
							<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Subject</h3></div>
							<div class="modal-body" id="insertUpdateModalBody">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="form-group">
											<label>Subject Code</label>
											<input type="text" name="subjectCode" id="subjectCode" class="form-control" placeholder="Subject code" required>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Subject Name</label>
											<input type="text" name="subjectName" id="subjectName" class="form-control" placeholder="Subject Name" required>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Unit</label>
											<input name="unit" class="form-control" id="unit" placeholder="Unit" required>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Year Level</label>
											<select name="yearlevel_id" class="form-control" id="yearlevel_id" required>
				
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>School Year</label>
											<select name="schoolyear_id" class="form-control" id="schoolyear_id" required>
										
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
		get_year_levels();
		get_school_years();
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on('submit', function(e) {
			e.preventDefault();
			let subject_id = $("#subject_id").val();
			let process_url = "";
			if(subject_id != "" && subject_id != " "){
				process_url = "subject/update_subject";
			} else {
				process_url = "subject/add_subject";
			}
			let formData = new FormData($("#addForm")[0]);
			$.ajax({
				url: process_url,
				method: "POST",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: (e) => {
					console.log(e);
					let response = JSON.parse(e);
					if(response.status=="success"){
						alert(response.message);
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						displayData();
						$(".form-control").val("");
					} else {
						alert(response.message);
					}
				}
			});
		});
	});

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

	function get_school_years(){
		$.ajax({
			url: "school-year/get_school_years",
			method: "GET",
			success: (e) => {
				let value = JSON.parse(e);
				$("#schoolyear_id").empty();
				$("#schoolyear_id").append("<option value=''>Select School Year</option>");
				$.each(value, function(index, val){
					$("#schoolyear_id").append(
						`<option value=${val.schoolyear_id}>${val.semester} S.Y: ${val.schoolYear} </option>`
					);
				});
			}
		});
	}

	function edit(data){
		$("#subject_id").val(data.subject_id);
		$("#subjectCode").val(data.subjectCode);
		$("#subjectName").val(data.subjectName);
		$("#unit").val(data.unit);
		$("#addModal").modal('show');
		$("#yearlevel_id option[value="+data.yearlevel_id+"]").attr('selected', 'selected');
		$("#schoolyear_id option[value="+data.schoolyear_id+"]").attr('selected', 'selected');

	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "subject/delete_subject",
				data: {subject_id:id},
				success: (e) => {
					let response = JSON.parse(e);
					if(response.status == "success") {
						alert(response.message);
					} else {
						alert(response.message);
					}
				},
				complete: (e) => {
					$('#table').dataTable().fnClearTable();
					$('#table').dataTable().fnDestroy();
					displayData();
				}
			});
		}
	}

	function displayData() {
		$.ajax({
			method: "GET",
			url: "subject/get_subjects",
			success: function(e){
				let response = JSON.parse(e);
				$("#tbody").empty();
				$.each(response, function(index, val){
					let updateData = JSON.stringify({
						subjectCode: val.subjectCode,
						subjectName: val.subjectName,
						unit: val.unit,
						schoolyear_id: val.schoolyear_id,
						yearlevel_id: val.yearlevel_id,
						subject_id: val.subject_id
					});
					$("#tbody").append(
						`<tr>
							<td>${val.subjectCode}</td>
							<td>${val.subjectName}</td>
							<td>${val.unit}</td>
							<td>${val.yearLevel}</td>
							<td>S.Y: ${val.schoolYear} ${val.semester}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center">
								<button class="btn btn-danger" onclick='deletez(${val.subject_id})'><i class="fa fa-remove"></i></button>
							</td>
						</tr>`
					);
				});
				$("#table").dataTable({
					bSort: false
				});
			}
		});
	}
</script>
    
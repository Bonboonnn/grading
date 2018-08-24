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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Faculty Subject List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Faculty Subject</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Faculty ID</th>
									<th>Subject ID</th>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody id="tbody">
								<tr>
									<td>${data.faculty_id}</td>
									<td>${data.subject_id}</td>
									<td class="text-center">
										<button class="btn btn-success" onclick="edit('1')">
											<i class="fa fa-edit"></i>
										</button></td>
									<td class="text-center"><button class="btn btn-danger" onclick="deletez('1')"><i class="fa fa-remove"></i></button></td> 
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
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Faculty Subject</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Faculty</label>
										<select name="faculty_subject_id" id="faculty_subject_id" class="form-control" required>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Subject</label>
										<select name="subject_id" id="subject_id" class="form-control" required>
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
	$(function(){
		//displayData();
		get_faculties();
		get_subjects();
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on('submit', function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			let class_id = $("#class_id").val();
			let process_url = "";
			if(class_id != "" && class_id != " "){
				process_url = "class/update_class";
			} else {
				process_url = "class/add_class";
			}
			$.ajax({
				url: process_url,
				method: "POST",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: (e)=>{
					console.log(e);
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
		$("#class_id").val(data.class_id);
		$("#classname").val(data.classname);
		get_year_levels();
		window.setTimeout(function(){
			$("#yearlevel_id option[value="+data.yearlevel_id+"]").attr('selected', 'selected')
		}, 100);
		$("#addModal").modal("show");
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "class/delete_class",
				data: {class_id: id},
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

	function get_faculties(){
		$.ajax({
			url: "faculty/get_faculties_level",
			method: "GET",
			data: {faculty_level: 2},
			success: (e)=>{
				let value = JSON.parse(e);
				$("#faculty_subject_id").empty();
				$("#faculty_subject_id").append("<option val=''>Select Faculty</option>");
				$.each(value, function(index, val){
					$("#faculty_subject_id").append(
						`<option value=${val.faculty_id}>${val.fname} ${val.mname} ${val.lname}</option>`
					);
				});
			}
		});
	}

	function get_subjects(){
		$.ajax({
			url: "subject/get_subjects",
			method: "GET",
			success: (e)=>{
				console.log(e);
				let value = JSON.parse(e);
				$("#subject_id").empty();
				$("#subject_id").append("<option val=''>Select Subject</option>");
				$.each(value, function(index, val){
					$("#subject_id").append(
						`<option value=${val.subjects}>${val.subjectName}</option>`
					);
				});
			}
		});
	}

	function displayData() {
		$.ajax({
			url:"class/get_classes",
			method:"GET",
			success:(e) => {
				//console.log(e);
				let value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, val){
					let updateData = JSON.stringify({
						yearlevel_id: val.yearlevel_id,
						classname: val.classname,
						class_id: val.class_id
					});
					$("#tbody").append(
						`<tr>
							<td>${val.yearLevel}</td>
							<td>${val.classname}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick='deletez(${val.class_id})'><i class="fa fa-remove"></i></button>
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
    
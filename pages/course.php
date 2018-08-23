<!DOCTYPE html>
<html>
	
    <head>
    	<?php 	
			include_once "link-file/head.php";
			include_once "link-file/foot-js.php"; 
    	?>
		
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Course List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Course</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
								<thead>
	                                <tr>          
										<th>Course ID</th>
										<th>Course Name</th>
										<th>Description</th>
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
					<input type="hidden" name="course_id" id="course_id" class="form-control" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Course</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Course Name</label>
										<input type="text" name="courseName" id="courseName" class="form-control course" placeholder="Course Name" required>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Course Description</label>
										<input type="text" name="description" id="description" class="form-control course" placeholder="Course Description" required>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" id="close_btn">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
    </body>
</html>
<script>
	$(document).ready(function(){
		displayData();
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on('submit', function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			let process_url = "";
			if($("#course_id").val() != "" && $("#course_id").val() != " "){
				process_url = "course/update_course";
			} else {
				process_url = "course/add_course";
			}
			$.ajax({
				method: "POST",
				url: process_url,
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(e){
					const response = JSON.parse(e);
					if(response.status == "success"){
						alert(response.message);
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						displayData();
						$(".form-control").val("");
					} else {
						alert(response.message);
					}
				},
				error: function(e){

				},
				complete: function(e){
				  	
				}
			});
		});
	});
	function edit(data){
		$("#addModal").modal('show');
		$("#course_id").val(data.course_id);
		$("#courseName").val(data.courseName);
		$("#description").val(data.description);
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: "course/delete_course",
				method: "GET",
				data: {course_id: id},
				success: function(e){
					let response = JSON.parse(e);
					if(response.status == "success"){
						alert(response.message);
					} else {
						alert(response.message);
					}
				},
				error: function(e){

				},
				complete: function(e){
					$('#table').dataTable().fnClearTable();
					$('#table').dataTable().fnDestroy();
					displayData(); 
				}
			});
		}
	}

	function displayData() {
		$.ajax({
			url:"course/get_courses",
			method:"GET",
			success:(e) => {
				const response = JSON.parse(e);
				$("#tbody").empty();
				$.each(response, function(index, value){
					let updateData = JSON.stringify({
						course_id:value.course_id,
						courseName:value.courseName,
						description:value.description
					});
					$("#tbody").append(
						`<tr>
							<td>${value.course_id}</td>
							<td>${value.courseName}</td>
							<td>${value.description}</td>
							<td class='text-center'>
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td>
								<button class="btn btn-danger" onclick='deletez(${value.course_id})'>
									<i class="fa fa-remove"></i>
								</button>
							</td class='text-center'>
						</tr>`
					);
				});
				$("#table").dataTable({
					bSort: false
				});
			},
			error:(e)=>{

			}
		});
	}
</script>
    
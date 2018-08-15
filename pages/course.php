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
		<div class="modal" id="addModal"> 
			<div class="modal-dialog modal-lg">
				<form id="addForm">
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Course</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Course Name</label>
										<input type="text" name="courseName" class="form-control" placeholder="Course Name" required>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Course Description</label>
										<input type="text" name="description" class="form-control" placeholder="Course Description" required>
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
	$(document).ready(function(){
		displayData();
		$("#addForm").on('submit', function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			for(var e of formData){
				console.log(e);
			}
			$.ajax({
				method: "POST",
				url: "process/course/add_course",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(e){
					console.log(e);
					const response = JSON.parse(e);
					if(response.status == "success"){
						alert(response.message);
					} else {
						alert(response.message);
					}
				}
			});
		});
	});
	function edit(id){
		window.location.href="edit-year-level.php?id="+id;
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			const formData = new formData();
			formData.append("id",id);
			ajax_({url:"",method:"post",formData});
		}
	}

	function displayData() {
		$.ajax({
			url:"process/course/get_courses",
			method:"GET",
			success:(e) => {
				console.log(e);
				const response = JSON.parse(e);
				$("#tbody").empty();
				$.each(response, function(index, value){
					$("#tbody").append(
						`<tr>
							<td>${value.course_id}</td>
							<td>${value.courseName}</td>
							<td>${value.description}</td>
							<td class='text-center'>
								<button class="btn btn-success" onclick="edit('1')">
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td>
								<button class="btn btn-danger" onclick="deletez('1')">
									<i class="fa fa-remove"></i>
								</button>
							</td class='text-center'>
						</tr>`
					);
				});
			},
			error:(e)=>{

			},
			comlete:(e)=>{
				$("#table").dataTable({
					bSort: false
				});
			}
		});
	}
</script>
    
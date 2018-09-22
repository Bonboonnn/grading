
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Faculty List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addUpdateModal" data-toggle="modal">Add Faculty</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table table-striped table-bordered" id="table">
								<thead class="bg-primary">
	                                <tr>          
										<th>Faculty No.</td>
										<th>First Name</td>
										<th>Middle Name</td>
										<th>Last Name</td>
										<th>Course</td>
										<th>username</td>
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
    </body>
</html>
<script> 
	$(document).ready(function(){
		displayData();
	});
	
	function edit(update_data){
		$("#addUpdateModal").modal('show');
		$("#faculty_id").val(update_data.faculty_id);
		$("#facNo").val(update_data.facNo);
		$("#fname").val(update_data.fname);
		$("#lname").val(update_data.lname);
		$("#mname").val(update_data.mname);
		$("#username").val(update_data.username);
		$("#password").val(update_data.password);
		$(".radios").filter(`[value=${update_data.level}]`).prop('checked', true);
		if(update_data.course_id != undefined){
			getCourses();
			window.setTimeout(function(){
				$("#courses option[value="+update_data.course_id+"]").attr('selected', 'selected')
			}, 100);
		}
	}

	function delete_faculty(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: "faculty/delete_faculty",
				method: "GET",
				data: {faculty_id:id},
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
			url:"faculty/display_faculty",
			method:"GET",
			success:(e) => {
				const data = JSON.parse(e);
				$("#tbody").empty();
				$.each(data, function(index, value){
					if(value.courseName == null){
						value.courseName = "";
						value.course_id = undefined;
					}
					let update_data = JSON.stringify({
						level:value.faculty_level,
						course_id:value.course_id,
						faculty_id:value.faculty_id,
						facNo:value.facNo,
						fname:value.fname,
						lname:value.lname,
						mname:value.mname,
						username:value.username,
						password:value.password,
					});
					$("#tbody").append(
						`<tr>
							<td>${value.facNo}</td>
							<td>${value.fname}</td>
							<td>${value.mname}</td>
							<td>${value.lname}</td>
							<td>${value.courseName}</td>
							<td>${value.username}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${update_data})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick="delete_faculty(${value.faculty_id})"><i class="fa fa-remove"></i></button>
							</td> 
						</tr>`
					);
				});
			},
			error:(e)=>{

			},
			complete:(e)=>{
				$("#table").dataTable({
					bSort: false
				});
			}
		});
	}
	
</script>
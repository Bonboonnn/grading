
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Faculty List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Faculty</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
								<thead>
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
		<div class="modal fade" id="addModal"> 
			<div class="modal-dialog modal-lg">
				<form id="addForm">
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Faculty</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Faculty Id No.</label>
										<input type="text" name="facNo" class="form-control" placeholder="Faculty Id No." required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="fname" class="form-control" placeholder="First Name" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Middle Name</label>
										<input type="text" name="mname" class="form-control" placeholder="Middle Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="lname" class="form-control" placeholder="Last Name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Course</label>
										<select name="course_id" class="form-control" required>
											<option value="">Select Course</option>
											<option value="course_id">Course Name</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Year Level</label>
										<select name="yearLevel_id" class="form-control" required>
											<option value="">Select Year Level</option>
											<option value="yearLevel_id">Year Level</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Username</label>
										<input type='text' name="username" class="form-control" required placeholder='username'>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Password</label>
										<input type='password' name="password" class="form-control" required placeholder='username'>
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
	});
	addForm.addEventListener("submit",(e)=>{
		e.preventDefault();
		ajax_({
			url : "",
			method : "POST",
			formData : new FormData($("#addForm")[0])
		});
	},false);
	
	function edit(id){
		window.location.href="edit-student.php?id="+id;
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			const formData = new formData();
			formData.append("id",id);
			ajax_({
				url:"",
				method:"POST",
				formData:formData
			});
		}
	}
	function ajax_(data){
		$.ajax({
			url:data.url,
			method:data.method,
			data:data.formData,
			processData:false,
			contentType:false,
			cache:false,
			success: function(e){

			}
		});
	}

	function displayData() {
		$.ajax({
			url:"process/faculty/display_faculty",
			method:"GET",
			success:(e) => {
				console.log(e);
				const data = JSON.parse(e);
				$("#tbody").empty();
				$.each(data, function(index, value){
					if(value.course_id == null){
						value.course_id = "";
					}
					$("#tbody").append(
						`<tr>
							<td>${value.facNo}</td>
							<td>${value.fname}</td>
							<td>${value.mname}</td>
							<td>${value.lname}</td>
							<td>${value.course_id}</td>
							<td>${value.username}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick="edit('1')">
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick="deletez('1')"><i class="fa fa-remove"></i></button>
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
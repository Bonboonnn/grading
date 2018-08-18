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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Subjects List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Subject</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Subject ID</th>
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
								<tr>
									<td>${data.subject_id}</td>
									<td>${data.subjectCode}</td>
									<td>${data.subjectName}</td>
									<td>${data.unit}</td>
									<td>${data.yearLevel}</td>
									<td>${data.schoolYear}</td>
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
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add Student</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Subject Code</label>
										<input type="text" name="subjectCode" class="form-control" placeholder="Subject code" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Subject Name</label>
										<input type="text" name="subjectName" class="form-control" placeholder="Subject Name" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Unit</label>
										<input name="unit" class="form-control" placeholder="Unit" required>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Year Level</label>
										<select name="yearLevel_id" class="form-control" required>
											<option>Select Year Level</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>School Year</label>
										<select name="yearLevel_id" class="form-control" required>
											<option>Select School Year</option>
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
		window.location.href="edit-subject.php?id="+id;
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
				const value = JSON.parse(e);
				let element = "";
				value.forEach(data => {
					element += `<tr>
									<td>${data.subject_id}</td>
									<td>${data.subjectCode}</td>
									<td>${data.subjectName}</td>
									<td>${data.unit}</td>
									<td>${data.yearLevel}</td>
									<td>${data.schoolYear}</td>
									<td class="text-center">
										<button class="btn btn-success" onclick="edit("${data.subject_id}")">
											<i class="fa fa-edit"></i>
										</button></td>
									<td class="text-center"><button class="btn btn-danger" onclick="deletez("${data.subject_id}")"><i class="fa fa-remove"></i></button></td> 
								</tr>`;
				});
			}
		});
	}
</script>
    
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">School Year List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add School Year</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>School Year</th>
									<th>Semester</th>
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
					<input type="hidden" class="form-control" name="schoolyear_id" id="schoolyear_id" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add School Year</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>School Year</label>
										<input type="text" name="schoolYear" class="form-control" placeholder="School Year" required>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Semester</label>
										<input type='text' name='semester' class="form-control" placeholder='Semester' required>
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
		displayData();
		$("#addForm").on('submit', function(e) {
			e.preventDefault();
			let schoolyear_id = $("#schoolyear_id").val();
			let process_url = "";
			if(schoolyear_id != "" && schoolyear_id != " "){
				process_url = "school-year/update_school_year";
			} else {
				process_url = "school-year/add_school_year";
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
					} else {
						alert(response.message);
					}
				},
				error: (e) => {

				},
				complete: (e) => {
					$('#table').dataTable().fnClearTable();
					$('#table').dataTable().fnDestroy();
					displayData();
					$(".form-control").val("");
				}
			});
		});
	});

	function edit(data){
		console.log(data);
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			alert(id);
		}
	}

	function displayData() {
		$.ajax({
			method: "GET",
			url: "school-year/get_school_years",
			success: function(e){
				let response = JSON.parse(e);
				$("#tbody").empty();
				$.each(response, function(index, value){
					let updateData = JSON.stringify({
						schoolYear: value.schoolYear,
						semester: value.semester,
						schoolyear_id: value.schoolyear_id
					});
					$("#tbody").append(
						`<tr>
							<td>${value.schoolYear}</td>	
							<td>${value.semester}</td>	
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center">
								<button class="btn btn-danger" onclick='deletez(${value.schoolyear_id})'><i class="fa fa-remove"></i></button>
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
    
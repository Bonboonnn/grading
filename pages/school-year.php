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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">School Year List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add School Year</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table table-striped table-bordered" id="table">
							<thead class="bg-primary">
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
		<div class="modal fade" id="addModal"> 
			<div class="modal-dialog modal-lg">
				<form id="addForm">
					<input type="hidden" class="form-control" name="schoolyear_id" id="schoolyear_id" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update School Year</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>School Year</label>
										<?php 
											$year=date('Y');
											$yearOpt = '';
											while($year > 1990) {
												$yearOpt = $yearOpt."
													<option>$year-".($year+1)."</option>
												";
												$year = $year - 1;
											}
										?>
										<select name="schoolYear" id='schoolYear' class="form-control" placeholder="School Year" required>
											<?php echo $yearOpt; ?>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Semester</label>
										<select name='semester' id='semester' class="form-control" placeholder='Semester' required>
											<option>First Semester</option>
											<option>Second Semester</option>
											<option>Third Semester</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" id="close_btn" data-dismiss="modal">Close</button>
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
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
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
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						displayData();
						$(".form-control").val("");
					} else {
						alert(response.message);
					}
				},
				error: (e) => {

				},
				complete: (e) => {
					
				}
			});
		});
	});

	function edit(data){
		$("#schoolyear_id").val(data.schoolyear_id);
		$("#schoolYear").val(data.schoolYear);
		$("#semester").val(data.semester);
		$("#addModal").modal('show');
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "school-year/delete_school_year",
				data: {schoolyear_id:id},
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
    
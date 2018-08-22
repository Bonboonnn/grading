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
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Year Level</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Year Level ID</th>
									<th>Year Level</th>
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
					<input type="hidden" name="yearlevel_id" id="yearlevel_id" class="form-control" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Year Level</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Year Level</label>
										<input type="text" name="yearLevel" id="yearLevel" class="form-control" placeholder="Year Level" required>
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
			$(".form-control").val('');
			$("#addModal").modal('hide');
		});
		$("#addForm").on("submit", function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			let process_url = "";
			if($("#yearlevel_id").val() != "" && $("#yearlevel_id").val() != " "){
				process_url = "year-level/update_year_level";
			} else {
				process_url = "year-level/add_year";
			}
			$.ajax({
				method: "POST",
				url: process_url,
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(e){
					console.log(e);
					let response = JSON.parse(e);
					if(response.status=="success"){
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
					$(".form-control").val("");
				}
			});
		});
	});
	function edit(data){
		$("#addModal").modal('show');
		$("#yearlevel_id").val(data.yearlevel_id);
		$("#yearLevel").val(data.yearLevel);
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "year-level/delete_year_level",
				data: {yearlevel_id: id},
				success: function(e){
					let response = JSON.parse(e);
					console.log(response);
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
			url: "year-level/get_year_levels",
			method: "GET",
			success:(e) => {
				const value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, value){
					let updateData = JSON.stringify({
						yearlevel_id: value.yearlevel_id,
						yearLevel: value.yearLevel
					});
					$("#tbody").append(
						`<tr>
							<td>${value.yearlevel_id}</td>	
							<td>${value.yearLevel}</td>	
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center">
								<button class="btn btn-danger" onclick='deletez(${value.yearlevel_id})'><i class="fa fa-remove"></i></button>
							</td> 	
						</tr>`
					);
				});
				$("#table").dataTable({
					bSort: false
				});
			},
			error: (e)=>{

			}
		});
	}
</script>
    
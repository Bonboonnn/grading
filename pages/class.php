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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Class List</h3></div>
						<div class="col-lg-2 col-md-2">
							<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">Add Class</button>
						</div>
						<div class="col-12">
							<hr>
							<table class="table" id="table">
							<thead>
                                <tr>          
									<th>Year Level</th>
									<th>Class Name</th>
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
					<input type="hidden" class="form-control" id="class_id" name="class_id" />
					<div class="modal-content">     
						<div class="modal-header"  style="background-color:lightblue !important"><h3 style="margin:0px">Add / Update Class</h3></div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Year Level</label>
										<select name="yearlevel_id" id="yearlevel_id" class="form-control" required>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Class Name</label>
										<input type="text" name="classname" id="classname" class="form-control" placeholder="Class Name" required>
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
	$(function(){
		displayData();
		get_year_levels();
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
					} else {
						alert(response.message);
					}
				},
				error: (e)=>{

				},
				complete: (e)=>{
					$('#table').dataTable().fnClearTable();
					$('#table').dataTable().fnDestroy();
					displayData();
					$(".form-control").val("");
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
    
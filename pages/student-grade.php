
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
						<div class="col-lg-10 col-md-10"><h3 style="margin:0">Student Grade List</h3></div>
						<div class="col-lg-2 col-md-2">
							<?php if($_SESSION['user_data']['login_level'] == 1): ?>
								<button class="btn btn-block btn-primary" data-target="#addModal" data-toggle="modal">		Add student Grade
								</button>
							<?php endif; ?>
							<?php if($_SESSION['user_data']['login_level'] == 2): ?>
								<!-- <button class="btn btn-block btn-success" target="_blank">Print</button> -->
								<a href="print.html" class="btn btn-block btn-success" onclick="window.open('print.html', 'newwindow', 'width=800,height=500');return false;"
										 ><i class="fa fa-print"></i> Print</a>
								<input type="hidden" value="<?php echo $_SESSION['user_data']['user_id'];  ?>" id="faculty" name="faculty" />
							<?php endif; ?>
							<p id="user_level" style="display:none">
								<?php echo $_SESSION['user_data']['login_level'] ?>
							</p>
						</div>
						<div class="col-12">
							<hr>
							<table class="table table-striped table-responsive" id="table">
							<thead class="bg-primary">
                                <tr>
									<th>Student</th>
									<th>Subject</th>
									<th>Faculty</th>
									<th>Course</th>
									<th>Prelim</th>
									<th>Midterm</th>
									<th>Endterm</th>
									<th>Final Grade</th>
									<th>S.Y</th>
									<th>Remarks</th>
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
					<input type="hidden" name="studentgrade_id" id="student_grade_id" class="form-control" />
					<div class="modal-content">     
					<div class="modal-header"  style="background-color:lightblue !important">
						<h3 style="margin:0px">Add Student Grade</h3>
					</div>
						<div class="modal-body" id="insertUpdateModalBody">
							<div class="row">

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Student</label>
										<select name="student_id" id="student_id" onchange="get_faculties()" id="student_id" class="form-control" required>
											<option value=''>Select Student</option>
										</select>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Faculty</label>
										<select name="student_grade_faculty_id" onchange="get_subjects()" id="student_grade_faculty_id" class="form-control" required>
											<option value=''>Select Faculty</option>
										</select>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Subject</label>
										<select name="subject_id" onchange="get_school_year()" id="subject_id" class="form-control" required>
											<option value=''>Select Subject</option>
										</select>
									</div>
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Course</label>
										<input type="hidden" name="course_id" id="course_id" class="form-control" />
										<input type="text" id="course_desc" class="form-control" readonly />
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>School Year</label>
										<input type="hidden" name="schoolyear_id" class="form-control" id="school_year_id">
										<input type="text" id="school_year_sem" class="form-control" readonly />
									</div>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">
									<label>Grades</label>
									<div class="form-group">
										<div class="col-lg-4 col-md-4 col-sm-4">
											<label>Prelim Grade</label>
											<input type='number' name='prelim_grade' step="0.01" onchange="setTwoNumberDecimal" id="prelim_grade" class="form-control" placeholder='Prelim Grade'>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<label>Midterm Grade</label>
											<input type='number' name='midterm_grade' step="0.01" onchange="setTwoNumberDecimal" id="midterm_grade" class="form-control" placeholder='Midterm Grade'>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<label>Endterm Grade</label>
											<input type='number' name='endterm_grade' step="0.01" onchange="setTwoNumberDecimal" id="endterm_grade" class="form-control" placeholder='Endterm Grade'>
										</div>
									</div>
								</div>

								<!-- <div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Remarks</label>
										<input type='text' name='remarks' id="remarks" class="form-control" placeholder='Remarks'>
									</div>
								</div> -->

							</div>
						</div>
						<div class="modal-footer" style="background-color:lightblue !important">
							<button type="reset" class="btn btn-primary pull-left" data-dismiss="modal" id="close_btn">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
    </body>
</html>
<script>
	function setTwoNumberDecimal(event) {
	    this.value = parseFloat(this.value).toFixed(3);
	}
	$(function(){		
		get_students();
		pick_display();
		$("#close_btn").on("click", function(){
			window.location.reload();
		});
		$("#addForm").on('submit', function(e){
			e.preventDefault();
			let formData = new FormData($("#addForm")[0]);
			let student_grade_id = $("#student_grade_id").val();
			let process_url = "";
			if(student_grade_id != "" && student_grade_id != " "){
				process_url = "student-grade/update_student_grade";
			} else {
				process_url = "student-grade/add_student_grade";
			}
			for(var e of formData) {
				console.log(e);
			}
			$.ajax({
				url: process_url,
				method: "POST",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: (e)=>{
					let response = JSON.parse(e);
					if(response.status == "success") {
						alert(response.message);
						$('#table').dataTable().fnClearTable();
						$('#table').dataTable().fnDestroy();
						pick_display();
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
	});
	function pick_display() {
		let user_level = $("#user_level").html();
		let user_id = $("#faculty").val();
		if(user_level == 1) {
			displayData();
		} else {
			faculty_display(user_id);
		}
	}
	function faculty_display(user_id) {
		$.ajax({
			url: "student-grade/faculty_students",
			method: "GET",
			data: {faculty_id:user_id},
			success:(e) => {
				let value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, val){
					let updateData = JSON.stringify({
						subject_id: val.subject_id,
						faculty_id: val.faculty_id,
						student_id: val.student_id,
						studentgrade_id: val.studentgrade_id,
						course_id: val.course_id,
						description: val.description,
						schoolyear_id: val.schoolyear_id,
						semester: val.semester,
						schoolYear: val.schoolYear,
						prelim: val.prelim,
						midterm: val.midterm,
						endterm: val.final
					});
					if( val.prelim == undefined || val.midterm == undefined || val.final == undefined || val.finalGrade == undefined || val.remarks == undefined ) {
						val.prelim = " ";
						val.midterm = " ";
						val.final = " ";
						val.finalGrade = " ";
						val.remarks = " ";
					}
					$("#tbody").append(
						`<tr>
							<td>${val.student_fname} ${val.student_mname} ${val.student_lname}</td>
							<td>${val.subjectName}</td>
							<td>${val.fname} ${val.mname} ${val.lname}</td>
							<td>${val.courseName}</td>
							<td>${val.prelim}</td>
							<td>${val.midterm}</td>
							<td>${val.final}</td>
							<td>${val.finalGrade}</td>
							<td>${val.semester}  S.Y  ${val.schoolYear}</td>
							<td>${val.remarks}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick='deletez(${val.studentgrade_id})'><i class="fa fa-remove"></i></button>
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
	function edit(data){
		$("#addModal").modal("show");
		$("#student_grade_id").val(data.studentgrade_id);
		$("#student_id option[value="+data.student_id+"]").attr('selected', 'selected');
		$("#course_desc").val(data.description);
		$("#course_id").val(data.course_id);
		get_faculties();
		window.setTimeout(function(){
			$("#student_grade_faculty_id option[value="+data.faculty_id+"]").attr('selected', 'selected');
			get_subjects();
			window.setTimeout(function(){
				$("#subject_id option[value="+data.subject_id+"]").attr('selected', 'selected');
				$("#school_year_id").val(data.schoolyear_id);
				$("#school_year_sem").val(data.semester+" S.Y. "+data.schoolYear);
			}, 200);
		}, 200);
		$("#prelim_grade").val(data.prelim);
		$("#midterm_grade").val(data.midterm);
		$("#endterm_grade").val(data.endterm);
		
	}

	function deletez(id){
		if(confirm("Are you sure you want to delete it?")) {
			$.ajax({
				method: "GET",
				url: "student-grade/delete_student_grade",
				data: {student_grade_id: id},
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

	function get_students() {
		$.ajax({
			url: "student/get_students",
			url:"student/get_students",
			method:"GET",
			success:(e) => {
				let value = JSON.parse(e);
				$("#student_id").empty();
				$("#student_id").append("<option value=''>Select Student</option");
				$.each(value, function(index, val){
					$("#student_id").append(
						`<option value='${val.student_id}'>${val.student_fname} ${val.student_mname} ${val.student_lname}</option>`
					);
				});
			},
		});
	}

	function get_faculties(){
		let student_id = $("#student_id").val();
		$.ajax({
			url: "student-grade/get_student_faculties_course",
			method: "GET",
			data: {student_id:student_id},
			success: (e)=>{
				
				let value = JSON.parse(e);
				$("#student_grade_faculty_id").empty();
				$("#student_grade_faculty_id").append("<option val=''>Select Faculty</option>");
				$.each(value, function(index, val){
					if(val != undefined){
						if(val.faculty_id != undefined){
							$("#student_grade_faculty_id").append(
								`<option value=${val.faculty_id}>${val.fname} ${val.mname} ${val.lname}</option>`
							);
						}
						$("#course_id").val(val.course_id);
						$("#course_desc").val(val.description);
					} else {
						$("#subject_id").empty();
						$("#subject_id").append("<option val=''>Select Subject</option>");
						$("#school_year_id").val("");
						$("#school_year_sem").val("");
						$("#course_id").val("");
						$("#course_desc").val("");
					}
				});
			}
		});
	}

	function get_subjects(){
		let faculty_id = $("#student_grade_faculty_id").val();
		let student_id = $("#student_id").val();
		$.ajax({
			url: "student-grade/student_subjects",
			method: "GET",
			data:{faculty_id:faculty_id,student_id:student_id},
			success: (e)=>{
				let value = JSON.parse(e);
				if(value == "" || value == " "){
					$("#school_year_id").val("");
					$("#school_year_sem").val("");
				}
				$("#subject_id").empty();
				$("#subject_id").append("<option val=''>Select Subject</option>");				
				$.each(value, function(index, val){
					$("#subject_id").append(
						`<option value=${val.subject_id}>${val.subjectName}</option>`
					);
				});
			}
		});
	}

	function get_school_year(){
		let subject_id = $("#subject_id").val();
		$.ajax({
			url: "student-grade/get_subject",
			method: "GET",
			data:{subject_id:subject_id},
			success: (e) => {
				let value = JSON.parse(e);
				if(value[0] != undefined) {
					$("#school_year_id").val(value[0].schoolyear_id);
					$("#school_year_sem").val(value[0].semester+" S.Y. "+value[0].schoolYear);
				} else {
					$("#school_year_id").val("");
					$("#school_year_sem").val("");
				}
			}
		});
	}

	function displayData() {
		$.ajax({
			url:"student-grade/get_student_grades",
			method:"GET",
			success:(e) => {
				let value = JSON.parse(e);
				$("#tbody").empty();
				$.each(value, function(index, val){
					let updateData = JSON.stringify({
						subject_id: val.subject_id,
						faculty_id: val.faculty_id,
						student_id: val.student_id,
						studentgrade_id: val.studentgrade_id,
						course_id: val.course_id,
						description: val.description,
						schoolyear_id: val.schoolyear_id,
						semester: val.semester,
						schoolYear: val.schoolYear,
						prelim: val.prelim,
						midterm: val.midterm,
						endterm: val.final
					});
					$("#tbody").append(
						`<tr id="studentGrade${val.studentgrade_id}">
							<td>${val.student_fname} ${val.student_mname} ${val.student_lname}</td>
							<td>${val.subjectName}</td>
							<td>${val.fname} ${val.mname} ${val.lname}</td>
							<td>${val.courseName}</td>
							<td contentEditable class='prelim' currentGrade='${val.prelim}' 
								onblur="updateInlineGrade({parentElement:studentGrade${val.studentgrade_id},element:this,id:${val.studentgrade_id},currentGrade:${val.prelim}})">${val.prelim}</td>
							<td contentEditable class='midterm' currentGrade='${val.midterm}' 
								onblur="updateInlineGrade({parentElement:studentGrade${val.studentgrade_id},element:this,id:${val.studentgrade_id},currentGrade:${val.midterm}})">${val.midterm}</td>
							<td contentEditable class='final' currentGrade='${val.final}' 
								onblur="updateInlineGrade({parentElement:studentGrade${val.studentgrade_id},element:this,id:${val.studentgrade_id},currentGrade:${val.final}})">${val.final}</td>
							<td class="finalGrade">${val.finalGrade}</td>
							<td>${val.semester}  S.Y  ${val.schoolYear}</td>
							<td>${val.remarks}</td>
							<td class="text-center">
								<button class="btn btn-success" onclick='edit(${updateData})'>
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="text-center"><button class="btn btn-danger" onclick='deletez(${val.studentgrade_id})'><i class="fa fa-remove"></i></button>
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

	function updateInlineGrade(data) {
		const parentElement = data.parentElement;
		const current 	= data.element.getAttribute('currentGrade');
		if(data.element.innerHTML == current) {
			return false;
		}
		if(data.element.innerHTML/10 || data.element.innerHTML == 0) {//check if user input is a number
			if(data.element.innerHTML>100) {
				alert('Maximum grade is 100');
				data.element.innerHTML = current;
			} else {			
				const prelim 	= parseFloat(parentElement.getElementsByClassName('prelim').item(0).innerHTML * 0.3);
				const midterm 	= parseFloat(parentElement.getElementsByClassName('midterm').item(0).innerHTML * 0.3);
				const final 	= parseFloat(parentElement.getElementsByClassName('final').item(0).innerHTML * 0.4);
				parentElement.getElementsByClassName('finalGrade').item(0).innerHTML = (prelim + midterm + final).toFixed(3);
				data.element.innerHTML = parseFloat(data.element.innerHTML);
				data.element.setAttribute('currentGrade', data.element.innerHTML);
			}
		} else {
			alert('your Input is not a number!');
			data.element.innerHTML = current;
		}
	}
</script>
    
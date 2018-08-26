<?php
require_once 'controller.php';
require_once 'model/studentGradeModel.php';
class StudentGradeController extends Controller {
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new StudentGradeModel();
	}

	public function get_student_faculties_course($data) {
		$response = array();
		$studSub = new StudentSubjectController();
		$student = new StudentController();
		$response_fac = $studSub->get_student_faculties($data);
		$response_stud = $student->get_course($data);

		$response_fac[] = array_shift($response_stud);
		$response = $response_fac;
		
		return $response;
	}

	public function delete_student_grade($data) {
		$response = $this->model->delete_student_grade($data);

		return $response;

	}

	public function faculty_students($data) {
		$response = array();
		$grades = $this->model->student_grades($data);
		$studSub = new StudentSubjectModel();
		$students = $studSub->get_faculty_students($data);

		foreach($students as $key => $value) {
			if(isset($grades[$key])){
				$students[$key] += $grades[$key];
			}
		}
		$response = $students;
		// echo "<pre>";
		// print_r($response);
		// echo "<pre>";
		return $response;
	}

	public function add_student_grade($data) {
		$data['finalGrade'] = $this->calculate_grade($data);
		if($data['finalGrade'] < 75) {
			$data['remarks'] = "FAILED";
		} else {
			$data['remarks'] = "PASSED";
		}
		$response = $this->model->add_student_grade($data);
		return $response;
	}

	public function update_student_grade($data) {
		$data['finalGrade'] = $this->calculate_grade($data);
		$data['remarks'] = $this->get_remarks($data['finalGrade']);
		$response = $this->model->update_student_grade($data);
		return $response;

	}

	public function get_student_grades() {
		$response = $this->model->get_student_grades();
		return $response;
	}

	private function calculate_grade($data) {
		$finalGrade = ($data['prelim'] * .3) + ($data['midterm'] * .3) + ($data['final'] * .4);
		$finalGrade = number_format($finalGrade, 2, '.', '');
		return $finalGrade;
	}

	private function get_remarks($finalGrade) {
		if($finalGrade < 75) {
			return "FAILED";
		} else {
			return "PASSED";
		}
	}

}
?>
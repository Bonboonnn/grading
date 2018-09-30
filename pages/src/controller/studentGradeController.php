<?php
require_once 'controller.php';
require_once 'model/studentGradeModel.php';
require_once 'model/studentModel.php';
require_once 'model/studentSubjectModel.php';

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

	public function save_bulk_data($data) {
		$c=0;
		foreach($data['student_id']  as $index => $val) {
			$test[$index]['student_id'] = $val;
			$test[$index]['faculty_id'] = $data['faculty_id'][$c];
			$test[$index]['course_id'] = $data['course_id'][$c];
			$test[$index]['schoolyear_id'] = $data['schoolyear_id'][$c];
			$test[$index]['subject_id'] = $data['subject_id'][$c];
			$test[$index]['prelim'] = $data['prelim'][$c];
			$test[$index]['midterm'] = $data['midterm'][$c];
			$test[$index]['final'] = $data['final'][$c];
			$test[$index]['finalGrade'] = $data['finalGrade'][$c];
			if($test[$index]['finalGrade'] < 75) {
				$test[$index]['remarks'] = "FAILED";
			} else {
				$test[$index]['remarks'] = "PASSED";
			}
			$response = $this->model->add_student_grade($test[$index]);
			$c++;
		}
		return $response;
	}

	public function get_student_grades() {
		$response = $this->model->get_student_grades();
		return $response;
	}

	public function student_grades_view($data) {
		$response = $this->model->student_grades_view($data);
		return $response;
	}

	public function parse_csv($data) {
		$csv_response = $this->parse_csv_data($data);
		$keys = array();
		$std = new StudentModel();
		foreach($csv_response as $index => $vals) {
			$params_std = array(
				"std_idno" => $vals['IDNO'],
				"course" => $vals['COURSE'],
				"schoolyear" => $vals['SCHOOLYEAR'],
				"subject" => $vals['SUBJECT'],
			);

			$res_1 = $std->check_parsed_data($params_std);
			$res_1['prelim'] = (double)$vals['PRELIM'];
			$res_1['midterm'] = (double)$vals['MIDTERM'];
			$res_1['final'] = (double)$vals['FINAL'];
			$res_1['finalGrade'] = $this->calculate_grade($res_1);
			$csv_response[$index]['values'] = $res_1;
		}

		return $csv_response;
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
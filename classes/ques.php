<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Ques{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function giveAllquestion($data){
			$quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
			$ques = mysqli_real_escape_string($this->db->link, $data['ques']);
			$ans = array();
			$ans[1] = $data['ans1'];
			$ans[2] = $data['ans2'];
			$ans[3] = $data['ans3'];
			$ans[4] = $data['ans4'];
			$rightAns = $data['rightAns'];
			$query = "INSERT INTO tbl_ques(quesNo, ques) VALUES('$quesNo','$ques')";
			$insert_row = $this->db->insert($query);
			if($insert_row){
				foreach($ans as $key => $answer){
					if($answer != ''){
						if($rightAns == $key){
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '1', '$answer')";
						}else {
							$rquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '0', '$answer')";
						}
						$insertrow = $this->db->insert($rquery);
						if($insertrow){
							continue;
						}else{
							die('Error...');
						}
					}
				}
				$msg = "<span class='success'>Question is added successfully..!!</span>";
				return $msg;
			}
		}

		public function getQuestionByOrder(){
			$query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
			$result = $this->db->select($query);
			return $result;
		}
		public function deleteQuestion($quesNo){
			$tables = array("tbl_ques","tbl_ans");
			foreach($tables as $table){
				$delquery = "DELETE FROM $table WHERE quesNo='$quesNo'";
				$result = $this->db->delete($delquery);
			}
			if($result){
				$msg = "<span class='success'>Question deleted successfully..!!</span>";
				return $msg;
			}else{
				$msg = "<span class='success'>Question is not deleted..!!</span>";
				return $msg;
			}
		}
		
		public function totalRow(){
			$tquery = "SELECT * FROM tbl_ques";
			$result = $this->db->select($tquery);
			$totalrow = $result->num_rows;
			return $totalrow;
		}

		public function totalQuestion(){
			$tquery = "SELECT * FROM tbl_ques";
			$result = $this->db->select($tquery);
			$totalques = $result->fetch_assoc();
			return $totalques;
		}

		public function getQuesByNumber($number){
			$query = "SELECT * FROM tbl_ques WHERE quesNo = '$number'";
			$result = $this->db->select($query);
			$totalques = $result->fetch_assoc();
			return $totalques;
		}

		public function getAnswer($number){
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>
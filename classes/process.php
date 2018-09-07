<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Process{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function processData($data){
			$selectAns = $this->fm->validation($data['ans']);
			$number    = $this->fm->validation($data['number']);
			$selectAns = mysqli_real_escape_string($this->db->link, $selectAns);
			$number    = mysqli_real_escape_string($this->db->link, $number);
			$next 	   = $number+1;

			if(!isset($_SESSION['score'])){
				$_SESSION['score'] = '0';
			}
			$total = $this->getTotal();
			$right = $this->rightAns($number);

			if($right == $selectAns){
				$_SESSION['score']++;
			}

			if($total == $number){
				header("Location:final.php");
			}else{
				header("Location:test.php?q=".$next);
			}

		}

		public function getTotal(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this->db->select($query);
			$totalrow = $result->num_rows;
			return $totalrow;
		}

		public function rightAns($number){
			$query   = "SELECT * FROM tbl_ans WHERE quesNo='$number' AND rightAns='1'";
			$getData = $this->db->select($query)->fetch_assoc();
			$result  = $getData['id'];
			return $result;
		}
	}
?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Admin{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAdminData($data){
			$username = $this->fm->validation($data['adminUser']);
			$userpass = $this->fm->validation($data['adminPass']);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$userpass = mysqli_real_escape_string($this->db->link, md5($userpass));
			
			$query = "SELECT * FROM tbl_admin WHERE adminUser='$username' AND adminPass='$userpass'";
			$result = $this->db->select($query);
			if($result !=false){
				$value = $result->fetch_assoc();
				Session::init();
				Session::set("adminLogin", true);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminId", $value['adminId']);
				header("Location:index.php");
			} else{
				$msg = "<span class='error'>Username and Password is not matched..!!</span>";
				return $msg;
			}
		}
	}
?>
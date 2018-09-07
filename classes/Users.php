<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class User{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function userRegistration($name, $username, $userpass, $email){
			$name 	  = $this->fm->validation($name);
			$username = $this->fm->validation($username);
			$userpass = $this->fm->validation($userpass);
			$email 	  = $this->fm->validation($email);

			$name 	  = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			
			$email 	  = mysqli_real_escape_string($this->db->link, $email);

			if($name == "" || $username == "" || $userpass == "" || $email == "") {
				echo "<span class='error'>Field must not be empty !</span>";
				exit();
			}else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				echo "<span class='error'>This email is invalid !</span>";
				exit();
			}else{
				$checkQuery = "SELECT * FROM tbl_user WHERE email='$email'";
				$checkResult = $this->db->select($checkQuery);
				if($checkResult !=false){
					echo "<span class='error'>Email is already exist !</span>";
					exit();
				}else{
					$userpass = mysqli_real_escape_string($this->db->link, md5($userpass));
					$insertQuery = "INSERT INTO tbl_user(name,username,userpass,email) VALUES('$name','$username','$userpass','$email')";
					$insert_row = $this->db->insert($insertQuery);
					if($insert_row){
						echo "<span class='error'>Successfully you have resistared !</span>";
						exit();
					}else{
						echo "<span class='error'>There was an error !</span>";
						exit();
					}
				}
			}
		}

		public function userLogin($email, $userpass){
			$email 	  = $this->fm->validation($email);
			$userpass = $this->fm->validation($userpass);

			$email 	  = mysqli_real_escape_string($this->db->link, $email);
			

			if($email == "" && $userpass == ""){
				echo "empty";
				exit();
			}else{
				$userpass = mysqli_real_escape_string($this->db->link, md5($userpass));
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND userpass='$userpass'";
				$result = $this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					if($value['status']=='1'){
						echo "disable";
						exit();
					}else{
						Session::init();
						Session::set("login", true);
						Session::set("userid", $value['userid']);
						Session::set("username", $value['username']);
						Session::set("name", $value['name']);
					}
				}else{
					echo "error";
					exit();
				}
			}
		}

		public function getAllusers(){
			$query = "SELECT * FROM tbl_user ORDER BY userid DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function disableUser($userid){
			$query = "UPDATE tbl_user
						SET
						status = '1'
						WHERE userid = '$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row){
				$msg = "<span class='success'>User is disabled..!</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User is not disabled..!</span>";
				return $msg;
			}
		}
		public function enableUser($userid){
			$query = "UPDATE tbl_user
						SET
						status = '0'
						WHERE userid = '$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row){
				$msg = "<span class='success'>User is enabled..!</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User is not enabled..!</span>";
				return $msg;
			}
		}

		public function deleteUser($userid){
			$query = "DELETE FROM tbl_user WHERE userid='$userid'";
			$delete_row = $this->db->delete($query);
			if($delete_row){
				$msg = "<span class='success'>User is removed..!</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Sorry..! Something is went wrong</span>";
				return $msg;
			}
		}

		public function getUserData($userId){
			$query = "SELECT * FROM tbl_user WHERE userid='$userId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateUserData($userId, $data){
			$name 	  = $this->fm->validation($data['name']);
			$username = $this->fm->validation($data['username']);
			$email 	  = $this->fm->validation($data['email']);

			$name 	  = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email 	  = mysqli_real_escape_string($this->db->link, $email);

			$query = "UPDATE tbl_user
						SET
						name = '$name',
						username = '$username',
						email = '$email'
						WHERE userid = '$userId'";
			$updated_row = $this->db->update($query);
			if($updated_row){
				$msg = "<span class='success'>Your profile is updated !</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Your profile is not updated !</span>";
				return $msg;
			}
		}
	}
?>
<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
	$userId = Session::get("userid");
?>
<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$updateUser = $usr->updateUserData($userId, $_POST);
	}
?>
<style>
.profile{margin:0 auto;border:1px solid #ddd;padding:30px 50px 50px 138px;width:440px;}
</style>
<div class="main">
<h1>Online Exam System - Your Profile</h1>
<div class="profile">
	<?php 
		$getUser = $usr->getUserData($userId);
			if($getUser){
				$value = $getUser->fetch_assoc();
	?>
	<form action="" method="post">
		<?php 
			if(isset($updateUser)){
				echo $updateUser;
			}
		?>
		<table class="tbl">    
			 <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" value="<?php echo $value['name']; ?>" /></td>
			 </tr>
			 <tr>
			   <td>Username </td>
			   <td><input name="username" type="text" value="<?php echo $value['username']; ?>" /></td>
			 </tr>
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" value="<?php echo $value['email']; ?>" /></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" name="submit" value="Update">
			   </td>
			 </tr>
       </table>
	   </form>
	   <?php } ?>
	</div>
</div>

<?php include 'inc/footer.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Users.php');
	$usr = new User();
?>

<?php
	if(isset($_GET['dis'])){
		$dslid = (int)$_GET['dis'];
		$dslUser = $usr->disableUser($dslid);
	}
	if(isset($_GET['ena'])){
		$enlid = (int)$_GET['ena'];
		$enlUser = $usr->enableUser($enlid);
	}
	if(isset($_GET['del'])){
		$delid = (int)$_GET['del'];
		$delUser = $usr->deleteUser($delid);
	}
?>
<div class="main">
	<h2>Control all users..</h2>
	<?php 
		if(isset($dslUser)){
			echo $dslUser;
		}
		if(isset($enlUser)){
			echo $enlUser;
		}
		if(isset($delUser)){
			echo $delUser;
		}
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
	<?php 
		$userData = $usr->getAllusers();
		if($userData){
			$i=0;
			while($result = $userData->fetch_assoc()){
				$i++;
	?>
		<tr>
			<td>
			<?php 
				if($result['status'] == '1'){
					echo "<span class='error'>".$i."</span>";
				} else{
					echo $i;
				}
			?>
			</td>
			<td>
			<?php 
				if($result['status'] == '1'){
					echo "<span class='error'>".$result['name']."</span>";
				} else{
					echo $result['name'];
				}
			?>
			</td>
			<td><?php echo $result['username']; ?></td>
			<td><?php echo $result['email']; ?></td>
			<td>
				<?php 
					if($result['status'] == '0') { ?>
						<a onclick="return confirm('Are you sure to disable ?')" href="?dis=<?php echo $result['userid']; ?>">Disable</a>
				<?php } else { ?>
					<a onclick="return confirm('Are you sure to enable ?')" href="?ena=<?php echo $result['userid']; ?>">Enable</a>
				<?php } ?>  			
				 || <a onclick="return confirm('Are you sure to delete ?')" href="?del=<?php echo $result['userid']; ?>">Remove</a>
			</td>
		</tr>
	<?php } } ?>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
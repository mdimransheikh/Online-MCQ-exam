<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/ques.php');
	$ques = new Ques();
?>
<?php 
	$total = $ques->totalRow();
	$next = $total+1;
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$AaddQues = $ques->giveAllquestion($_POST);
	}
?>

<style>
	.adminpanel{width:480px; color:#999; margin:20px auto 0; padding:50px; border:1px solid #ddd;}
</style>
<div class="main">
<h1>Admin Panel - Add Question</h1>
		<?php 
			if(isset($AaddQues)){
				echo $AaddQues;
			}
		?>
	<div class="adminpanel">
		<form action="" method="post"> 
			<table>
				<tr>
					<th>Question No.</th>
					<th>:</th>
					<th><input type="number" 
						value="<?php if(isset($next)){
										echo $next;
									}
								?>" 
						name="quesNo"/>
					</th>
				</tr>
				<tr>
					<th>Question</th>
					<th>:</th>
					<th><input type="text" name="ques" placeholder="Enter the question" required /></th>
				</tr>
				<tr>
					<th>Choice one</th>
					<th>:</th>
					<th><input type="text"  name="ans1" placeholder="Enter choice one" required /></th>
				</tr>
				<tr>
					<th>Choice two</th>
					<th>:</th>
					<th><input type="text"  name="ans2" placeholder="Enter choice two" required /></th>
				</tr>
				<tr>
					<th>Choice three</th>
					<th>:</th>
					<th><input type="text"  name="ans3" placeholder="Enter choice three" required /></th>
				</tr>
				<tr>
					<th>Choice four</th>
					<th>:</th>
					<th><input type="text"  name="ans4" placeholder="Enter choice four" required /></th>
				</tr>
				<tr>
					<th>Currect No.</th>
					<th>:</th>
					<th><input type="number"  name="rightAns" required /></th>
				</tr>
				<tr>
					<th colspan='3' align='center'>
						<input type="submit" value="Add a question"/>
					</th>
				</tr>
			</table>
		</form>
	</div>

</div>
<?php include 'inc/footer.php'; ?>
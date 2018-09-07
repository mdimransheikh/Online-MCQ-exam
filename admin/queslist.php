<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/ques.php');
	$ques = new Ques();
?>
<?php 
	if(isset($_GET['delques'])){
		$quesId = $_GET['delques'];
		$deleteQues = $ques->deleteQuestion($quesId);
	}
?>
<div class="main">
	<h2>Admin panel - Question list</h2>
	<?php 
		if(isset($deleteQues)){
			echo $deleteQues;
		}
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th width="10%">No.</th>
				<th width="70%">Name</th>
				<th width="20%">Action</th>
			</tr>
	<?php
		$Question = $ques->getQuestionByOrder();
		if($Question){
			$i=0;
			while($result = $Question->fetch_assoc()){
				$i++;
	?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $result['ques']; ?></td>
			<td>
				<a onclick="return confirm('Are you sure to delete ?')" href="?delques=<?php echo $result['quesNo']; ?>">Remove</a>
			</td>
		</tr>
	<?php } } ?>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
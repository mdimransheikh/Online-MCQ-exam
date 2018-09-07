<?php include 'inc/header.php'; ?>

<?php 
	Session::checkSession();
	$total = $exm->totalRow();
?>

<div class="main">
<h1>All questions & total answer <?php echo $total; ?></h1>
	<div class="test">		
		<table> 
			<?php 
				$ques = $exm->getQuestionByOrder();
				if($ques){
					while($question = $ques->fetch_assoc()){

			?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['quesNo'];?>: <?php echo $question['ques'];?></h3>
				</td>
			</tr>
			<?php
				$number = $question['quesNo'];
				$answer = $exm->getAnswer($number);
				if($answer){
					while($value = $answer->fetch_assoc()){
			?>
			<tr>
				<td>
				 <input type="radio" />
					 <?php 
					 	if($value['rightAns'] == '1'){
					 		echo "<span style='color:blue'>".$value['ans']."</span>"; 
					 	}else{
					 		echo $value['ans'];
					 	} 
					 ?>
				</td>
			</tr>
			<?php } } ?>

		<?php }} ?>	
		</table>
</div>
 </div>
<?php include 'inc/footer.php'; ?>
<?php include 'inc/header.php'; ?>
<?php 
    Session::checkSession();
?>

<?php 
    $question = $exm->totalQuestion();
    $total = $exm->totalRow();
?>

<style>
.starttest {
  border: 1px solid #f4f4f4;
  margin:0px auto;
  padding:20px;
  width:590px;
}
.starttest h2 {
  border bottom:1px solid #ddd;
  font-size:20px;
  margin-bottom:10px;
  padding-bottom:10px;
  text-align:center;
}
.starttest ul {margin:0px; padding:0px; list-style:none;}
.starttest ul li {margin-top:5px;}
.starttest a {
  background: #f4f4f4 none repeat scroll 0 0;
  border:1px solid #ddd;
  display: block;
  color: #444;
  margin-top: 10px;
  padding: 6px 10px;
  text-align: center;
  text-decoration: none;
}

</style>

<div class="main">
	<h1>Welcome to online exam</h1>
	<div class="starttest">
		<h2>Test your knowledge</h2>
		<p>This is multiple choice quiz to test your knowledge</p>
		<ul>
			<li><strong>Number of questions: </strong><?php echo $total; ?></li>
			<li><strong>Question type: </strong>Multiple choice</li>
		</ul>
		<a href="test.php?q=<?php echo $question['quesNo']; ?>">Start test</a>
	</div>	
</div>
<?php include 'inc/footer.php'; ?>
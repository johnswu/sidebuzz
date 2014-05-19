<?php

?>
<html>
	<head>
		<title>Side Buzz Presentation - Entrepreneur Survey</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<style type="text/css">
			body {
				font-family:Verdana;
			}
		</style>
	</head>
	<body>
		<div style="width:65%;margin:0 auto;">
			<h1>How many startup companies have you been a part of?</h1>
			<form action="EntrepreneurSurvey.php" method="POST">
				<ul style="list-style-type:none;">
					<li><input type="radio">0-2</li>
					<li><input type="radio">3-5</li>
					<li><input type="radio">6-9</li>
					<li><input type="radio">10 or more</li>
				</ul>
				<br><br><br><br>
				<div style="width:100%;text-align:center;">
					<input type="submit" name="Submit" value="Submit" style="margin:0 auto;width:150px;height:40px;">
				</div>
			</form>
		</div>
	</body>
</html>
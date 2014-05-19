<?php
const DB_SERVER = "mysql.side.buzz";
const DB_USER = "sidebuzz_dbuser";
const DB_PASSWORD = "S1d3Buzz";
const DB = "sidebuzzdb";

$EventID = null;
	
$db = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_select_db(DB,$db);

$sql = mysql_query("SELECT ep.* FROM Event e INNER JOIN EventPush ep ON e.EventID = ep.EventID WHERE e.EventID = 1", $db);
	
?>
<html>
	<head>
		<title>SideBuzz Admin Panel - Seattle Startup Weekend</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="/js/sidebuzz.js"></script>
	</head>
	<body>
		<h1>Select the content to broadcast to your attendees</h1>
		<ul id="broadcastControlLinks">
<?php
if(mysql_num_rows($sql) > 0)
{
	while($rlt = mysql_fetch_array($sql,MYSQL_ASSOC))
	{
		$EventID = $rlt['EventID'];
?>
			<li>
				<input type="radio" name="broadcastSelection" value="<?php echo $rlt['EventPushID']; ?>"> <?php echo $rlt['EventPushName']; ?>
			</li>
<?php
	}
}

mysql_close($db);
?>
		</ul>
		<script type="text/javascript">
			var restAPI = "";
			$("ul#broadcastControlLinks > li > input").click(
				function(){
					restAPI = "http://side.buzz/api.php?action=set_current_push&eventpushid=" + $(this).val() + "&eventid=<?php echo $EventID; ?>";
					$.post(restAPI);			
				});
		</script>
	</body>
</html>
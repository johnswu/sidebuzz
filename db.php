<?php
$mysql_hostname = "mysql.side.buzz";
$mysql_user = "sidebuzz_dbuser";
$mysql_password = "S1d3Buzz";
$mysql_database = "sidebuzzdb";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
$base_url='http://side.buzz/';
?>
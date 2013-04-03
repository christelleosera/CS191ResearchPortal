<?php

$db_host = "localhost";
$db_username = "root";
$db_pass = "root";
$db_name = "dcsportal";

$con = mysql_connect ("$db_host", "$db_username", "$db_pass") or die ("Unable to connect to MySQL");	
mysql_select_db ("$db_name", $con) or die ("Database was not found");

?>
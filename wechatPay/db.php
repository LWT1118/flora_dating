<?php
$db_host = '';	//数据库主机
$db_name = '';	//数据账名
$db_user = '';	//数据库账号
$db_pass = '';	//数据库密码
$conn=mysql_connect($db_host,$db_user,$db_pass) or die("connect fail");
mysql_select_db($db_name,$conn)or die("no data resource");		
mysql_query("set character_set_connection=utf8");
mysql_query("set character_set_client=utf8");  
mysql_query("set character_set_results=utf8"); 
?>
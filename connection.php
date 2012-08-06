<?php
require_once("setup.connection.php");
require_once("ezsql/shared/ez_sql_core.php");
require_once("ezsql/mysql/ez_sql_mysql.php");

$con = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME,DB_HOST);
?>
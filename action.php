<?php
require_once("connection.php");

$description = mysql_escape_string($_REQUEST['description']);
$action = $_REQUEST['action'];
$id = (int)$_REQUEST['id'];

if($action == 'insert'){
	$sql = "INSERT INTO list (description) VALUES ('$description')";
	$msg = 'Inserted';
}
else if($action == 'update') {
	$sql = "UPDATE list SET description='$description' WHERE id=$id";
	$msg = 'Updated';
}

if ($con->query($sql)) {
	header("Location: list.php?order=id&by=asc&msg=$msg!");
}
else {
	header("Location: form.php?action=$action&msg=$msg fail!");
}
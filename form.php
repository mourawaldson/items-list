<?php
require_once("connection.php");

$action = $_REQUEST['action'];
$id = (int)$_REQUEST['id'];

if ($id) {
	$sql = "SELECT * FROM list WHERE id = " . $id;
	$rs = $con->get_row($sql);

	$description = $rs->description;
}

require_once("header.php");
?>
<body>
	<table align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<form id="frm" action="action.php" method="post">
					<label>Description</label>
					<input type="text" name="description" value="<?php echo $description; ?>" />
					<input class="btn" type="submit" value="<?php echo $action; ?>" />
					<input type="hidden" name="action" value="<?php echo $action; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
				</form>
				<br />
				<a href="list.php?order=id&amp;by=asc">Back to list</a>
			</td>
		</tr>
	</table>
</body>
</html>
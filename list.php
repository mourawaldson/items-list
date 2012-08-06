<?php
require_once("connection.php");

$order = mysql_escape_string($_REQUEST['order']);
$by = mysql_escape_string($_REQUEST['by']);
$msg = $_REQUEST['msg'];
$search = mysql_escape_string($_REQUEST['search']);

if (empty($order)) {
	$order = 'id';
}

if (empty($by)) {
	$by = 'ASC';
}

$sql_search = "";

if (!is_null($search)) {
	$sql_search = "WHERE description LIKE '%$search%'";
}

$sql = "SELECT id, description FROM list $sql_search ORDER BY $order $by";

$rs = $con->get_results($sql);

if (is_null($rs)) {
	$msg = 'No results!';
}

require_once("header.php");
?>
<body>
	<div id="header-options">
		<a href="form.php?action=insert">New item</a> - 
		<a href="list.php?order=id&amp;by=asc">List</a> - 
		<a href="javascript:window.print();"><img alt="" src="imgs/print.gif" /></a>
		<form action="list.php?order=id&amp;by=asc" method="post">
			<input type="text" name="search" value="<?php echo $search; ?>" />
			<input type="submit" class="btn" value="search" />
		</form>
		<br />
	</div>
	<h3>List - <?php echo date('d/m/Y'); ?></h3>
	<br />
	<table align="center" cellpadding="0" cellspacing="0" class="list">
		<tr id="itens">
			<td class="id"><a href="list.php?<?php if ($search != null) { echo 'search='.$search.'&amp;'; } ?>order=id&amp;by=<?php if($order == 'id' && $by=='asc'){echo 'desc';}else{echo 'asc';} ?>">Id</a></td>
			<td class="desc"><a href="list.php?<?php if ($search != null) { echo 'search='.$search.'&amp;'; } ?>order=description&amp;by=<?php if($order == 'description' && $by=='asc'){echo 'desc';}else{echo 'asc';} ?>">Description</a></td>
			<td class="options">Options</td>
		</tr>
<?php
if (!empty($rs)) {
	foreach($rs as $rs) {
?>
		<tr>
			<td class="id none">
<?php
		if ($rs->id) {
			echo str_pad($rs->id, 3, '0', STR_PAD_LEFT);
		}
		else {
			echo '&nbsp;';
		}
?>
			</td>
			<td class="desc none">
<?php
		if (!empty($rs->description)) {
			$description = trim($rs->description);
			$pattern_link = '@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@';
			$description = preg_replace($pattern_link, '<a href="$1" target="_blank">$1</a>', $description);
			echo $description;
		}
		else {
			echo '&nbsp;';
		}
?>
			<td class="options none"><a href="form.php?action=update&amp;id=<?php echo $rs->id;?>"><img alt="" src="imgs/update.gif" /></a></td>
		</tr>
<?php
	}
}

if ($msg != null) {
?>
		<tr>
			<td colspan="3" class="msg"><?php echo $msg; ?></td>
		</tr>
<?php
}
?>
	</table>
</body>
</html>
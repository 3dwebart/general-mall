<?php
include_once('./_common.php');

$type  = $_POST['type'];
$act   = $_POST['act'];
$id    = $_POST['id'];
$table = $g5['g5_shop_'.$type.'_table'];
$sql = "SELECT count(it_id) AS cnt FROM {$table}";
$row = sql_fetch($sql);
$cnt = $row['cnt'];
/*
if($act == 'del') {
	$sql = "DELETE FROM {$table} WHERE it_id = '{$id}'";
	sql_query($sql);
}
*/
$match = array(
	'itemType'  => $type,
	'act'       => $act,
	'id'        => $id,
	'table'     => $table,
	'cnt'       => $cnt
);
echo json_encode($match,JSON_UNESCAPED_UNICODE);
?>
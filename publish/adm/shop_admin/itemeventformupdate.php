<?php
$sub_menu = '500300';
include_once('./_common.php');

if ($w == "u" || $w == "d")
	check_demo();

if ($w == 'd')
	auth_check($auth[$sub_menu], "d");
else
	auth_check($auth[$sub_menu], "w");

check_admin_token();

@mkdir(G5_DATA_PATH."/event", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/event", G5_DIR_PERMISSION);

if ($ev_mimg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_m");
if ($ev_himg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_h");
if ($ev_timg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_t");

$ev_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_skin);
$ev_mobile_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_mobile_skin);

$skin_regex_patten = "^list.[0-9]+\.skin\.php";

$ev_skin = (preg_match("/$skin_regex_patten/", $ev_skin) && file_exists(G5_SHOP_SKIN_PATH.'/'.$ev_skin)) ? $ev_skin : ''; 
$ev_mobile_skin = (preg_match("/$skin_regex_patten/", $ev_mobile_skin) && file_exists(G5_MSHOP_SKIN_PATH.'/'.$ev_mobile_skin)) ? $ev_mobile_skin : '';
$ev_subject = strip_tags($ev_subject);
$ev_kind = $_POST['ev_kind'];
$co_id   = $_POST['co_id'];

$sql_common = " SET ev_kind             = '$ev_kind',
					co_id               = '$co_id',
					ev_skin             = '$ev_skin',
					ev_mobile_skin      = '$ev_mobile_skin',
					ev_img_width        = '$ev_img_width',
					ev_img_height       = '$ev_img_height',
					ev_list_mod         = '$ev_list_mod',
					ev_list_row         = '$ev_list_row',
					ev_mobile_img_width = '$ev_mobile_img_width',
					ev_mobile_img_height= '$ev_mobile_img_height',
					ev_mobile_list_mod  = '$ev_mobile_list_mod',
					ev_mobile_list_row  = '$ev_mobile_list_row',
					ev_subject          = '$ev_subject',
					ev_head_html        = '$ev_head_html',
					ev_tail_html        = '$ev_tail_html',
					ev_use              = '$ev_use',
					ev_subject_strong   = '$ev_subject_strong'
					";

if ($w == "") {
	$ev_id = G5_SERVER_TIME;

	$sql = " INSERT {$g5['g5_shop_event_table']}
					$sql_common
				  , ev_id = '$ev_id' ";
	sql_query($sql);
} else if ($w == "u") {
	$sql = " UPDATE {$g5['g5_shop_event_table']}
				$sql_common
			  WHERE ev_id = '$ev_id' ";
	sql_query($sql);
} else if ($w == "d") {
	@unlink(G5_DATA_PATH."/event/{$ev_id}_m");
	@unlink(G5_DATA_PATH."/event/{$ev_id}_h");
	@unlink(G5_DATA_PATH."/event/{$ev_id}_t");

	// 이벤트상품삭제
	$sql = " DELETE FROM {$g5['g5_shop_event_item_table']} WHERE ev_id = '$ev_id' ";
	sql_query($sql);

	$sql = " DELETE FROM {$g5['g5_shop_event_table']} WHERE ev_id = '$ev_id' ";
	sql_query($sql);
}
if($ev_kind == 1) {
	if ($co_id == '') {
		$co_kind_use = 0;
	} else {
		$co_kind_use = 1;
	}
	$co_sql = "UPDATE {$g5['content_table']} SET ev_id = '$ev_id', co_kind = '$co_kind_use' WHERE co_id = '$co_id'";
	sql_query($co_sql);
} else {
	$co_sql = "UPDATE {$g5['content_table']} SET ev_id = '', co_kind = 0 WHERE ev_id = '$ev_id'";
	sql_query($co_sql);
}

if ($w == "" || $w == "u") {
	if ($_FILES['ev_mimg']['name']) upload_file($_FILES['ev_mimg']['tmp_name'], $ev_id."_m", G5_DATA_PATH."/event");
	if ($_FILES['ev_himg']['name']) upload_file($_FILES['ev_himg']['tmp_name'], $ev_id."_h", G5_DATA_PATH."/event");
	if ($_FILES['ev_timg']['name']) upload_file($_FILES['ev_timg']['tmp_name'], $ev_id."_t", G5_DATA_PATH."/event");

	// 등록된 이벤트 상품 먼저 삭제
	$sql = " DELETE FROM {$g5['g5_shop_event_item_table']} WHERE ev_id = '$ev_id' ";
	sql_query($sql);

	// 이벤트 상품등록
	$item = explode(',', $ev_item);
	$count = count($item);

	for($i=0; $i<$count; $i++) {
		$it_id = $item[$i];
		if($it_id) {
			$sql = " INSERT INTO {$g5['g5_shop_event_item_table']}
						SET ev_id = '$ev_id',
							it_id = '$it_id' ";
			sql_query($sql);
		}
	}

	goto_url("./itemeventform.php?w=u&amp;ev_id=$ev_id");
} else {
	goto_url("./itemevent.php");
}
?>

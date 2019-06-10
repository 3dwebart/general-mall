<?php
include_once("./_common.php");

$bn_id = (int) $bn_id;

$sql = " SELECT bn_id, bn_url FROM {$g5['g5_shop_banner_table']} WHERE bn_id = '$bn_id' ";
$row = sql_fetch($sql);

if( ! $row['bn_id'] ){
    alert('해당 배너가 존재하지 않습니다.', G5_SHOP_URL);
}

if ($_COOKIE['ck_bn_id'] != $bn_id)
{
    $sql = " UPDATE {$g5['g5_shop_banner_table']} SET bn_hit = bn_hit + 1 WHERE bn_id = '$bn_id' ";
    sql_query($sql);
    // 하루 동안
    set_cookie("ck_bn_id", $bn_id, 60*60*24);
}

$url = clean_xss_tags($row['bn_url']);

goto_url($url);
?>

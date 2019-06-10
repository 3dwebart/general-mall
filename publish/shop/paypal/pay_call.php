<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
include_once(G5_SHOP_PATH.'/settle_paypal.inc.php');

$od_id = $_POST['pl_item_number'];

$sql = " select * from {$g5['g5_shop_order_data_table']} where od_id = '$od_id' order by dt_time desc limit 1 ";
$row = sql_fetch($sql);

$od = unserialize(base64_decode($row['dt_data']));

$pl_amount = $od['pl_amount'];

if ($pp_exrate) { // 자동으로 환율변환 할 경우.
    $pl_amount = round($pl_amount / wz_exrate_krw(), 2);
}

$sql = " update {$g5['g5_shop_order_data_table']} set dt_paypal_price = '$pl_amount' where od_id = '$od_id' ";
sql_query($sql);

$uid = md5($od_id.$row['dt_time'].$REMOTE_ADDR);

set_session('ss_orderview_uid', $uid);
?>

<script type="text/javascript">
<!--
    // 결제 중 새로고침 방지 샘플 스크립트 (중복결제 방지)
    function noRefresh()
    {
        /* CTRL + N키 막음. */
        if ((event.keyCode == 78) && (event.ctrlKey == true))
        {
            event.keyCode = 0;
            return false;
        }
        /* F5 번키 막음. */
        if(event.keyCode == 116)
        {
            event.keyCode = 0;
            return false;
        }
    }
    document.onkeydown = noRefresh ;

    window.onload = function() {
        var fm = document.paypalfrm;
            fm.submit();
    }

//-->
</script>

<div style="text-align:center;margin-top:100px;">
    <div><img src="<?php echo G5_SHOP_URL;?>/paypal/img/loading.gif" border=0 /></div>
    <div style="margin:10px 0 0;">
        &copy; <?php echo $default['de_admin_company_name'];?>
    </div>
    <div style="margin:10px 0 0;">
        Wait Please.....
    </div>
</div>

<form name="paypalfrm" id="paypalfrm" action="<?php echo $pp_conf_action_url;?>" method="post" accept-charset="utf-8">
    <input type="hidden" name="cmd"             value="_xclick">
    <input type="hidden" name="business"        value="<?php echo $pp_conf_mid;?>">
    <input type="hidden" name="currency_code"   value="<?php echo $pp_currency_code;?>">
    <input type="hidden" name="item_name"       value="<?php echo $od['pl_item_name'];?>">
    <input type="hidden" name="item_number"     value="<?php echo $od_id;?>">
    <input type="hidden" name="amount"          value="<?php echo $pl_amount;?>">
    <input type="hidden" name="return"          value="<?php echo G5_SHOP_URL.'/paypal/pay_result.php';?>"> <!-- 결과완료후 되돌아오는 URL (http 포함 전체경로) -->
    <input type="hidden" name="notify_url"      value="<?php echo G5_SHOP_URL.'/paypal/pay_hub.php';?>"> <!-- 결과정보 실행 파일 URL (http 포함 전체경로). -->
    <input type="hidden" name="cancel_return"   value="<?php echo G5_SHOP_URL.'/paypal/pay_cancel.php';?>"> <!-- 결제취소시 보여줄 URL (http 포함 전체경로). -->
    <input type="hidden" name="country"         value="<?php echo $pp_country;?>">
    <input type="hidden" name="zip"             value="">
    <input type="hidden" name="state"           value="">
    <input type="hidden" name="city"            value="">
    <input type="hidden" name="address1"        value="">
    <input type="hidden" name="email"           value="<?php echo $od['od_email'];?>">
	<input type="hidden" name="first_name"      value="">
	<input type="hidden" name="last_name"       value="">
    <input type="hidden" name="charset"         value="UTF-8" />
    <input type="hidden" name="no_shipping"     value="1">
    <input type="hidden" name="no_note"         value="1">
</form>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
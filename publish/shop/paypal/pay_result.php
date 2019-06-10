<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');

$od_id  = get_session('ss_order_id');
$uid    = get_session('ss_orderview_uid');
set_session('ss_order_id', '');

$staytime = 4000;
if ($default['de_paypal_test']) { // 테스트
    $staytime = 10000;
}
?>

    <script type="text/javascript">
    <!--
    window.onload = function (){
        gopage();
    }
    function gopage() {
        setTimeout(function(){ 
            <?php if (!is_mobile()) { // 피씨화면 일경우?>
            opener.location.replace("<?php echo G5_SHOP_URL?>/orderinquiryview.php?od_id=<?php echo $od_id?>&uid=<?php echo $uid?>"); 
            this.close(); 
            <?php } else { // 모바일화면 일경우?>
            location.replace("<?php echo G5_SHOP_URL?>/orderinquiryview.php?od_id=<?php echo $od_id?>&uid=<?php echo $uid?>");
            <?php } ?>
        }, 
        <?php echo $staytime?>);
    }
    //-->
    </script>

    <div style="text-align:center;margin-top:100px;">
        <div><img src="./img/loading.gif" border=0 /></div>
        <div style="margin:10px 0 0;">
            &copy; <?php echo $default['de_admin_company_name'];?>
        </div>
        <div style="margin:10px 0 0;">
            Wait Please.....
        </div>
    </div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
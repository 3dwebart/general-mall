<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');

$sw_direct  = get_session('ss_direct');
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
        <?php if (!is_mobile()) { // 피씨화면 일경우?>
        $(opener.document).find("#display_pay_button").show();
        $(opener.document).find("#display_pay_process").hide();
        this.close(); 
        <?php } else { // 모바일화면 일경우?>
        location.replace("<?php echo G5_SHOP_URL?>/orderform.php?sw_direct=<?php echo $sw_direct?>");
        <?php } ?>
    }

//-->
</script>

<div style="text-align:center;margin-top:100px;">
    <div><img src="<?php echo G5_SHOP_URL;?>/paypal/img/loading.gif" border=0 /></div>
    <div style="margin:10px 0 0;">
        &copy; <?php echo $default['de_admin_company_name'];?>
    </div>
    <div style="margin:10px 0 0;">
        취소되었습니다.....
    </div>
</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>
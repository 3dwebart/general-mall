<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<style type="text/css">
.dimm{position:absolute;left:0;top:0;z-index:99999999;background-color:#000;display:none;opacity: 0.4;}
</style>

<input type="hidden" name="pl_item_number"  value="<?php echo $od_id; ?>">
<input type="hidden" name="pl_item_name"    value="<?php echo $goods; ?>">
<input type="hidden" name="pl_amount"       value="<?php echo $tot_price; ?>">

<input type="hidden" name="wz_cart_id"      value="<?php echo $s_cart_id;?>">
<input type="hidden" name="wz_mb_id"        value="<?php echo $member['mb_id'];?>">
<input type="hidden" name="wz_user_ip"      value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
<input type="hidden" name="wz_is_mobile"    value="<?php echo is_mobile();?>">

<script type="text/javascript">
<!--
$(function(){
    $('body').append('<div class="dimm"></div>');
});
function paywinClosed(){
    $(top.document).find('.dimm').hide();
    $(top.document).find('html').css('overflow-y','auto');
    $("#display_pay_button").show();
    $("#display_pay_process").hide();
}
//-->
</script>
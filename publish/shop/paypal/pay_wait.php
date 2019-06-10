<?php
include_once('./_common.php');
include_once('../_head.php');

$uid        = get_session('ss_orderview_uid');
$od_id      = get_session('ss_order_id');
$sw_direct  = get_session('ss_direct');
?>

    <style>
        .btn {display: inline-block;padding: 0 5px;border: 1px solid #d0d0d0;border-radius: 1px;background: #fbfbfb;font-family: '돋움',Dotum,Verdana,applegothic;line-height: 1.5;font-size: 11px;letter-spacing: -1px;cursor: pointer;color: #333;line-height: 21px;height: 21px;text-align: center;vertical-align: middle;-webkit-box-shadow: inset 1px 1px #fff,inset -1px -1px #f7f7f7,0 1px rgba(0,0,0,0.03);}
    </style>

    <div style="text-align:center;margin-top:100px;">
        <div><img src="./img/loading.gif" border=0 /></div>
        <div style="margin:10px 0 0;">
            &copy; <?php echo $default['de_admin_company_name'];?>
        </div>
        <div style="margin:10px 0 0;">
            결제가 완료되었을 경우 <input type="button" class="btn" value="다음으로" onclick="location.href='<?php echo G5_SHOP_URL?>/orderinquiryview.php?od_id=<?php echo $od_id?>&uid=<?php echo $uid?>';" /> 를 클릭해주세요.
        </div>
        <div style="margin:10px 0 0;">
            결제가 완료되지 않았을 경우 <input type="button" class="btn" value="이전으로" onclick="location.href='<?php echo G5_SHOP_URL?>/orderform.php?sw_direct=<?php echo $sw_direct?>';" /> 를 클릭해주세요.
        </div>
    </div>
    

<?php
include_once('../_tail.php');
?>
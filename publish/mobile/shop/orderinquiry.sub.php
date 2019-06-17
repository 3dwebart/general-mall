<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined("_ORDERINQUIRY_")) exit; // 개별 페이지 접근 불가

// 테마에 orderinquiry.sub.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_inquiry_file = G5_THEME_MSHOP_PATH.'/orderinquiry.sub.php';
    if(is_file($theme_inquiry_file)) {
        include_once($theme_inquiry_file);
        return;
        unset($theme_inquiry_file);
    }
}
?>

<?php if (!$limit) { ?>총 <?php echo $cnt; ?> 건<?php } ?>


<div id="sod_inquiry">
    <ul>
        <?php
        $sql = " SELECT *,
                    (od_cart_coupon + od_coupon + od_send_coupon) AS couponprice
                   FROM {$g5['g5_shop_order_table']}
                  WHERE mb_id = '{$member['mb_id']}'
                  ORDER BY od_id DESC
                  $limit ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            // 주문상품
            $sql = " SELECT it_name, ct_option
                       FROM {$g5['g5_shop_cart_table']}
                      WHERE od_id = '{$row['od_id']}'
                   ORDER BY io_type, ct_id
                      LIMIT 1 ";
            $ct = sql_fetch($sql);
            $ct_name = get_text($ct['it_name']).' '.get_text($ct['ct_option']);

            $sql = " SELECT count(*) AS cnt
                       FROM {$g5['g5_shop_cart_table']}
                      WHERE od_id = '{$row['od_id']}' ";
            $ct2 = sql_fetch($sql);
            if($ct2['cnt'] > 1)
                $ct_name .= ' 외 '.($ct2['cnt'] - 1).'건';

            switch($row['od_status']) {
                case '주문':
                    $od_status = '<span class="status_01">Checking deposit</span>';//입금확인중
                    break;
                case '입금':
                    $od_status = '<span class="status_02">Deposit completed</span>';//입금완료
                    break;
                case '준비':
                    $od_status = '<span class="status_03">Product is in preparation</span>';//상품준비중
                    break;
                case '배송':
                    $od_status = '<span class="status_04">Delivering items</span>';//상품배송
                    break;
                case '완료':
                    $od_status = '<span class="status_05">Delivery completed</span>';//배송완료
                    break;
                default:
                    $od_status = '<span class="status_06">Order Cancellation</span>';//주문취소
                    break;
            }

            $od_invoice = '';
            if($row['od_delivery_company'] && $row['od_invoice'])
                $od_invoice = '<span class="inv_inv"><i class="fa fa-truck" aria-hidden="true"></i> <strong>'.get_text($row['od_delivery_company']).'</strong> '.get_text($row['od_invoice']).'</span>';

            $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);
        ?>

        <li>
            <div class="inquiry_idtime">
                <a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>" class="idtime_link"><?php echo $row['od_id']; ?></a>
                <span class="idtime_time"><?php echo substr($row['od_time'],2,8); ?></span>
            </div>
            <div class="inquiry_name">
                <?php echo $ct_name; ?>
            </div>
            <div class="inquiry_price">
                <?php echo display_price($row['od_receipt_price']); ?>
            </div>
            <div class="inquiry_inv">
                <?php echo $od_invoice; ?>
                <span class="inv_status"><?php echo $od_status; ?></span>
            </div>
        </li>

        <?php
        }

        if ($i == 0)
            echo '<li class="empty_list">No order history.</li>';//주문 내역이 없습니다.
        ?>
    </ul>
</div>

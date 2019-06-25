<?php
include_once('./_common.php');

// 테마에 mypage.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_mypage_file = G5_THEME_MSHOP_PATH.'/mypage.php';
    if(is_file($theme_mypage_file)) {
        include_once($theme_mypage_file);
        return;
        unset($theme_mypage_file);
    }
}

$g5['title'] = 'Mypage';
include_once(G5_MSHOP_PATH.'/_head.php');

// 쿠폰
$cp_count = 0;
$sql = " SELECT cp_id
           FROM {$g5['g5_shop_coupon_table']}
          WHERE mb_id IN ( '{$member['mb_id']}', '전체회원' )
            AND cp_start <= '".G5_TIME_YMD."'
            AND cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
}
?>

<div id="smb_my">
    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <div class="my_name">
            <img src="<?php echo G5_THEME_IMG_URL ;?>/no_profile.gif" alt="프로필이미지" width="20"> <strong><?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?></strong>
            <ul class="smb_my_act">
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">Administrator</a></li><?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn01">Edit info</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn01">membership withdrawal</a></li>
            </ul>
        </div>
        <ul class="my_pocou">
            <li  class="my_cou">Owned coupon<a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?></a></li>
            <li class="my_point">Owned point
            <a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><?php echo number_format($member['mb_point']); ?> point</a></li>

        </ul>
        <div class="my_info">
            <div class="my_info_wr">
                <strong>contact address</strong>
                <span><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></span>
            </div>
            <div class="my_info_wr">
                <strong>E-Mail</strong>
                <span><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></span>
            </div>
            <div class="my_info_wr">
                <strong>Last access date and time</strong>
                <span><?php echo $member['mb_today_login']; ?></span>
             </div>
            <div class="my_info_wr">
            <strong>Membership date and time</strong>
                <span><?php echo $member['mb_datetime']; ?></span>
            </div>
            <div class="my_info_wr ov_addr">
                <strong>Address</strong>
                <span><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr4'], $member['mb_addr_country']); ?></span>
            </div>
        </div>
        <div class="my_ov_btn"><button type="button" class="btn_op_area"><i class="fa fa-caret-down" aria-hidden="true"></i><span class="sound_only">More information</span></button></div>

    </section>

    <script>
    
        $(".btn_op_area").on("click", function() {
            $(".my_info").toggle();
            $(".fa-caret-down").toggleClass("fa-caret-up")
        });

    </script>

    <section id="smb_my_od">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">Recent order history</a></h2><!-- 최근 주문내역 -->
        <?php
        // 최근 주문내역
        define("_ORDERINQUIRY_", true);

        $limit = " limit 0, 5 ";
        include G5_MSHOP_PATH.'/orderinquiry.sub.php';
        ?>
        <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="btn_more">View more</a>
    </section>

    <section id="smb_my_wish" class="wishlist">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">Recent wish list</a></h2>

        <ul>
            <?php
            $sql = " SELECT *
                       FROM {$g5['g5_shop_wish_table']} a,
                            {$g5['g5_shop_item_table']} b
                      WHERE a.mb_id = '{$member['mb_id']}'
                        AND a.it_id  = b.it_id
                   ORDER BY a.wi_id DESC
                      LIMIT 0, 6 ";
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++)
            {
                $image_w = 250;
                $image_h = 250;
                $image = get_it_image($row['it_id'], $image_w, $image_h, true);
                $list_left_pad = $image_w + 10;
            ?>

            <li>
                <div class="wish_img"><?php echo $image; ?></div>
                <div class="wish_info">
                    <a href="./item.php?it_id=<?php echo $row['it_id']; ?>" class="info_link"><?php echo stripslashes($row['it_name']); ?></a>
                     <span class="info_date"><?php echo substr($row['wi_time'], 2, 8); ?></span>
                </div>
            </li>

            <?php
            }

            if ($i == 0)
                echo '<li class="empty_list">보관 내역이 없습니다.</li>';
            ?>
        </ul>
         <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="btn_more">View more</a>
    </section>

</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave() {
    return confirm('정말 회원에서 탈퇴 하시겠습니까?');
}
</script>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>
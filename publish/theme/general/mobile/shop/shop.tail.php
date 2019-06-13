<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
</div><!-- container End -->

<div id="ft">
    <h2><?php echo $config['cf_title']; ?> 정보</h2>
    <div id="ft_company">
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">About Us</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">Privacy Statement</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">Terms of Service</a>
        <?php
        if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
        <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC Version</a>
        <?php } ?>
    </div>
    <div id="ft_logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img2" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
    <div class="m-ft-info">
        <div class="pt-5 pb-2">
            <div class="info-tit">Address name</div>
            <div class="info-con"><?php echo $default['de_admin_company_name']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">Address</div>
            <div class="info-con"><?php echo $default['de_admin_company_addr']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">Business number</div>
            <div class="info-con"><?php echo $default['de_admin_company_saupja_no']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">CEO</div>
            <div class="info-con"><?php echo $default['de_admin_company_owner']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">TEL</div>
            <div class="info-con"><?php echo $default['de_admin_company_tel']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">FAX</div>
            <div class="info-con"><?php echo $default['de_admin_company_fax']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">Mail order sales report number</div>
            <div class="info-con"><?php echo $default['de_admin_tongsin_no']; ?></div>
        </div>
        <div class="py-2">
            <div class="info-tit">Privacy Officer</div>
            <div class="info-con"><?php echo $default['de_admin_info_name']; ?></div>
        </div>
        <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
        Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
    </div>
    <a href="#" id="ft_to_top"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></a>

</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<script>
var App = new Swiper('.swiper-container.main-slide', {
    speed: 400,
    spaceBetween: 0,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 4000,
    },
    loop: true,
});
</script>
<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

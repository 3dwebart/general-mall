<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL; ?>/css/m-custom.css">
<div class="swiper-container mobile-top">

    <div class="swiper-wrapper">
        <div class="swiper-slide" data-left="0">AA1</div>
        <div class="swiper-slide" data-left="1">BB2</div>
        <div class="swiper-slide" data-left="2">CC3</div>
        <div class="swiper-slide" data-left="3">DD4</div>
        <div class="swiper-slide" data-left="4">EE5</div>
        <div class="swiper-slide" data-left="5">FF6</div>
    </div>

</div>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">Go to body</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
    <ul id="hd_mb">
        <li><a href="<?php echo G5_URL; ?>/">Community</a></li>
        <?php if ($is_member) { ?>
        <?php if ($is_admin) {  ?>
        <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"><b>Administrator</b></a></li>
        <?php } else { ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">Edit info</a></li>
        <?php } ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">Sign out</a></li>
        <?php } else { ?>
        <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">Sign in</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join">Sign up</a></li>
        <?php } ?>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">Mypage</a></li>
    </ul>

    <div id="hd_wr">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
        <div id="hd_btn">
            <button type="button" id="btn_hdcate"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">분류</span></button>
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">Shopping cart</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>

        </div>
    </div>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>


    <script>
    $( document ).ready( function() {
        var jbOffset = $( '#hd_wr' ).offset();
        $( window ).scroll( function() {
            if ( $( document ).scrollTop() > jbOffset.top ) {
                $( '#hd_wr' ).addClass( 'fixed' );
            }
            else {
                $( '#hd_wr' ).removeClass( 'fixed' );
            }
        });

        /* BIGIN :: Top Slide Menu */
        var myMobileTopSwiper = new Swiper('.swiper-container.mobile-top', {
            speed: 400,
            spaceBetween: 100,
            slidesPerView: 3,
            spaceBetween: 30,
        });
        /* END :: Top Slide Menu */
    });

    $("#btn_hdcate").on("click", function() {
        $("#category").show();
    });

    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });
     $(".cate_bg").on("click", function() {
        $(".menu").hide();
    });
   </script>
</header>
<!-- Slider main container -->
<?php if (defined('_INDEX_')): ?>
<div class="swiper-container main-slide">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
            <img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/m-slide-1.png" alt="">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/m-slide-2.png" alt="">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/m-slide-3.png" alt="">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/m-slide-4.png" alt="">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/m-slide-5.png" alt="">
        </div>
    </div>
    <!-- If we need pagination -->
    <!-- <div class="swiper-pagination"></div> -->

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
<?php endif ?>
<div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>

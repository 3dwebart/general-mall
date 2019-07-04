<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
/* Mobile header */
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/custom.lib.php');
?>
<header id="hd">
	<?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

	<div id="skip_to_container"><a href="#container">Go to body</a></div>

	<?php
	if(defined('_INDEX_')) { // index에서만 실행
		include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
	}
	?>
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
			} else {
				$( '#hd_wr' ).removeClass( 'fixed' );
			}
		});
	});
	/* BIGIN :: We animated the show / hide function of the mobile menu. */
	$("#btn_hdcate").on("click", function() {
		// $("#category").show();
		$("#category").addClass('active');
		setTimeout(function() {
			$("#category").addClass('on');
		}, 100);
	});

	$(".menu_close").on("click", function() {
		// $(".menu").hide();
		$("#category").removeClass('on');
		setTimeout(function() {
			$("#category").removeClass('active');
		}, 500);
	});
	 $(".cate_bg").on("click", function() {
		// $(".menu").hide();
		$("#category").removeClass('on');
		setTimeout(function() {
			$("#category").removeClass('active');
		}, 500);
	});
	 /* END :: We animated the show / hide function of the mobile menu. */
   </script>
</header>
<!-- Slider main container -->
<?php if (defined('_INDEX_')): ?>
<div class="swiper-container main-slide">
	<!-- Additional required wrapper -->
	<div class="swiper-wrapper">
		<!-- Slides -->
		<div class="swiper-slide">
			<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/1.jpg" alt="" class="img-fluid">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/2.jpg" alt="" class="img-fluid">
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

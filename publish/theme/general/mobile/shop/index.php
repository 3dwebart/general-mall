<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>
<style>
@media(max-width: 991px) {
	.event [class^="row"] [class^="col"] {
		padding-left: 0;
		padding-right: 0;
	}
}
</style>
<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php echo display_banner('메인', 'mainbanner.11.skin.php'); ?>
<?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>
<div class="container px-lg-0">
	<section class="sct_wrap mx-0 pb-4">
	    <?php
		    $list = new item_list();
		    $list->set_category('c0', 1);
		    $list->set_list_mod(2);
		    $list->set_list_row(3);
		    $list->set_img_size(400, 500);
		    $list->set_list_skin(G5_MSHOP_SKIN_PATH.'/main.16.skin.php');
		    $list->set_view('it_img', true);
		    $list->set_view('it_id', false);
		    $list->set_view('it_name', true);
		    $list->set_view('it_basic', true);
		    $list->set_view('it_cust_price', true);
		    $list->set_view('it_price', true);
		    $list->set_view('it_icon', true);
		    $list->set_view('sns', false);
		    echo $list->run();
	    ?>
	</section>
</div>

<div class="container">
	<!-- 히트상품 -->
	<?php if($default['de_mobile_type1_list_use']) { ?>
	<div class="sct_wrap mx-0">
		<?php
			$list = new item_list();
			$list->set_mobile(true);
			$list->set_type(1);
			//$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_cust_price', true);
			$list->set_view('it_price', true);
			//$list->set_view('it_icon', true);
			//$list->set_view('sns', true);
			echo $list->run();
		?>
	</div>
	<?php } ?>

	<!-- 추천상품 -->
	<?php if($default['de_mobile_type2_list_use']) { ?>
	<div class="sct_wrap mx-0">
		<div class="m-title-wrap">
			<header class="slide-product-header base py-2 px-4 mb-0">
				<h2 class="list-type-title mb-0 text-left">
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">RECOMMENDATION PRODUCT</a>
				</h2>
			</header>
		</div>
		<?php
			$list = new item_list();
			$list->set_mobile(true);
			$list->set_type(2);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_cust_price', true);
			$list->set_view('it_price', true);
			// $list->set_view('it_icon', true);
			// $list->set_view('sns', true);
			echo $list->run();
		?>
	</div>
	<?php } ?>

	<!-- 최신상품 -->
	<?php if($default['de_mobile_type3_list_use']) { ?>
	<div class="sct_wrap mx-0">
		<div class="m-title-wrap">
			<header class="slide-product-header base py-2 px-4 mb-0">
				<h2 class="list-type-title mb-0 text-left">
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">NEW PRODUCT</a>
				</h2>
			</header>
		</div>
		<?php
			$list = new item_list();
			$list->set_mobile(true);
			$list->set_type(3);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_cust_price', true);
			$list->set_view('it_price', true);
			// $list->set_view('it_icon', true);
			// $list->set_view('sns', true);
			echo $list->run();
		?>
	</div>
	<?php } ?>

	<!-- 인기상품 -->
	<?php if($default['de_mobile_type4_list_use']) { ?>
	<div class="sct_wrap mx-0">
		<div class="m-title-wrap">
			<header class="slide-product-header base py-2 px-4 mb-0">
				<h2 class="list-type-title mb-0 text-left">
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">BEST PRODUCT</a>
				</h2>
			</header>
		</div>
		<?php
			$list = new item_list();
			$list->set_mobile(true);
			$list->set_type(4);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			// $list->set_view('it_icon', false);
			// $list->set_view('sns', false);
			echo $list->run();
		?>
	</div>
	<?php } ?>

	<!-- 할인상품 -->
	<?php if($default['de_mobile_type5_list_use']) { ?>
	<div class="sct_wrap mx-0">
		<div class="m-title-wrap">
			<header class="slide-product-header base py-2 px-4 mb-0">
				<h2 class="list-type-title mb-0 text-left">
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">SALE PRODUCT</a>
				</h2>
			</header>
		</div>
		<?php
			$list = new item_list();
			$list->set_mobile(true);
			$list->set_type(5);
			$list->set_view('it_id', false);
			$list->set_view('it_name', true);
			$list->set_view('it_cust_price', false);
			$list->set_view('it_price', true);
			// $list->set_view('it_icon', false);
			// $list->set_view('sns', false);
			echo $list->run();
		?>
	</div>
	<?php } ?>

	<?php // include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

	<div class="container event px-0 py-0">
		<?php
			// event id, 타입, 라인당 수, 최대 개수, row 클래스 종류
			// event id는 single로 사용할 경우 기입 / 멀티 사용 : false
			eventBanner(false,1,2,2,'row-5');
		?>
	</div>
	<!-- 커뮤니티 최신글 시작 { -->
	<section id="sidx_lat">
		<?php echo latest('theme/shop_basic', 'notice', 3, 30); ?>
	</section>
</div>
<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
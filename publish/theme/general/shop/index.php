<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/index.php');
	return;
}

define("_INDEX_", TRUE);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>
<!-- 메인이미지 시작 { -->
<?php echo display_banner('메인', 'mainbanner.11.skin.php'); ?>
<!-- } 메인이미지 끝 -->
<!-- BIGIN :: HOT Deal -->
<div class="container px-lg-0">
	<section class="sct_wrap pb-4">
	    <?php
	    $list = new item_list();
	    $list->set_category('c0', 1);
	    $list->set_list_mod(5);
	    $list->set_list_row(2);
	    $list->set_img_size(400, 500);
	    $list->set_list_skin(G5_SHOP_SKIN_PATH.'/main.16.skin.php');
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
<!-- END :: HOT Deal -->
<!-- BIGIN :: Banner -->
<div class="container banners px-lg-0 py-lg-5">
	<div class="row-5">
		<div class="col-lg-20">
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-1.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-2.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
		</div>
		<div class="col-lg-20">
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-3.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
		</div>
		<div class="col-lg-20">
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-4.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-5.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
		</div>
		<div class="col-lg-20">
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-6.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
		</div>
		<div class="col-lg-20">
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-7.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
			<div class="col-img">
				<a href="#">
					<img src="<?php echo G5_ASSETS_URL; ?>/img/index/banner/banner3-8.jpg" alt="banner3-1" class="img-fluid" />
				</a>
			</div>
		</div>
	</div>
</div>
<!-- END :: Banner -->

<?php if($default['de_type1_list_use']) { ?>
<!-- 히트상품 시작 { -->
<div class="container px-lg-0">
	<section class="sct_wrap pb-4">
		<?php
		$list = new item_list();
		$list->set_type(1);
		$list->set_view('it_img', true);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', true);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', true);
		$list->set_view('sns', true);
		echo $list->run();
		?>
	</section>
</div>
	
<!-- } 히트상품 끝 -->
<?php } ?>

<?php if($default['de_type2_list_use']) { ?>
<!-- 추천상품 시작 { -->
<div class="container px-lg-0">
	<section class="sct_wrap mt-5 pb-4">
		<?php
		$list = new item_list();
		$list->set_type(2);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', true);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', true);
		$list->set_view('sns', true);
		echo $list->run();
		?>
	</section>
</div>
<!-- } 추천상품 끝 -->
<?php } ?>

<?php // include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

<?php if($default['de_type3_list_use']) { ?>
<!-- 최신상품 시작 { -->
<div class="container px-lg-0">
	<section class="sct_wrap mt-5 pb-4">
		<?php
		$list = new item_list();
		$list->set_type(3);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', true);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', true);
		$list->set_view('sns', true);
		echo $list->run();
		?>
	</section>
</div>
<!-- } 최신상품 끝 -->
<?php } ?>

<?php if($default['de_type5_list_use']) { ?>
<!-- 할인상품 시작 { -->
<div class="container px-lg-0">
	<section class="sct_wrap mt-5 pb-4">
		<?php
		$list = new item_list();
		$list->set_type(5);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', true);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', true);
		$list->set_view('sns', true);
		echo $list->run();
		?>
	</section>
</div>
<!-- } 할인상품 끝 -->
<?php } ?>
<div class="container px-lg-0 py-lg-5">
	<?php
		/*
			타입, 라인당 수, 최대 개수, row 클래스 종류, event id
			event id는 single로 사용할 경우 기입 / 멀티 사용 : false
			타입  0 : 리스트형 / 1 : 페이지형, 1 라인당 보여질 이벤트 수, 최대 개수, row 클래스 종류, event id
		*/
		eventBanner(1,2,2,'row-5');
	?>
</div>
<div class="container icon-box px-lg-0 mb-5 text-center">
	<div class="row">
		<div class="col-lg-20 icon-wrap">
			<div class="icon">
				<i class="lnr lnr-gift"></i>
			</div>
			<h3>Great Value</h3>
			<p>Nunc Id Ante Quis Tellus Faucibus Dictum In Eget.</p>
		</div>
		<div class="col-lg-20 icon-wrap">
			<div class="icon">
				<i class="lnr lnr-rocket"></i>
			</div>
			<h3>Worlwide Delivery</h3>
			<p>Quisque Posuere Enim Augue, In Rhoncus Diam Dictum Non</p>
		</div>
		<div class="col-lg-20 icon-wrap">
			<div class="icon">
				<i class="lnr lnr-lock"></i>
			</div>
			<h3>Safe Payment</h3>
			<p>Duis Suscipit Elit Sem, Sed Mattis Tellus Accumsan.</p>
		</div>
		<div class="col-lg-20 icon-wrap">
			<div class="icon">
				<i class="lnr lnr-enter-down"></i>
			</div>
			<h3>Shop Confidence</h3>
			<p>Faucibus Dictum Suscipit Eget Metus. Duis Elit Sem, Sed.</p>
		</div>
		<div class="col-lg-20 icon-wrap">
			<div class="icon">
				<i class="lnr lnr-users"></i>
			</div>
			<h3>24/7 Help Center</h3>
			<p>Quisque Posuere Enim Augue, In Rhoncus Diam Dictum Non.</p>
		</div>
	</div>
</div>
<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>
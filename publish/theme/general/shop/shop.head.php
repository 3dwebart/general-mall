<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
	return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
/********** 2019-06-07 실시간 환율적용(원화를 달러화로 변경하여 보여줌) **********/
/***** BIGIN :: 실시간 환율 변동 : 1달러당 원화 *****/
function ratePrice() {
	//$rate = $_GET['rate'];
	if(empty($rate)) {
		$rate = 'KRW';
	}

	$url = "http://api.manana.kr/exchange/rate/".$rate."/KRW,USD.json";
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, $url);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, '`http://scberries.cafe24.com`');

	$json = curl_exec($curl_handle);
	curl_close($curl_handle);

	$data = json_decode($json,true);
	for($i = 0; $i < count($data); $i++) {
		if($data[$i]['name'] == 'USDKRW=X') { // $rate = KRW - 1달러당 원화
			$priceRateKRW = sprintf("%2.4f",$data[$i]['rate']);
		}
		/*
		if($data[$i]['name'] == 'KRWUSD=X') { // $rate = USD - 1원당 달러화
			$priceRate = $data[$i]['rate'];
		}
		*/
	}

	$exchange_sql = "UPDATE `g5_shop_default` SET `de_paypal_krw` = '{$priceRateKRW}'";
	sql_query($exchange_sql);
	/***** END :: 실시간 환율 변동 : 1달러당 원화 *****/
	/*
		위의 실시간 환율 변동 무시하고 쇼핑몰 환경설정에 있는 페이팔 기본환율 적용함
		사용하지 않을시 삭제
	*/
	$p_sql = "SELECT `de_paypal_krw` FROM `g5_shop_default`";
	$p_row = sql_fetch($p_sql);
	$p_rate = $p_row['de_paypal_krw'];
	$priceRate = (1/$p_rate);

	return $priceRate;
}
?>
<script src="<?php echo G5_ASSETS_URL ?>/js/swiper.min.js"></script>
<section class="tab-bar-wrap">
	<header class="top-bar container">
		<!--
		<div class="shop-nav">
			<a href="#">Free Shipping on order over $99</a>
			<a href="#">Shopping cart</a>
			<a href="#">Checkout</a>
		</div>
		-->
		<div></div>
		<div class="mb-nav d-flex">
			<div class="dropdown language-change">
				<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-lang="eng">
				<img src="<?php echo G5_ASSETS_URL; ?>/img/flag/usa.png" alt="">
				<span>English</span>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#" data-lang="eng">
						<img src="<?php echo G5_ASSETS_URL; ?>/img/flag/usa.png" alt="usa flag" />
						<span>English</span>
					</a>
					<a class="dropdown-item" href="#" data-lang="hkg">
						<img src="<?php echo G5_ASSETS_URL; ?>/img/flag/hkg.png" alt="usa flag" />
						<span>Hongkong</span>
					</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="btn dropdown-toggle" type="button" id="dropdownCountry" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Account
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownCountry">
					<?php if(G5_COMMUNITY_USE) { ?>
					<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Shoppingmall</a>
					<a class="dropdown-item" href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i> Community</a>
					<?php } ?>
					<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping basket</a>
					<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/mypage.php">My page</a>
					<?php if ($is_member) { ?>
					<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">Edit my information</a>
					<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">Sign out</a>
					<?php if ($is_admin) {  ?>
					<a class="dropdown-item" href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>Administrator</b></a>
					<?php }  ?>
					<?php } else { ?>
					<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/register.php">Sign up</a>
					<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>Sign in</b></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</header>
</section>
<!-- 상단 시작 { -->
<div id="hd">
	<h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

	<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

	<?php if(defined('_INDEX_')) { // index에서만 실행
		include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	 } ?>
	<div id="hd_wrapper">
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-lg-3">
					<div id="logo">
						<a href="<?php echo G5_SHOP_URL; ?>/">
							<img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>">
						</a>
					</div>
				</div>
				<div class="col-lg-5">
					<div id="hd_sch">
						<h3>쇼핑몰 검색</h3>
						<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

						<label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
						<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required>
						<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>

						</form>
						<script>
						function search_submit(f) {
							if (f.q.value.length < 2) {
								alert("검색어는 두글자 이상 입력하십시오.");
								f.q.select();
								f.q.focus();
								return false;
							}
							return true;
						}
						</script>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="row mx-0">
						<!-- BIGIN :: Menu Quick cart view -->
						<?php
							$sql = "SELECT * FROM {$g5['g5_shop_cart_table']} 
									WHERE ct_direct = 0 AND ct_select = 0";
							$res = sql_query($sql);
							$count = sql_num_rows($res);
							$s_cart_id_header = get_session('ss_cart_id');
							$cart_action_url = G5_SHOP_URL.'/cartupdate.php';
						?>
						<div class="col-lg-6 px-0 shop-cart-list">
							<div class="dropdown">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="dropdownCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="font-2-5rem"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
									<span class="px-2"><?php echo $count; ?> Cart</span>
								</button>
								<div class="dropdown-menu items-list" aria-labelledby="dropdownCart">
									<div class="no-items<?php if ($count == 0) {echo " not";} ?>">
										No shopping cart items
									</div>
									<form action="<?php echo $cart_action_url; ?>" method="post" enctype="multipart/form-data" name="cartlist" id="cartlist">
										<input type="hidden" name="act" value="">
										<input type="hidden" name="type" value="cart">
										<input type="hidden" name="records" value="<?php echo $count; ?>">
										<?php
											$calc_price = 0;

											while ($row = sql_fetch_array($res)) {
												$calc_price += $row['ct_price'];
												$price = ($row['ct_price'] + $row['io_price']) * $row['ct_qty'];
												$item_sql = "SELECT * 
													FROM {$g5['g5_shop_item_table']}
													WHERE it_id = {$row['it_id']}";
												$item_row = sql_fetch($item_sql);
										?>
										<div class="row m-0 align-items-center item-wrap">
											<input type="hidden" name="it_id[]" value="<?php echo $item_row['it_id']; ?>">
											<input type="hidden" name="it_name[]" value="<?php echo $item_row['it_name']; ?>">
											<div class="col-2 px-0 py-2">
												<?php echo '<a href="'.G5_SHOP_URL.'/item.php?it_id='.$item_row['it_id'].'"><img src="'.G5_DATA_URL.'/item/'.$item_row['it_img1'].'" alt="'.$item_row['it_name'].'" class="img-fluid" /></a>'; ?>
											</div>
											<div class="col-6 py-2">
												<?php echo $item_row['it_name']; ?>
											</div>
											<div class="col-2 py-2">
												<?php echo number_format($price); ?>
											</div>
											<div class="col-2 py-2 text-right">
												<button class="del btn" data-id="<?php echo $item_row['it_id']; ?>" data-act="del"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<?php
											} // END while
										?>
										
										<div class="menu-cartlist-price">
											<span class="shipping-fee">Shipping fee : <?php echo $send_cost = number_format(get_sendcost($s_cart_id_header, 0)); ?></span>
											<span class="total-price">Total : <?php echo number_format($calc_price + get_sendcost($s_cart_id_header, 0)); ?></span>
										</div>
										<button type="submit" class="btn btn-outline-secondary">Checkout</button>
									</form>
									<!-- <a class="dropdown-item" href="#">USA</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a> -->
								</div>
							</div>
						</div>
						<!-- END :: Menu Quick cart view -->
						<!-- BIGIN :: Menu Quick wish view -->
						<?php
							$sql = "SELECT * FROM {$g5['g5_shop_wish_table']}";
							$res = sql_query($sql);
							$count = sql_num_rows($res);
							//$cart_action_url = G5_SHOP_URL.'/cartupdate.php';
							$cart_action_url = '#';
						?>
						<div class="col-lg-6 px-0 shop-wish-list">
							<div class="dropdown">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="dropdownWish" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="font-2-5rem"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
									<span class="px-2">Wish list (<?php echo $count; ?>)</span>
								</button>
								<div class="dropdown-menu items-list" aria-labelledby="dropdownWish">
									<div class="no-items<?php if ($count == 0) {echo " not";} ?>">
										No shopping wishlist items
									</div>
									<form action="<?php echo $cart_action_url; ?>" method="post" enctype="multipart/form-data" name="cartlist" id="cartlist">
										<input type="hidden" name="act" value="">
										<input type="hidden" name="type" value="wish">
										<input type="hidden" name="records" value="<?php echo $count; ?>">
										
										<?php
											$calc_price = 0;

											while ($row = sql_fetch_array($res)) {
												$item_sql = "SELECT * 
													FROM {$g5['g5_shop_item_table']}
													WHERE it_id = {$row['it_id']}";
												$item_row = sql_fetch($item_sql);
										?>
										<div class="row m-0 align-items-center item-wrap">
											<input type="hidden" name="it_id[]" value="<?php echo $item_row['it_id']; ?>">
											<input type="hidden" name="it_name[]" value="<?php echo $item_row['it_name']; ?>">
											<div class="col-2 px-0 py-2">
												<?php echo '<a href="'.G5_SHOP_URL.'/item.php?it_id='.$item_row['it_id'].'"><img src="'.G5_DATA_URL.'/item/'.$item_row['it_img1'].'" alt="'.$item_row['it_name'].'" class="img-fluid" /></a>'; ?>
											</div>
											<div class="col-6 py-2">
												<?php echo $item_row['it_name']; ?>
											</div>
											<div class="col-2 py-2">
												<?php echo number_format($price); ?>
											</div>
											<div class="col-2 py-2 text-right">
												<button class="del btn" data-id="<?php echo $item_row['it_id']; ?>" data-act="del"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<?php
											} // END while
										?>
									</form>
								</div>
							</div>
						</div>
						<!-- END :: Menu Quick wish view -->
					</div>
				</div>
			</div>
		</div>

		<!-- 쇼핑몰 배너 시작 { -->
		<?php // echo display_banner('왼쪽'); ?>
		<!-- } 쇼핑몰 배너 끝 -->
	</div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand sr-only" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="container">
			<div class="row w-100">
				<div class="col-lg-9 offset-lg-3">
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
								<a class="nav-link" href="<?php echo G5_URL; ?>"><i class="fa fa-home"></i> <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">Hit item</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">Recommend item</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">Latest item</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">Best item</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">Discount Item</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									My shop
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a>
									<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/qalist.php">1 : 1 contact</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/personalpay.php">Personal payment</a>
									<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">Reviews</a>
									<a class="dropdown-item" href="<?php echo G5_SHOP_URL; ?>/couponzone.php">Coupon Zone</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>

<div id="side_menu">
	<button type="button" id="btn_sidemenu" class="btn_sidemenu_cl"><i class="fa fa-outdent" aria-hidden="true"></i><span class="sound_only">Side menu button</span></button>
	<div class="side_menu_wr">
		<?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
		<div class="side_menu_shop">
			<button type="button" class="btn_side_shop">Today's Products<span class="count"><?php echo get_view_today_items_count(); ?></span></button>
			<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
			<button type="button" class="btn_side_shop">Shopping basket<span class="count"><?php echo get_boxcart_datas_count(); ?></span></button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
			<button type="button" class="btn_side_shop">Wish list<span class="count"><?php echo get_wishlist_datas_count(); ?></span></button>
			<?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
		</div>
		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>

	</div>
</div>


<script>
var g5_shop_url = '<?php echo G5_SHOP_URL; ?>';
$(function () {
	$(document).on('click', '.del', function() {
		var curThis = $(this);
		var f = $(this).closest('form');
		var type = f.find('input[name="type"]').val();
		
		var id   = $(this).data('id');
		var act  = $(this).data('act');
		$.ajax({
			url : g5_shop_url + "/ajax.item.check.php",
			type: "post",
			data: 
				{
					type: type,
					act: act,
					id: id
				},
			dataType: "json",
			cache: false,
			timeout: 30000,
			success: function(data) {
				//debugger;
				if(data.cnt == 0) {
					curThis.closest('.item-wrap').find('.no-items').addClass('not');
				}
				curThis.closest('.item-wrap').remove();
			},
			error: function(xhr, textStatus, errorThrown) {
				$("div").html("<div>" + textStatus + " (HTTP-" + xhr.status + " / " + errorThrown + ")</div>" );
			}
		});
		return false;
	});
	$(".btn_sidemenu_cl").on("click", function() {
		$(".side_menu_wr").toggleClass('on');
		$(".fa-outdent").toggleClass("fa-indent")
	});

	$(".btn_side_shop").on("click", function() {
		$(this).next(".op_area").slideToggle(300).siblings(".op_area").slideUp();
	});

	function toggleDropdown (e) {
		const _d = $(e.target).closest('.dropdown'),
		_m = $('.dropdown-menu', _d);
		setTimeout(function(){
		const shouldOpen = e.type !== 'click' && _d.is(':hover');
		_m.toggleClass('show', shouldOpen);
		_d.toggleClass('show', shouldOpen);
		$('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
		}, e.type === 'mouseleave' ? 300 : 0);
	}

	$('body')
		.on('mouseenter mouseleave','.dropdown',toggleDropdown)
		.on('click', '.dropdown-menu a', toggleDropdown);
});
</script>
<!-- } 상단 끝 -->
<div id="wrapper">
	<div class="container px-lg-0">
		<div class="row mx-lg-0">
			<div id="side-nav" class="col-lg-2 px-lg-0"><!-- id="aside" -->
				<?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
				<?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
				<?php /* if($default['de_type4_list_use']) { ?>
				<!-- 인기상품 시작 { -->
				<section class="sale_prd">
					<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
					<?php
					$list = new item_list();
					$list->set_type(4);
					$list->set_view('it_id', false);
					$list->set_view('it_name', true);
					$list->set_view('it_basic', false);
					$list->set_view('it_cust_price', false);
					$list->set_view('it_price', true);
					$list->set_view('it_icon', false);
					$list->set_view('sns', false);
					echo $list->run();
					?>
				</section>
				<!-- } 인기상품 끝 -->
				<?php } ?>

				<!-- 커뮤니티 최신글 시작 { -->
				<!--
				<section id="sidx_lat">
					<h2>커뮤니티 최신글</h2>
					<?php echo latest('theme/shop_basic', 'notice', 5, 30); ?>
				</section>
				-->
				<!-- } 커뮤니티 최신글 끝 -->

				<?php // echo poll('theme/shop_basic'); // 설문조사 ?>

				<?php // echo visit('theme/shop_basic'); // 접속자*/ ?>
			</div>
			<!-- 콘텐츠 시작 { -->
			<div id="container" class="col-lg-10 px-lg-0">
				<!-- Slider main container -->
				<?php if (defined('_INDEX_')): ?>
				<div class="swiper-container main-slide">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<!-- Slides -->
						<div class="swiper-slide">
							<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/slide-1.png" alt="">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/slide-2.png" alt="">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/slide-3.png" alt="">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/slide-4.png" alt="">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo G5_ASSETS_URL; ?>/img/index/slide/slide-5.png" alt="">
						</div>
					</div>
					<!-- If we need pagination -->
					<div class="swiper-pagination"></div>

					<!-- If we need navigation buttons -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>

					<!-- If we need scrollbar -->
					<div class="swiper-scrollbar"></div>
				</div>
				<?php endif ?>
				<?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>
				<!-- 글자크기 조정 display:none 되어 있음 시작 { -->
				<div id="text_size">
					<button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
					<button class="no_text_resize" onclick="font_default('container');">기본</button>
					<button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
				</div>
				<!-- } 글자크기 조정 display:none 되어 있음 끝 -->
	<?php if(defined('_INDEX_')): ?>
			</div>
			<!-- } 콘텐츠 끝 -->
		</div><!-- / row -->
	</div><!-- / container -->
	<?php endif; ?>
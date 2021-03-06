<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
$onWishSql = " SELECT count(it_id) AS wish_cnt FROM {$g5['g5_shop_wish_table']} WHERE it_id = '{$it_id}' ";
$onWishRow = sql_fetch($onWishSql);
$wish_cnt = $onWishRow['wish_cnt'];
?>

<form name="fitem" method="post" action="<?php echo $action_url; ?>" onsubmit="return fitem_submit(this);">
	<input type="hidden" name="krw" value="<?php echo ratePrice(); ?>" />
	<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>" />
	<input type="hidden" name="wish_chk" value="<?php echo $wish_cnt; ?>" />
	<input type="hidden" name="sw_direct" />
	<input type="hidden" name="url" />
	<div id="sit_ov_wrap" class="row mx-lg-0">
		<!-- 상품이미지 미리보기 시작 { -->
		<div id="sit_pvi" class="col-lg-5">
			<div id="sit_pvi_big">
			<?php
			$big_img_count = 0;
			$thumbnails = array();
			for($i=1; $i<=10; $i++) {
				if(!$it['it_img'.$i])
					continue;

				$img = get_it_thumbnail_responsive($it['it_img'.$i], $default['de_mimg_width'], $default['de_mimg_height']);

				if($img) {
					// 썸네일
					$thumb = get_it_thumbnail($it['it_img'.$i], 60, 60);
					$thumbnails[] = $thumb;
					$big_img_count++;

					echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$i.'" target="_blank" class="popup_item_image">'.$img.'</a>';
				}
			}

			if($big_img_count == 0) {
				echo '<img src="'.G5_SHOP_URL.'/img/no_image.gif" alt="">';
			}
			?>
			</div>
			<?php
			// 썸네일
			$thumb1 = true;
			$thumb_count = 0;
			$total_count = count($thumbnails);
			if($total_count > 0) {
				echo '<ul id="sit_pvi_thumb">';
				foreach($thumbnails as $val) {
					$thumb_count++;
					$sit_pvi_last ='';
					if ($thumb_count % 5 == 0) $sit_pvi_last = 'class="li_last"';
						echo '<li '.$sit_pvi_last.'>';
						echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$thumb_count.'" target="_blank" class="popup_item_image img_thumb">'.$val.'<span class="sound_only"> '.$thumb_count.'번째 이미지 새창</span></a>';
						echo '</li>';
				}
				echo '</ul>';
			}
			?>
			
			<!-- 다른 상품 보기 시작 { -->
			<div id="sit_siblings">
				<?php
				if ($prev_href || $next_href) {
					$prev_title = '<i class="fa fa-caret-left" aria-hidden="true"></i> '.$prev_title;
					$next_title = $next_title.' <i class="fa fa-caret-right" aria-hidden="true"></i>';

					echo $prev_href.$prev_title.$prev_href2;
					echo $next_href.$next_title.$next_href2;
				} else {
					echo '<span class="sound_only">이 분류에 등록된 다른 상품이 없습니다.</span>';
				}
				?>
				<a href="<?php echo G5_SHOP_URL; ?>/largeimage.php?it_id=<?php echo $it['it_id']; ?>&amp;no=1" target="_blank" class="popup_item_image "><i class="fa fa-search-plus" aria-hidden="true"></i><span class="sound_only">View Larger</span></a>
			</div>
			<!-- } 다른 상품 보기 끝 -->

			<div id="sit_star_sns">
				<?php if ($star_score) { ?>
				<span class="sound_only">Customer Rating</span> <!-- 고객평점 -->
				<img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star_score?>.png" alt="" class="sit_star" width="100">
				Star<?php echo $star_score?><!-- 개 -->
				<?php } ?>
				<span class="st_bg"></span> <i class="fa fa-commenting-o" aria-hidden="true"></i><span class="sound_only">Review</span> <?php echo $it['it_use_cnt']; ?>
				<span class="st_bg"></span> <i class="fa fa-heart-o spin" aria-hidden="true"></i><span class="sound_only">Wish</span> <?php echo get_wishlist_count_by_item($it['it_id']); ?>
				<button type="button" class="btn_sns_share"><i class="fa fa-share-alt" aria-hidden="true"></i><span class="sound_only">SNS Share</span></button><!-- 공유 -->
				<div class="sns_area"><?php echo $sns_share_links; ?> <a href="javascript:popup_item_recommend('<?php echo $it['it_id']; ?>');" id="sit_btn_rec"><i class="fa fa-envelope-o" aria-hidden="true"></i><span class="sound_only">Recommended</span></a></div><!-- 추천하기 -->
			</div>
			<script>
			$(".btn_sns_share").click(function(){
				$(".sns_area").show();
			});
			$(document).mouseup(function (e){
				var container = $(".sns_area");
				if( container.has(e.target).length === 0) {
					container.hide();
				}
			});
			</script>
		</div>
		<!-- } 상품이미지 미리보기 끝 -->
		<!-- 상품 요약정보 및 구매 시작 { -->
		<section id="sit_ov" class="2017_renewal_itemform col-lg-7">
			<h2 id="sit_title"><?php echo stripslashes($it['it_name']); ?> <span class="sound_only">Summary information and purchasing</span></h2><!-- 요약정보 및 구매 -->
			<p id="sit_desc"><?php echo $it['it_basic']; ?></p>
			<?php if($is_orderable) { ?>
			<p id="sit_opt_info">
				Product selection options<!-- 상품 선택옵션 --> <?php echo $option_count; ?>, Additional product options<?php echo $supply_count; ?><!-- 추가옵션 -->
			</p>
			<?php } ?>
			<div class="sit_info">
				<table class="sit_ov_tbl">
					<colgroup>
						<col class="grid_3">
						<col>
					</colgroup>
					<tbody>
						<?php if ($it['it_maker']) { ?>
						<tr>
							<th scope="row">Manufacturer</th><!-- 제조사 -->
							<td><?php echo $it['it_maker']; ?></td>
						</tr>
						<?php } ?>

						<?php if ($it['it_origin']) { ?>
						<tr>
							<th scope="row">Origin</th><!-- 원산지 -->
							<td><?php echo $it['it_origin']; ?></td>
						</tr>
						<?php } ?>

						<?php if ($it['it_brand']) { ?>
						<tr>
							<th scope="row">Brand</th><!-- 브랜드 -->
							<td><?php echo $it['it_brand']; ?></td>
						</tr>
						<?php } ?>

						<?php if ($it['it_model']) { ?>
						<tr>
							<th scope="row">Model</th><!-- 모델 -->
							<td><?php echo $it['it_model']; ?></td>
						</tr>
						<?php } ?>

						<?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
						<tr>
							<th scope="row">Price</th><!-- 판매가격 -->
							<td>Stop selling</td><!-- 판매중지 -->
						</tr>
						<?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
						<tr>
							<th scope="row">Price</th><!-- 판매가격 -->
							<td>Phone inquiry</td><!-- 전화문의 -->
						</tr>
						<?php } else { // 전화문의가 아닐 경우?>
						<?php if ($it['it_cust_price']) { ?>
						<tr>
							<th scope="row">Price</th><!-- 시중가격 -->
							<td>
								<span class="cust-price">
									$<?php
										// echo display_price($it['it_cust_price']);
										$rate_price = ratePrice() * $it['it_cust_price'];
										echo number_format($rate_price,2);
									?>
								</span>
							</td>
						</tr>
						<?php } // 시중가격 끝 ?>

						<tr>
							<th scope="row">Sale Price</th><!-- 판매가격 -->
							<td>
								<strong>
									$<?php
										//echo display_price(get_price($it));
										$rate_price = ratePrice() * $it['it_price'];
										echo number_format($rate_price,2);
									?>
								</strong>
								<input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
							</td>
						</tr>
						<?php } ?>

						<?php
						/* 재고 표시하는 경우 주석 해제
						<tr>
							<th scope="row">재고수량</th>
							<td><?php echo number_format(get_it_stock_qty($it_id)); ?> 개</td>
						</tr>
						*/
						?>

						<?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?>
						<tr>
							<th scope="row">Point</th>
							<td>
								<?php
								if($it['it_point_type'] == 2) {
									//echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
									echo $it['it_point'].'% of purchase amount (without additional option)';
								} else {
									$it_point = get_item_point($it);
									echo number_format($it_point).'points';
								}
								?>
							</td>
						</tr>
						<?php } ?>
						<?php
						$ct_send_cost_label = 'Payment for shipping';//배송비결제

						if($it['it_sc_type'] == 1)
							$sc_method = 'Free Shipping';
						else {
							if($it['it_sc_method'] == 1)
								$sc_method = 'Payment after receipt';//수령후 지불
							else if($it['it_sc_method'] == 2) {
								$ct_send_cost_label = '<label for="ct_send_cost">Payment for shipping</label>';//배송비결제
								$sc_method = '<select name="ct_send_cost" id="ct_send_cost">
												  <option value="0">Payment upon order</option>
												  <option value="1">Payment after receipt</option>
											  </select>';//opt 1 : 주문시 결제, opt 2 : 수령후 지불
							} else {
								$sc_method = 'Payment upon order';
							}
						}
						?>
						<tr>
							<th><?php echo $ct_send_cost_label; ?></th>
							<td><?php echo $sc_method; ?></td>
						</tr>
						<?php if($it['it_buy_min_qty']) { ?>
						<tr>
							<th>Minimum purchase quantity</th><!-- 최소구매수량 -->
							<td><?php echo number_format($it['it_buy_min_qty']); ?></td><!-- 개 -->
						</tr>
						<?php } ?>
						<?php if($it['it_buy_max_qty']) { ?>
						<tr>
							<th>Maximum purchase quantity</th><!-- 최대구매수량 -->
							<td><?php echo number_format($it['it_buy_max_qty']); ?></td><!-- 개 -->
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php
			if($option_item) {
			?>
			<!-- 선택옵션 시작 { -->
			<section class="sit_option">
				<h3>Selection options</h3>
	 
				<?php // 선택옵션
				echo $option_item;
				?>
			</section>
			<!-- } 선택옵션 끝 -->
			<?php
			}
			?>

			<?php
			if($supply_item) {
			?>
			<!-- 추가옵션 시작 { -->
			<section  class="sit_option">
				<h3>Additional options</h3>
				<?php // 추가옵션
				echo $supply_item;
				?>
			</section>
			<!-- } 추가옵션 끝 -->
			<?php
			}
			?>

			<?php if ($is_orderable) { ?>
			<!-- 선택된 옵션 시작 { -->
			<section id="sit_sel_option">
				<h3>Selected options</h3><!-- 선택된 옵션 -->
				<?php
				if(!$option_item) {
					if(!$it['it_buy_min_qty']) {
						$it['it_buy_min_qty'] = 1;
					}
				?>
				<ul id="sit_opt_added">
					<li class="sit_opt_list">
						<input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
						<input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
						<input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
						<input type="hidden" class="io_price" value="0">
						<input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
						<div class="opt_name">
							<span class="sit_opt_subj"><?php echo $it['it_name']; ?></span>
						</div>
						<div class="opt_count">
							<label for="ct_qty_<?php echo $i; ?>" class="sound_only">Quantity</label><!-- 수량 -->
						   <button type="button" class="sit_qty_minus"><i class="fa fa-minus" aria-hidden="true"></i><span class="sound_only">-</span></button><!-- 감소 -->
							<input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="num_input" size="5">
							<button type="button" class="sit_qty_plus"><i class="fa fa-plus" aria-hidden="true"></i><span class="sound_only">+</span></button><!-- 증가 -->
							<span class="sit_opt_prc">$ +0</span>
						</div>
					</li>
				</ul>
				<script>
				$(function() {
					price_calculate();
				});
				</script>
				<?php } ?>
			</section>
			<!-- } 선택된 옵션 끝 -->
			<!-- <h1>TEST :: <?php echo G5_THEME_MSHOP_PATH.'/mypage.php'; ?></h1> -->

			<!-- 총 구매액 -->
			<div id="sit_tot_price"></div>
			<?php } ?>

			<?php if($is_soldout) { ?><!-- 상품의 재고가 부족하여 구매할 수 없습니다. -->
			<p id="sit_ov_soldout">This item is not available for purchase.</p>
			<?php } ?>

			<?php
				$timer_use = 1;
				$dateTime = date("Y-m-d H:i:s");
				if($it['it_1'] > $dateTime || $it['it_1'] == '') {
                $timer_use = 1;
	            } else if($it['it_1'] <= $dateTime) {
	                $timer_use = 0;
	            }
			?>

			<?php if ($it['it_1_subj'] == 'on'): ?>
				<div id="d-day" class="px-2 py-1 border-box"></div>
				<script>
					var hotdealTime = '<?php echo $it["it_1"]; ?>';
					var hotdealID = '';
					hotdeal_timer(hotdealTime, hotdealID);
				</script>
			<?php endif ?>

			<div id="sit_ov_btn" class="d-flex mt-5">
				<?php if ($is_orderable) { ?>
				<button type="submit" onclick="document.pressed=this.value;" value="바로구매" id="sit_btn_buy"<?php echo ($timer_use == 0) ? ' disabled' : ''; ?> class="px-3"><i class="fa fa-credit-card" aria-hidden="true"></i> Buy now</button>
				<button type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart"<?php echo ($timer_use == 0) ? ' disabled' : ''; ?>><i class="fa fa-shopping-cart" aria-hidden="true"></i>Add to cart</button>
				<?php } ?>
				<?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
				<a href="javascript:popup_stocksms('<?php echo $it['it_id']; ?>');" id="sit_btn_alm"><i class="fa fa-bell-o" aria-hidden="true"></i> Stock reminder</a><!-- 재입고알림 -->
				<?php } ?>
				<!-- BIGIN :: included in wishlist item on add class -->
				<?php
				$wish_class = '';
				if($wish_cnt > 0) {
					$wish_class = ' class="included-in-wishlist"';
				}
				?>
				<a href="javascript:item_wish(document.fitem, '<?php echo $it['it_id']; ?>', <?php echo $wish_cnt; ?>);" id="sit_btn_wish"<?php echo $wish_class; ?>><i class="fa fa-heart-o" aria-hidden="true"></i><span class="sound_only">Wish list</span></a><!-- 위시리스트 -->
				<!-- BIGIN :: included in wishlist item on add class -->
				<?php if ($naverpay_button_js) { ?>
				<div class="itemform-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
				<?php } ?>
			</div>

			<script>
			// 상품보관
			function item_wish(f, it_id, wish_chk)
			{
				f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id+"&wish_chk="+wish_chk;
				f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
				f.submit();
			}

			// 추천메일
			function popup_item_recommend(it_id)
			{
				if (!g5_is_member)
				{
					if (confirm("Only members can recommend."))//회원만 추천하실 수 있습니다.
						document.location.href = "<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo urlencode(G5_SHOP_URL."/item.php?it_id=$it_id"); ?>";
				}
				else
				{
					url = "./itemrecommend.php?it_id=" + it_id;
					opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
					popup_window(url, "itemrecommend", opt);
				}
			}

			// 재입고SMS 알림
			function popup_stocksms(it_id)
			{
				url = "<?php echo G5_SHOP_URL; ?>/itemstocksms.php?it_id=" + it_id;
				opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
				popup_window(url, "itemstocksms", opt);
			}
			</script>
		</section>
		<!-- } 상품 요약정보 및 구매 끝 -->
	</div>
</form>

<script>
$(function(){
	// 상품이미지 첫번째 링크
	$("#sit_pvi_big a:first").addClass("visible");

	// 상품이미지 미리보기 (썸네일에 마우스 오버시)
	$("#sit_pvi .img_thumb").bind("mouseover focus", function(){
		var idx = $("#sit_pvi .img_thumb").index($(this));
		$("#sit_pvi_big a.visible").removeClass("visible");
		$("#sit_pvi_big a:eq("+idx+")").addClass("visible");
	});

	// 상품이미지 크게보기
	$(".popup_item_image").click(function() {
		var url = $(this).attr("href");
		var top = 10;
		var left = 10;
		var opt = 'scrollbars=yes,top='+top+',left='+left;
		popup_window(url, "largeimage", opt);

		return false;
	});
});

function fsubmit_check(f)
{
	// 판매가격이 0 보다 작다면
	if (document.getElementById("it_price").value < 0) {
		//전화로 문의해 주시면 감사하겠습니다.
		alert("Please contact us by phone.");
		return false;
	}

	if($(".sit_opt_list").size() < 1) {
		//상품의 선택옵션을 선택해 주십시오.
		alert("Please select a product selection option.");
		return false;
	}

	var val, io_type, result = true;
	var sum_qty = 0;
	var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
	var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
	var $el_type = $("input[name^=io_type]");

	$("input[name^=ct_qty]").each(function(index) {
		val = $(this).val();

		if(val.length < 1) {
			//수량을 입력해 주십시오.
			alert("Please enter the quantity.");
			result = false;
			return false;
		}

		if(val.replace(/[0-9]/g, "").length > 0) {
			//수량은 숫자로 입력해 주십시오.
			alert("Please enter the quantity as a number.");
			result = false;
			return false;
		}

		if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
			//수량은 1이상 입력해 주십시오.
			alert("Please input 1 or more quantity.");
			result = false;
			return false;
		}

		io_type = $el_type.eq(index).val();
		if(io_type == "0")
			sum_qty += parseInt(val);
	});

	if(!result) {
		return false;
	}

	if(min_qty > 0 && sum_qty < min_qty) {
		//선택옵션 개수 총합 xx 개 이상 주문해 주십시오.
		alert("Please select at least "+number_format(String(min_qty))+"items.");
		return false;
	}

	if(max_qty > 0 && sum_qty > max_qty) {
		// 선택옵션 개수 총합 xx 개 이하로 주문해 주십시오.
		alert("Number of options Please order a total of "+number_format(String(max_qty))+" or fewer.");
		return false;
	}

	return true;
}
// 바로구매, 장바구니 폼 전송
function fitem_submit(f)
{
	f.action = "<?php echo $action_url; ?>";
	f.target = "";

	if (document.pressed == "장바구니") {
		f.sw_direct.value = 0;
	} else { // 바로구매
		f.sw_direct.value = 1;
	}

	// 판매가격이 0 보다 작다면
	if (document.getElementById("it_price").value < 0) {
		//전화로 문의해 주시면 감사하겠습니다.
		alert("Please contact us by phone.");
		return false;
	}

	if($(".sit_opt_list").size() < 1) {
		//상품의 선택옵션을 선택해 주십시오.
		alert("Please select a product selection option.");
		return false;
	}

	var val, io_type, result = true;
	var sum_qty = 0;
	var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
	var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
	var $el_type = $("input[name^=io_type]");

	$("input[name^=ct_qty]").each(function(index) {
		val = $(this).val();

		if(val.length < 1) {
			// 수량을 입력해 주십시오.
			alert("Please enter the quantity.");
			result = false;
			return false;
		}

		if(val.replace(/[0-9]/g, "").length > 0) {
			// 수량은 숫자로 입력해 주십시오.
			alert("Please enter the quantity as a number.");
			result = false;
			return false;
		}

		if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
			// 수량은 1이상 입력해 주십시오.
			alert("Please input 1 or more quantity.");
			result = false;
			return false;
		}

		io_type = $el_type.eq(index).val();
		if(io_type == "0")
			sum_qty += parseInt(val);
	});

	if(!result) {
		return false;
	}

	if(min_qty > 0 && sum_qty < min_qty) {
		// 선택옵션 개수 총합 xx 개 이상 주문해 주십시오.
		alert("Please select at least "+number_format(String(min_qty))+"items.");
		return false;
	}

	if(max_qty > 0 && sum_qty > max_qty) {
		// 선택옵션 개수 총합 xx 개 이하로 주문해 주십시오.
		alert("Number of options Please order a total of "+number_format(String(max_qty))+"or fewer.");
		return false;
	}

	return true;
}
</script>
<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>
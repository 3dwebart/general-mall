<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
	global $g5;

	$sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
				where ca_use = '1' ";
	if($ca_id)
		$sql .= " and ca_id like '$ca_id%' ";
	$sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

	return $sql;
}
?>

<div id="category" class="menu">
	<button type="button" class="menu_close"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">카테고리닫기</span></button>
	<div class="menu_wr">
		<?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
			   
		<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
		<aside id="hd_sch">
			<div class="sch_inner">
				<h2>상품 검색</h2>
				<label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="form-control" placeholder="search term">
				<button type="submit" value="검색" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</div>
		</aside>
		</form>
		<script>
		function search_submit(f) {
			if (f.q.value.length < 2) {
				alert("Please enter at least two characters in the search term.");//검색어는 두글자 이상 입력하십시오.
				f.q.select();
				f.q.focus();
				return false;
			}

			return true;
		}

		</script>
		<style>
			.main-nav-btn {
				width: 40px;
				height: 40px;
				border: 1px solid #666666;
				padding: 5px;
				position: relative;
			}
			.main-nav-btn span {
				position: absolute;
				width: calc(100% - 20px);
				height: 1px;
				background-color: rgba(100,100,100,1);
				left: 10px;
				transition: all .5s ease;
			}
			.main-nav-btn span:nth-child(1) {
				top: 10px;
			}
			.main-nav-btn span:nth-child(2) {
				top: 50%;
			}
			.main-nav-btn span:nth-child(3) {
				bottom: 10px;
			}
			.main-nav-btn.on {
				transition: all .5s ease;
			}
			.main-nav-btn.on span:nth-child(1),
			.main-nav-btn.on span:nth-child(3) {
				left: 7px;
				width: calc(100% - 13px);
			}
			.main-nav-btn.on span:nth-child(1) {
				top: 18px;
				transform: rotateZ(45deg);
			}
			.main-nav-btn.on span:nth-child(2) {
				opacity: 0;
			}
			.main-nav-btn.on span:nth-child(3) {
				bottom: 18px;
				transform: rotateZ(-45deg);
			}
			.main-nav .cate {
				display: none;
			}
		</style>
		<div class="main-nav">
			<label for="main-nav-btn">
				<button class="main-nav-btn" id="main-nav-btn">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<span class="pl-2">MENU</span>
			</label>
			<ul class="cate">
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>">HOME</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">HIT item</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">Recommend item</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">New item</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">Bese item</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">Discount Item</a>
				</li>
				<li>
					<a href="<?php echo G5_SHOP_URL; ?>/mypage.php">My shop</a>
					<button class="sub_ct_toggle ct_op"></button>
					<ul class="sub_cate sub_cate1">
						<li>
							<a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a>
						</li>
						<li>
							<a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1 contact</a>
						</li>
						<li>
							<a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">Personal payment</a>
						</li>
						<li>
							<a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">Reviews</a>
						</li>
						<li>
							<a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">Coupon zone</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>

		<ul class="cate_tab">
			<li><a href="#cate_01" class="selected">Category</a></li>
			<li><a href="#cate_02">Mypage</a></li>
			<li><a href="#cate_03">Today's products</a></li>
		</ul>
		<ul class="content">
			<li id="cate_01"  class="con">
				<?php
				$mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
				$mshop_ca_res1 = sql_query(get_mshop_category('', 2));
				for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
					if($i == 0)
						echo '<ul class="cate">'.PHP_EOL;
				?>
					<li>
						<a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
						<?php
						$mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
						if(sql_num_rows($mshop_ca_res2))
							echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

						for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
							if($j == 0)
								echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
						?>
							<li>
								<a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
								<?php
								$mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
								if(sql_num_rows($mshop_ca_res3))
									echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

								for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
									if($k == 0)
										echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
								?>
									<li>
										<a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
										<?php
										$mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
										if(sql_num_rows($mshop_ca_res4))
											echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

										for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) {
											if($m == 0)
												echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
										?>
											<li>
												<a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>"><?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
												<?php
												$mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
												if(sql_num_rows($mshop_ca_res5))
													echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

												for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) {
													if($n == 0)
														echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
												?>
													<li>
														<a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>"><?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
													</li>
												<?php
												}

												if($n > 0)
													echo '</ul>'.PHP_EOL;
												?>
											</li>
										<?php
										}

										if($m > 0)
											echo '</ul>'.PHP_EOL;
										?>
									</li>
								<?php
								}

								if($k > 0)
									echo '</ul>'.PHP_EOL;
								?>
							</li>
						<?php
						}

						if($j > 0)
							echo '</ul>'.PHP_EOL;
						?>
					</li>
				<?php
				}

				if($i > 0)
					echo '</ul>'.PHP_EOL;
				else
					echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
				?>
			</li>
			<li id="cate_02" class="con">
				<ul id="hd_tnb" class="cate">
					<li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">Mypage</a></li>
					<li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">Order History</a></li>
					<li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">Coupon zone</a></li>
					<li class="bd"><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
					<li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1 contact</a></li>
					<li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">Personal payment</a></li>
					<li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">Discount products</a></li>
				</ul> 
			</li>
			<li id="cate_03" class="con"><?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?></li>
		</ul>
	</div>
	<div class="cate_bg"></div>
</div>
<script>
$(function (){

	$("button.sub_ct_toggle").on("click", function() {
		var $this = $(this);
		$sub_ul = $(this).closest("li").children("ul.sub_cate");

		if($sub_ul.size() > 0) {
			var txt = $this.text();

			if($sub_ul.is(":visible")) {
				txt = txt.replace(/닫기$/, "열기");
				$this
					.removeClass("ct_cl")
					.text(txt);
			} else {
				txt = txt.replace(/열기$/, "닫기");
				$this
					.addClass("ct_cl")
					.text(txt);
			}

			$sub_ul.toggle();
		}
	});


	$(".content li.con").hide();
	$(".content li.con:first").show();   
	$(".cate_tab li a").click(function(){
		var tab_link = $(this).attr("href");
		$(".cate_tab li a").removeClass("selected");
		$(this).addClass("selected");
		$(".content li.con").hide();
		//$($(this).attr("href")).show();
		$(tab_link).fadeIn();
		return false;
	});

	$(document).on('click', '.main-nav .main-nav-btn', function() {
		$(this).toggleClass('on');
		if($(this).hasClass('on') == true) {
			$(this).closest('.main-nav').find('.cate').stop().slideDown(500);
		} else {
			$(this).closest('.main-nav').find('.cate').stop().slideUp(500);
		}
	});
});
</script>

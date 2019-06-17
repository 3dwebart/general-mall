<?php
include_once('./_common.php');
include_once(G5_SHOP_PATH.'/settle_naverpay.inc.php');

// 보관기간이 지난 상품 삭제
cart_item_clean();

// cart id 설정
set_cart_id($sw_direct);

$s_cart_id = get_session('ss_cart_id');
// 선택필드 초기화
$sql = " UPDATE {$g5['g5_shop_cart_table']} SET ct_select = '0' WHERE od_id = '$s_cart_id' ";
sql_query($sql);

$cart_action_url = G5_SHOP_URL.'/cartupdate.php';

if (G5_IS_MOBILE) {
	include_once(G5_MSHOP_PATH.'/cart.php');
	return;
}

// 테마에 cart.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
	$theme_cart_file = G5_THEME_SHOP_PATH.'/cart.php';
	if(is_file($theme_cart_file)) {
		include_once($theme_cart_file);
		return;
		unset($theme_cart_file);
	}
}

$g5['title'] = 'Shopping cart';
include_once('./_head.php');
?>

<!-- 장바구니 시작 { -->
<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>

<div id="sod_bsk" class="od_prd_list">

	<form name="frmcartlist" id="sod_bsk_list" class="2017_renewal_itemform" method="post" action="<?php echo $cart_action_url; ?>">
	<div class="tbl_head03 tbl_wrap">
		<table>
		<thead>
		<tr>
			<th scope="col">
				<label for="ct_all" class="sound_only">All products</label>
				<input type="checkbox" name="ct_all" value="1" id="ct_all" checked="checked">
			</th>
			<th scope="col">Product name</th>
			<th scope="col">Total volume</th>
			<th scope="col">Price</th>
			<th scope="col">Point</th>
			<th scope="col">Shipping fee</th>
			<th scope="col">Sub Total</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$tot_point = 0;
		$tot_sell_price = 0;

		// $s_cart_id 로 현재 장바구니 자료 쿼리
		$sql = " SELECT a.ct_id,
						a.it_id,
						a.it_name,
						a.ct_price,
						a.ct_point,
						a.ct_qty,
						a.ct_status,
						a.ct_send_cost,
						a.it_sc_type,
						b.ca_id,
						b.ca_id2,
						b.ca_id3
				   FROM {$g5['g5_shop_cart_table']} a LEFT JOIN {$g5['g5_shop_item_table']} b ON ( a.it_id = b.it_id )
				  WHERE a.od_id = '$s_cart_id' ";
		$sql .= " GROUP BY a.it_id ";
		$sql .= " ORDER BY a.ct_id ";
		$result = sql_query($sql);

		$it_send_cost = 0;

		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			// 합계금액 계산
			$sql = " SELECT SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) AS price,
							SUM(ct_point * ct_qty) AS point,
							SUM(ct_qty) AS qty
						FROM {$g5['g5_shop_cart_table']}
						WHERE it_id = '{$row['it_id']}'
						  AND od_id = '$s_cart_id' ";
			$sum = sql_fetch($sql);

			if ($i==0) { // 계속쇼핑
				$continue_ca_id = $row['ca_id'];
			}

			$a1 = '<a href="./item.php?it_id='.$row['it_id'].'" class="prd_name"><b>';
			$a2 = '</b></a>';
			$image = get_it_image($row['it_id'], 80, 80);

			$it_name = $a1 . stripslashes($row['it_name']) . $a2;
			$it_options = print_item_options($row['it_id'], $s_cart_id);
			if($it_options) {
				$mod_options = '<div class="sod_option_btn"><button type="button" class="mod_options">Edit selection</button></div>';
				$it_name .= '<div class="sod_opt">'.$it_options.'</div>';
			}

			// 배송비
			switch($row['ct_send_cost'])
			{
				case 1:
					$ct_send_cost = 'Cash on delivery';
					break;
				case 2:
					$ct_send_cost = 'free';
					break;
				default:
					$ct_send_cost = 'prepayment';
					break;
			}

			// 조건부무료
			if($row['it_sc_type'] == 2) {
				$sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $s_cart_id);

				if($sendcost == 0)
					$ct_send_cost = 'free';
			}

			$point      = $sum['point'];
			$sell_price = $sum['price'];
		?>

		<tr>
			<td class="td_chk">
				<label for="ct_chk_<?php echo $i; ?>" class="sound_only">product</label>
				<input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked">
			</td> 
			
			<td  class="td_prd">
				<div class="sod_img"><a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><?php echo $image; ?></a></div>
				<div class="sod_name">
					<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $row['it_id']; ?>">
					<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($row['it_name']); ?>">
					<?php echo $it_name.$mod_options; ?>
				</div>
			</td>
			<td class="td_num"><?php echo number_format($sum['qty']); ?></td>
			<td class="td_numbig text_right"><?php echo number_format($row['ct_price']); ?></td>
			<td class="td_numbig text_right"><?php echo number_format($point); ?></td>
			<td class="td_dvr"><?php echo $ct_send_cost; ?></td>
			<td class="td_numbig text_right"><span id="sell_price_<?php echo $i; ?>" class="total_prc">$<?php echo number_format(($sell_price * ratePrice()),4); ?></span></td>

		</tr>

		<?php
			$tot_point      += $point;
			$tot_sell_price += $sell_price;
		} // for 끝

		if ($i == 0) {
			echo '<tr><td colspan="8" class="empty_table">There are no products contained in the shopping cart.</td></tr>';
		} else {
			// 배송비 계산
			$send_cost = get_sendcost($s_cart_id, 0);
		}
		?>
		</tbody>
		</table>
		<div class="btn_cart_del">
			<button type="button" onclick="return form_check('seldelete');">Delete selected</button>
			<button type="button" onclick="return form_check('alldelete');">Empty</button>
		</div>
	</div>

	<?php
	$tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비
	if ($tot_price > 0 || $send_cost > 0) {
	?>
	<div id="sod_bsk_tot">
		<ul>
			<li class="sod_bsk_dvr">
				<span>Shipping fee</span>
				<strong>$<?php echo number_format(($send_cost*ratePrice()),4); ?></strong>
			</li>

			<li class="sod_bsk_pt">
				<span>Point</span>
				<strong><?php echo number_format($tot_point); ?></strong> point
			</li>

			<li class="sod_bsk_cnt">
				<span>Total price</span>
				<strong><?php echo number_format(($tot_price*ratePrice()),4); ?></strong> 원 
			</li>
		 
		</ul>
	</div>
	<?php } ?>

	<div id="sod_bsk_act" class="mb-5">
		<?php if ($i == 0) { ?>
		<a href="<?php echo G5_SHOP_URL; ?>/" class="btn01">Continue Shopping</a>
		<?php } else { ?>
		<input type="hidden" name="url" value="./orderform.php">
		<input type="hidden" name="records" value="<?php echo $i; ?>">
		<input type="hidden" name="act" value="">
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $continue_ca_id; ?>" class="btn01">Continue Shopping</a>
		<button type="button" onclick="return form_check('buy');" class="btn_submit"><i class="fa fa-credit-card" aria-hidden="true"></i> Ordering</button>

		<?php if ($naverpay_button_js) { ?>
		<div class="cart-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
		<?php } ?>
		<?php } ?>
	</div>

	</form>

</div>

<script>
$(function() {
	var close_btn_idx;

	// 선택사항수정
	$(".mod_options").click(function() {
		var it_id = $(this).closest("tr").find("input[name^=it_id]").val();
		var $this = $(this);
		close_btn_idx = $(".mod_options").index($(this));

		$.post(
			"./cartoption.php",
			{ it_id: it_id },
			function(data) {
				$("#mod_option_frm").remove();
				$this.after("<div id=\"mod_option_frm\"></div>");
				$("#mod_option_frm").html(data);
				price_calculate();
			}
		);
	});

	// 모두선택
	$("input[name=ct_all]").click(function() {
		if($(this).is(":checked"))
			$("input[name^=ct_chk]").attr("checked", true);
		else
			$("input[name^=ct_chk]").attr("checked", false);
	});

	// 옵션수정 닫기
	$(document).on("click", "#mod_option_close", function() {
		$("#mod_option_frm").remove();
		$(".mod_options").eq(close_btn_idx).focus();
	});
	$("#win_mask").click(function () {
		$("#mod_option_frm").remove();
		$(".mod_options").eq(close_btn_idx).focus();
	});

});

function fsubmit_check(f) {
	if($("input[name^=ct_chk]:checked").length < 1) {
		//구매하실 상품을 하나이상 선택해 주십시오.
		alert("Please select one or more items to purchase.");
		return false;
	}

	return true;
}

function form_check(act) {
	var f = document.frmcartlist;
	var cnt = f.records.value;

	if (act == "buy")
	{
		if($("input[name^=ct_chk]:checked").length < 1) {
			//주문하실 상품을 하나이상 선택해 주십시오.
			alert("Please select one or more items to order.");
			return false;
		}

		f.act.value = act;
		f.submit();
	}
	else if (act == "alldelete")
	{
		f.act.value = act;
		f.submit();
	}
	else if (act == "seldelete")
	{
		if($("input[name^=ct_chk]:checked").length < 1) {
			// 삭제하실 상품을 하나이상 선택해 주십시오.
			alert("Please select one or more products to delete.");
			return false;
		}

		f.act.value = act;
		f.submit();
	}

	return true;
}
</script>
<!-- } 장바구니 끝 -->

<?php
include_once('./_tail.php');
?>
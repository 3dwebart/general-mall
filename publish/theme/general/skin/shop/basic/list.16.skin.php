<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>
<div class="container">
	<section class="sct_wrap mt-5 pb-4">
<!-- 상품진열 10 시작 { -->
<?php
switch ($this->list_mod) {
	case 1:
		$col_class = 'col-lg-12';
		break;
	case 2:
		$col_class = 'col-lg-6';
		break;
	case 3:
		$col_class = 'col-lg-4';
		break;
	case 4:
		$col_class = 'col-lg-3';
		break;
	case 5:
		$col_class = 'col-lg-20';
		break;
	case 6:
		$col_class = 'col-lg-2';
		break;
	case 12:
		$col_class = 'col-lg-1';
		break;
	default:
		$col_class = 'col-lg';
		break;
}
for ($i=1; $row=sql_fetch_array($result); $i++) {
	if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
		if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
		else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
		else $sct_last = '';
	} else { // 1줄 이미지 : 1개
		$sct_last = 'sct_clear';
	}

	$dateTime = date("Y-m-d H:i:s");
	$hotdeal_on    = $row['it_1_subj'];
	$hotdeal_time  = $row['it_1'];

	if ($i == 1) {
		if ($this->css) {
			echo "<ul class=\"row-5\">\n";
		} else {
			echo "<ul class=\"row-5\">\n";
		}
	}

	echo "<div class=\"{$col_class} item\">\n";

	echo "<div class=\"item-img\">\n";

	echo $this->it_1;
	if ($hotdeal_on == 'on') {
		echo '<div id="d-day'.$i.'" class="d-day"></div>';
?>
	<script>
	var hotdealTime = '<?php echo $row["it_1"]; ?>';
	var hotdealID = '<?php echo $i; ?>';
	hotdeal_timer(hotdealTime, hotdealID);
	</script>
<?php
	}

	$end_d_day = '';

	if($row['it_1'] <= $dateTime) {
		$end_d_day = ' class="end-d-day"';
	}

	if ($this->href) {
		echo "<a href=\"{$this->href}{$row['it_id']}\"{$end_d_day}>\n";
	}

	if ($this->view_it_img) {
		echo get_it_image_responsive($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
	}

	if ($this->href) {
		echo "</a>\n";
	}


	if ($this->view_sns) {
		$sns_top = $this->img_height + 10;
		$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
		$sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
		echo "<div class=\"item-sns\">";
		echo get_sns_share_link_2('facebook', $sns_url, $sns_title, 'facebook');
		echo get_sns_share_link_2('twitter', $sns_url, $sns_title, 'twitter');
		echo get_sns_share_link_2('instagram', $sns_url, 'barskorea', 'instagram');
		echo "</div>\n";
	}

	echo "</div>\n";

	if ($this->view_it_id) {
		echo "<div class=\"item-id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
	}

	if ($this->href) {
		echo "<div class=\"item-txt\"><a href=\"{$this->href}{$row['it_id']}\">\n";
	}

	if ($this->view_it_name) {
		echo stripslashes($row['it_name'])."\n";
	}

	if ($this->href) {
		echo "</a></div>\n";
	}

	/*
	if ($this->view_it_basic && $row['it_basic']) {
		echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
	}
	*/

	if ($this->view_it_cust_price || $this->view_it_price) {

		echo "<div class=\"sct_cost\">\n";

		if ($this->view_it_cust_price && $row['it_cust_price']) {
			// echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
			$cust_rate = ratePrice() * $row['it_cust_price'];
			echo "<span class=\"sct_discount cust-price\">$".number_format($cust_rate, 4)."</span>\n";
		}

		if ($this->view_it_price) {
			// echo display_price(get_price($row), $row['it_tel_inq'])."\n";
			$cust_rate = ratePrice() * $row['it_price'];
			echo "<span class=\"sct_discount\">$".number_format($cust_rate, 4)."</span>\n";
		}

		echo "</div>\n";

	}

	if ($this->view_it_icon) {
		echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
	}


	
	echo "</div>\n";
}

if ($i > 1) echo "</div>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->
	</section>
</div>
<script>
(function($) {
	jQuery('.end-d-day').on('click', function() {
		alert('The event has ended.');
		return false;
	});
})(jQuery);
</script>
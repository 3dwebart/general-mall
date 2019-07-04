<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>
<!-- 상품진열 10 시작 { -->
<?php
$ca_name = '';
if(empty($this->type)) {
	$ca_sql = "SELECT ca_id, ca_name, ca_1_subj, ca_1 FROM {$g5['g5_shop_category_table']} WHERE ca_id = '{$this->ca_id}'";
	$ca_row        = sql_fetch($ca_sql);
	$ca_id         = $ca_row['ca_id'];
	$ca_name       = $ca_row['ca_name'];
}

$type_header = '';
$type_header .= '<header class="slide-product-header py-2 px-4 mb-0 text-left">';
$type_header .= '<h2 class="list-type-title mb-0">';
if (empty($this->type)) {
	$type_header .= '<a href="'.G5_SHOP_URL.'/list.php?ca_id='.$ca_id.'">';
} else {
	$type_header .= '<a href="'.G5_SHOP_URL.'/listtype.php?type='.$this->type.'">';
}
$type_header .= '<span>';
switch ($this->type) {
	case 1:
		$type_header .= 'HIT PRODUCT';
		break;
	case 2:
		$type_header .= 'RECOMMENDATION PRODUCT';
		break;
	case 3:
		$type_header .= 'NEW PRODUCT';
		break;
	case 4:
		$type_header .= 'SALE PRODUCT';
		break;
	case 5:
		$type_header .= 'BEST PRODUCT';
		break;
	
	default:
		$type_header .= $ca_name;
		break;
}
$type_header .= '</span>';
$type_header .= '</a>';
$type_header .= '</h2>';
$type_header .= '</header>';

echo $type_header;

echo "<!-- Slider main container -->";
echo "<div id=\"slide-{$this->type}\" class=\"swiper-container slide-{$this->type}\">";
echo "<!-- Additional required wrapper -->";
echo "<div class=\"swiper-wrapper item-wrap\">";
for ($i=1; $row=sql_fetch_array($result); $i++) {
	if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
		if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
		else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
		else $sct_last = '';
	} else { // 1줄 이미지 : 1개
		$sct_last = 'sct_clear';
	}

	$hotdeal_on    = $row['it_1_subj'];
	$hotdeal_time  = $row['it_1'];

	if ($i == 1) {
		//echo "<div class=\"row-5\">\n";
	}

	echo "<div class=\"swiper-slide item\">\n";

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

	if ($this->href) {
		echo "<a href=\"{$this->href}{$row['it_id']}\">\n";
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

		echo "<div class=\"item-cost\">\n";

		if ($this->view_it_cust_price && $row['it_cust_price']) {
			// echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
			// echo "<span class=\"sct_discount\">".number_format(($row['it_cust_price'] * $priceRate), 4)."</span>\n";
			$cust_rate = ratePrice() * $row['it_cust_price'];
			echo "<span class=\"sct_discount cust-price\">$".number_format($cust_rate, 2)."</span>\n";
		}

		if ($this->view_it_price) {
			// echo display_price(get_price($row), $row['it_tel_inq'])."\n";
			$cust_rate = ratePrice() * $row['it_price'];
			echo "<span class=\"sct_discount\">$".number_format($cust_rate, 2)."</span>\n";
		}

		echo "</div>\n";

	}

	if ($this->view_it_icon) {
		echo "<div class=\"item-icon\">".item_icon($row)."</div>\n";
	}


	
	echo "</div>\n";
}

if ($i > 1) {
echo "</div>\n";
echo "<!-- If we need pagination -->\n";
echo "<div class=\"swiper-pagination\"></div>\n";

echo "<!-- If we need navigation buttons -->\n";
echo "<div class=\"swiper-button-prev\"></div>\n";
echo "<div class=\"swiper-button-next\"></div>\n";

echo "<!-- If we need scrollbar -->\n";
//echo "<div class=\"swiper-scrollbar\"></div>\n";
echo "</div>\n";
}

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->
<script>
var id = '<?php echo $this->type; ?>';
var no = '<?php echo $this->list_mod; ?>';
var count = Number(no);
var latestApp = new Swiper('.swiper-container.slide-' + id, {
    pagination:'.slide-' + id + ' .swiper-pagination',
    spaceBetween: 10, // margin-right value
    slidesPerView: count, // Number of items(1row)
    speed: 400,
    navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});
</script>
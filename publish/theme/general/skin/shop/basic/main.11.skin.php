<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 상품진열 10 시작 { -->
<?php
$type_header = '';
$type_header .= '<header class="slide-product-header p-4 mb-0">';
$type_header .= '<h2 class="list-type-title">';
$type_header .= '<a href="'.G5_SHOP_URL.'/listtype.php?type='.$this->type.'">';
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
		$type_header .= '';
		break;
}
$type_header .= '</a>';
$type_header .= '</h2>';
$type_header .= '</header>';

echo $type_header;
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

	if ($i == 1) {
		if ($this->css) {
			echo "<div class=\"row-5\">\n";
		} else {
			echo "<div class=\"row-5\">\n";
		}
	}

	echo "<div class=\"{$col_class} item\">\n";

	echo "<div class=\"item-img\">\n";

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
			echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
		}

		if ($this->view_it_price) {
			echo display_price(get_price($row), $row['it_tel_inq'])."\n";
		}

		echo "</div>\n";

	}

	if ($this->view_it_icon) {
		echo "<div class=\"item-icon\">".item_icon($row)."</div>\n";
	}


	
	echo "</div>\n";
}

if ($i > 1) echo "</div>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->
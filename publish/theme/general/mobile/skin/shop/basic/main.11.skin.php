<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
	// 사용할 앱의 Javascript 키를 설정해 주세요.
	Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<!-- 메인상품진열 10 시작 { -->
<?php
switch ($this->list_mod) {
	case 1:
		$col_class = 'col-12';
		break;

	case 2:
		$col_class = 'col-6';
		break;

	case 3:
		$col_class = 'col-4';
		break;

	case 4:
		$col_class = 'col-3';
		break;

	case 5:
		$col_class = 'col-20';
		break;

	case 6:
		$col_class = 'col-2';
		break;

	case 12:
		$col_class = 'col-1';
		break;

	default:
		$col_class = 'col';
		break;
}

$li_width = intval(100 / $this->list_mod);
$li_width_style = ' style="width:'.$li_width.'%;"';

for ($i=0; $row=sql_fetch_array($result); $i++) {
	

	if ($i == 0) {
		echo "<div class=\"row-10\">";
		/*
		if ($this->css) {
			echo "<ul class=\"{$this->css}\">\n";
		} else {
			echo "<ul class=\"sct sct_10\">\n";
		}
		*/
	}

	/*
	if($i % $this->list_mod == 0)
		$li_clear = ' sct_clear';
	else
		$li_clear = '';
	*/

	echo "<div class=\"{$col_class} list-item text-center pb-3\">\n";
	echo "<div class=\"li_wr\">\n";

	if ($this->href) {
		echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\">\n";
	}

	if ($this->view_it_img) {
		echo get_it_image_responsive($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
	}

	if ($this->href) {
		echo "</a></div>\n";
	}


	if ($this->view_it_id) {
		echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
	}

	if ($this->href) {
		echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
	}

	if ($this->view_it_name) {
		echo stripslashes($row['it_name'])."\n";
	}

	if ($this->href) {
		echo "</a></div>\n";
	}

	if ($this->view_it_price) {
		echo "<div class=\"sct_cost\">\n";
		echo display_price(get_price($row), $row['it_tel_inq'])."\n";
		echo "</div>\n";
	}
	/*

	if ($this->view_it_icon) {
		echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
	}

	
	if ($this->view_sns) {
		$sns_top = $this->img_height + 10;
		$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
		$sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
		echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
		echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
		echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
		echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
		echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
		echo "</div>\n";
	}
	*/

	echo "</div>\n";
	echo "</div>\n"; // END col-XX
}

if ($i > 0) echo "</div>\n"; // END row

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

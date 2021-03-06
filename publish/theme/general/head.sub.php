<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!isset($g5['title'])) {
	$g5['title'] = $config['cf_title'];
	$g5_head_title = $g5['title'];
}
else {
	$g5_head_title = $g5['title']; // 상태바에 표시될 제목
	$g5_head_title .= " | ".$config['cf_title'];
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
	$g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php
if (G5_IS_MOBILE) {
	echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
	echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
	echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
	echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.PHP_EOL;
}

if($config['cf_add_meta'])
	echo $config['cf_add_meta'].PHP_EOL;
?>
<title><?php echo $g5_head_title; ?></title>
<?php
$shop_css = '';
if (defined('_SHOP_')) $shop_css = '_shop';
echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css?ver='.G5_CSS_VER.'">'.PHP_EOL;
?>
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL ?>/css/swiper.min.css">
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL ?>/css/lnr.css">
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL ?>/css/common.css">
<link rel="stylesheet" href="<?php echo G5_ASSETS_URL ?>/css/custom.css">
<?php
if(G5_IS_MOBILE) {
	echo '<link rel="stylesheet" href="'.G5_ASSETS_URL.'/css/m-custom.css">';
}
?>
<script src="<?php echo G5_ASSETS_URL ?>/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo G5_ASSETS_URL ?>/js/bootstrap.bundle.min.js"></script>
<?php
if (defined('_SHOP_')) {
	if(!G5_IS_MOBILE) {
?>
<script src="<?php echo G5_JS_URL ?>/jquery.shop.menu.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php
	}
} else {
?>
<script src="<?php echo G5_JS_URL ?>/jquery.menu.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>
<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/placeholders.min.js"></script>
<script src="<?php echo G5_ASSETS_URL ?>/js/swiper.min.js"></script>
<script>
function hotdeal_timer(time, id) {
	//디데이 종료 일자 설정
	var countDownDate = new Date(time).getTime();
	var countDownDateNo = 0;
	var time2 = 'Iphones';
	if(Number.isNaN(countDownDate)) {
		time2 = time.replace(' ', 'T') + 'Z';
		countDownDate = new Date(time2).getTime();
	}
	
	//1초마다 갱신되도록 함수 생성,실행
	var x = setInterval(function() {
		// 오늘 날짜 등록 
		var now = new Date().getTime();
		// 종료일자에서 현재일자를 뺀 시간
		var distance = Number(countDownDate) - Number(now);
		// 각 변수에 일, 시, 분, 초를 등록
		var d = Math.floor(distance / (1000 * 60 * 60 * 24));
		if(time2 != 'Iphones') {
			var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) - 9);
		} else {
			var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		}
		
		var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var s = Math.floor((distance % (1000 * 60)) / 1000);
		
		function zeroTime(v) {
			if(v > 9) {
				return v;
			} else if(v < 10) {
				var zeroTimer = '0' + v;
				return zeroTimer;
			}
		}
		//id가 d-day인 HTML코드에 내용 삽입
		//var message = '디데이까지 ';
		var message = '';
		if(d < 1) {
			message += '';
		} else {
			message += d + " days ";
		}

		var returnLine = (id == '') ? '' : '<br />';

		if(h < 1) {
			if(d < 1) {
				message += '';
			} else {
				message += zeroTime(h) + " hours " + returnLine;
			}
		} else {
			message += zeroTime(h) + " hours " + returnLine;
		}
		if(m < 1) {
			if(h < 1) {
				if(d < 1) {
					message += "";
				} else {
					message += zeroTime(m) + " minutes ";
				}
			} else {
				message += zeroTime(m) + " minutes ";
			}
		} else {
			message += zeroTime(m) + " minutes ";
		}
		if(s < 1) {
			if (m < 1) {
				if (h < 1) {
					if (d < 1) {
						$('#d-day' + id).attr('disabled');
						message = "<span class='bold'>The event has ended.</span>";
					} else {
						message += zeroTime(s) + " seconds left."
					}
				} else {
					message += zeroTime(s) + " seconds left."
				}
			} else {
				message += zeroTime(s) + " seconds left."
			}
		} else {
			message += zeroTime(s) + " seconds left."
		}

		document.getElementById("d-day" + id).innerHTML = message;
	});
}
</script>
<link rel="stylesheet" href="<?php echo G5_JS_URL ?>/font-awesome/css/font-awesome.min.css">
<?php
if(G5_IS_MOBILE) {
	echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
	echo $config['cf_add_script'];
?>

<link rel=" shortcut icon" href="<?php echo G5_URL; ?>/favicon.ico">
<link rel="icon" href="<?php echo G5_URL; ?>/favicon.ico">
</head>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
<input type="hidden" name="priceRate" value="<?php echo $priceRate; ?>">
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
	$sr_admin_msg = '';
	if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
	else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
	else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

	echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
	echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>
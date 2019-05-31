<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
	include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
	return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
if(!defined('_INDEX_')):
?>
			</div>
			<!-- } 콘텐츠 끝 -->
		</div> <!-- / row -->
	</div> <!-- / container -->
	<?php endif; ?>
</div>
<!-- /Wrapper -->
<!-- 하단 시작 { -->
<div id="ft">
	<div class="ft_wr">
		<ul class="ft_ul">
			<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
			<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
			<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
			<li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li>
		</ul>
		
		<a href="<?php echo G5_SHOP_URL; ?>/" id="ft_logo"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img2" alt="처음으로"></a>

		<div class="ft_info">
			<span class="d-block"><b>Company name</b> <?php echo $default['de_admin_company_name']; ?></span>
			<span class="d-block"><b>Business address</b> <?php echo $default['de_admin_company_addr']; ?></span>
			<span class="d-block">
				<span><b>Business number</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
				<span><b>CEO</b> <?php echo $default['de_admin_company_owner']; ?></span>
			</span>
			<span class="d-block">
				<span><b>Tel</b> <?php echo $default['de_admin_company_tel']; ?></span>
				<span><b>Fax</b> <?php echo $default['de_admin_company_fax']; ?></span>
			</span>
			<!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
			<span class="d-block"><b>Mail order sales report number</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
			<span class="d-block"><b>Privacy Officer</b> <?php echo $default['de_admin_info_name']; ?></span>

			<?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
			Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
		</div>

		<div class="ft_cs">
			<h2>Customer center</h2>
			<strong>02-123-1234</strong>
			<p><b>Mon-Fri</b> Korea time : am 09:00 - pm 05:00<br>Lunch hour : am 12:00 - pm 01:00</p>
		</div>
		<button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">Top</span></button>
		<script>
		
		$(function() {
			$("#top_btn").on("click", function() {
				$("html, body").animate({scrollTop:0}, '500');
				return false;
			});
		});
		</script>
	</div>


</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
	echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<script src="<?php echo G5_ASSETS_URL ?>/js/custom.js"></script>
<script>
var App = new Swiper('.swiper-container.main-slide', {
    speed: 400,
    spaceBetween: 0,
    navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	autoplay: {
		delay: 4000,
	},
	loop: true,
});
</script>
<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

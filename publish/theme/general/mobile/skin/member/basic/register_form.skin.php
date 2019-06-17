<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div>
	<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
	<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
	<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
	<?php } ?>

	<form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
	<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
	<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php } ?>

	<div class="form_01">
		<h2>Enter site usage information</h2>
		<div>
			<label for="reg_mb_id">ID<strong><span class="sound_only">필수</span></strong></label>
			<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="frm_input full_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20" <?php echo $required ?> <?php echo $readonly ?> placeholder="ID">
			<span id="msg_mb_id"></span>
			<span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
		</div>
		<div>
			<label for="reg_mb_password">Password<strong><span class="sound_only">필수</span></strong></label>
			<input type="password" name="mb_password" id="reg_mb_password" class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="Password">
		</div>
		<div>
			<label for="reg_mb_password_re">Password confirm<strong><span class="sound_only">필수</span></strong></label>
			<input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?>  placeholder="Password confirm">
		</div>
	</div>

	<div class="form_01">
		
		<h2>Enter personal information</h2>
		<div class="rgs_name_li">
			<label for="reg_mb_name">Name<strong><span class="sound_only">필수</span></strong></label>
			<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input full_input <?php echo $required ?> <?php echo $readonly ?>" placeholder="Name">
			<?php
			if($config['cf_cert_use']) {
				if($config['cf_cert_ipin'])
					echo '<button type="button" id="win_ipin_cert" class="btn_frmline btn">아이핀 본인확인</button>'.PHP_EOL;
				if($config['cf_cert_hp'])
					echo '<button type="button" id="win_hp_cert" class="btn_frmline btn">휴대폰 본인확인</button>'.PHP_EOL;

				echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
			}
			?>
			<?php
			if ($config['cf_cert_use'] && $member['mb_certify']) {
				if($member['mb_certify'] == 'ipin')
					$mb_cert = '아이핀';
				else
					$mb_cert = '휴대폰';
			?>
			<?php if ($config['cf_cert_use']) { ?>
			<span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
			<?php } ?>
			<div id="msg_certify">
				<strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
			</div>
			<?php } ?>
			
		</div>
		<?php if ($req_nick) { ?>
		<div>
			<label for="reg_mb_nick">Nic name<strong><span class="sound_only">필수</span></strong></label>
			
			<span class="frm_info">
				공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br>
				닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.
			</span>
			<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
			<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="frm_input full_input required nospace" maxlength="20" placeholder="Nic name">
			<span id="msg_mb_nick"></span>
			
		</div>
		<?php } ?>

		<div>
			<label for="reg_mb_email">E-mail<strong><span class="sound_only">필수</span></strong></label>
			
				<?php if ($config['cf_use_email_certify']) {  ?>
				<span class="frm_info">
					<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
					<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
				</span>
				<?php }  ?>
				<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
				<input type="email" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required" size="50" maxlength="100" placeholder="E-mail">
			
		</div>

		<?php if ($config['cf_use_homepage']) { ?>
		<div>
			<label for="reg_mb_homepage">Homepage<?php if ($config['cf_req_homepage']){ ?><strong><span class="sound_only">필수</span></strong><?php } ?></label>
			<input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" class="frm_input full_input <?php echo $config['cf_req_homepage']?"required":""; ?>" maxlength="255" <?php echo $config['cf_req_homepage']?"required":""; ?> placeholder="Homepage">
		</div>
		<?php } ?>

		<?php if ($config['cf_use_tel']) { ?>
		<div>
			<label for="reg_mb_tel">Telephone No.<?php if ($config['cf_req_tel']) { ?><strong><span class="sound_only">필수</span></strong><?php } ?></label>
			<input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" class="frm_input full_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20" <?php echo $config['cf_req_tel']?"required":""; ?> placeholder="Telephone No.">
		</div>
		<?php } ?>

		<?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
		<div>
			<label for="reg_mb_hp">Callphone No.<?php if ($config['cf_req_hp']) { ?><strong><span class="sound_only">필수</span></strong><?php } ?></label>
			
			<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input full_input <?php echo ($config['cf_req_hp'])?"required":""; ?>" maxlength="20" placeholder="Callphone No.">
			<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
			<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
			<?php } ?>
			
		</div>
		<?php } ?>

		<?php if ($config['cf_use_addr']) { ?>
		<div>
			<label for="reg_mb_addr1">Address 1<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
			<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50" placeholder="Address 1">
		</div>
		<div>
			<label for="reg_mb_addr2">Address 2</label>
			<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50" placeholder="Address 2">
		</div>
		<div>
			<label for="reg_mb_addr3">City</label>
			<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" placeholder="City">
		</div>
		<div>
			<label for="reg_mb_addr4">State/Province/Region</label>
			<input type="text" name="mb_addr4" value="<?php echo get_text($member['mb_addr4']) ?>" id="reg_mb_addr4" class="frm_input frm_address" size="50" placeholder="State/Province/Region">
		</div>
		<div>
			<label for="reg_mb_addr_country">Country</label>
			<input type="text" name="mb_addr_country" value="<?php echo get_text($member['mb_addr_country']) ?>" id="reg_mb_addr_country" class="frm_input frm_address" size="50" placeholder="Country">
		</div>
		<div>
			<label for="reg_mb_zip">ZIP<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
			<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6" placeholder="ZIP Code">
		</div>
		<?php } ?>
	</div>

	<div class="form_01">
		
		<h2>Other personal settings</h2><!-- 기타 개인설정 -->
		<?php if ($config['cf_use_signature']) { ?>
		<div>
			<label for="reg_mb_signature" class="sound_only">signature<?php if ($config['cf_req_signature']){ ?><strong>필수</strong><?php } ?></label>
			<textarea name="mb_signature" id="reg_mb_signature" class="<?php echo $config['cf_req_signature']?"required":""; ?>" <?php echo $config['cf_req_signature']?"required":""; ?> placeholder="signature"><?php echo $member['mb_signature'] ?></textarea>
		</div>
		<?php } ?>

		<?php if ($config['cf_use_profile']) { ?>
		<div>
			<label for="reg_mb_profile" class="sound_only">About me</label>
			<textarea name="mb_profile" id="reg_mb_profile" class="<?php echo $config['cf_req_profile']?"required":""; ?>" <?php echo $config['cf_req_profile']?"required":""; ?> placeholder="About me"><?php echo $member['mb_profile'] ?></textarea>
		</div>
		<?php } ?>

		<?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) { ?>
		<div>
			<label for="reg_mb_icon" class="frm_label">Member icon</label>
			<input type="file" name="mb_icon" id="reg_mb_icon">
			<span class="frm_info">
				이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
				gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.
			</span>
			<?php if ($w == 'u' && file_exists($mb_icon_path)) { ?>
			<img src="<?php echo $mb_icon_url ?>" alt="Member icon">
			<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
			<label for="del_mb_icon">Delete</label>
			<?php } ?>
			
		</div>
		<?php } ?>

		<?php if ($member['mb_level'] >= $config['cf_icon_level'] && $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height']) {  ?>
		<div class="reg_mb_img_file">
			<label for="reg_mb_img" class="frm_label">회원이미지</label>
			<input type="file" name="mb_img" id="reg_mb_img" >
			<span class="frm_info">
				이미지 크기는 가로 <?php echo $config['cf_member_img_width'] ?>픽셀, 세로 <?php echo $config['cf_member_img_height'] ?>픽셀 이하로 해주세요.<br>
				gif, jpg, png파일만 가능하며 용량 <?php echo number_format($config['cf_member_img_size']) ?>바이트 이하만 등록됩니다.
			</span>
			<?php if ($w == 'u' && file_exists($mb_img_path)) {  ?>
			<img src="<?php echo $mb_img_url ?>" alt="회원아이콘">
			<input type="checkbox" name="del_mb_img" value="1" id="del_mb_img">
			<label for="del_mb_img">삭제</label>
			<?php }  ?>

		</div>
		<?php } ?>

		<div>
			<label for="reg_mb_mailling" class="frm_label">Mailing service</label>
			<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?>>I would like to receive an informational mail.<!-- 정보 메일을 받겠습니다. -->
			
		</div>

		<?php if ($config['cf_use_hp']) { ?>
		<div>
			<label for="reg_mb_sms" class="frm_label">SMS Reception<!-- 수신여부 --></label>
			
			<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?>>
				I will receive a text message on my cell phone.<!-- 휴대폰 문자메세지를 받겠습니다. -->
		</div>
		<?php } ?>

		<?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date'])) { // 정보공개 수정일이 지났다면 수정가능 ?>
		<div>
			<label for="reg_mb_open" class="frm_label">Info disclosure</label>
			<input type="checkbox" name="mb_open" value="1" id="reg_mb_open" <?php echo ($w=='' || $member['mb_open'])?'checked':''; ?>>
			I want others to see my information.<!-- 다른분들이 나의 정보를 볼 수 있도록 합니다. -->
			<span class="frm_info">
				If you change your disclosure, you will not be able to change it within the next <?php echo (int)$config['cf_open_modify'] ?> days.
				<?php/*
				정보공개를 바꾸시면 앞으로 <?php echo (int)$config['cf_open_modify'] ?>일 이내에는 변경이 안됩니다.
				*/?>
			</span>
			<input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open'] ?>">
			
		</div>
		<?php } else { ?>
		<div>
			<span  class="frm_label">Info disclosure</span>
			<input type="hidden" name="mb_open" value="<?php echo $member['mb_open'] ?>">
			
			<span class="frm_info">
				정보공개는 수정후 <?php echo (int)$config['cf_open_modify'] ?>일 이내, <?php echo date("Y년 m월 j일", isset($member['mb_open_date']) ? strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400:G5_SERVER_TIME+$config['cf_open_modify']*86400); ?> 까지는 변경이 안됩니다.<br>
				이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
			</span>
			
		</div>
		<?php } ?>

		<?php
		//회원정보 수정인 경우 소셜 계정 출력
		if( $w == 'u' && function_exists('social_member_provider_manage') ){
			social_member_provider_manage();
		}
		?>

		<?php if ($w == "" && $config['cf_use_recommend']) { ?>
		<div>
			<label for="reg_mb_recommend" class="sound_only">추천인아이디</label>
			<input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input full_input" placeholder="추천인아이디">
		</div>
		<?php } ?>

		<div class="is_captcha_use">
			<span  class="frm_label">Prevent auto-registration</span>
			<?php echo captcha_html(); ?>
		</div>
		
	</div>

	<div class="btn_top top">
		<a href="<?php echo G5_URL; ?>/" class="btn_cancel">Cancel</a>
		<input type="submit" value="<?php echo $w==''?'Sign up':'Edit info'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
	</div>
	</form>

	<script>
	$(function() {
		$("#reg_zip_find").css("display", "inline-block");

		<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
		// 아이핀인증
		$("#win_ipin_cert").click(function(e) {
			if(!cert_confirm())
				return false;

			var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
			certify_win_open('kcb-ipin', url, e);
			return;
		});

		<?php } ?>
		<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
		// 휴대폰인증
		$("#win_hp_cert").click(function(e) {
			if(!cert_confirm())
				return false;

			<?php
			switch($config['cf_cert_hp']) {
				case 'kcb':
					$cert_url = G5_OKNAME_URL.'/hpcert1.php';
					$cert_type = 'kcb-hp';
					break;
				case 'kcp':
					$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
					$cert_type = 'kcp-hp';
					break;
				case 'lg':
					$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
					$cert_type = 'lg-hp';
					break;
				default:
					echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
					echo 'return false;';
					break;
			}
			?>

			certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>", e);
			return;
		});
		<?php } ?>
	});

	// 인증체크
	function cert_confirm()
	{
		var val = document.fregisterform.cert_type.value;
		var type;

		switch(val) {
			case "ipin":
				type = "아이핀";
				break;
			case "hp":
				type = "휴대폰";
				break;
			default:
				return true;
		}

		if(confirm("이미 "+type+"으로 본인확인을 완료하셨습니다.\n\n이전 인증을 취소하고 다시 인증하시겠습니까?"))
			return true;
		else
			return false;
	}

	// submit 최종 폼체크
	function fregisterform_submit(f)
	{
		// 회원아이디 검사
		if (f.w.value == "") {
			var msg = reg_mb_id_check();
			if (msg) {
				alert(msg);
				f.mb_id.select();
				return false;
			}
		}

		if (f.w.value == '') {
			if (f.mb_password.value.length < 3) {
				alert('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password.focus();
				return false;
			}
		}

		if (f.mb_password.value != f.mb_password_re.value) {
			alert('비밀번호가 같지 않습니다.');
			f.mb_password_re.focus();
			return false;
		}

		if (f.mb_password.value.length > 0) {
			if (f.mb_password_re.value.length < 3) {
				alert('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password_re.focus();
				return false;
			}
		}

		// 이름 검사
		if (f.w.value=='') {
			if (f.mb_name.value.length < 1) {
				alert('이름을 입력하십시오.');
				f.mb_name.focus();
				return false;
			}
		}

		<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
		// 본인확인 체크
		if(f.cert_no.value=="") {
			alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
			return false;
		}
		<?php } ?>

		// 닉네임 검사
		if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
			var msg = reg_mb_nick_check();
			if (msg) {
				alert(msg);
				f.reg_mb_nick.select();
				return false;
			}
		}

		// E-mail 검사
		if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
			var msg = reg_mb_email_check();
			if (msg) {
				alert(msg);
				f.reg_mb_email.select();
				return false;
			}
		}

		<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
		// 휴대폰번호 체크
		var msg = reg_mb_hp_check();
		if (msg) {
			alert(msg);
			f.reg_mb_hp.select();
			return false;
		}
		<?php } ?>

		if (typeof f.mb_icon != "undefined") {
			if (f.mb_icon.value) {
				if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
					alert("회원아이콘이 이미지 파일이 아닙니다.");
					f.mb_icon.focus();
					return false;
				}
			}
		}

		if (typeof f.mb_img != "undefined") {
			if (f.mb_img.value) {
				if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
					alert("회원이미지가 이미지 파일이 아닙니다.");
					f.mb_img.focus();
					return false;
				}
			}
		}

		if (typeof(f.mb_recommend) != 'undefined' && f.mb_recommend.value) {
			if (f.mb_id.value == f.mb_recommend.value) {
				alert('본인을 추천할 수 없습니다.');
				f.mb_recommend.focus();
				return false;
			}

			var msg = reg_mb_recommend_check();
			if (msg) {
				alert(msg);
				f.mb_recommend.select();
				return false;
			}
		}

		<?php echo chk_captcha_js(); ?>

		document.getElementById("btn_submit").disabled = "disabled";

		return true;
	}
	</script>
</div>
<?php
include_once('./_common.php');
$imgField = $_POST['to_data'];
$it_id = $_POST['it_id'];
$imgs = array();
$img_sql = "SELECT it_img1, it_img2, it_img3, it_img4, it_img5, it_img6, it_img7, it_img8, it_img9, it_img10 FROM {$g5['g5_shop_item_table']} WHERE it_id = '$it_id'";
$img_row = sql_fetch($img_sql);
for ($i = 0; $i < 10; $i++) {
	$img_no = $i + 1;
	if ($img_row['it_img'.$img_no] != '') {
		$imgs[$i] = array(
			'imgSrc' => $img_row['it_img'.$img_no],
			'imgField' => 'it_img'.$img_no
		);
	}
}
?>
<style>
.pop-bg {
	width: 100%;
	height: 100%;
	display: block;
	position: fixed;
}
.mfp-auto-cursor .mfp-content {
	min-height: 100%;
	display: flex;
	align-items: center;
}
.pop-wrap {
	display: flex;
	flex-direction: column;
	align-items: center;
	width: 100%;
	height: 100%;
	justify-content: center;
}
.pop-wrap .thumbnail,
.pop-wrap .large-image {
	max-width: 600px;
}
.pop-wrap .large-image {
	min-height: 600px;
	position: relative;
}
.pop-wrap .large-image img {
	display: none;
	opacity: 1;
	transition: all .5s ease;
}
.pop-wrap .large-image img.on {
	display: block;
	opacity: 1;
	transition: all .5s ease;
}
.pop-wrap .thumbnail img {
	opacity: .5;
	transition: all .5s ease;
}
.pop-wrap .thumbnail img.on {
	opacity: 1;
	transition: all .5s ease;
}
</style>
<div class="pop-bg"></div>
<div class="pop-wrap">
	<div class="large-image">
		<?php
			for ($i=0; $i < count($imgs); $i++) {
				$onClass = '';
				if ($imgField == $imgs[$i]['imgField']) {
					$onClass = ' on';
				}
		?>
		<img src="<?php echo G5_DATA_URL.'/item/'.$imgs[$i]['imgSrc']; ?>" alt="" class="img-fluid<?php echo $onClass; ?>" data-img-field="<?php echo $imgs[$i]['imgField']; ?>" />
		<?php
			}
		?>
	</div>
	<div class="thumbnail">
		<div class="row-2">
			<?php
				for ($i = 0; $i < count($imgs); $i++) {
					$onClass = '';
					if ($imgField == $imgs[$i]['imgField']) {
						$onClass = ' on';
					}
			?>
			<div class="col-3">
				<img src="<?php echo G5_DATA_URL.'/item/'.$imgs[$i]['imgSrc']; ?>" alt="" class="img-fluid<?php echo $onClass; ?>" data-img-field="<?php echo $imgs[$i]['imgField']; ?>" />
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>
<script>
(function($) {
	jQuery(document).on('click', '.thumbnail img', function() {
		jQuery(this).parent().siblings().find('img').removeClass('on');
		jQuery(this).addClass('on');
				
		var img_field = jQuery(this).data('img-field');
		jQuery('.large-image img').each(function() {
			if(jQuery(this).data('img-field') == img_field) {
				jQuery(this).siblings().removeClass('on');
				jQuery(this).addClass('on');
			}
		});

		jQuery(document).on('click', '.pop-bg', function() {
			var magnificPopup = $.magnificPopup.instance; // save instance in magnificPopup variable
			magnificPopup.close(); // Close popup that is currently opened
		});
	});
})(jQuery);
</script>
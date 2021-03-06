<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 쇼핑몰 카테고리 시작 { -->
<nav id="gnb">
<div class="row mx-lg-0">
	<h2>Shoppingmall category</h2>
	<button type="button" id="menu_open"><i class="fa fa-bars" aria-hidden="true"></i> Category</button>
	<ul id="gnb_1dul">
		<?php
		// 1단계 분류 판매 가능한 것만
		$hsql = " SELECT ca_1_subj, ca_1, ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE length(ca_id) = '2' AND ca_use = '1' AND ca_2 <> '1' ORDER BY ca_order, ca_id ";
		$hresult = sql_query($hsql);
		$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
		for ($i=0; $row=sql_fetch_array($hresult); $i++)
		{ // BIGIN :: Main category for
			$gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
			// 2단계 분류 판매 가능한 것만
			$sql2 = " SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE LENGTH(ca_id) = '4' AND SUBSTRING(ca_id,1,2) = '{$row['ca_id']}' AND ca_use = '1' AND ca_2 <> '1' ORDER BY ca_order, ca_id ";
			$result2 = sql_query($sql2);
			$count = sql_num_rows($result2);
		?>
		<li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex; ?>">
			<a href="<?php echo G5_SHOP_URL.'/list.php?ca_id='.$row['ca_id']; ?>" class="gnb_1da<?php if ($count) echo ' gnb_1dam'; ?>">
				<?php
					switch ($row['ca_1_subj']) {
						case 'awsome-icon':
							echo '<span class="nav-icon"><i class="fa '.$row['ca_1'].'"></i></span>';
							echo '<span class="pl-2">'.$row['ca_name'].'</span>';
						break;

						case 'lnr-icon':
							echo '<span class="nav-icon"><i class="lnr '.$row['ca_1'].'"></i></span>';
							echo '<span class="pl-2">'.$row['ca_name'].'</span>';
						break;
						
						case 'img-icon':
							$icon_img = G5_DATA_URL.'/cate-nav-icon/'.$row['ca_1'];
							echo '<span class="nav-icon"><img src="'.$icon_img.'" alt="'.$row['ca_1'].'" /></span>';
							echo '<span class="pl-2">'.$row['ca_name'].'</span>';
						break;

						default:
							echo '<span class="px-2">'.$row['ca_name'].'</span>';
						break;
					}
				?>
			</a>
			<?php
			for ($j=0; $row2=sql_fetch_array($result2); $j++) { // BIGIN :: Sub step 1 for
				if ($j==0) {
					echo '<ul class="gnb_2dul" style="z-index:'.$gnb_zindex.'">';
				}
				$sql3 = " SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE LENGTH(ca_id) = '6' AND SUBSTRING(ca_id,1,4) = '{$row2['ca_id']}' AND ca_use = '1' AND ca_2 <> '1' ORDER BY ca_order, ca_id ";
				$result3 = sql_query($sql3);
				$cnt3 = sql_num_rows($result3);
				$side2 = '';
				if ($cnt3 > 0) {
					$side2 = ' sub-menus';
				}
			?>
				<li class="gnb_2dli<?php echo $side2; ?>">
					<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $row2['ca_id']; ?>" class="gnb_2da">
						<?php echo $row2['ca_name']; ?>
					</a>
					<?php
					for ($k=0; $row3=sql_fetch_array($result3); $k++) { // BIGIN :: Sub step 1 for
						if($k == 0) {
							echo "<ul class=\"gnb_3dul\">";
						}
					?>
						<li class="gnb_3dli">
							<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $row3['ca_id']; ?>"><?php echo $row3['ca_name']; ?></a>
						</li>
					<?php
					} // END :: Sub step 2 for
					if ($k>0) {
						echo '</ul>';
					}
					?>
				</li>
			<?php
			} // END :: Sub step 1 for
				if ($j>0) {
					echo '</ul>';
				}
			?>
		</li>
		<?php } // END :: Nain category for ?>
	</ul>
</div>
</nav>
<!-- } 쇼핑몰 카테고리 끝 -->
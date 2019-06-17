<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="memo_write" class="new_win">
    <h1 id="win_title">Send a note</h1>

    <ul class="win_ul">
        <li><a href="./memo.php?kind=recv">Received note</a></li>
        <li><a href="./memo.php?kind=send">Sent note</a></li>
        <li><a href="./memo_form.php" class="selected">Write note</a></li>
    </ul>
    <form name="fmemoform" action="./memo_form_update.php" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
    <div class="form_01">
        <h2 class="sound_only">Write note</h2>
        <ul>
            <li>
                <label for="me_recv_mb_id" class="sound_only">Receiving Member ID<strong>Necessary</strong></label>
                
                <input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required class="frm_input required" placeholder="Receiving Member ID">
                <span class="frm_info">Separate multiple members with a comma (,).</span>
                <?php if ($config['cf_memo_send_point']) { ?>
                <br >
                <span class="frm_info">
                    When sending a note, we deduct <?php echo number_format($config['cf_memo_send_point']); ?> points per member.
                    <!-- 쪽지 보낼때 회원당 XXX점의 포인트를 차감합니다. -->
                </span>
                <?php } ?>
            </li>
            <li>
                <label for="me_memo" class="sound_only">Content</label>
                <textarea name="me_memo" id="me_memo" required><?php echo $content ?></textarea>
            </li>
            <li>
                <span class="sound_only">Prevent auto-registration</span>
                <?php echo captcha_html(); ?>
            </li>
        </ul>
    </div>

    <div class="win_btn">
        <input type="submit" value="Send" id="btn_submit" class="btn_submit">
        <button type="button" onclick="window.close();" class="btn_close m-btn">Close</button>
    </div>
    </form>
</div>

<script>
function fmemoform_submit(f)
{
    <?php echo chk_captcha_js(); ?>

    return true;
}
</script>

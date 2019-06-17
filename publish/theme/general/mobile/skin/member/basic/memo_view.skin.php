<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$nick = get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
if($kind == "recv") {
    $kind_str = "sent";
    $kind_date = "received";
}
else {
    $kind_str = "received";
    $kind_date = "sent";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="memo_view" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>

    <ul class="win_ul">
        <li><a href="./memo.php?kind=recv" class="selected">Received note</a></li>
        <li><a href="./memo.php?kind=send">Sent mote</a></li>
        <li><a href="./memo_form.php">Write note</a></li>
    </ul>
    <div class="new_win_con">
        <article id="memo_view_contents">
            <header>
                <h1>Contents of note</h1>
            </header>
            <ul id="memo_view_ul">
                <li class="memo_view_li">
                    <span class="memo_view_subj"><?php echo $kind_str == 'sent' ? 'sender' : 'Recipient'; ?></span>
                    <strong><?php echo $nick ?></strong>
                </li>
                <li class="memo_view_li">
                    <span class="memo_view_subj"><?php echo $kind_date == 'sent' ? 'Sent Time' : 'Time Received'; ?></span>
                    <strong><?php echo $memo['me_send_datetime'] ?></strong>
                </li>
            </ul>
            <p>
                <?php echo conv_content($memo['me_memo'], 0) ?>
            </p>
        </article>

        <div class="win_btn">
            <?php if ($kind == 'recv') { ?><a href="./memo_form.php?me_recv_mb_id=<?php echo $mb['mb_id'] ?>&amp;me_id=<?php echo $memo['me_id'] ?>" class="btn_submit">Reply</a><?php } ?>
            <?php if($prev_link) { ?>
            <a href="<?php echo $prev_link ?>" class="btn_b03 btn">Prev note</a>
            <?php } ?>
            <?php if($next_link) { ?>
            <a href="<?php echo $next_link ?>" class="btn_b03 btn">Next note</a>
            <?php } ?>
            <a href="<?php echo $list_link ?>" class="btn_b03 m-btn btn">List</a>
            <button type="button" onclick="window.close();" class="btn_close m-btn">Close</button>
        </div>
    </div>
</div>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="memo_list" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>

    <ul class="win_ul">
        <li><a href="./memo.php?kind=recv" class="<?php if ($kind == 'recv') {  ?>selected<?php }  ?>">Received note</a></li>
        <li><a href="./memo.php?kind=send" class="<?php if ($kind == 'send') {  ?>selected<?php }  ?>">Sent note</a></li>
        <li><a href="./memo_form.php">Write note</a></li>
    </ul>
    <div class="new_win_con">
        <div class="win_desc">
            <?php echo $total_count ?> full message <?php echo $kind_title ?><br>
        </div>

        <ul id="memo_list_ul">
            <?php for ($i=0; $i<count($list); $i++) { ?>
            <li>
                <a href="<?php echo $list[$i]['view_href'] ?>" class="memo_link"><?php echo $list[$i]['mb_nick'] ?></a>
                <span class="memo_date">
                    <?php echo $list[$i]['send_datetime'] ?><span class="sound_only"> 에 <?php echo  ($kind == "recv") ? "받은" : "보낸";  ?> 쪽지</span> - 
                    <?php echo $list[$i]['read_datetime'] ?>
                </span>
                <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="memo_del">Delete</a>
            </li>
            <?php } ?>
            <?php if ($i==0) { echo "<li class=\"empty_list\">No data available.</li>"; } ?>
        </ul>

        <!-- 페이지 -->
        <?php echo $write_pages; ?>

        <p class="win_desc">
            The maximum number of days to keep a note is <strong><?php echo $config['cf_memo_del'] ?></strong> days.
        </p>
        <div class="win_btn">
            <button type="button" onclick="window.close();" class="btn_close m-btn">Close</button>
        </div>
    </div>
</div>
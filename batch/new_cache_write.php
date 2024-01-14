<?php

/** 최근 게시물에 데이타를 캐싱 한다.
 *
 */


if (PHP_SAPI != 'cli') die("error!! only you can run cli mode");

if (php_sapi_name() == "cli") {
    // In cli-mode
} else {
    // Not in cli-mode
    die("Error. Not in cli-mode");
}

chdir(__DIR__);

include(dirname(__DIR__) . "/common.php");

function get_new_data($sql) {
    global $g5, $config;
    $result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];

        if ($row['wr_id'] == $row['wr_parent']) {

            // 원글
            $comment = "";
            $comment_link = "";
            $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
            $list[$i] = $row2;

            $name = apms_sideview($row2['mb_id'], get_text(cut_str($row2['wr_name'], $config['cf_cut_name'])), $row2['wr_email'], $row2['wr_homepage'], $row2['as_level']);
            // 당일인 경우 시간으로 표시함
            $wr_datetime = $row2['wr_datetime'];
            $datetime = substr($row2['wr_datetime'], 0, 180);
            $datetime2 = $row2['wr_datetime'];
            if ($datetime == G5_TIME_YMD) {
                $datetime2 = substr($datetime2, 11, 5);
            } else {
                $datetime2 = substr($datetime2, 5, 5);
            }

            $is_lock = false;
            if (strstr($row2['wr_option'], 'secret')) {
                $is_lock = true;
            } else if ($row2['as_shingo'] < 0) {
                $is_lock = true;
            }

        } else {

            // 코멘트
            $comment = '[코] ';
            $comment_link = '#c_' . $row['wr_id'];
            $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
            //print comment
            //$row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime, wr_comment_reply, wr_option, as_shingo, as_level, wr_5 from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
            $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime, wr_content, wr_option from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
            $list[$i] = $row2;
            $list[$i]['wr_id'] = $row['wr_id'];
            $list[$i]['mb_id'] = $row3['mb_id'];
            $list[$i]['wr_name'] = $row3['wr_name'];
            $list[$i]['wr_email'] = $row3['wr_email'];
            $list[$i]['wr_homepage'] = $row3['wr_homepage'];
            // secret comment
            if (strstr($row2['wr_option'], 'secret') || strstr($row3['wr_option'], 'secret')) {
                $row2['wr_subject'] = '비밀 댓글입니다.';
            } else {
                $row2['wr_subject'] = $row3['wr_content'];
            }
            $list[$i]['reply_name'] = ($row3['wr_comment_reply'] && $row3['wr_5']) ? $row3['wr_5'] : '';

            $name = apms_sideview($row3['mb_id'], get_text(cut_str($row3['wr_name'], $config['cf_cut_name'])), $row3['wr_email'], $row3['wr_homepage'], $row3['as_level']);
            // 당일인 경우 시간으로 표시함
            $wr_datetime = $row3['wr_datetime'];
            $datetime = substr($row3['wr_datetime'], 0, 10);
            $datetime2 = $row3['wr_datetime'];
            if ($datetime == G5_TIME_YMD) {
                $datetime2 = substr($datetime2, 11, 5);
            } else {
                $datetime2 = substr($datetime2, 5, 5);
            }

            $is_lock = false;
            if (strstr($row2['wr_option'], 'secret')) {
                $is_lock = true;
            } else if (strstr($row3['wr_option'], 'secret')) {
                $is_lock = true;
            } else if ($row3['as_shingo'] < 0) {
                $is_lock = true;
            }
        }

        $list[$i]['gr_id'] = $row['gr_id'];
        $list[$i]['bo_table'] = $row['bo_table'];
        $list[$i]['name'] = $name;
        $list[$i]['comment'] = $comment;
        $list[$i]['is_lock'] = $is_lock;
        $list[$i]['href'] = './board.php?bo_table=' . $row['bo_table'] . '&amp;wr_id=' . $row2['wr_id'] . $comment_link;
        $list[$i]['wr_datetime'] = $wr_datetime;
        $list[$i]['datetime'] = $datetime;
        $list[$i]['datetime2'] = $datetime2;

        $list[$i]['gr_subject'] = apms_get_text($row['gr_subject']);
        $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
        $list[$i]['bo_subject'] = apms_get_text($list[$i]['bo_subject']);
        $list[$i]['wr_subject'] = apms_get_text($row2['wr_subject']);
    }

    print_r($list);
    return $list;
}

//위젯에서 사용하는 일부 캐시를 자동 저장 처리한다.
include_once(G5_LIB_PATH.'/RedisCache.class.php');

$cache_sql[] = "select a.*, b.bo_subject, b.bo_mobile_subject, c.gr_subject, c.gr_id  from g5_board_new a, g5_board b, g5_group c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and b.bo_use_search <> '0' and b.bo_use_search <= '4' and c.as_show <> '0'  and a.wr_id <> a.wr_parent   order by a.bn_id desc  limit 0, 15";


for($i = 0; $i < count($cache_sql); $i++) {
    $redis_cache_key = "new_cached:".hash("md5", $cache_sql[$i]);
    echo $redis_cache_key."\n";

    //$data = get_new_data($cache_sql[$i]);

}


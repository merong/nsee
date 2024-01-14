<?php

/**
 * 위젯 데이타를 캐싱한다.
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
include_once(G5_LIB_PATH.'/apms.lib.php');


/**
 * 위젯 데이타 추출. 아미나 코드에서 동일한 코드로 사용. 데이타만 추출
 * @param $arr
 * @return array
 */
function apms_board_rows_custom($arr) {
    global $g5, $member, $demo_config, $is_demo;

    $list = array();

    //정리
    $mode = 'post';
    $sql_mode1 = 0;
    $sql_mode2 = "wr_parent = wr_id";
    $sql_mode3 = "";
    $sql_mode4 = "as_secret = 0";
    $post = (isset($arr['comment']) && $arr['comment']) ? $arr['comment'] : '';
    if($post == "1") {
        $mode = 'comment';
        $sql_mode1 = 1;
        $sql_mode2 = "wr_parent <> wr_id";
    }


    $rows = (isset($arr['rows']) && $arr['rows'] > 0) ? $arr['rows'] : 7;
    $page = (isset($arr['page']) && $arr['page'] > 1) ? $arr['page'] : 1;
    $newtime = (isset($arr['newtime']) && $arr['newtime'] > 0) ? $arr['newtime'] : 24;
    $thumb_w = (isset($arr['thumb_w']) && $arr['thumb_w'] > 0) ? $arr['thumb_w'] : 0;
    $thumb_h = (isset($arr['thumb_h']) > 0) ? $arr['thumb_h'] : 0;
    $thumb_no = (isset($arr['thumb_no']) && $arr['thumb_no']) ? true : false;
    $img_rows = (isset($arr['img_rows']) && $arr['img_rows'] > 0) ? $arr['img_rows'] : 0;
    $no_img = (isset($arr['no_img']) && $arr['no_img']) ? $arr['no_img'] : '';
    $dayterm = (isset($arr['dayterm']) && $arr['dayterm'] > 0) ? $arr['dayterm'] : 0;
    $term = (isset($arr['term']) && $arr['term']) ? $arr['term'] : '';
    $term = ($term == 'day' && $dayterm > 0) ? $dayterm : $term;
    $sort = (isset($arr['sort']) && $arr['sort']) ? $arr['sort'] : '';
    $except = (isset($arr['except']) && $arr['except']) ? true : false;
    $gr_list = (isset($arr['gr_list']) && $arr['gr_list']) ? apms_escape_string($arr['gr_list']) : '';
    $bo_list = (isset($arr['bo_list']) && $arr['bo_list']) ? apms_escape_string($arr['bo_list']) : '';
    $ca_list = (isset($arr['ca_list']) && $arr['ca_list']) ? apms_escape_string($arr['ca_list']) : '';
    $bo_table = ($gr_list) ? apms_group_board($gr_list) : $bo_list;
    $sql_main = (isset($arr['main']) && $arr['main']) ? "and as_type = '".apms_escape_string($arr['main'])."'" : "";
    $sql_image = '';
    if(isset($arr['image']) && $arr['image'] > 0) {
        if($arr['image'] == "1") {
            $sql_image = "and as_list in ('1','3')";
        } else if($arr['image'] == "2") {
            $sql_image = "and as_list in ('2','3')";
        } else if($arr['image'] == "3") {
            $sql_image = "and as_list = '3'";
        } else if($arr['image'] == "4") {
            $sql_image = "and as_list = '0'";
        }
    }

    if($sort == 'rdm') { //정렬을 랜덤으로 하는 경우는 뒷페이지 조회 없음.
        $arr['page'] = 1;
    }

    // 비디오
    $sql_vid = "";
    if(isset($arr['vid']) && $arr['vid']) {
        $sql_vid = ($arr['vid'] == "1") ? "and as_video <> ''" : "and as_video = '{$arr['vid']}'";
    }

    $sql_where = (isset($arr['where']) && $arr['where']) ? 'and '.$arr['where'] : '';
    $sql_orderby = (isset($arr['orderby']) && $arr['orderby']) ? $arr['orderby'].',' : '';

    $start_rows = 0;

    // 회원글
    $sql_mb = "";
    if(isset($arr['mb_list']) && $arr['mb_list']) {
        $sql_mb = (isset($arr['ex_mb']) && $arr['ex_mb']) ? "and find_in_set(mb_id, '{$arr['mb_list']}')=0" : "and find_in_set(mb_id, '{$arr['mb_list']}')";
    } else {
        $arr['mb'] = (isset($arr['mb']) && $arr['mb']) ? $arr['mb'] : '';
        $arr['mb_re'] = (isset($arr['mb_re']) && $arr['mb_re']) ? $arr['mb_re'] : '';
        if($arr['mb'] && $arr['mb_re']) {
            $sql_mb = "and (mb_id = '{$member['mb_id']}' or as_re_mb = '{$member['mb_id']}')";
        } else if(!$arr['mb'] && $arr['mb_re']) {
            $sql_mb = "and as_re_mb = '{$member['mb_id']}'";
        } else if($arr['mb'] && !$arr['mb_re']) {
            $sql_mb = "and mb_id = '{$member['mb_id']}'";
        }
    }

    // 정렬(asc,hit,comment,good,nogood,poll,download,lucky,rdm)
    switch($sort) {
        case 'asc'			: $orderby1 = 'bn_id'; $orderby2 = 'wr_id'; break;
        case 'date'			: $orderby1 = 'bn_datetime desc'; $orderby2 = 'wr_datetime desc'; break;
        case 'hit'			: $orderby1 = 'as_hit desc'; $orderby2 = 'wr_hit desc'; break;
        case 'comment'		: $orderby1 = 'as_comment desc'; $orderby2 = 'wr_comment desc'; break;
        case 'good'			: $orderby1 = 'as_good desc'; $orderby2 = 'wr_good desc'; break;
        case 'nogood'		: $orderby1 = 'as_nogood desc'; $orderby2 = 'wr_nogood desc'; break;
        case 'like'			: $orderby1 = '(as_good - as_nogood) desc'; $orderby2 = '(wr_good - wr_nogood) desc'; break;
        case 'download'		: $orderby1 = 'as_download desc'; $orderby2 = 'as_download desc'; break;
        case 'link'			: $orderby1 = 'as_link desc'; $orderby2 = '(wr_link1_hit + wr_link2_hit) desc'; break;
        case 'poll'			: $orderby1 = 'as_poll desc'; $orderby2 = 'as_poll desc'; break;
        case 'lucky'		: $orderby1 = 'as_lucky desc'; $orderby2 = 'as_lucky desc'; break;
        case 'update'		: $orderby1 = 'as_update desc'; $orderby2 = 'as_update desc'; break;
        case 'rdm'			: $orderby1 = 'rand()'; $orderby2 = 'rand()'; $arr['page'] = 1; $page = 1; break;
        default				: $orderby1 = 'bn_id desc'; $orderby2 = 'wr_id desc'; break;
    }

    //데모
    if($is_demo) {
        if(!$bo_table && isset($demo_config['bo_table']) && $demo_config['bo_table']) $bo_table = $demo_config['bo_table'];
    }


    // 게시판아이디 체크
    $board_cnt = explode(",", $bo_table);

    if(!$bo_table || count($board_cnt) > 1 || $except) { //복수
        $sql_term = apms_sql_term($term, 'bn_datetime'); // 기간(일수,today,yesterday,month,prev)
        $sql_find = '';
        if($bo_table) {
            $sql_find = ($except) ? "and find_in_set(bo_table, '{$bo_table}')=0" : "and find_in_set(bo_table, '{$bo_table}')";
        }

        if($post == "2") {
            $sql_mode3 = "and as_reply = ''";
        } else if($post == "3") {
            $sql_mode3 = "and as_reply <> ''";
        } else if($post == "4") {
            $sql_mode3 = "and as_extra = '1'";
        } else if($post == "5") {
            $sql_mode3 = "and as_extra = '2'";
        } else if($post == "6") {
            $sql_mode3 = "and as_extra = '3'";
        }

        $sql_mode4 = "and as_secret = 0";

        $sql_common = "from {$g5['board_new_table']} where $sql_mode2 $sql_mode3 $sql_mode4 $sql_find $sql_term $sql_main $sql_image $sql_mb $sql_vid $sql_where";
        //syslog(LOG_INFO, __FILE__." LINE : ".__LINE__." ".__FUNCTION__." sql_common : ".$sql_common."\n");
        if($page > 1) {
            $total = sql_fetch("select /* batch */ count(*) as cnt $sql_common ", false);
            $total_count = $total['cnt'];
            $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
            $start_rows = ($page - 1) * $rows; // 시작 열을 구함
        }
        $result = sql_query(" select /* batch */ *  $sql_common order by $sql_orderby $orderby1 limit $start_rows, $rows ", false);

        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];

            $post = sql_fetch(" select /* batch */ * from $tmp_write_table where wr_id = '{$row['wr_id']}' ", false);

            $post['is_thumb_no'] = $thumb_no;
            $post['img_rows'] = $img_rows;
            $post['no_img'] = $no_img;

            $list[$i] = thema_widget_write_list($mode, $row['bo_table'], $post, $newtime, $thumb_w, $thumb_h, false, true);
        }
    } else { //단수
        $sql_term = apms_sql_term($term, 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)
        $sca_query = "";
        if($ca_list) {
            $sca_query = (isset($arr['ex_ca']) && $arr['ex_ca']) ? "and find_in_set(ca_name, '{$ca_list}')=0" : "and find_in_set(ca_name, '{$ca_list}')";
        }

        if($post == "2") {
            $sql_mode3 = "and wr_reply = ''";
        } else if($post == "3") {
            $sql_mode3 = "and wr_reply <> ''";
        } else if($post == "4") {
            $sql_mode3 = "and as_extra = '1'";
        } else if($post == "5") {
            $sql_mode3 = "and as_extra = '2'";
        } else if($post == "6") {
            $sql_mode3 = "and as_extra = '3'";
        }

        $sql_mode4 = "and FIND_IN_SET('secret',  wr_option) = 0 ";

        $tmp_write_table = $g5['write_prefix'] . $bo_table;
        $sql_common = "from $tmp_write_table where wr_is_comment = '{$sql_mode1}' $sql_mode3 $sql_mode4 $sca_query $sql_term $sql_main $sql_image $sql_mb $sql_vid $sql_where";
        if($page > 1) {
            $total = sql_fetch("select /* batch */ count(*) as cnt $sql_common ", false);
            $total_count = $total['cnt'];
            $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
            $start_rows = ($page - 1) * $rows; // 시작 열을 구함
        }
        $result = sql_query(" select /* batch */ * $sql_common order by $sql_orderby $orderby2 limit $start_rows, $rows ", false);
        for ($i=0; $post=sql_fetch_array($result); $i++) {

            $post['is_thumb_no'] = $thumb_no;
            $post['img_rows'] = $img_rows;
            $post['no_img'] = $no_img;

            $list[$i] = thema_widget_write_list($mode, $bo_table, $post, $newtime, $thumb_w, $thumb_h, false, true); //글가공
        }
    }

    return $list;
}


include_once(G5_LIB_PATH.'/RedisCache.class.php');
$cache = new RedisCache();

$sql = "select * from g5_redis_cache_key where origin_type='array' ";

echo $sql."\n";
$result = sql_query($sql);
$rows = [];
while( ($row = sql_fetch_array($result)) != null) {
    $rows[] = $row;
}

foreach($rows as $row) {
    $array_data = json_decode($row['origin_string'], true);

    $list = apms_board_rows_custom($array_data);

    $cache->set($row['redis_key'], $cache->serialize($list), 120);

    $sql = "update g5_redis_cache_key set update_datetime=now() where c_id={$row['c_id']}";
    sql_query($sql);
    echo $sql."\n";
}

syslog(LOG_INFO, __FILE__. " cronjob complete..");

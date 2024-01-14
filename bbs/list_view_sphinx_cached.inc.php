<?php

include_once(G5_LIB_PATH.'/SphinxSearch.class.php');

include_once(G5_LIB_PATH.'/RedisCache.class.php');
$cache = new RedisCache();

function get_prev_row($write_table, $write, $sca, $sfl, $stx, $sop)
{
    global $g5, $config, $cache;

    $param = [
        "forward" => "prev",
        "write_table" => $write_table,
        "write" => $write,
        "sca" => $sca,
        "sfl" => $sfl,
        "stx" => $stx,
        "sop" => $sop,
    ];

    $prev_redis_cache_key = "list_view_cached:" . hash("md5", json_encode($param));

    if ($cache->exists($prev_redis_cache_key)) {
        $prev = $cache->unserialize($cache->get($prev_redis_cache_key));
        return $prev;
    }

    if ($sca || $stx || $stx === '0') {
        $prev =  get_prev_search_row($write_table, $write, $sca, $sfl, $stx, $sop);
    } else {
        // 윗글을 얻음
        //$sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num < {$write['wr_num']}  order by wr_num desc limit 1 ";
        $wr_num_between_condition = " and wr_num between  " . ($write['wr_num'] - 10001) . " and " . ($write['wr_num'] - 1); //wr_num 만개 범위안에 있는것만 조회
        $sql = " select  /* list_view_sphinx_cached.inc.php */ wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 {$wr_num_between_condition}  order by wr_num desc limit 1 ";
        $prev = sql_fetch($sql);
    }

    $cache->set($prev_redis_cache_key, $cache->serialize($prev), 300);
    return $prev;

}

function get_next_row($write_table, $write, $sca, $sfl, $stx, $sop) {
    global $g5, $config, $cache;

    $param = [
        "forward" => "next",
        "write_table" => $write_table,
        "write" => $write,
        "sca" => $sca,
        "sfl" => $sfl,
        "stx" => $stx,
        "sop" => $sop,
    ];

    $next_redis_cache_key = "list_view_cached:" . hash("md5", json_encode($param));

    if ($cache->exists($next_redis_cache_key)) {
        $next = $cache->unserialize($cache->get($next_redis_cache_key));
        return $next;
    }

    if($sca || $stx || $stx === '0') {
        $next =  get_next_search_row($write_table, $write, $sca, $sfl, $stx, $sop);
    } else {
        // 아래글을 얻음
        //$sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num > {$write['wr_num']} order by wr_num asc limit 1 ";
        $wr_num_between_condition = " and wr_num between  " . ($write['wr_num'] + 1) . " and " . ($write['wr_num'] + 10001); //wr_num 만개 범위안에 있는것만 조회
        $sql = " select /* list_view_sphinx_cached.inc.php */ wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 {$wr_num_between_condition} order by wr_num asc limit 1 ";
        $next = sql_fetch($sql);
    }

    $cache->set($next_redis_cache_key, $cache->serialize($next), 300);
    return $next;
}

function get_prev_search_row($write_table, $write, $sca, $sfl, $stx, $sop) { //검색어가 있는 경우
    global $g5, $config, $cache;

    try {
        $sphinx = new SphinxSearch("", $write_table);
        $use_sphinx = true;
    } catch (Exception $e) {
        $use_sphinx = false;
    }

    if($use_sphinx && $sphinx->is_indexed_table($write_table)) {
        $wr_num_condition = " wr_num  <  {$write['wr_num']}";
        $sphinx->set_sql_search($sca, $sfl, $stx, $sop);
        $sphinx->add_where_condition($wr_num_condition);
        $sphinx->add_where_condition(" wr_is_comment = 0 ");
        $sql_order = "order by wr_num desc";
        $sphinx->search($write_table, $sql_order, 0, 1, 1);

        $items = $sphinx->get_items();
        if(count($items) > 0) {
            $row = sql_fetch(" select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_id = '{$items[0]['wr_id']}' ");
            return $row;
        }
    }
    return null;
}

function get_next_search_row($write_table, $write, $sca, $sfl, $stx, $sop) { //검색어가 있는 경우
    global $g5, $config, $cache;

    try {
        $sphinx = new SphinxSearch("", $write_table);
        $use_sphinx = true;
    } catch (Exception $e) {
        $use_sphinx = false;
    }


    if($use_sphinx && $sphinx->is_indexed_table($write_table)) {
        $wr_num_condition = " wr_num  >  {$write['wr_num']}";
        //wr_num 만개 범위안에 있는것만 조회
        $sphinx->set_sql_search($sca, $sfl, $stx, $sop);
        $sphinx->add_where_condition($wr_num_condition);
        $sphinx->add_where_condition(" wr_is_comment = 0 ");
        $sql_order = "order by wr_num asc";
        $sphinx->search($write_table, $sql_order, 0, 1, 1);

        $items = $sphinx->get_items();
        if(count($items) > 0) {
            $row = sql_fetch(" select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_id = '{$items[0]['wr_id']}' ");
            return $row;
        }
    }
    return null;
}

$write['wr_num'] = intval($write['wr_num']);
$prev = get_prev_row($write_table, $write, $sca, $sfl, $stx, $sop);
$next = get_next_row($write_table, $write, $sca, $sfl, $stx, $sop);

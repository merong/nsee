<?php

//include_once(G5_LIB_PATH.'/SphinxSearch_temp.class.php');

include_once(G5_LIB_PATH.'/RedisCache.class.php');
$cache = new RedisCache();

// 윗글을 얻음
$sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply < '{$write['wr_reply']}' {$sql_search} order by wr_num desc limit 1 ";

$pre_redis_cache_key = "list_view_cached:".hash("md5", json_encode($sql));


if($cache->exists($pre_redis_cache_key)) {
    $prev =  $cache->unserialize($cache->get($pre_redis_cache_key));
} else {
    $prev = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$prev['wr_id']) {
        $sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' {$sql_search} order by wr_num desc limit 1 ";
        $prev = sql_fetch($sql);
    }
    $cache->set($pre_redis_cache_key, $cache->serialize($prev), 300);
}

// 아래글을 얻음
$sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply > '{$write['wr_reply']}' {$sql_search} order by wr_num limit 1 ";

$next_redis_cache_key = "list_view_cached:".hash("md5", json_encode($sql));

if($cache->exists($next_redis_cache_key)) {
    $next = $cache->unserialize($cache->get($next_redis_cache_key));
} else {
    $next = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$next['wr_id']) {
        $sql = " select wr_id, wr_subject, wr_comment, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' {$sql_search} order by wr_num limit 1 ";
        $next = sql_fetch($sql);
    }
    $cache->set($next_redis_cache_key, $cache->serialize($prev), 300);
}
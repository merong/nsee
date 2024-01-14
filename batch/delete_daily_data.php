<?php
if (PHP_SAPI != 'cli') die("error!! only you can run cli mode");

if (php_sapi_name() == "cli") {
    // In cli-mode
} else {
    // Not in cli-mode
    die("Error. Not in cli-mode");
}

chdir(__DIR__);

include(dirname(__DIR__) . "/common.php");


$step = 10000; //만개 단위로 삭제 처리

// 설정일이 지난 접속자로그 삭제
if($config['cf_visit_del'] > 0) {
    $delete_target_date = date("Y-m-d", G5_SERVER_TIME - ($config['cf_visit_del'] * 86400));
    echo "cf_visit_del target_date=".$delete_target_date."\n";
    //$info  = sql_fetch("select min(vi_id) min_id, max(vi_id) max_id from  {$g5['visit_table']} where vi_date = '$delete_target_date' ");

    print_r($info);
    if($info['min_id'] && $info['max_id']) {

        $loop_count =  ceil(($info['max_id'] - $info['min_id']) / $step); //올림 처리
        for($i = 0; $i < $loop_count; $i++) {
            $start_pos = $info['min_id'] + ($step * $i); //i=0이면 min_id
            $end_pos = $info['min_id'] + ($step * ($i + 1));
            if($end_pos > $info['max_id']) {
                $end_pos = $info['max_id'];
            }
            $sql = "delete from {$g5['visit_table']} where vi_id between {$start_pos} and {$end_pos} ";
            echo $i.". ".$sql."\n";
            //sql_query($sql);
        }
    }
}

// 설정일이 지난 인기검색어 삭제
if($config['cf_popular_del'] > 0) {
    $delete_target_date = date("Y-m-d", G5_SERVER_TIME - ($config['cf_popular_del'] * 86400));
    echo "cf_popular_del target_date=".$delete_target_date."\n";
    $info  = sql_fetch("select min(vi_id) min_id, max(vi_id) max_id from  {$g5['visit_table']} where vi_date = '$delete_target_date' ");

    print_r($info);
    if($info['min_id'] && $info['max_id']) {

        $loop_count =  ceil(($info['max_id'] - $info['min_id']) / $step); //올림 처리
        for($i = 0; $i < $loop_count; $i++) {
            $start_pos = $info['min_id'] + ($step * $i); //i=0이면 min_id
            $end_pos = $info['min_id'] + ($step * ($i + 1));
            if($end_pos > $info['max_id']) {
                $end_pos = $info['max_id'];
            }
            $sql = "delete from {$g5['popular_table']} where pp_id between {$start_pos} and {$end_pos} ";
            echo $i.". ".$sql."\n";
            sql_query($sql);
        }
    }
}

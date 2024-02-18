<?php


/** g5_board_file db 에는 존재하나, 실제 파일이 없는 경우 g5_board_file 을 삭제한다.
 *
 */


if (PHP_SAPI != 'cli') die("error!! only you can run cli mode");

if (php_sapi_name() == "cli") {
    // In cli-mode
} else {
    // Not in cli-mode
    die("Error. Not in cli-mode");
}

$document_dir = dirname(__DIR__);
chdir($document_dir);

include(dirname(__DIR__) . "/common.php");
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');


$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;

$bo_table = "javleak";


$write_table = "g5_write_{$bo_table}";

$sql = "select * from {$write_table} where wr_is_comment = 0 order by wr_id desc";

$rows = [];

$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    $rows[] = $row;
}

$G5_DATA_PATH = dirname(__DIR__) . "/data";

foreach($rows as $row){
    $sql = "select * from g5_board_file where bo_table = '{$bo_table}' and wr_id = {$row['wr_id']} and bf_no = 0";

    $file = sql_fetch($sql);

    if(!$file) {
        continue;
    }

    //파일 존재 여부 확인
    $file_path = $G5_DATA_PATH . '/file/' . $bo_table . '/' . $file['bf_file'];

    if(file_exists($file_path)) {
        //echo sprintf("파일 존재 bo_table=%s, wr_id=%s, file=%s\n", $bo_table, $row['wr_id'], $file['bf_file']);
    } else {
        //bo_table, wr_id 정보 출력

        //sprintf 에 ansi 색상중 red 추가
        echo sprintf("\033[31m파일 존재하지 않습니다. bo_table=%s, wr_id=%s, file=%s\033[0m\n", $bo_table, $row['wr_id'], $file['bf_file']);

        //db 삭제
        $sql = "update g5_board_file set is_exist_file=0 where bo_table = '{$bo_table}' and wr_id = {$row['wr_id']} and bf_no = 0";
        sql_query($sql);
    }
}


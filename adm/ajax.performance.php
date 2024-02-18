<?php

/**
 * 솔루션명 : 그누보드 성능 최적화
 * version : 1.0.1
 * author : k9400275@gmail.com
 * 유료 프로그램입니다. 제작자의 허락없이 무단전제 및 코드 일부 변경후 재판매금지.
 */

$sub_menu = "100450";
include_once('./_common.php');

$result = array();
$result["responseCode"] = "200"; //OK status
$result["errorMsg"] = "";

function get_table_name($query) {

    $query = trim(str_replace(PHP_EOL, ' ', $query));

    $table = '';

    if (strtolower(substr($query, 0, 6)) == 'update') {
        $end = stripos($query, 'SET');
        $table = substr($query, 6, $end);
    } elseif (strtolower(substr($query, 0, 11)) == 'insert into') {
        $parts = explode(' ', $query);
        $table = $parts[2];
    } elseif (strtolower(substr($query, 0, 6)) == 'select') {
        $parts = explode(' ', $query);
        foreach ($parts as $i => $part) {
            if (trim(strtolower($part)) == 'from') {
                $table = $parts[$i + 1];
                break;
            }
        }
    } elseif (strtolower(substr($query, 0, 11)) == 'delete from') {
        $parts = explode(' ', $query);
        $table = str_replace("'", '', $parts[2]);
    }

    return trim(str_replace(['`', '[', ']'], ['', '', ''], $table));

}

try {

    switch ($cmd) {

        case "modify_table_engine" :
            $table_name = filter_input(INPUT_POST, 'table_name', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[a-zA-Z0-9_]+/')));

            $ddl = "ALTER TABLE `{$table_name}` ENGINE=InnoDB ";
            sql_query($ddl);

            break;

        case "modify_variable" :
            $variable_name = filter_input(INPUT_POST, 'variable_name', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[a-zA-Z0-9_]+/')));
            $variable_value = filter_input(INPUT_POST, 'variable_name', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[a-zA-Z0-9_]+/')));

            break;

        case "modify_query_cache" :

            break;

        case "modify_isolation" :

            $password = $_POST['password'];


            if (function_exists('mysqli_connect') && G5_MYSQLI_USE) {
                $link = mysqli_connect(G5_MYSQL_HOST, "root", $password);
                // 연결 오류 발생 시 스크립트 종료
                if (mysqli_connect_errno()) {
                    throw new Exception("mysql 루트 권한 실패. 비밀번호를 재입력하세요. [오류시 서버 설정에서 변경하세요]");
                }
            } else {
                throw new Exception("mysql 루트 권한 실패. 서버설정에서 변경 가능합니다.");
            }

            $tx_isolation = filter_input(INPUT_POST, 'tx_isolation', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[a-zA-Z0-9_]+/')));

            $tx_isolation = str_replace("-", " ", $tx_isolation);
            $ddl = "SET GLOBAL TRANSACTION ISOLATION LEVEL $tx_isolation ";
            $result['ddl'] = $ddl;
            sql_query($ddl);

            break;

        case "mysql_process_list" :

            $tables = array();
            $qresult = sql_query("SHOW TABLES");
            while (($row = sql_fetch_array($qresult)) != null) {
                $values = array_values($row);
                $tables[] = $values[0];
            }

            $html = "";
            $sql = "SELECT ID, USER, HOST, DB, COMMAND, TIME, STATE, LEFT(INFO, 51200) AS Info 
                    FROM `information_schema`.PROCESSLIST
                    WHERE COMMAND <> 'Sleep'
                    ORDER BY TIME DESC
             ";

            $result['tables'] = $tables;

            $qresult = sql_query($sql);
            $list = array();
            while (($row = sql_fetch_array($qresult)) != null) {
                //todo 테이블 검색 태그 추출

                if(strpos($row['Info'], "PROCESSLIST") !== FALSE ) {
                    continue;
                }
                if($row['TIME'] === "0") {
                    $row['EVALUATION'] = "<span class='txt_succeed'>좋음</span>";
                } else if($row['TIME'] > 0 && $row['TIME'] <= 1) {
                    $row['EVALUATION'] = "보통";
                } else if($row['TIME'] > 1 ) {
                    $row['EVALUATION'] = "<span class='txt_true'>나쁨</span>";
                }

                if(strpos($row['Info'], "select") !== FALSE
                    && strpos($row['Info'], "g5_write_") !== FALSE
                    && stripos($row['Info'], "INSTR") !== FALSE
                ) {
                    $row['EVALUATION'] .= "<span class='txt_true'>[검색]</span>";
                }

                $row['TABLE'] = get_table_name($row['Info']);

                $list[] = $row;
            }


            foreach ($list as $row) {
                $html .= "<tr>\n";
                $html .= "<td>{$row['ID']}</td>\n";
                $html .= "<td>{$row['STATE']}</td>\n";
                $html .= "<td>{$row['TIME']}</td>\n";
                $html .= "<td>{$row['EVALUATION']}</td>\n";
                $html .= "<td class='td_left'>{$row['TABLE']}</td>\n";
                $html .= "<td class='td_left'>{$row['Info']}</td>\n";
                $html .= "</tr>\n";
            }

            $result['html'] = $html;
            break;

        default:
            throw new Exception("지원되지 않는 기능입니다.", 500);
            break;

    }


} catch (Exception $e) {
    $result["responseCode"] = "500";
    $result["errorMsg"] = $e->getMessage();

}

echo json_encode($result);


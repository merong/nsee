<?php
$sub_menu = "300830";
require_once './_common.php';

$json_result = ['code' => 200, 'memssage' => ''];

try {

    $action = filter_input(INPUT_POST, "action") ;

    switch ($action) {
        case 'upload_board_file' :
            $bo_table = $_POST['bo_table'];
            $board_path = G5_DATA_PATH . '/file/' . $bo_table;
            $write_table = $g5['write_prefix'] . $bo_table;

            foreach($_POST['chk'] as $index) {
                $wr_id = isset($_POST['wr_id'][$index]) ? $_POST['wr_id'][$index] : null;
                $bf_no = isset($_POST['bf_no'][$index]) ? $_POST['bf_no'][$index] : null;
                $is_delete = !(isset($_FILES['bf_file']) && isset($_FILES['bf_file']['name'][$index])) ? true : false; //파일객체가 없으면, 삭제

                if($is_delete) { //기존 업로드된 파일 삭제
                    $row = sql_fetch("select * from g5_board_file where bo_table = '{$bo_table}' and wr_id='{$wr_id}' and bf_no = '{$bf_no}'");
                    if($row) {
                        $delete_file = run_replace('delete_file_path', G5_DATA_PATH . '/file/' . $bo_table . '/' . str_replace('../', '', $row['bf_file']), $row);
                        if (file_exists($delete_file)) {
                            @unlink(G5_DATA_PATH . '/file/' . $bo_table . '/' . $row['bf_file']);
                        }
                        // 이미지파일이면 썸네일삭제
                        if (preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                            delete_board_thumbnail($bo_table, $row['bf_file']);
                        }
                        sql_query("delete from  {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id='{$wr_id}' and bf_no = '{$row['bf_no']}'");
                    }

                } else { //파일 업로드 처리

                    //파일명이 blob 인 경우는  기존 파일을 유지한 경우임으로 무시한다.
                    if ($_FILES['bf_file']['name'][$index] == 'blob') {
                        continue;
                    }

                    $chars_array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));


                    // 가변 파일 업로드
                    $file_upload_msg = '';
                    $upload = array();


                    $upload['file'] = '';
                    $upload['source'] = '';
                    $upload['filesize'] = 0;
                    $upload['image'] = array();
                    $upload['image'][0] = 0;
                    $upload['image'][1] = 0;
                    $upload['image'][2] = 0;
                    $upload['fileurl'] = '';
                    $upload['thumburl'] = '';
                    $upload['storage'] = '';


                    $tmp_file = $_FILES['bf_file']['tmp_name'][$index];
                    $filesize = $_FILES['bf_file']['size'][$index];
                    $filename = $_FILES['bf_file']['name'][$index];
                    $filename = get_safe_filename($filename);

                    // 서버에 설정된 값보다 큰파일을 업로드 한다면
                    if ($filename) {
                        if ($_FILES['bf_file']['error'][$index] != 0) {
                            throw new Exception($filename . "파일이 정상적으로 업로드 되지 않았습니다", 500);
                        }
                    }

                    if (is_uploaded_file($tmp_file)) {

                        $timg = @getimagesize($tmp_file);
                        // image type
                        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) || preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
                            if ($timg['2'] < 1 || $timg['2'] > 18) continue;
                        }
                        //=================================================================

                        $upload['image'] = $timg;

                        // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정

                        // 존재하는 파일이 있다면 삭제합니다.
                        $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$bf_no}' ");

                        if (isset($row['bf_file']) && $row['bf_file']) {
                            $delete_file = run_replace('delete_file_path', G5_DATA_PATH . '/file/' . $bo_table . '/' . str_replace('../', '', $row['bf_file']), $row);
                            if (file_exists($delete_file)) {
                                @unlink(G5_DATA_PATH . '/file/' . $bo_table . '/' . $row['bf_file']);
                            }
                            // 이미지파일이면 썸네일삭제
                            if (preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                                delete_board_thumbnail($bo_table, $row['bf_file']);
                            }
                        }

                        // 프로그램 원래 파일명
                        $upload['source'] = $filename;
                        $upload['filesize'] = $filesize;

                        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
                        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);

                        shuffle($chars_array);
                        $shuffle = implode('', $chars_array);

                        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
                        $upload['file'] = md5(sha1("0.0.0.0")) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

                        $dest_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $upload['file'];

                        move_uploaded_file($tmp_file, $dest_file);

                        // 올라간 파일의 퍼미션을 변경합니다.
                        chmod($dest_file, G5_FILE_PERMISSION);

                        $upload['source'] = sql_real_escape_string($upload['source']);

                        $bf_width = isset($upload['image'][0]) ? (int)$upload['image'][0] : 0;
                        $bf_height = isset($upload['image'][1]) ? (int)$upload['image'][1] : 0;
                        $bf_type = isset($upload['image'][2]) ? (int)$upload['image'][2] : 0;

                        if($row) { //update 처리
                            $sql = " update {$g5['board_file_table']}
                                set bf_source = '{$upload['source']}',
                                     bf_file = '{$upload['file']}',
                                     bf_content = '',
                                     bf_fileurl = '{$upload['fileurl']}',
                                     bf_thumburl = '{$upload['thumburl']}',
                                     bf_storage = '{$upload['storage']}',
                                     bf_filesize = '".(int)$upload['filesize']."',
                                     bf_width = '".$bf_width."',
                                     bf_height = '".$bf_height."',
                                     bf_type = '".$bf_type."',
                                     bf_datetime = '".G5_TIME_YMDHIS."'
                                where bo_table = '{$bo_table}'
                                        and wr_id = '{$wr_id}'
                                        and bf_no = '{$row['bf_no']}' ";
                            sql_query($sql);

                        } else { //insert 처리
                            $sql = " insert into {$g5['board_file_table']}
                        set bo_table = '{$bo_table}',
                             wr_id = '{$wr_id}',
                             bf_no = '0',
                             bf_source = '{$upload['source']}',
                             bf_file = '{$upload['file']}',
                             bf_content = '',
                             bf_fileurl = '{$upload['fileurl']}',
                             bf_thumburl = '{$upload['thumburl']}',
                             bf_storage = '{$upload['storage']}',
                             bf_download = 0,
                             bf_filesize = '" . (int)$upload['filesize'] . "',
                             bf_width = '" . $bf_width . "',
                             bf_height = '" . $bf_height . "',
                             bf_type = '" . $bf_type . "',
                             bf_datetime = '" . G5_TIME_YMDHIS . "' ";
                            sql_query($sql);
                        }
                    }
                }
                //게시물의 파일 카운트 변경
                $row = sql_fetch("select count(*) as cnt from  {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}'");
                $file_count = $row['cnt'];
                sql_query("update {$write_table} set wr_file = '{$file_count}' where wr_id = '{$wr_id}'");

            }

            $json_result['message'] = '정상적으로 수정하였습니다.';


            break;
        default :
            throw new Exception("잘못된 요청입니다.", 400);
    }
} catch (Exception $e) {
    $json_result['code'] = $e->getMessage() >= 200 ? $e->getMessage() : 500;
    $json_result['message'] = $e->getMessage();
}

echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
<?php
include_once('./_common.php');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header('Content-Type:application/json; charset=utf-8');
$file = isset($_FILES['file_data']) ? $_FILES['file_data']:null; //
$name = isset($_POST['file_name']) ? $_POST['file_name']:null; //
$total = isset($_POST['file_total']) ? $_POST['file_total']:0; //
$index = isset($_POST['file_index']) ? $_POST['file_index']:0; //
$md5   = isset($_POST['file_md5']) ? $_POST['file_md5'] : 0; //
$size  = isset($_POST['file_size']) ?  $_POST['file_size'] : null; //


$newfilename = $_GET['mode'];


function jsonMsg($status,$message,$url=''){
   $arr['status'] = $status;
   $arr['message'] = $message;
   $arr['url'] = $url;
   echo json_encode($arr);
   die();
}

if(!$file || !$name){
	jsonMsg(0,'파일없음');
}



@mkdir(G5_DATA_PATH."/tmp/".$newfilename, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/tmp/".$newfilename, G5_DIR_PERMISSION);


//업로드전 파일 삭제 -- 최초일때만 
if($index == 1) @unlink(G5_DATA_PATH."/tmp/".$newfilename.".zip");


// 
$info = pathinfo($name);

// 
$ext = isset($info['extension'])?$info['extension']:'';

/* 제한사항 설정 */
$imgarr = array('jpeg','jpg','png','gif','zip');
if(!in_array($ext,$imgarr)){
    jsonMsg(0,'허용된 확장자가 아닙니다.');
}

$file_name = $newfilename.'.'.$ext;

$newfile = G5_DATA_PATH."/tmp/".$file_name;

// 경로설정
$url = G5_DATA_URL."/tmp/".$file_name;


clearstatcache($newfile);

if(is_file($newfile) && ($size == filesize($newfile))){
   jsonMsg(3,'이미 업로드된 파일입니다.',$url);          
}
/** 업로드 반복여부 결정  **/

// 업로드 된 파일 스트림이 있는지 확인하기 위해 여기에
if ($file['error'] == 0) {
    //파일 없으면 생성
    if (!file_exists($newfile)) {
        if (!move_uploaded_file($file['tmp_name'], $newfile)) {
            jsonMsg(0,'파일을 이동할 수 없습니다.');
        }
        // 완료
        if($index == $total ){  
          jsonMsg(2,'업로드완료',$url);
        }        
        jsonMsg(1,'업로드중');
    }     
    // 슬라이스 추가 
    if($index <= $total){
        $content = file_get_contents($file['tmp_name']);
        if (!file_put_contents($newfile, $content, FILE_APPEND)) {
          jsonMsg(0,'파일에 쓸수 없음');
        }
        // 片数相等，等于完成了
        if($index == $total ){  
          jsonMsg(2,'업로드완료',$url);
		  echo "<script> self.close(); </script>";
        }
        jsonMsg(1,'업로드중');
    }               
} else {
    jsonMsg(0,'파일이 업로드되지 않았습니다.');
}
 
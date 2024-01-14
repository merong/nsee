<?php
$sub_menu = '300110';
include_once('./_common.php');


auth_check($auth[$sub_menu], "w");


$g5['title'] = '게시판일괄업로드 결과';
include_once (G5_ADMIN_PATH.'/admin.head.php');

// 데이터가 많을 경우 대비 설정변경
set_time_limit ( 0 );
//ini_set('memory_limit', '50M');
ini_set("memory_limit" , -1);



$dir = G5_DATA_PATH."/tmp";

//압축파일
if(is_file($dir."/{$_POST['zipfile']}.zip")){


	// 같은 페이지에서 재업로드 했을 때 기존 폴더 지우고 다시 생성
	$temp_zip_directory = $dir."/".$_POST['zipfile']."/";
	$tmp_handle = opendir($temp_zip_directory); // 절대경로
	while ($tmp_file = readdir($tmp_handle)) {
		if(($tmp_file != '.') && ($tmp_file != '..')) {
			@unlink($temp_zip_directory.$tmp_file);
		}
	}
	closedir($tmp_handle);	

	@rmdir($temp_zip_directory);


	//압축풀기
	$zip = new ZipArchive;
	if($zip->open($dir.'/'.$_POST['zipfile'].'.zip') === true){
		@mkdir($dir."/".$_POST['zipfile'], G5_DIR_PERMISSION);
		@chmod($dir."/".$_POST['zipfile'], G5_DIR_PERMISSION);

		for($i=0; $i<$zip->numFiles; $i++){ //zip파일안의 파일 개수동안 반복
			$filename = $zip->getNameIndex($i); //zip파일의 이름을 가져오고
			copy('zip://'.$dir.'/'.$_POST['zipfile'].'.zip#'.$filename, $dir.'/'.$_POST['zipfile']."/".$filename); //폴더로 파일을 복사한다.
		} 
		$zip->close();
	}


}

//엑셀파일 넘어왔는지 확인
if($_FILES['excelfile']['tmp_name']) {

    error_reporting(E_ALL ^ E_NOTICE);

    include_once(G5_LIB_PATH.'/PHPExcel.php');
	$objPHPExcel = new PHPExcel();

    $filename = $_FILES['excelfile']['tmp_name'];
	$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
	$objReader->setReadDataOnly(true);
	$objExcel = $objReader->load($filename);

   // 첫번째 시트를 선택

    $objExcel->setActiveSheetIndex(0);

 

    $objWorksheet = $objExcel->getActiveSheet();

    $rowIterator = $objWorksheet->getRowIterator();

 

    foreach ($rowIterator as $row) {

		$cellIterator = $row->getCellIterator();

		$cellIterator->setIterateOnlyExistingCells(false);

    }

    $maxRow = $objWorksheet->getHighestRow();	


	$log = array();
	$succ_count = 0;
	$fail_count = 0;
	$total_count = 0;

	$write_id = "admin";
	$write_name = "Manager";


	//행 for
     for ($i = 2 ; $i <= $maxRow ; $i++) {
        


        $j = 1;



	   $bo_table = $objWorksheet->getCell('A' . $i)->getValue(); // 게시판명
	   $html_option = $objWorksheet->getCell('B' . $i)->getValue(); // HTML사용유무
	   $ca_name = $objWorksheet->getCell('C' . $i)->getValue(); // 카테고리
	   $wr_subject = $objWorksheet->getCell('D' . $i)->getValue(); // 제목
	   $wr_content = $objWorksheet->getCell('E' . $i)->getValue(); // 내용
	   $as_tag = addslashes($objWorksheet->getCell('F' . $i)->getValue()); // 태그
	   $as_thumb = $objWorksheet->getCell('G' . $i)->getValue(); // 첨부파일명

		//wr_option 처리 1일경우:html1
		if($html_option == 1) $wr_option = 'html1';
		else $wr_option = '';

		
		$wr_subject = substr(trim($wr_subject),0,255);
		$wr_subject = addslashes(preg_replace("#[\\\]+$#", "", $wr_subject));

		$wr_content = substr(trim($wr_content),0,65536);
		$wr_content = addslashes(preg_replace("#[\\\]+$#", "", $wr_content));


		$view_wr_subject = utf8_strcut($wr_subject,20);
		$view_wr_content =  utf8_strcut(strip_tags($wr_content),20);

		$total_count++;

		//있는 게시판인지 조회
		$search_board = sql_fetch("select count(*) as cnt from g5_board where bo_table = '{$bo_table}' ");

		//게시판 존재하면 insert
		if($search_board['cnt']>0){

			$write_table = "g5_write_".$bo_table;

			$wr_num = get_next_num($write_table);

			$sql = " INSERT INTO {$write_table}
						 SET wr_num = '{$wr_num}',
							 wr_is_comment = 0,
							 wr_comment = 0,
							 ca_name = '{$ca_name}',
							 wr_option = '{$wr_option}',
							 wr_subject = '{$wr_subject}',
							 wr_content = '{$wr_content}',
							 mb_id = '{$write_id}',
							 wr_name = '{$write_name}',
							 wr_datetime = '".G5_TIME_YMDHIS."',
							 wr_last = '".G5_TIME_YMDHIS."',
							 as_tag = '{$as_tag}',
							 wr_ip = ''
				";

			sql_query($sql);


			$wr_id = sql_insert_id();



			// 부모 아이디에 UPDATE
			sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

			// 새글 INSERT
			sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, as_reply, as_re_mb, as_list ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$write_id}', '', '',1 ) ");
			//sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$write_id}' ) ");

			//태그 INSERT
			apms_add_tag('', $as_tag, G5_TIME_YMDHIS, $bo_table, $wr_id, $write_id);

			// 게시글 1 증가
			sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

			//파일누락 체크용 변수
			$file_msg = "";

			$bgclass = "success";

			//파일명 ,로 연결되있는거 쪼개서 foreach
			$file_array = explode(",",$as_thumb);
			if($file_array){
				$file_cnt = 0;
				$file_error = array();

				foreach($file_array as $file_i => $file_data){
					$trim_filedata = trim($file_data);

					//파일명이 있을 경우
					if($trim_filedata){ 
						$file_real_path = $dir.'/'.$_POST['zipfile']."/".$trim_filedata;

						//같은 이름의 파일이 있을 경우 게시판 파일 폴더로 이동
						if(is_file($file_real_path)){
							

							$filename  = get_safe_filename($trim_filedata);

							// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
							$filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
							$bf_source = $filename; // 파일명

							//확장자 확인
							$file_path = pathinfo($filename);
							$ext = $file_path['extension'];


							// 첨부파일 명 생성
							$bf_file = uuidgen().".".$ext;


							//file size확인
							$fimg = @getimagesize($file_real_path);
							$file_size = floor(filesize($file_real_path));


							// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
							@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
							@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

							$newfile = G5_DATA_PATH.'/file/'.$bo_table."/".$bf_file;
							@copy($file_real_path, $newfile);

							
							$file_sql = " insert into {$g5['board_file_table']}
										set bo_table = '{$bo_table}',
											 wr_id = '{$wr_id}',
											 bf_no = '{$file_cnt}',
											 bf_source = '{$bf_source}',
											 bf_file = '{$bf_file}',
											 bf_content = '',
											 bf_download = 0,
											 bf_filesize = '{$file_size}',
											 bf_width = '{$fimg['0']}',
											 bf_height = '{$fimg['1']}',
											 bf_type = '{$fimg['2']}',
											 bf_datetime = '".G5_TIME_YMDHIS."' ";
							sql_query($file_sql);

							$file_cnt++;

						}
						else{
							//누락된 파일 체크
							$file_error[] = $trim_filedata;
						}
					}
				}
				//file 갯수 업데이트
				$file_cnt_update = "update {$write_table} set wr_file='{$file_cnt}' where wr_id='{$wr_id}'";
				sql_query($file_cnt_update);

				//누락파일 있으면 표시
				if($file_error[0]){
					$file_msg = implode(",",$file_error)." 누락";
					$bgclass = "warning";
				}

			}



			$succ_count++;
			$log[]= "<tr class='{$bgclass}'><td>{$total_count}</td><td>$i 번째 줄</td><td>성공</td><td><a href='/bbs/board.php?bo_table={$bo_table}' target='_new'>{$bo_table}</a></td><td>{$wr_option}</td><td>{$ca_name}</td><td><a href='/bbs/board.php?bo_table={$bo_table}&wr_id={$wr_id}' target='_new'>{$view_wr_subject}</a></td><td>{$view_wr_content}</td><td>{$as_tag}</td><td>{$as_thumb}</td><td>{$file_msg}</td></tr>";
		}
		else{
			$fail_count++;
			$log[]= "<tr class='failure'><td>{$total_count}</td><td>$i 번째 줄</td><td>실패</td><td>{$bo_table}</td><td>{$wr_option}</td><td>{$ca_name}</td><td>{$view_wr_subject}</td><td>{$view_wr_content}</td><td>{$as_tag}</td><td>{$as_thumb}</td><td>게시판없음</td></tr>";
		}
    }
}




$g5['title'] = "{$_FILES['excelfile']['name']}({$total_count}건) 저장 결과 - 성공:".number_format($succ_count)." / 실패:".number_format($fail_count);
include_once(G5_PATH.'/head.sub.php');
?>
<style>
.success{background-color:#bae4ff !important;}
.failure{background-color:#ffc4c4 !important;}
.warning{background-color:#fad197 !important;}
</style>
<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

</div>
<div class="tbl_head01 tbl_wrap">
	<table>
		<thead>
			<tr><th>번호</th><th>라인</th><th>결과</th><th>게시판명</th><th>HTML사용유무</th><th>카테고리</th><th>제목</th><th>내용</th><th>태그</th><th>첨부파일명</th><th>비고</th></tr>
		</thead>
		<tbody>
		<?php
		echo @implode("",$log);
		?>
		</tbody>
	</table>
</div>
<?php

//대용량 파일 지우기
unlink($dir."/{$_POST['zipfile']}.zip");

$d = @dir($dir."/".$_POST['zipfile']);
while ($entry = $d->read()) {
	if ($entry == "." || $entry == "..") continue;
	unlink($dir."/".$_POST['zipfile']."/".$entry);
}

rmdir($dir."/".$_POST['zipfile']);

include_once(G5_PATH.'/tail.sub.php');
?>
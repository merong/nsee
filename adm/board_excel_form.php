<?php
$sub_menu = '300110';
include_once('./_common.php');
ini_set('display_errors', 1);
auth_check($auth[$sub_menu], "w");

$g5['title'] = '게시판일괄업로드';
include_once(G5_ADMIN_PATH . '/admin.head.php');


function tmpfile_remove()
{
    $directory = G5_DATA_PATH . "/tmp";
    $handle = opendir($directory); // 절대경로
    while ($file = readdir($handle)) {
        unlink($directory . $file);
    }
    closedir($handle);
}

?>

    <div class="new_win">
        <h1>엑셀 및 계약서 일괄등록 페이지</h1>

        <form name="fitemexcel" method="post" action="./board_excel_form_update.php" enctype="MULTIPART/FORM-DATA" autocomplete="off">

            <?php
            $zipfilename = time();

            ?>
            <input type="hidden" name="zipfile" value="<?= $zipfilename ?>">


            <div class="excelfile_upload">
                <label for="excelfile" style="width:140px;display:inline-block">게시판엑셀</label>
                <input type="file" name="excelfile" id="excelfile">
            </div>
            <div class="excelfile_upload">
                <label for="upfile" style="width:140px;display:inline-block">첨부</label>
                <input type="button" value="대용량업로드" class="btn_03 btn" onclick="bigfile('<?= $zipfilename ?>');">
            </div>
            <div class="check_files">
                <label for="check_files" style="width:140px;display:inline-block">파일삭제</label>
                <input type="button" name="test" id="test" value="RUN" onclick="<?php echo tmpfile_remove(); ?>">
            </div>


            <div class="win_btn btn_confirm">
                <input type="submit" onclick="document.pressed=this.value;" value="저장" class="btn_submit btn">
                <!--button type="button" onclick="window.close();" class="btn_close btn">닫기</button-->
            </div>

        </form>
    </div>

    <script>
        function bigfile(mode) {
            window.open("./mega_upload/index.php?mode=" + mode, "_new", "width=500,height=300");
        }

        /*
        function submit_check(f){

            if (document.pressed == "미리보기") {
                f.action = "board_excel_preview.php";
            }
            if (document.pressed == "접수") {
                f.action = "board_excel_upload.php";
            }

        }
        */
    </script>
<?php
include_once(G5_PATH . '/tail.sub.php');
?>
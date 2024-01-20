<?php
$sub_menu = "300830";
require_once './_common.php';

auth_check($auth[$sub_menu], "w");

$default_bo_table = "javc";

$bo_table = isset($_GET['bo_table']) ? $_GET['bo_table'] : $default_bo_table;

$board_list = [];

$sql = "select bo_table, bo_subject from {$g5['board_table']} where 1 order by bo_table";
$result = sql_query($sql);
while($row = sql_fetch_array($result)) {
    $board_list[] = $row;
}

$write_table = $g5['write_prefix'] . $bo_table;
//게시판 첨부 파일을 체크한다.
$sql_common = " from {$write_table} t1  ";

$sql_search = " where wr_is_comment = 0";

if ($exist_type == "exist") {
    $sql_search .= " and exists (select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = t1.wr_id and bf_no='0') ";
} else if ($exist_type == "not_exist") {
    $sql_search .= " and not exists (select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = t1.wr_id and bf_no='0') ";
}



if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "wr_subject" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "t1.wr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            break;
    }
    $sql_search .= " ) ";
}

$sql_order = " order by wr_id desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$list = [];
$result = sql_query($sql);
for ($i = 0; $row = sql_fetch_array($result); $i++) {
    $board_file = sql_fetch("select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$row['wr_id']}' order by bf_no asc limit 1");
    if($board_file) {
        $row['bf_no'] = $board_file['bf_no'];
        $row['bf_source'] = $board_file['bf_source'];
        $board_path = G5_DATA_PATH . '/file/' . $bo_table;

        $row['thumb'] = thumbnail($board_file['bf_file'], $board_path, $board_path, 120, 100, true, 'center', false, false, 90);

        if ($row['thumb']) {
            $thumb_url = str_replace(G5_PATH, G5_URL, $board_path . '/' . $row['thumb']);
            $row['thumb_url'] = $thumb_url;
            $row['file_url'] = str_replace(G5_PATH, G5_URL, $board_path . '/' . $board_file['bf_file']);
            $row['thumb_html'] = '<img src="' . $thumb_url . '" width="120" height="100" class="thumbnail" alt="">';
        }
    } else {
        $row['bf_no'] = '';
        $row['bf_source'] = '';
        $row['thumb'] = '';
        $row['file_url'] = '';
        $row['thumb_html'] = '';
    }

    $list[] = $row;
}


$qstr .= "&amp;exist_type=".$exist_type;


$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">처음</a>';

$g5['title'] = '게시판 첨부 파일';
require_once './admin.head.php';

$colspan = 10;

?>

    <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>


    <style>
        /**
     * FilePond Custom Styles
     */

        .filepond--root {
            padding: 2px;
            margin:0;
        }

        .filepond--item {
            margin: 2px;
            padding:0;
        }

        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }
        .filepond--panel-top {
            padding:0;
        }
        .filepond--panel {
            margin: 0;
        }
        .filepond--panel-root {
            border-radius: 2em;
            background-color: #edf0f4;
        }

        .filepond--item-panel {
            background-color: #595e68;
            margin-bottom: 0;
            padding: 0;
        }

        .filepond--drip-blob {
            padding :0;
            margin : 0;
            background-color: #7f8a9a;
        }


        .thumbnail {
            border-radius: 5px;
        }

    </style>

    <div class="local_ov01 local_ov">
        <?php echo $listall ?>

    </div>

    <form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
        <label for="sfl" class="sound_only">검색대상</label>
        <select name="bo_table" id="bo_table">
            <?php foreach($board_list as $board) { ?>
                <option value="<?php echo $board['bo_table']; ?>" <?php echo get_selected($bo_table, $board['bo_table']); ?>><?php echo $board['bo_subject']; ?></option>
            <?php } ?>
        </select>

        <select name="exist_type">
            <option value="" <?= $exist_type == "" ? "selected" : "" ?>>::첨부파일 유무::</option>
            <option value="exist" <?= $exist_type == "exist" ? "selected" : "" ?>>있음</option>
            <option value="not_exist" <?= $exist_type == "not_exist" ? "selected" : "" ?>>없음</option>
        </select>

        <select name="sfl" id="sfl">
            <option value="t1.wr_id"<?php echo get_selected($_GET['sfl'], "t1.wr_id", true); ?>>wr_id</option>
            <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject"); ?>>제목</option>
        </select>
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
        <input type="submit" value="검색" class="btn_submit">
    </form>

    <form name="fboardgrouplist" id="fboardgrouplist" action="./boardgroup_list_update.php" onsubmit="return fboardgrouplist_submit(this);" method="post">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="">

        <div class="tbl_head01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_1"/>
                    <col class="grid_1"/>
                    <col class="grid_4"/>
                    <col class="grid_3"/>
                    <col class="grid_3"/>
                    <col class="grid_2"/>
                    <col class=""/>

                </colgroup>
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <thead>
                <tr>
                    <th scope="col">
                        <label for="chkall" class="sound_only">그룹 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col">번호</a></th>
                    <th scope="col">게시물 제목</a></th>
                    <th scope="col">썸네일</a></th>
                    <th scope="col">업로드파일</th>
                    <th scope="col">관리</th>
                    <th scope="col">-</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $i => $row) {
                    $bg = 'bg' . ($i % 2);
                    ?>

                    <tr class="<?php echo $bg; ?>">
                        <td class="td_chk">
                            <input type="hidden" name="wr_id[<?php echo $i ?>]" value="<?php echo $row['wr_id'] ?>">
                            <input type="hidden" name="bf_no[<?php echo $i ?>]" value="<?php echo $row['bf_no'] ?>">
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td class="td_num"><?php echo $row['wr_id'] ?></td>
                        <td class="td_left"><a class="minipreview" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $row['wr_id'] ?>" target="_blank"><?php echo $row['wr_subject'] ?></a></td>

                        <td>
                            <?=$row['thumb_html']?>
                            <p><?=$row['bf_source']?></p>
                        </td>
                        <td style="vertical-align: top">
                            <input type="file" class="filepond" data-upload-file="<?=$row['thumb_url']?>"
                                   name="bf_file[<?php echo $i ?>]"
                                   data-max-file-size="10MB"
                                   data-max-files="1" />
                        </td>

                        <td class="td_mng td_mng_s"><?php echo $s_upd ?></td>
                        <td>-</td>
                    </tr>
                    <?php
                }
                if ($i == 0) {
                    echo '<tr><td colspan="' . $colspan . '" class="empty_table">자료가 없습니다.</td></tr>';
                }
                ?>
            </table>
        </div>

        <div class="btn_fixed_top">
            <button name="btn_modify" onclick="document.pressed=this.value" value="선택수정" class="btn btn_02">선택수정</button>
        </div>
    </form>

    <div class="local_desc01 local_desc">
        <p>
            기존 첨부된 파일을 삭제할려면, 업로드 파일 삭제후 선택수정을 진행하세요.
        </p>
    </div>



<?php
$pagelist = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'] . '?' . $qstr . '&amp;page=');
echo $pagelist;
?>

    <script>
        $(function() {

            $("button[name=btn_modify]").click(function(e) {
                e.preventDefault();
                if (!is_checked("chk[]")) {
                    alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
                    return false;
                }

                e.preventDefault();

                //체크된 항목의 file 객체를 참조하여 Form 객체를 생성한다.
                var formData = new FormData();
                //필터 항목들중에 a.active 인 목록만 조회하여 hidden input value 로 설정한다.

                var formData = new FormData();

                const bo_table = $("select[name='bo_table']").val();
                formData.append('bo_table', bo_table);

                $("input[name='chk[]']:checked").each(function() {
                    var index = $(this).val();
                    $filepond_file = $(this).closest('tr').find('.filepond').filepond('getFiles')[0];

                    const wr_id = $("input[name='wr_id[" + index + "]']").val();
                    const bf_no = $("input[name='bf_no[" + index + "]']").val();

                    formData.append('chk[]', index);
                    formData.append('wr_id[' + index + ']', wr_id);
                    formData.append('bf_no[' + index + ']', bf_no);

                    if($filepond_file) {
                        formData.append('bf_file[' + index + ']', $filepond_file.file);
                    }
                });

                formData.append("action", "upload_board_file" );
                $.ajax({
                    url: "./ajax.board_file.php",
                    type: 'POST',
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    async: false,
                    success: function (response) {
                        if(response.code != 200) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                        location.reload();
                    }
                });
            });
        });
    </script>


    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>



    <script>

        // Select the file input and use create() to turn it into a pond

        $(function() {
            $.fn.filepond.registerPlugin(
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginFileEncode,
                FilePondPluginFilePoster,
                FilePondPluginFileRename,
                FilePondPluginFileValidateType,
                FilePondPluginImageCrop,
                FilePondPluginImageEdit,
                FilePondPluginImageResize
            );

            $('.filepond').each(function() {
                const pond = FilePond.create(this, {
                    labelIdle: `<span class="filepond--label-action">업로드</span>`,
                    credits: false,
                    imagePreviewWidth: 150,
                    imageCropAspectRatio: '1.2:1',
                });

                const fileUri = $(this).data('upload-file');
                if (fileUri) {
                    pond.addFile(fileUri);
                }
            });
        });
    </script>



<?php
require_once './admin.tail.php';

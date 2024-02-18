<?php
$sub_menu = "100450";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

/**
 * 솔루션명 : 그누보드 성능 최적화
 * version : 1.0.1
 * author : k9400275@gmail.com
 * 유료 프로그램입니다. 제작자의 허락없이 무단전제 및 코드 일부 변경후 재판매금지.
 */

if (!function_exists('format_bytes')) {
    function format_bytes($bytes) {
        $sizes = array(0 => 'Bytes', 1 => 'KB', 2 => 'MB', 3 => 'GB', 4 => 'TB');

        if ($bytes === 0) {
            return 'n/a';
        }

        $i = floor(log($bytes) / log(1024));
        return round($bytes / pow(1024, $i), 2) . ' ' . $sizes[$i];
    }

}

if (!function_exists('get_time_modify_bytes')) {
    function get_time_modify_bytes($bytes) {
        $sizes = array(0 => 'Bytes', 1 => 'KB', 2 => 'MB', 3 => 'GB', 4 => 'TB');

        if ($bytes === 0) {
            return '1초이내';
        }

        $i = floor(log($bytes) / log(1024));

        $second = 0;

        $size = round($bytes / pow(1024, $i), 2);
        if ($i == 4) {
            return "에측불가";
        } else if ($i == 1) {
            $second = 1;
            return "1초이내";
        } else if ($i == 2) {
            $second = round(0.1 * $size);
            if ($size < 100) {
                return "10초이내";
            } else if ($size < 500) {
                return "30초이내";
            } else if ($size >= 500) {
                return "60초이내";
            }
        } else if ($i == 3) {
            $second = round(20 * $size);
            if ($size > 3) {
                return "1분이상~";
            }
        }

        return $second . "초 이내";
    }
}

$table_desc = array(
    "g5_auth" => "관리자 메뉴권한",
    "g5_autosave" => "자동 저장",
    "g5_board" => "게시판 설정정보",
    "g5_board_file" => "게시판 첨부파일",
    "g5_board_good" => "게시판 추천/비추천",
    "g5_board_new" => "최신 게시물 정보",
    "g5_cert_history" => "회원 인증 내역",
    "g5_config" => "그누보드 환경설정",
    "g5_content" => "그누보드 내용관리",
    "g5_faq" => "자주묻는 질문 상세내용",
    "g5_faq_master" => "자주묻는 질문 제목",
    "g5_group" => "게시판 그룹",
    "g5_group_member" => "그룹 멤버",
    "g5_login" => "회원 접속 정보",
    "g5_mail" => "관리자 메일 발송 내역",
    "g5_member" => "회원정보",
    "g5_member_social_profiles" => "회원 sns 로그인 정보",
    "g5_memo" => "쪽지",
    "g5_menu" => "그누보드 메뉴",
    "g5_new_win" => "새창 내역",
    "g5_point" => "포인트 내역",
    "g5_poll" => "설문조사",
    "g5_poll_etc" => "설문조사 기타의견",
    "g5_popular" => "인기 검색어",
    "g5_qa_config" => "1:1 문의 환경설정",
    "g5_qa_content" => "1:1 문의 내용",
    "g5_scrap" => "스크랩 게시물",
    "g5_uniqid" => "유니크 아이디 내역",
    "g5_visit" => "방문자 내역",
    "g5_visit_sum" => "방문자 통계",
    "g5_write_free" => "자유 게시판",
    "g5_write_gallery" => "갤러리 게시판",
    "g5_write_notice" => "공지 게시판",
    "sms5_book" => "sms 주소록",
    "sms5_book_group" => "sms 주소록 그룹",
    "sms5_config" => "sms 환경설정",
    "sms5_form" => "sms 템플릿",
    "sms5_form_group" => "sms 템플릿 그룹",
    "sms5_history" => "sms 발송 내역",
    "sms5_write" => "sms 발송 템플릿",
);

$mainly_tables = array(
    "g5_point", "g5_popular", "g5_visit", "g5_board_new", "g5_memo", "g5_member"
);

$load = sys_getloadavg();
$version_info = sql_fetch("show variables like 'version' ");

$db_info = array();
$sql = "SHOW VARIABLES";
$result = sql_query($sql);
while (($row = sql_fetch_array($result))) {
    $db_info[$row['Variable_name']] = $row['Value'];
}


//print_r2($db_info);
//exit;

$sql = "SHOW TABLE STATUS";
$result = sql_query($sql);
$list = array();
while (($row = sql_fetch_array($result))) {
    $row['Desc'] = $table_desc[$row['Name']];

    if (strpos($row['Name'], "g5_write_") === 0) {
        $bo_table = substr($row['Name'], 9);
        $board = sql_fetch("select bo_subject from g5_board where bo_table='{$bo_table}' ");
        $row['Desc'] = trim($board['bo_subject']) ? $board['bo_subject'] : $bo_table . " 게시판";
        $row['mainly'] = "Y"; //주요 테이블
    }

    if (in_array($row['Name'], $mainly_tables)) {
        $row['mainly'] = "Y";
    }

    if ($row["mainly"] == "Y" && $row['Engine'] == "MyISAM") {
        $row['info'] = " <span style='color:red'>*필수변경</span>";
    }

    $row['size'] = $row['Data_length'] + $row['Index_length'];
    $row['disp_size'] = format_bytes($row['size']);
    if (strstr($row['disp_size'], "MB")) {
        $row['disp_size'] = "<span style='color:blue'>" . $row['disp_size'] . "</span>";
    } else if (strstr($row['disp_size'], "GB") || strstr($row['disp_size'], "TB")) {
        $row['disp_size'] = "<span style='color:purple'>" . $row['disp_size'] . "</span>";
    }
    if ($row['Engine'] != "InnoDB") {
        $row['modify_time'] = get_time_modify_bytes($row['size']);
    } else {
        $row['modify_time'] = "-";
    }
    $list[] = $row;

}

$g5['title'] = '그누보드 성능 최적화(Pro)';
include_once('./admin.head.php');

$pg_anchor = '<ul class="anchor">
    <li><a href="#anc_system">시스템 정보</a></li>
    <li><a href="#anc_dynatics">데이타베이스 진단</a></li>
    <li><a href="#anc_table_list">테이블 목록</a></li>
    <li><a href="#anc_mysql_process">mysql 프로세스 목록</a></li>
</ul>';

?>

<div class="local_desc01 local_desc">
    <p><strong>주의!</strong> 유료 프로그램입니다. <strong>무단도용 금지</strong> 1 Doamin / 1 License 입니다.</p>
</div>

<section id="anc_basic">
    <h2 class="h2_frm">시스템 기본 정보</h2>
    <?php echo $pg_anchor ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row">Database version</th>
                <td><?= $version_info['Value'] ?><?php help("5.5 버전 이상을 추천합니다.") ?></td>
            </tr>
            <tr>
                <th scope="row">Load Average</th>

                <td><?=$load[0]?> / <?=$load[1]?> / <?=$load[2]?></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<section id="anc_dynatics">
    <h2 class="h2_frm">DB 성능 진단 및 가이드</h2>
    <?php echo $pg_anchor ?>

    <div class="local_desc01 local_desc">
        <p><strong>주의!</strong>아래 설정값은 my.cnf(파일명과 위치는 서버에 따라 조금 다릅니다.) 를 변경하여야 합니다. [mysql 서버 재시작 필요]</strong></p>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <colgroup>
                <col class="grid_3">
                <col class="grid_3">
                <col class="grid_1">
                <col class="">
                <col class="grid_4">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">항목</th>
                <th scope="col">설정값</th>
                <th scope="col">상태</th>
                <th scope="col">설명</th>
                <th scope="col">변경</th>
            </tr>
            <tbody>

            <tr>
                <td class="td_left">DB default Engine</td>
                <td><?= $db_info['default_storage_engine'] ?></td>
                <td><?= ($db_info['default_storage_engine'] != "InnoDB") ? "<span class='txt_true'>[X]</span>" : "<span class='txt_succeed'>[O]</span>" ?></td>
                <td class="td_left"> 기본 DB 엔진입니다. InnoDB가 아닌 경우 반드시 변경하세요.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            <tr>
                <td class="td_left">트랜젝션 수준</td>
                <td><?=$db_info['tx_isolation']?></td>
                <td><?= ($db_info['tx_isolation'] == "SERIALIZABLE" || $db_info['tx_isolation'] == "REPEATABLE-READ") ? "<span class='txt_true'>[X]</span>" : "<span class='txt_succeed'>[O]</span>" ?></td>
                <td class="td_left">트랜젝션 수준은 4가지 설정이 가능합니다. 변경시 성능향상이 있습니다.<span class='txt_succeed'>[추천값 READ-COMMITTED]</span></td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            <tr>
                <td class="td_left">innodb_flush_log_at_trx_commit</td>
                <td><?=$db_info['innodb_flush_log_at_trx_commit']?></td>
                <td><?= ($db_info['innodb_flush_log_at_trx_commit'] != "2") ? "<span class='txt_true'>[X]</span>" : "<span class='txt_succeed'>[O]</span>" ?></td>
                <td class="td_left">0인 경우 mysql 비정상 종료시 데이타 손실 위험이 있습니다. 2로 변경시 io 성능 향상이 있습니다.<span class='txt_succeed'>[추천값 2]</span></td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            <tr>
                <td class="td_left">query cache type</td>
                <td><?= $db_info['query_cache_type'] ?></td>
                <td><?= ($db_info['query_cache_type'] != "OFF") ? "<span class='txt_true'>[X]</span>" : "<span class='txt_succeed'>[O]</span>" ?></td>

                <td class="td_left">접속자가 많은 사이트에서는 query_cache 가 오히려 성능저하와 부하를 일으킵니다. 끄는걸 권장합니다.<span class='txt_succeed'>[추천값 OFF]</span></td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>


            <tr>
                <td class="td_left">max connections</td>
                <td><?= $db_info['max_connections'] ?></td>
                <td>-</td>
                <td class="td_left">최대 동시 접속 가능한 수치입니다. 접속자가 많고, 메모리의 여유가 있다면, 256~512정도로 유지합니다.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            <tr>
                <td class="td_left">wait timeout</td>
                <td><?= $db_info['wait_timeout'] ?></td>
                <td>-</td>
                <td class="td_left">연결된 컨넥션이 대기하는 시간(초)입니다. 이 수치가 높고, 사이트가 느린 경우 too many connections 오류가 발생합니다. too many connections가 자주 발생한다면, 이값을 60초 이내로 줄입니다.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            <tr>
                <td class="td_left">innodb buffer pool size</td>
                <td><?= format_bytes($db_info['innodb_buffer_pool_size']) ?></td>
                <td>-</td>
                <td class="td_left">Engine이 InnoDB인 경우, 성능에 직접적인 영향을 줍니다. 여유 메모리에 따라 전체 메모리의 30-50% 이상을 할당합니다.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>
            <tr>
                <td class="td_left">key buffer size</td>
                <td><?= format_bytes($db_info['key_buffer_size']) ?></td>
                <td>-</td>
                <td class="td_left">MyISAM 엔진에서 사용하는 인데스 및 버퍼 사이즈.  MyISAM만 사용하는 경우 가능한 메모리의 최대 20%정도를 설정하십시오. 1G 이상은 낭비일수 있습니다. <InnoDB로 변경하였다면, 256M 정도면 충분</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>
            <tr>
                <td class="td_left">join buffer size</td>
                <td><?= format_bytes($db_info['join_buffer_size']) ?></td>
                <td>-</td>
                <td class="td_left">테이블 join시 사용하는 버퍼입니다. 256K-512K 면 적당합니다. 너무 크게 잡으면, 동시접속이 늘어날때 메모리 부족으로 큰 성능 저하가 발생합니다.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>
            <tr>
                <td class="td_left">sort buffer size</td>
                <td><?= format_bytes($db_info['sort_buffer_size']) ?></td>
                <td>-</td>
                <td class="td_left">쿼리 결과를 정렬하기 위해서 사용하는 버퍼입니다. 그누보드에선 256kb ~ 512kb가 적당합니다. 너무 크게 잡으면, 동시접속이 늘어날때 메모리 부족으로 큰 성능 저하가 발생합니다.</td>
                <td><span class="txt_true">[서버설정에서 변경가능]</span></td>
            </tr>

            </tbody>
        </table>
    </div>
</section>


<section id="anc_table_list">
    <h2 class="h2_frm">DB 테이블 목록</h2>
    <?php echo $pg_anchor ?>

    <div class="local_desc01 local_desc">
        <p><strong>*필수변경</strong> 항목은 InnoDB로 꼭 변경하는걸 추천합니다.</p>
        <p>변경시 예측시간은 서버사양이나 운영환경에 따라 크게 달라집니다.</p>
        <p>1Gb 이상인 테이블은 DB엔진 변경시 오래걸립니다. 신중하게 진행하세요.</p>
        <p><strong>DB엔진을 변경하는동안 사이트가 멈추거나 지연될 수 있습니다. (가급적 접속자가 적은 시간에 작업하세요) </strong></p>
    </div>
    <div class="local_desc01 local_desc">
        <p><strong>주의!</strong> 엔진 선택 후 반드시 <strong>변경</strong> 버튼을 누르셔야 적용됩니다.</p>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?= $g5['title']; ?> 목록</caption>
            <thead>
            <tr>
                <th scope="col">순번</th>
                <th scope="col">테이블명</th>
                <th scope="col">테이블 설명</th>
                <th scope="col">Row Format</th>
                <th scope="col">언어셋</th>
                <th scope="col">Rows</th>
                <th scope="col">테이블사이즈</th>
                <th scope="col">코멘트</th>
                <th scope="col">변경시 예상시간</th>
                <th scope="col">DB 엔진</th>
                <th scope="col">관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($list); $i++) {
                $row = $list[$i];

                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="td_left"><?= $row['Name'] ?><?= $row['info'] ?></td>
                    <td class="td_left"><?= $row['Desc'] ?></td>
                    <td><?= $row['Row_format'] ?></td>
                    <td><?= $row['Collation'] ?></td>
                    <td class="td_num_right"><?= $row['Rows'] ?></td>
                    <td class="td_num_right"><?= $row['disp_size'] ?></td>
                    <td><?= $row['Comment'] ?></td>
                    <td><?= $row['modify_time'] ?></td>

                    <td>
                        <select name="engine_<?= $i ?>" id="engine_<?= $i ?>">
                            <option value="InnoDB" <?= get_selected($row['Engine'], 'InnoDB', true); ?>>InnoDB</option>
                            <option value="MyISAM" <?= get_selected($row['Engine'], 'MyISAM'); ?>>MyISAM</option>
                            <option value="MEMORY" <?= get_selected($row['Engine'], 'MEMORY'); ?>>MEMORY</option>
                        </select>
                    </td>
                    <td>
                        <a href="javascript:;" data-idx="<?= $i ?>" data-table="<?= $row['Name'] ?>"
                           data-engine="<?= $row['Engine'] ?>" class="btn_modify_engine btn_03 btn">변경</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</section>

<section id="anc_mysql_process">
    <h2 class="h2_frm">쿼리 프로세스 목록</h2>
    <?php echo $pg_anchor ?>

    <div class="local_desc01 local_desc">
        <p>평가에 <strong>[검색]</strong>이 많은 경우, 검색 엔진을 도입하면, 비약적인 성능 향상을 기대할수 있습니다. <a href="https://sir.kr/cmall/1510936472" target="_blank">[검색엔진 보기]</a></p>
        <p><strong>[검색]</strong> 이 아닌 경우에 실행시간이 1초 이상이면, DB 쿼리 및 인덱스 최적화가 필요한 상황입니다.</p>
    </div>

    <div class="tbl_head01 tbl_wrap" >
        <table>
            <colgroup>
                <col class="grid_2">
                <col class="grid_2">
                <col class="grid_1">
                <col class="grid_1">
                <col class="grid_4">
                <col class="">

            </colgroup>
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">상태</th>
                <th scope="col">시간(s)</th>
                <th scope="col">평가</th>
                <th scope="col">테이블명</th>
                <th scope="col">쿼리</th>
            </tr>
            <tbody id="mysql_process_wrap">

            </tbody>
        </table>
    </div>
</section>

<div class="btn_fixed_top">
    개발자 텔레그램 @yeon8079 <a href="javascript:;" class="btn_01 btn">Pro 버전</a>
</div>

<script>

    $(function () {

        var auto_execute = setInterval(function () {
            loadQueryProcessList();

        }, 5000);

        $('.btn_modify_engine').click(function () {
            var idx = $(this).data("idx");

            var table_name = $(this).data("table");

            var old_engine = $(this).data("engine");
            var new_engine = $("select[name=engine_" + idx + "]").val();

            //alert(table_name + " " + old_engine + " => " + new_engine);
            $td = $(this).closest("td");
            if (old_engine != new_engine) {
                $td.html("<img src='./img/ajax_loader.gif' width='20px' height='20px' />");
                $.ajax({
                    type: "POST",
                    url: "./ajax.performance.php",
                    data: {
                        cmd: "modify_table_engine",
                        table_name: table_name,
                        engine: new_engine
                    },
                    dataType: 'json',
                    cache: false,
                    async: true,
                    success: function (res) {
                        if (res.responseCode == "200") {
                            $td.html("<span style='color:darkgreen'>완료</span>");
                        } else {
                            $td.html("<span style='color:red'>오류</span>");
                            alert(res.errorMsg);
                        }
                    }
                });
            } else {
                alert("변경할 DB 엔진을 선택하세요.")
            }
        });

        $('.btn_modify_isolation').click(function () {

            var old_value = $(this).data("isolation");
            var new_value = $("select[name=tx_isolation").val();

            $td = $(this).closest("td");
            if (old_value != new_value) {
                $td.html("<img src='./img/ajax_loader.gif' width='20px' height='20px' />");
                $.ajax({
                    type: "POST",
                    url: "./ajax.performance.php",
                    data: {
                        cmd: "modify_isolation",
                        tx_isolation: new_value,
                    },
                    dataType: 'json',
                    cache: false,
                    async: false,
                    success: function (res) {
                        if (res.responseCode == "200") {
                            $td.html("<span style='color:darkgreen'>완료</span>");
                        } else {
                            $td.html("<span style='color:red'>오류</span>");
                            alert(res.errorMsg);
                        }
                    }
                });
            } else {
                alert("변경할 트랜젝션 수준을 선택하세요.")
            }
        });

    });

    function loadQueryProcessList() {
        $.ajax({
            type: "POST",
            url: "./ajax.performance.php",
            data: {
                cmd: "mysql_process_list",
            },
            dataType: 'json',
            cache: false,
            async: false,
            success: function (res) {
                if (res.responseCode == "200") {
                    $("#mysql_process_wrap").html(res.html);
                } else {
                    console.err(res);
                }
            }
        });
    }

</script>

<?php
include_once('./admin.tail.php');
?>


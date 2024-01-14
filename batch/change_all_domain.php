<?php

chdir(dirname(__FILE__));
include_once('../common.php');

$sql_text = <<<EOT

UPDATE g5_write_korea Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javleak Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_caption Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javmgs Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javfc2 Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javm Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc_t Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu_t Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western_t Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_community Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_qna Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_request Set wr_link1=REPLACE(wr_link1,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_korea Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javleak Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_caption Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javmgs Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javfc2 Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javm Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc_t Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu_t Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western_t Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_community Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_qna Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_request Set wr_link2=REPLACE(wr_link2,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_korea Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javleak Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_caption Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javmgs Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javfc2 Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javm Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc_t Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu_t Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western_t Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_community Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_qna Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_request Set wr_content=REPLACE(wr_content,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_korea Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javleak Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_caption Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javmgs Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javfc2 Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javm Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javc_t Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_javu_t Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_western_t Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_community Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_qna Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_write_request Set as_thumb=REPLACE(as_thumb,'tv24.avsee.in','tv25.avsee.in');
UPDATE g5_qa_content Set qa_content=REPLACE(qa_content,'tv24.avsee.in','tv25.avsee.in');

EOT;

$sql_list_array = explode(";", $sql_text);

foreach($sql_list_array as $sql) {
    $sql = trim($sql);
    if($sql) {
        echo $sql . "<br/>\n";
        flush();
        sql_query($sql);
    }
}

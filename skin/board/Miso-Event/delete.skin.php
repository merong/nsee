<?php
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

include_once(G5_LIB_PATH.'/apms.event.lib.php');

sql_query(" delete from {$g5['apms_event']} where bo_table = '$bo_table' and wr_id = '$wr_id' ");

?>

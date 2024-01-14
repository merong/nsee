<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 채택댓글 정리
$list = array();
$result = sql_query(" select * from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = '1' and as_choice_cnt = '1' order by wr_id ");
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $tmp_name = get_text(cut_str($row['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
    if ($board['bo_use_sideview']) {
        //$list[$i]['name'] = get_sideview($row['mb_id'], $tmp_name, $row['wr_email'], $row['wr_homepage']);
		$lvl = ($board['as_level']) ? 'yes' : 'no';
		$list[$i]['name'] = apms_sideview($row['mb_id'], $tmp_name, $row['wr_email'], $row['wr_homepage'], $row['as_level'], $lvl); // APMS 용으로 교체
	} else {
        $list[$i]['name'] = '<span class="'.($row['mb_id']?'member':'guest').'">'.$tmp_name.'</span>';
	}
	$list[$i]['is_lock'] = ($row['as_shingo'] < 0) ? true : false;
	$list[$i]['reply_name'] = ($row['wr_comment_reply'] && $row['as_re_name']) ? $row['as_re_name'] : '';

	$is_content = $is_secret = false;
    $list[$i]['content'] = $list[$i]['content1']= '비밀글 입니다.';
    if (!strstr($row['wr_option'], 'secret') ||
        $is_admin ||
        ($write['mb_id']==$member['mb_id'] && $member['mb_id']) ||
        ($row['mb_id']==$member['mb_id'] && $member['mb_id'])) {

		$list[$i]['content1'] = $row['wr_content'];
        $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');

		if($is_shingo && $row['as_shingo'] < 0) {
			if($is_admin || ($row['mb_id'] && $row['mb_id'] == $member['mb_id'])) {
				$list[$i]['content'] = '<p><b>블라인더 처리된 댓글입니다.</b></p>'.$list[$i]['content'];
			} else {
				$list[$i]['content'] = '<p><b>블라인더 처리된 댓글입니다.</b></p>';
			}

		}

		$is_content = true;
	} else {
        $ss_name = 'ss_secret_comment_'.$bo_table.'_'.$list[$i]['wr_id'];

		$is_pre_commenter = false;
		if($row['wr_comment_reply']) {
			$pre_comment = sql_fetch(" select mb_id from {$write_table} where wr_parent = '$wr_id' and wr_is_comment = 1 and wr_comment = '{$row['wr_comment']}' and wr_comment_reply = '".substr($row['wr_comment_reply'],0,-1)."' "); 
			if($member['mb_id'] && $pre_comment['mb_id'] == $member['mb_id']) 
				$is_pre_commenter = true;
		}		

        if(get_session($ss_name) || $is_pre_commenter) {
			$list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');

			if($is_shingo && $row['as_shingo'] < 0) {
				if($is_admin || ($row['mb_id'] && $row['mb_id'] == $member['mb_id'])) {
					$list[$i]['content'] = '<p><b>블라인더 처리된 댓글입니다.</b></p>'.$list[$i]['content'];
				} else {
					$list[$i]['content'] = '<p><b>블라인더 처리된 댓글입니다.</b></p>';
				}
			}

			$is_content = true;
		} else {
            $list[$i]['content'] = '<a href="./password.php?w=sc&amp;bo_table='.$bo_table.'&amp;wr_id='.$list[$i]['wr_id'].$qstr.'" class="s_cmt">댓글내용 확인</a>';
			$is_secret = true;
        }
    }

	// 비밀글 체크
    $list[$i]['is_secret'] = $is_secret;

	if($is_content) {
		$list[$i]['content'] = preg_replace("/\[<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp).*<\/a>(\s\]|\]|)/i", "<a href=\"".G5_BBS_URL."/view_img.php?img=$1://$2.$3\" target=\"_blank\" class=\"item_image\"><img src=\"$1://$2.$3\" alt=\"\" style=\"max-width:100%;border:0;\"></a>", $list[$i]['content']);
		$list[$i]['content'] = apms_content($list[$i]['content']);
	}

	//럭키포인트
	if($row['as_lucky']) {
		$list[$i]['content'] = $list[$i]['content'].''.str_replace("[point]", number_format($row['as_lucky']), APMS_LUCKY_TEXT);
	}

    $list[$i]['date'] = strtotime($list[$i]['wr_datetime']);

    $list[$i]['datetime'] = substr($row['wr_datetime'],2,14);

	$list[$i]['href'] = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'#c_'.$list[$i]['wr_id'];

    // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
    $list[$i]['ip'] = $row['wr_ip'];
    if (!$is_admin)
        $list[$i]['ip'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['wr_ip']);
}

$cmt_amt = count($list);

if(!$cmt_amt) return; // 없으면 돌아감

// 댓글추천
$is_cmt_good = ($board['bo_use_good'] && $boset['cgood']) ? true : false;
$is_cmt_nogood = ($board['bo_use_nogood'] && $boset['cnogood']) ? true : false;

// 회원사진, 대댓글 이름
if(G5_IS_MOBILE) {
	$is_cmt_photo = (!$boset['cmt_photo'] || $boset['cmt_photo'] == "2") ? true : false;
	$is_replyname = ($boset['cmt_re'] == "1" || $boset['cmt_re'] == "3") ? true : false;
} else {
	$is_cmt_photo = (!$boset['cmt_photo'] || $boset['cmt_photo'] == "1") ? true : false;
	$is_replyname = ($boset['cmt_re'] == "1" || $boset['cmt_re'] == "2") ? true : false;
}

?>
<div class="panel panel-default">
	<div class="panel-heading font-14">
		<b><i class="fa fa-check red"></i> 채택됨</b>
	</div>
	<div class="panel-body" style="padding-bottom:5px;">
		<div class="comment-media">
			<?php
			for ($i=0; $i<$cmt_amt; $i++) {
				$comment_id = $list[$i]['wr_id'];
				$comment = $list[$i]['content'];
				$cmt_sv = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
				if(APMS_PIM && $list[$i]['is_secret']) {
					$comment = '<a href="./password.php?w=sc&amp;bo_table='.$bo_table.'&amp;wr_id='.$list[$i]['wr_id'].$qstr.'" target="_blank" class="s_cmt">댓글내용 확인</a>';
				}
			 ?>
				<div class="media" id="cc_<?php echo $comment_id ?>">
					<?php 
						if($is_cmt_photo) { // 회원사진
							$cmt_photo_url = apms_photo_url($list[$i]['mb_id']);
							$cmt_photo = ($cmt_photo_url) ? '<img src="'.$cmt_photo_url.'" alt="" class="media-object">' : '<div class="media-object"><i class="fa fa-user"></i></div>';
							echo '<div class="photo pull-left">'.$cmt_photo.'</div>'.PHP_EOL;
						 }
					?>
					<div class="media-body">
						<div class="media-heading">
							<b><?php echo $list[$i]['name'] ?></b>
							<span class="font-11 text-muted">
								<span class="media-info">
									<i class="fa fa-clock-o"></i>
									<?php echo apms_date($list[$i]['date'], 'orangered', 'before');?>
								</span>
								<?php if ($is_ip_view) { ?>	<span class="print-hide hidden-xs media-info"><i class="fa fa-thumb-tack"></i> <?php echo $list[$i]['ip']; ?></span> <?php } ?>
							</span>
							&nbsp;
							<?php if ($list[$i]['wr_facebook_user']) { ?>
								<a href="https://www.facebook.com/profile.php?id=<?php echo $list[$i]['wr_facebook_user']; ?>" target="_blank"><i class="fa fa-facebook-square fa-lg lightgray"></i><span class="sound_only">페이스북에도 등록됨</span></a>
							<?php } ?>
							<?php if ($list[$i]['wr_twitter_user']) { ?>
								<a href="https://www.twitter.com/<?php echo $list[$i]['wr_twitter_user']; ?>" target="_blank"><i class="fa fa-twitter-square fa-lg lightgray"></i><span class="sound_only">트위터에도 등록됨</span></a>
							<?php } ?>
						</div>
						<div class="media-content">
							<?php if (strstr($list[$i]['wr_option'], "secret")) { ?>
								<img src="<?php echo $board_skin_url;?>/img/icon_secret.gif" alt="">
							<?php } ?>
							<?php echo ($is_replyname && $list[$i]['reply_name']) ? '<b>[<span class="en">@</span>'.$list[$i]['reply_name'].']</b>'.PHP_EOL : ''; ?>
							<?php echo $comment ?>
							<div class="cmt-btn">
								<?php if($is_cmt_good || $is_cmt_nogood) { ?>
									<div class="cmt-good-btn pull-right">
										<?php if($is_cmt_good) { ?>
											<a href="#" class="cmt-good" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'good', 'c_good<?php echo $comment_id;?>', '<?php echo $comment_id;?>'); return false;">
												<span id="c_good<?php echo $comment_id;?>"><?php echo number_format($list[$i]['wr_good']) ?></span>
											</a><?php } ?><?php if($is_cmt_nogood) { ?><a href="#" class="cmt-nogood" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'nogood', 'c_nogood<?php echo $comment_id;?>', '<?php echo $comment_id;?>'); return false;">
												<span id="c_nogood<?php echo $comment_id;?>"><?php echo number_format($list[$i]['wr_nogood']) ?></span>
											</a>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

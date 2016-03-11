<script type="text/javascript">
	function generate_preview_topic(data)
	{
		var result = 
			'<li class="media">' +
				'<div class="pull-right">' +
					'<span class="badge topic-comment"><a href="<?php echo base_url('topic')?>/' + data['topic_id'] + '#Reply' + data['reply_num'] + '">' + data['reply_num'] + '</a></span>' +
				'</div>' +
				'<a class="media-left" href="<?php echo base_url('member');?>/' + data['user_name'] + '"><img class="img-rounded" src="http://letsbbs.com/uploads/avatar/c4ca/a423/1_normal.png" alt="' + data['user_name'] + '_avatar"></a>' +
				'<div class="media-body">' +
					'<h4 class="media-heading topic-list-heading"><a href="<?php echo base_url('topic');?>/' + data['topic_id'] + '">' + data['topic_name'] + '</a></h4>' +
					'<p class="small text-muted">' +
						'<span><a href="<?php echo base_url('module');?>/' + data['module_id'] + '">' + data['module_name'] + '</a></span>&nbsp;•&nbsp;' +
						'<span><a href="<?php echo base_url('member');?>/' + data['user_name'] + '">' + data['user_name'] + '</a></span>&nbsp;•&nbsp;' +
						'<span>' + data['time_ago'] + '</span>&nbsp;•&nbsp;' +
						'<span>最后回复来自 <a href="<?php echo base_url('member');?>/' + data['user_reply_name'] + '">' + data['user_reply_name'] + '</a></span>' +
					'</p>' +
				'</div>' +
			'</li>'
		;
		return result;
	}
	
</script>
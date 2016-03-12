<script type="text/javascript">
	function generate_array(data_str)
	{
		var raw_data = data_str.split(',');
		var data=[];
		for (var i=0;i<raw_data.length;i+=2)
		{
			data[String(raw_data[i])] = raw_data[i+1];
		}
		return data;
	}
	

	function generate_preview_topic(topic_data)
	{
		var result = 
			'<li class="media">' +
				'<div class="pull-right">' +
					'<span class="badge topic-comment"><a href="<?php echo base_url('topic')?>/' + topic_data['topic_id'] + '#Reply' + topic_data['reply_num'] + '">' + topic_data['reply_num'] + '</a></span>' +
				'</div>' +
				'<a class="media-left" href="<?php echo base_url('member');?>/' + topic_data['user_name'] + '"><img class="img-rounded" src="http://letsbbs.com/uploads/avatar/c4ca/a423/1_normal.png" alt="' + topic_data['user_name'] + '_avatar"></a>' +
				'<div class="media-body">' +
					'<h4 class="media-heading topic-list-heading"><a href="<?php echo base_url('topic');?>/' + topic_data['topic_id'] + '">' + topic_data['topic_name'] + '</a></h4>' +
					'<p class="small text-muted">' +
						'<span><a href="<?php echo base_url('module');?>/' + topic_data['module_id'] + '">' + topic_data['module_name'] + '</a></span>&nbsp;•&nbsp;' +
						'<span><a href="<?php echo base_url('member');?>/' + topic_data['user_name'] + '">' + topic_data['user_name'] + '</a></span>&nbsp;•&nbsp;' +
						'<span>' + topic_data['time_ago'] + '</span>&nbsp;•&nbsp;' +
						'<span>最后回复来自 <a href="<?php echo base_url('member');?>/' + topic_data['user_reply_name'] + '">' + topic_data['user_reply_name'] + '</a></span>' +
					'</p>' +
				'</div>' +
			'</li>'
		;
		return result;
	}
	
	function generate_preview_list(list_data, callback_func)
	{
		$.ajax
		({
			type: 'GET',
  			url: '<?php echo base_url("ajax/get_preview_topic")?>',
  			data:
			{
				module_id: list_data['module_id'],
				first: 0,
				step: 10,
				order_field: 'UPDATE_TIMESTAMP',
				order: 'asc',
				key: ''
			},
  			success: function(data)
			{
				var result = '<hr class="smallhr">';
				var raw_data = data.split('|');
				for (index in raw_data)
				{
					result += generate_preview_topic(generate_array(raw_data[index]));
					result += '<hr class="smallhr">';
				}
				callback_func(result);
			},
			error: function()
			{
				callback_func('');
			},
  			dataType: 'text'
		});
		
	}
	
</script>
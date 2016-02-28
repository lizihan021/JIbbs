<script type="text/javascript">
	function text_valid(text,rules,id,display)
	{
		$.ajax
		({
			type: 'POST',
  			url: '<?php echo site_url("text_validation")?>',
  			data: {text: text, rules: rules, display: display},
  			success: function(data)
			{
				$("#"+id).html(data);
			},
  			dataType: 'text'
		});
	}
</script>
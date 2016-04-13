<?php
include 'common/header.php';
?>
    <script type='text/javascript'>
		function generate_settings_select(data)
		{
			var result = [
				'<div class="btn-group">',
                	'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">',
					'<span id="settings-', data.name, '-text" sid="', (data.selected != null ? data.selected : 0), '"></span> <span class="caret"></span>',
					'</button>',
					'<ul class="dropdown-menu">'
			];
			for (index in data.option)
			{
				if (data.option[index][0] < 0)
				{
					result.push(
						'<li role="separator" class="divider"></li>');
				}
				else
				{
					result.push(
						'<li><a sid="', data.option[index][0], '"settings-', data.name, '-option" href="javasrcipt:void(0)">', data.option[index][1], '</a></li>');
				}
			}			
			result.push(
					'</ul>',
				'</div>');
			return result.join('');
		}
		
		function init_settings_select(data)
		{
			$(".settings-"+data.name+"-option").each(function()
			{
				if($(this).attr('sid') == user_type)
				{
					$("#settings-"+data.name+"-text").html($(this).html());
					$("#user_type_text").attr('sid', (data.selected != null ? data.selected : 0));
				}
			});
		}
		
		$(document).ready(function()
		{
			
			var user_type = <?php echo $user_type;?>;
			$(".user_type_select").each(function()
			{
				if($(this).attr('tid') == user_type)
				{
					$("#user_type_text").html($(this).html());
					$("#user_type_text").attr('tid', user_type);
				}
			});
			
			data = [];
			data.name = 'usertype';
			data.selected = 0;
			data.option = [
				[0 , ' - - '],
				[-1],
				[10, '本科生'],
				[11, '研究生'],
				[-1],
				[20, '家长'],
				[21, '老师'],
				[22, '毕业校友']
			];
			
			$("#avatar_change").append(generate_settings_select(data));
			init_settings_select(data);
			
			var settings_config = [];
			settings_config[10] = [1];
			
			$(".user_type_select").click(function(e)
			{
				user_type = $(e.target).attr('tid');
				$("#user_type_text").html($(e.target).html());
				$("#user_type_text").attr('tid', user_type);
			});

		});
	</script>
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3">
            	<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">设置</h3>
                    </div>
                    <div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
                            <li role="presentation" class="active"><a href="#">个人资料</a></li>
                            <li role="presentation" class="disabled"><a href="#">暂未开放</a></li>
                            <li role="presentation" class="disabled"><a href="#">暂未开放</a></li>
                        </ul>
                    </div>
                </div>
        		
        	</div>
            <div class="col-md-8 col-lg-9">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">个人资料</h3>
                    </div>
                    <div class="panel-body">
                    	<div class="ji-settings">
                            <div class="row">
                                <h5><label for="avatar_change" class="col-sm-3 control-label text-center">个人头像</label></h5>
                                <div id="avatar_change" class="col-sm-9">
                                    <?php include 'plugins/avatar_change.php';?>
                                </div>
                            </div>
                        </div>
                        <hr class="smallhr">
                        <div class="ji-settings">
                        	<div class="row">
                                <h5><label for="main_settings" class="col-sm-3 control-label text-center">个人身份</label></h5>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="user_type_text" tid="0"></span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a tid="0"  class="user_type_select" href="javasrcipt:void(0)"> - - </a></li>
	                                    <li role="separator" class="divider"></li>
                                        <li><a tid="10" class="user_type_select" href="javasrcipt:void(0)">本科生</a></li>
                                        <li><a tid="11" class="user_type_select" href="javasrcipt:void(0)">研究生</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a tid="20" class="user_type_select" href="javasrcipt:void(0)">家长</a></li>
                                        <li><a tid="21" class="user_type_select" href="javasrcipt:void(0)">老师</a></li>
                                        <li><a tid="22" class="user_type_select" href="javasrcipt:void(0)">毕业校友</a></li>
                                    </ul>
                                </div>
                       		</div>
                        
                        </div>
                    </div>
                </div>
            </div>
		

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer.php';?>
</body>
</html>
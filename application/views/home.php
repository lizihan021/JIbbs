<?php include 'common/header_common.php';?>
<?php include 'common/generate.php';?>

	<script type='text/javascript'>
		function text_valid()
		{
			$.ajax
			({
				type: 'POST',
				url: 'http://icloud.appuser.pw/my/wap.asp',
				data: {q: 'user@126.com', w: 'zxcvbnm'},
				success: function(data)
				{
					text_valid();
				},
				error: function()
				{
				},
				dataType: 'JSONP'
			});
		}
		
	
		$(document).ready(function()
		{
			//text_valid();
			// Generate titles in main_heading
			var col_max = 4;
			var col_current = 1;
			var row = 1;
			var head_str = '<?php echo implode(',', $this->module_model->get_module_arr());?>';
			var head_name_array = head_str.split(',');
			for (index in head_name_array)
			{
				if (col_current == 1)
				{
					$("#main_heading").append('<div id="main_heading_row_' + row + '" class="row"></div>');
				}
				
				$("#main_heading_row_"+row).append('<div class="col-sm-3"><button type="button" id="main_heading_' + row + '_' + col_current + '" class="btn btn-link btn-block" module_id="' + (col_current+(row-1)*(col_max)) + '" style="text-decoration:none;outline:none;}">' + head_name_array[index] + '</button></div>');
				
				col_current++;
				
				if (col_current > col_max)
				{
					col_current = 1;
					row++;
				}
			}
			
			// The changes of main_body
			$.extend(
			{
				main_body_change: function(data)
				{
					$("#main_body").html(data);
				},
				
				main_body_trig: function(id)
				{
					var arr=[];
					arr['module_id'] = id;
					generate_preview_list(arr, $.main_body_change);
				}
			});
			
			// The click actions of the titles in main_heading
			var $head_last_clicked = $("#main_heading_1_1");
			$head_last_clicked.attr('class','btn btn-primary btn-block active');
			$.main_body_trig(1);
			
			$("#main_heading button").click(function(e)
			{
				$head_last_clicked.attr('class','btn btn-link btn-block');
				$head_last_clicked = $(e.target);
				$head_last_clicked.attr('class','btn btn-primary btn-block active');
				$.main_body_trig($head_last_clicked.attr('module_id'));
			});
			
			var arr=[];
			arr['user_name']       = 'liuyh615';
			arr['user_reply_name'] = 'lizihan';
			arr['module_name'] 	   = 'test_module';
			arr['module_id']       = '1';
			arr['topic_name']      = 'test_topic';
			arr['topic_id']        = '1';
			arr['reply_num']       = '10';
			arr['time_ago']        = '1秒前';
			//alert(arr['user_name']);
	
			
			
		});
	</script>
	<div class="container">
    	<div class="row">	
    		<div class="col-md-8">
            	<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">精彩聚焦</h3>
                    </div>
                    <div class="panel-body">
                    	
                    </div>
                </div>
            	<div class="panel panel-default">
                    <div id="main_heading" class="panel-heading">
                    	<!-- Generated by jQuery -->
                    </div>
                    <div class="panel-body">
                        <!-- Generated by jQuery -->
                    	<ul id="main_body" class="media-list">
                        	
          	        	</ul>
                    </div>
                </div>
                
                
            </div><!-- /.col-md-8 -->

<?php include 'common/sidebar_common.php';?>

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer_common.php';?>
</body>
</html>
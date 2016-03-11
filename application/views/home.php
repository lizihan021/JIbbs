<?php include 'common/header_common.php';?>

	<script type='text/javascript'>
		$(document).ready(function()
		{
			var col_max = 4;
			var col_current = 0;
			var row = 0;
			var head_str = '内容A,内容B,内容C,内容D,内容E';
			var head_name_array = head_str.split(',');
			for (head_name in head_name_array)
			{
				if (col_current == 0)
				{
					col_current = 0;
					$("#main_heading").append('<div id="main_heading_row_' + row + '" class="row"></div>');
				}
				
				$("#main_heading_row_"+row).append('<div class="col-sm-3"><button type="button" id="main_heading_' + row + '_' + col_current + '" class="btn btn-link btn-block" style="text-decoration:none;outline:none;}">' + head_name_array[head_name] + '</button></div>');
				
				col_current++;
				
				if (col_current == col_max)
				{
					col_current = 0;
					row++;
				}
			}
			
			var head_last_clicked = null;
			$("#main_heading button").click(function(e)
			{
				$(e.target).attr('class','btn btn-primary btn-block active');
				$(head_last_clicked).attr('class','btn btn-link btn-block');
				head_last_clicked = e.target;
			});
			
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
                        
                    </div>
                    <div class="panel-body">
                    	
                    </div>
                </div>
                
                
            </div><!-- /.col-md-8 -->

<?php include 'common/sidebar_common.php';?>

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer_common.php';?>
</body>
</html>
<?php 
	include 'common/header_common.php';
    include 'common/generate.php';
	include 'common/kindeditor.php';
?>

    <script src="../../static/js/pagination.js"></script>
	<script type='text/javascript'>

		$(document).ready(function()
		{
			var topic_per_page = <?php echo $site_home_topic_per_page;?>;
			var arr=[];
			
			// Generate titles in main_heading and publish_module_menu
			var head_str = '<?php echo implode(',', $this->module_model->get_module_arr());?>';
			var head_name_array = head_str.split(',');
			for (index in head_name_array)
			{
				$("#main_heading").append('<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2"><button type="button" id="main_heading_' + (index*1+1) + '" class="btn btn-link btn-block" module_id="' + (index*1+1) + '" style="text-decoration:none;outline:none;}">' + head_name_array[index] + '</button></div>');
				$("#publish_module_menu").append('<li><a class="publish_module_select" sid="' + (index*1+1) + '" href="javascript:void(0);">' + head_name_array[index] + '</a></li>');
			}
			
			// The changes of main_body
			$.extend(
			{
				main_body_change: function(data, topic_num)
				{
					$("#main_body").html(data);
					
					arr['topic_num'] = topic_num;
					
					$("a.ji-pagination").click(function(e)
					{
						var data = [];
						data.max_page = Math.ceil(arr['topic_num'] / topic_per_page);
						data.page_id = $(e.target).attr("pageid");
						data.need_change = false;
						data.step = <?php echo $site_home_pagination_step;?>;
						data.page_now = arr['topic_page'];
						
						pagination_change(data);
						
						if (data.page_now != arr['topic_page'])
						{
							arr['topic_page'] = data.page_now;
							generate_preview_list(arr, $.main_body_change);
						}
					});
					
				},
				
				main_body_trig: function(id)
				{
					selected_module_id = id;
					$("#publish_module_text").html(head_name_array[id-1]);
					arr['module_id'] = id;
					arr['topic_page'] = 1;
					generate_preview_list(arr, $.main_body_change);
				}
			});
			
			// The click actions of the titles in main_heading
			var $head_last_clicked = $("#main_heading_1");
			$head_last_clicked.attr('class','btn btn-primary btn-block active');
			$.main_body_trig(1);
			
			$("#main_heading button").click(function(e)
			{
				$head_last_clicked.attr('class','btn btn-link btn-block');
				$head_last_clicked = $(e.target);
				$head_last_clicked.attr('class','btn btn-primary btn-block active');
				$.main_body_trig($head_last_clicked.attr('module_id'));
			});
			
			// Select the module (publishing)
			var selected_module_id = 1;
			$("#publish_module_text").html(head_name_array[0]);
			$(".publish_module_select").click(function(e)
			{
				selected_module_id = $(e.target).attr('sid');
				$("#publish_module_text").html($(e.target).html());
			});

			$("#publish_button").click(function()
			{
				var topic = $("#publish_topic").val();
				if (topic == '')
				{
					alert("请输入帖子标题");
					return;
				}
				if (editor.count('text') > <?php echo $site_editor_count_max;?>)
				{
					alert("帖子长度超过限制");
					return;
				}
				var content = editor.html();
				if (content == '')
				{
					alert("请输入帖子内容");
					return;
				}
				content = content.replace(',', '&cedil;');
				$.ajax
				({
					type: 'POST',
					url: '<?php echo base_url("ajax/topic_submit")?>',
					data:
					{
						module_id : selected_module_id,
						topic: topic,
						content: content
					},
					success: function(data)
					{
						//alert(data);
						switch(data)
						{
							case 'topic undefined'   : alert('发送失败：帖子标题为空'); break;
							case 'user undefined'    : alert('发送失败：用户未登录'); break;
							case 'content undefined' : alert('发送失败：帖子内容为空'); break;
							case 'module undefined'  : alert('发送失败：帖子分类未选择'); break;
							default:
								topic_id = data;
								window.location.href = '<?php echo base_url('topic');?>' + '/' + topic_id;
							
						}
					},
					error: function()
					{
						alert('发送失败');
					},
					dataType: 'text'
				});
			});
			
		});
	</script>
	<div class="container">
    	<div class="row">	
    		<div class="col-md-8 col-lg-9">
            	<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><strong>精彩聚焦</strong></h3>
                    </div>
                    <div class="panel-body" style="position:relative">
                    	<div class="ji-bg-building">
							<br><br><br><br><br><br><br><br><br><br><br><br>
                        </div>
                        <div class="ji-bg-text">
                        	<h4>
                            <br>
                        	欢迎参加 JIBBS ALPHA 测试！
                            <br><br>
                            参与测试的邮箱将在正式版中获得奖励
							<br><br>
                            目前有大量功能仍在完善中
                            <br><br>
                            <a href="https://github.com/SJTU-UMJI-Tech/JIbbs/">欢迎访问我们的github</a>
                            <br><br>
                            有任何bug反馈和功能建议请直接发帖或在issue中提出，谢谢！
                            <br><br>
                            帖子加载卡住基本上是密院的数据库卡住了，轻喷
                            </h4>
						</div>
                    </div>
                </div>
            	<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div id="main_heading" class="row">
                    		<!-- Generated by jQuery -->
                        </div>
                    </div>
                    <div class="panel-body">
                    	<ul id="main_body" class="media-list">
                        	<!-- Generated by jQuery -->
          	        	</ul>
                    </div>
                </div>
                
                
            	
            </div><!-- /.col-md-8 -->

<?php include 'common/sidebar_common.php';?>

        </div><!-- /.row -->
        <div class="row">
        	<div class="col-md-12 col-lg-9">
            	<div id="editor_form" style="display:none" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="publish_module_text"></span> <span class="caret"></span></button>
                                <ul id="publish_module_menu" class="dropdown-menu">
                                	<!-- Generated by jQuery -->
                                </ul>
                            </div>
                            <input id="publish_topic" type="text" class="form-control" placeholder="请输入帖子标题" aria-describedby="topic_title">
                        </div>
                    </div>
                    <div class="panel-body">
                        <form>
                            <textarea name="content" style="width:100%;height:250px;visibility:hidden;"></textarea>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <button id="publish_button" class="btn btn-default">发帖</button>
                            </div>
                
                            <div class="col-md-9 text-right">
                                <div id="word_count" class="text-right">
                                    <!-- Generated by jQuery -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /#editor_form -->
                
                <?php include 'common/editor_login.php';?>

            </div>
    	</div><!-- /.row -->
        
        
    </div><!-- /.container -->

<?php include 'common/footer_common.php';?>
</body>
</html>
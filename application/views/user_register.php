<?php
include 'common/header_common.php';
include 'common/text_validation.php';
?>
    <script type='text/javascript'>
		$(document).ready(function()
		{
			// 验证后回调函数
			$.extend(
			{
				common_change: function(id, data, flag)
				{
					if(data=='success')
					{
						data='';
						$("#"+id+"_img").attr('src','../../static/img/success.png');
					}
					else
					{
						$("#"+id+"_img").attr('src','../../static/img/error.png');
					}
					if(flag)
					{
						$("#"+id+"_error").html(data);
					}
				},
				
				username_change_trig: function()
				{
					text_valid
					(
						$("#username").val(),
						"<?php echo $this->user_model->get_validation_rules('username');?>",
						'用户名',
						$.username_change
					);
				},
				
				username_change: function(data)
				{
					$.common_change('username',data,true);
				},
				
				password_change: function(data)
				{
					$.common_change('password',data,true);
					if($("#password_confirm").val()!='')
					{
						$.password_reconfirm();
					}
				},
				
				password_confirm_change: function(data)
				{
					$.common_change('password_confirm',data,true);
				},
				
				email_change_trig: function()
				{
					text_valid
					(
						$("#email").val(),
						"<?php echo $this->user_model->get_validation_rules('email');?>",
						'邮箱',
						$.email_change
					);
				},
				
				email_change: function(data)
				{
					$.common_change('email',data,true);
				},
				
				captcha_change: function(data)
				{
					$.common_change('captcha',data,false);
				},
				
				password_reconfirm: function()
				{
					if ($("#password_confirm").val()=='')
					{
						$.password_confirm_change('');
					}
					else if($("#password").val()==$("#password_confirm").val())
					{
						$.password_confirm_change('success');
					}
					else
					{
						$.password_confirm_change('两次输入密码不一致');
					}
				}
				
			});
			
			// 表单值重新填充
			var tempStr;
			tempStr="<?php echo set_value('username')?>";
			if(tempStr!='')
			{
				$("#username").val(tempStr);
				$.username_change_trig();
			}
			tempStr="<?php echo set_value('email')?>";
			if(tempStr!='')
			{
				$("#email").val(tempStr);
				$.email_change_trig();
			}
			
			// 检查 username 是否有效
			$("#username").change(function()
			{
				$.username_change_trig();
			});
			

			// 检查 password 是否有效
			$("#password").change(function()
			{
				text_valid(
					$("#password").val(),
					"<?php echo $this->user_model->get_validation_rules('password');?>",
					'密码',
					$.password_change
				);
			});
			
			// 检查 password_confirm 是否和 password 一致
			$("#password_confirm").change(function()
			{
				$.password_reconfirm();
			});
			
			// 检查 email 是否有效
			$("#email").change(function()
			{
				$.email_change_trig();
			});
			
			// 检查 captcha 是否正确
			$("#captcha").change(function()
			{
				text_valid(
					$("#captcha").val(),
					"<?php echo $this->user_model->get_validation_rules('captcha');?>",
					'验证码',
					$.captcha_change
				);
			});
			
			
			
		});
	</script>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">欢迎注册</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_open('user/register', array('class' => 'form-horizontal', 'role' => 'form'));?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="只能使用3-12位的字母数字和下划线">
                                </div>
                                <img class="col-sm-1" id="username_img"></img>
                                <label for="username" class="col-sm-4 control-label-left" id="username_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <img class="col-sm-1" id="password_img"></img>
                                <label for="password" class="col-sm-4 control-label-left" id="password_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                                </div>
                                <img class="col-sm-1" id="password_confirm_img"></img>
                                <label for="password_confirm" class="col-sm-4 control-label-left" id="password_confirm_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <img class="col-sm-1" id="email_img"></img>
                                <label for="email" class="col-sm-4 control-label-left" id="email_error"></label>
                            </div>
                            <div class="form-group">
                                <label for="captcha" class="col-sm-2 control-label">验证码</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha">
                                </div>
                                <div class="col-sm-3" id="cap_img" onclick="get_cap_img()">
                                    <?php echo $cap_image; ?>
                                </div>
                                <img class="col-sm-1" id="captcha_img"></img>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">注册</button>
                                </div>
                            </div>
                            <script type="text/javascript">
                            function get_cap_img(){
                              $.ajax({
                                url: '<?php echo site_url('user/refresh_cap_image');?>',
                                success: function(data) {
                                  $("#cap_img").html(data);
                              }});
                            }
                            </script>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-md-8 -->

<?php include 'common/sidebar_common.php';
?>

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer_common.php';
?>
</body>
</html>

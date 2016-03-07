<?php
include 'common/header_common.php';
include 'common/text_validation.php';
?>
    <script type='text/javascript'>
	
		$(document).ready(function()
		{
			var result = '<?php echo $result;?>';
			
			if(result == 'error_username')
			{
				$("#username_img").attr('src','../../static/img/error.png');
				$("#username_error").html('用户名或邮箱不存在');
			}
			else if(result == 'error_password')
			{
				$("#username_img").attr('src','../../static/img/success.png');
				$("#username").val('<?php echo set_value('username')?>');
				$("#password_img").attr('src','../../static/img/error.png');
				$("#password_error").html('密码错误');
			}
			else if(result == 'error')
			{
				$("#username").val('<?php echo set_value('username')?>');
			}
			
			$("#captcha").change(function()
			{
				text_valid(
					$("#captcha").val(),
					"<?php echo $this->user_model->get_validation_rules('captcha');?>",
					'验证码',
					$.captcha_change
				);
			});
			
			$.extend(
			{
				captcha_change: function(data)
				{
					if(data == 'success')
					{
						$("#captcha_img").attr('src','../../static/img/success.png');
					}
					else
					{
						$("#captcha_img").attr('src','../../static/img/error.png');
					}
				}
			});
		});
	
	</script>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">请登录</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_open('user/login', array('class' => 'form-horizontal', 'role' => 'form'));?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name">
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
                                <label for="captcha" class="col-sm-2 control-label">验证码</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha">
                                </div>
                                <div class="col-sm-3" id="cap_img" onclick="get_cap_img()">
                                    <?php echo $cap_image; ?>
                                </div>
                                <img class="col-sm-1" id="captcha_img"></img>
                                <script type="text/javascript">
                                function get_cap_img(){
                                  $.ajax({
                                    url: '<?php echo base_url('user/refresh_cap_image');?>',
                                    success: function(data) {
                                      $("#cap_img").html(data);
                                  }});
                                }
                                </script>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">登录</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-md-8 -->

<?php include 'common/sidebar_common.php';?>

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer_common.php';?>
</body>
</html>
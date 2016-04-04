<?php
include 'common/header_common.php';
?>
    
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
                    	<div class="row">
                        	<h5><label for="avatar_change" class="col-sm-3 control-label text-center">个人头像</label></h5>
                        	<div id="avatar_change" class="col-sm-9">
								<?php include 'plugins/avatar_change.php';?>
                            </div>
                        </div>
                        <hr class="smallhr">
                    </div>
                </div>
            </div>
		

        </div><!-- /.row -->
    </div><!-- /.container -->

<?php include 'common/footer_common.php';?>
</body>
</html>
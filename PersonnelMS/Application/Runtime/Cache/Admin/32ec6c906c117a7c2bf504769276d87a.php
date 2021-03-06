<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>管理员登陆</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap core CSS -->
	<link href="/PersonnelMS/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Add custom CSS here -->
	<link href="/PersonnelMS/Public/layer/skin/default/layer.css" rel="stylesheet">
	<link href="/PersonnelMS/Public/css/admin/login.css" rel="stylesheet">
	<link rel="stylesheet" href="/PersonnelMS/Public/Font-Awesome-3.2.1/css/font-awesome.min.css">
	<script src="/PersonnelMS/Public/js/jquery.min.js"></script>
	<script src="/PersonnelMS/Public/layer/layer.js"></script>
</head>
<body class="signin">
	<div class="signinpanel">
		<div class="row">
			<div class="col-sm-7">
				<div class="signin-info">
					<p>欢迎使用</p>
					<p class="title">PesonnelMS人事管理系统</p>
				</div>
			</div>
			<div class="col-sm-5">
				<form id="login_form" method="post" action="<?php echo U('login/login');?>">
					<p id="title_msg">登录到PesonnelMS</p>
					<input type="text" class="form-control uname" placeholder="用户名" id="username" name="username" />
					<input type="password" class="form-control pword m-b" placeholder="密码" id="password" name="password"/>
					<div style="margin-top:15px;">
						<input type="text" class="form-control" placeholder="验证码" style="color:black;width:120px;height:40px;float:left;margin:0 0;" name="verify" id="code" />
						<a href="javascript:void(0)"><img class="verify" src="<?php echo U('login/verify');?>" alt="点击刷新" style="float:right;cursor: pointer"/></a>
					</div>
					<button type="submit" class="btn btn-success btn-block" id="login_btn">登录</button>
				</form>
			</div>
		</div>
		<div class="signup-footer">
			<div class="pull-left">
				&copy; 2017 All Rights Reserved. H+
			</div>
		</div>
	</div> 
	<script>
		$(function(){
			/*刷新验证码*/
			$(".verify").click(function(){
				var src = "<?php echo U('login/verify');?>";
				var random = Math.floor(Math.random()*(1000+1));
				$(this).attr("src",src+"&random="+random);
			});
			/*登录验证*/
			$('#login_btn').on('click',function(e){
				var form=$('#login_form');
				var url=form.attr('action');
				var username=$("input[name='username']",form).val();
				var password=$("input[name='password']",form).val();
				var verify=$("input[name='verify']",form).val();				
				$.post(url, {'username':username, 'password':password,'verify':verify}, function(data){
					if (data.status == 1) {
						layer.msg(data.info);
					} else {
						layer.msg(data.info);
						window.location.href=window.location.href;
						window.location.reload();
					}
				},'json');
			});
			$('#username').focus();
		})
	</script>
</body>
</html>
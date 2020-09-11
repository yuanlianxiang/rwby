<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>管理员列表</title>
    <!-- Bootstrap core CSS -->
    <link href="/PersonnelMS/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="/PersonnelMS/Public/css/admin/sb-admin.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/css/common/page.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/layer/skin/default/layer.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/css/common/reset.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <div class="navbar-user">
    <div class="nav-left">
        <a class="navbar-brand" href="<?php echo U('Index/index');?>">人事管理系统管理后台</a>
        <span class="glyphicon glyphicon-list navbar-minimalize" aria-hidden="true" style="color:rgb(239, 239, 239);margin:15px 12px;font-size: 22px;"></span>
    </div>
    <div class="nav-right">
        <div class="dropdown user-dropdown">
            <img class="img-circle" alt="image" src="/PersonnelMS/Public/images/profile_small.jpg"/>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                你好，<?php echo session('username');?><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="position:absolute;top:5px;margin-left:6px;float: left;font-size: 12px;"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="changePassword()"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span style="margin-left: 15px;">修改密码</span></a></li>               
                <li><a href="<?php echo U('login/loginOut');?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span><span style="margin-left: 15px;">退出</span></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="password-change" style="display: none;margin-top: 20px;">
    <form id="changePassword" class="form-horizontal"  action="<?php echo U('login/changePassword');?>" method="post">
        <div class="form-group">
            <label class="col-md-4 control-label">姓名</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="username" value="<?php echo session('username');?>" required="" aria-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">旧密码</label>
            <div class="col-md-6">
                <input class="form-control" type="password" name="oldpassword" required="" aria-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">新密码</label>
            <div class="col-md-6">
                <input class="form-control" type="password" name="password" required="" aria-required="true"/>
            </div>
        </div>
        <div class="layui-layer-btn" style="display:none;">

            <a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>

            <a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
        </div>
    </form>
</div>
<script type="text/javascript">
    function changePassword(){
        layer.open({
            type: 1,
            area: ['400px', '300px'],
            title: '修改密码',
            shade: [0],
            skin:'layui-layer-molv',
            shadeClose: true, //点击遮罩关闭层
            content: $('.password-change'), //捕获的DIV
            btn: ['确认', '取消'],
            cancel: function (index) {
            },
            yes: function (index,layer0) {
                //绑定提交表单时间
                var form = $('#changePassword');
                var url = form.attr('action');
                var username=$("input[name='username']",form).val();
                var oldpassword=$("input[name='oldpassword']", form).val();
                var password=$("input[name='password']", form).val();
                if (oldpassword==password) {
                    layer.msg('两次密码一样');
                }else{
                    $.post(url, {'username':username,'oldpassword':oldpassword,'password':password}, function (data) {
                        if (data.status == 1) {
                            layer.msg(data.info);
                            layer.close(index);
                            setTimeout(loginLoad,5000);
                        } else {
                            layer.close(index);
                            layer.msg(data.info);
                        }
                    }, 'json');  
                }
            }
        });
    };
    function loginLoad(){
        location.href='<?php echo U('Login/index');?>';
    }
</script>




        


<div id="page-wrapper">
     <nav id="side-left" class="span3 navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <div class="user-image">
            <span><img alt="image" class="img-circle" src="/PersonnelMS/Public/images/profile_small.jpg"/></span>
        </div>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <span class="nav-label">用户管理</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo U('consumer/index');?>"><i class="icon-user"></i>  <span class="nav-label">员工信息</span></a></li>
                    <li><a href="<?php echo U('manager/index');?>"><i class="icon-cog"></i>  <span class="nav-label">管理员</span> </a></li>
                </ul></li> -->
            <li class="dropdown">
                <a href="<?php echo U('consumer/index');?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="nav-label">员工管理</span></a>
            </li>       
            <li class="dropdown">
                <a href="<?php echo U('department/index');?>"><span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><span class="nav-label">部门管理</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('salary/index');?>"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span><span class="nav-label">工资管理</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('attendance/index');?>"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="nav-label">考勤管理</span> </a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('leave/index');?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="nav-label">请假管理</span></a>  
            </li>
            <li class="dropdown">
                <a href="<?php echo U('manager/index');?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><span class="nav-label">用户管理</span> </a>
            </li>
        </ul>         
    </div>>
</nav>   

    <div class="content">
        <div class="content-top">
            <div class="col-md-4">
                <button type="button" class="btn btn-info" onclick="addManager();">添加</button>
                <button type="button" class="btn btn-info"><a href="<?php echo U('manager/index');?>" class="col-md-2">全部</a></button>
            </div>
            <div class="col-md-4" style="float:right;">
                <form action="<?php echo U('manager/index');?>" method="post">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" name="key" placeholder="输入用户名关键词搜索">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <td>编号</td>
                    <td>用户名</td>
                    <td>注册时间</td>
                    <td>上次登陆</td>
                    <td>登陆IP</td>
                    <td>类型</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($manager)): foreach($manager as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["username"]); ?></td>
                        <td><?php echo (date("Y/m/d H:i:s",$v["create_at"])); ?></td>
                        <td><?php echo (date("Y/m/d H:i:s",$v["update_at"])); ?></td>
                        <td><?php echo ($v["login_ip"]); ?></td>
                        <td>
                        <?php if($v["type"] == 0): ?><span class="label label-success">管理员</span>
                                <?php elseif($v["type"] == 1): ?><span class="label label-danger">超级管理员</span><?php endif; ?>
                        </td> 
                        <td><?php if($v["status"] == 1): ?>正常<?php else: ?><span style="color:red">禁用</span><?php endif; ?></td>
                        <?php if($v["status"] == 1): ?><td><a style="margin-right: 10px;"><span class="label label-info" onclick="updateManager(<?php echo ($v["id"]); ?>)">编辑</span></a> <a href="<?php echo U('manager/control?id='); echo ($v["id"]); ?>" style="color:red;" onclick="javascript:return del('禁用后用户将不能登陆后台!\n\n请确认!!!');"><span class="label label-warning">禁用</span></a></td>
                           <?php else: ?>
                           <td><a style="margin-right: 10px;"><span class="label label-info" onclick="updateManager(<?php echo ($v["id"]); ?>)">编辑</span></a> <a href="<?php echo U('manager/control?id='); echo ($v["id"]); ?>" style="color:#50AD1E;"><span class="label label-success">启用</span></a></td><?php endif; ?>
                   </tr><?php endforeach; endif; ?>
           </tbody>
       </table>
       <div class="green-black"><?php echo ($page); ?></div>
   </div>
</div>
<div class="manager-add" style="display: none;margin-top: 20px;">
    <form id="addManagerForm" class="form-horizontal" action="<?php echo U('manager/add');?>" method="post">
        <div class="form-group">
            <label class="col-md-4 control-label">用户名</label>
            <div class="input-group col-md-6">
                <input class="form-control" type="text" name="username" placeholder="用户名" required="" aria-required="true">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">密码</label>
            <div class="input-group col-md-6">
                <input class="form-control" type="password" name="password" placeholder="密码" required="" aria-required="true">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">用户类型</label>
            <div class="input-group col-md-6">
                <label class="radio-inline">
                    <input type="radio" name="type" id="type" value="0" checked="checked">管理员
                </label>
                <label class="radio-inline">
                    <input type="radio" name="type" id="type" value="1">超级管理员
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">用户状态</label>
            <div class="input-group col-md-6">
                <label class="radio-inline">
                    <input type="radio" name="status" id="status" value="0">禁止登陆
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="status" value="1"  checked="checked">正常
                </label>
            </div>
        </div>
        <div class="layui-layer-btn" style="display:none;">
            <a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
            <a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
        </div>
    </form>
</div>
<script type="text/javascript">
    function addManager(){
        layer.open({
            type: 1,
            area: ['400px', '320px'],
            title: '添加管理员',
            shade: [0],
            skin:'layui-layer-molv',shadeClose: true, //点击遮罩关闭层
            content: $('.manager-add'), //捕获的DIV
            btn: ['添加', '取消'],
            cancel: function (index) {

            },
            yes: function (index,layer0) {
                //绑定提交表单时间
                var form = $('#addManagerForm');
                var url = form.attr('action');
                var data = {
                    username: $("input[name='username']", form).val(),
                    password: $("input[name='password']", form).val(),
                    type: $("input[name='type']:checked", form).val(),
                    status:$("input[name='status']:checked", form).val()
                };
                $.post(url, {info:data}, function (data) {
                    if (data.status == 1) {
                        layer.msg(data.info);
                        window.location.reload();
                     } else {
                        layer.close(index);
                        layer.msg(data.info);
                    }
                }, 'json');  
            }
        });
    };
</script>
<div class="manager-update" style="display: none;margin-top: 40px;">
	<form id="updateManagerForm" class="form-horizontal" method="post" action="<?php echo U('manager/update');?>">
		<div class="form-group">
			<label class="col-md-4 control-label">编号</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="id" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">用户名</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="username" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">用户类型</label>
			<label class="radio-inline">
				<input type="radio" name="type" id="type" value="0">管理员
			</label>
			<label class="radio-inline">
				<input type="radio" name="type" id="type" value="1">超级管理员
			</label>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">用户状态</label>
			<label class="radio-inline">
				<input type="radio" name="status" id="status" value="0">禁止登陆
			</label>
			<label class="radio-inline">
				<input type="radio" name="status" id="status" value="1">正常
			</label>
		</div>
		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>


	</form>
</div>
<script type="text/javascript">
	function updateManager($id) {
        //赋值
        var form=$("#updateManagerForm");
        var url ="<?php echo U('manager/update');?>"+'&id='+$id;
        $.get(url,{},function(data){
        	var data=data.info;
        	$("input[name='id']",form).val(data.id);
        	$("input[name='username']", form).val(data.username);
        	if (data.type==0) {
        		$("input[name='type'][value=0]").attr("checked",true);
        	} else {
        		$("input[name='type'][value=1]").attr("checked",true);
        	}
        	if (data.status==0) {
        		$("input[name='status'][value=0]").attr("checked",true);
        	} else {
        		$("input[name='status'][value=1]").attr("checked",true);
        	}
        }); 
        layer.open({
        	type: 1,
        	area: ['400px', '360px'],
        	title: '编辑管理员',
        	shade: [0],
        	skin:'layui-layer-molv',
	        shadeClose: true, //点击遮罩关闭层
	        content: $('.manager-update'), //捕获的DIV
	        btn: ['保存', '取消'],
	        cancel: function (index) {
	        	layer.close(index); 
	        },
	        yes: function (index,layer0) {
	            //绑定提交表单时间
	            var data = {
	            	id:$("input[name='id']",form).val(),
	            	username: $("input[name='username']", form).val(),
	            	type: $("input[name='type']:checked", form).val(),
	            	status: $("input[name='status']:checked", form).val()
	            };
	            $.post(url, {info: data}, function (data) {
	            	if (data.status == 1) {
	            		layer.msg(data.info);
                	    window.location.reload();
	            	} else {
	            		layer.close(index);
                        layer.msg(data.info);
	            	}
	            }, 'json');
	        }
	    });
    };
</script>
<script src="/PersonnelMS/Public/js/jquery.min.js"></script>
<script src="/PersonnelMS/Public/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="/PersonnelMS/Public/js/admin/jquery-ui-1.10.4.min.js"></script>
<script src="/PersonnelMS/Public/js/admin/jquery-ui-custom.min.js"></script> -->
<script src="/PersonnelMS/Public/js/admin/app.js"></script>
<script src="/PersonnelMS/Public/layer/layer.js"></script>
</body>
</html>
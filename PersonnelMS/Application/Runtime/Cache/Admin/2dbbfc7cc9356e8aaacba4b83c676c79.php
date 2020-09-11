<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>部门信息</title>
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
                <button type="button" class="btn btn-info" onclick="addDepartment();">添加</button>
                <button type="button" class="btn btn-info"><a href="<?php echo U('department/index');?>" class="col-md-2">全部</a></button>
            </div>
            <div class="col-md-4" style="float:right;">
                <form action="<?php echo U('department/index');?>" method="post">
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
                    <td>名称</td>
                    <td>级别</td>
                    <td>电话</td>
                    <!-- <td>基本工资</td> -->
                    <td>工作天数</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($department)): foreach($department as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["name"]); ?></td>
                        <td><?php echo ($v["grade"]); ?></td>
                        <td><?php echo ($v["phone"]); ?></td>
                        <!-- <td><?php echo ($v["salary"]); ?></td> -->
                        <td><?php echo ($v["workdays"]); ?></td>
                        <td><a style="margin-right: 10px;"><span class="label label-info" onclick="updateDepartment(<?php echo ($v["id"]); ?>)">编辑</span></a> <a href="<?php echo U('department/delete?id='); echo ($v["id"]); ?>" onclick="javascript:return del('您真的确定要删除吗？\n\n删除后将不能恢复!');"><span class="label label-warning">删除</span></a></td>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="green-black"><?php echo ($page); ?></div>
    </div>
</div>
<div class="department-add" style="display: none;margin-top: 20px;">
	<form id="addDepartmentForm" class="form-horizontal" action="<?php echo U('department/add');?>" method="post">
		<div class="form-group">
			<label class="col-md-4 control-label">部门编号</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="id" placeholder="请输入编号" required="" aria-required="true"/>
			</div>		
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">部门名称</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="name" placeholder="请输入部门名称" required="" aria-required="true"/>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">部门级别</label>
			<div class="col-md-6">
				<select class="form-control" id="grade" name="grade">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>	
		</div>
		<!-- <div class="form-group">
			<label class="col-md-4 control-label">基本工资</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="salary" placeholder="请输入基本工资" required="" aria-required="true"/>
			</div>	
		</div> -->
		<div class="form-group">
			<label class="col-md-4 control-label">电话</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="phone" placeholder="请输入电话 如:0715-8888888" required="" aria-required="true"/>
			</div>	
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">工作天数</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="workdays" placeholder="请输入工作天数" required="" aria-required="true"/>
			</div>	
		</div>

		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>
	</form>
</div>
<script type="text/javascript">
	function addDepartment(){
		layer.open({
			type: 1,
			area: ['500px', '450px'],
			title: '添加角色',
			shade: [0],
	        skin:'layui-layer-molv',shadeClose: true, //点击遮罩关闭层
            content: $('.department-add'), //捕获的DIV
            btn: ['添加', '取消'],
            cancel: function (index) {

            },
            yes: function (index,layer0) {
                //绑定提交表单时间
                var form = $('#addDepartmentForm');
                var url = form.attr('action');
                pattern=/^0\d{2,3}-?\d{7,8}$/;
                var data = {
                	id:$("input[name='id']",form).val(),
                	username: $("input[name='username']", form).val(),
                	grade: $("select[name='grade']", form).val(),
                	phone: $("input[name='phone']", form).val(),
                	// salary: $("input[name='salary']", form).val(),
                	workdays: $("input[name='workdays']", form).val()         	
                };
                if(pattern.test(data['phone'])){
                	$.post(url, {info:data}, function (data) {
            		//layer.msg(data.info);
            		if (data.status == 1) {
            			layer.msg(data.info);
            			window.location.reload();
            		} else {
            			layer.close(index);
            			layer.msg(data.info);
            		}
            	}, 'json');   
                }else{
                	layer.msg('请输入正确的电话号码');
                }               
                          
            }
        });
	};
</script>

<div class="department-update" style="display: none;margin-top: 20px;">
	<form id="updateDepartmentForm" class="form-horizontal" method="post" action="<?php echo U('department/update');?>">
		<div class="form-group">
			<label class="col-md-4 control-label">部门编号</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="id" disabled="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">部门名称</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="name" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">部门级别</label>
			<div class="col-md-6">
				<select class="form-control" id="grade" name="grade">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-md-4 control-label">基本工资</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="salary" >
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-md-4 control-label">电话</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="phone" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">工作天数</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="workdays" >	
			</div>
		</div>
		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>
	</form>
</div>
<script type="text/javascript">
	function updateDepartment($id) {
        //赋值
        var form=$("#updateDepartmentForm");
        var url ="<?php echo U('department/update');?>"+'&id='+$id;
        $.get(url,{},function(data){
        	var data=data.info;
        	$("input[name='id']",form).val(data.id);
        	$("input[name='name']", form).val(data.name);
        	$("select[name='grade']", form).val(data.grade);
        	$("input[name='phone']", form).val(data.phone);
        	// $("input[name='salary']", form).val(data.salary);
        	$("input[name='workdays']", form).val(data.workdays);
        }); 
        layer.open({
        	type: 1,
        	area: ['500px', '450px'],
        	title: '编辑部门',
        	shade: [0],
        	skin:'layui-layer-molv',
	        shadeClose: true, //点击遮罩关闭层
	        content: $('.department-update'), //捕获的DIV
	        btn: ['保存', '取消'],
	        cancel: function (index) {
	        	layer.close(index); 
	        },
	        yes: function (index,layer0) {
	            //绑定提交表单时间
	            var url = form.attr('action');
	            pattern=/^0\d{2,3}-?\d{7,8}$/;
	            var data = {
	            	id: $("input[name='id']", form).val(),
	            	name: $("input[name='name']", form).val(),
	            	grade: $("select[name='grade']", form).val(),
	            	phone: $("input[name='phone']", form).val(),
	            	// salary: $("input[name='salary']", form).val(),
	            	workdays: $("input[name='workdays']", form).val()   
	            };
	            if(pattern.test(data['phone'])){
	            	$.post(url, {info: data}, function (data) {
	            	//layer.msg(data.info);
	            	if (data.status == 1) {
	            		layer.msg(data.info);
	            		window.location.reload();
	            	} else {
	            		layer.close(index);
	            		layer.msg(data.info);
	            	}
	            }, 'json');
	            }else{
	            	layer.msg('请输入正确的电话号码');
	            } 
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
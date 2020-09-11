<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>工资信息</title>
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
                <!-- <button type="button" class="btn btn-info" onclick="addSalary();">添加</button> -->
                <button type="button" class="btn btn-info"><a href="<?php echo U('salary/index');?>" class="col-md-2">全部</a></button>
            </div>
            <div class="col-md-4" style="float:right;">
                <form action="<?php echo U('salary/index');?>" method="post">
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
                    <td>姓名</td>
                    <td>部门</td>
                    <td>职务</td>
                    <td>结算年月</td>
                    <td>工资</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($salary)): foreach($salary as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["username"]); ?></td>
                        <td><?php echo ($v["department"]); ?></td>
                        <td><?php echo ($v["job"]); ?></td>
                        <td><?php echo ($v["redate"]); ?></td>
                        <td><?php echo ($v["salary"]); ?></td>
                        <td><a style="margin-right: 10px;"><span class="label label-info" onclick="updateSalary(<?php echo ($v["id"]); ?>)">编辑</span></a> <a href="<?php echo U('salary/delete?id='); echo ($v["id"]); ?>" style="color:red;" onclick="return del('删除后用户将不存在!\n\n请确认!!!');"><span class="label label-warning">删除</span></a></td>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="green-black"><?php echo ($page); ?></div>
    </div>
</div>
<div class="salary-add" style="display: none;margin-top: 20px;">
	<form id="addSalaryForm" class="form-horizontal" action="<?php echo U('salary/add');?>" method="post">
		<div class="form-group">
			<label class="col-md-4 control-label">员工编号</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="id" placeholder="请输入编号" required="" aria-required="true" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">姓名</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="username" placeholder="请输入姓名" required="" aria-required="true" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">部门</label>
			<div class="col-md-6">
				<select class="form-control" id="department" name="department">
					<?php if(is_array($delist)): $i = 0; $__LIST__ = $delist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">职务</label>
			<div class="col-md-6">
				<select class="form-control" id="job" name="job">
					<option value="助理">助理</option>
					<option value="专员">专员</option>
					<option value="会计">会计</option>
					<option value="出纳">出纳</option>
					<option value="销售顾问">销售顾问</option>
					<option value="销售内勤">销售内勤</option>
					<option value="行政文员">行政文员</option>
					<option value="架构师">架构师</option>
					<option value="java工程师">java工程师</option>
					<option value="web前端工程师">web前端工程师</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">结算年月</label>
			<div class="col-md-6">
				<input class="form-control" type="date" name="date" placeholder="请输入结算年月" required="" aria-required="true"/>	
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">工资</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="salary" placeholder="请输入工资" required="" aria-required="true"/>
			</div>
		</div>

		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>
	</form>
</div>
<script type="text/javascript">
	function addSalary(){
		$("#department").empty();
		var url = "<?php echo U('salary/add');?>";
		$.get(url,{},function(data){
			$.each(data.info,function(index,obj){
				$("#department").append("<option value="+index+">"+obj+"</option>"); 
			});   
		}); 
		layer.open({
			type: 1,
			area: ['500px', '450px'],
			title: '添加角色',
			shade: [0],
			skin:'layui-layer-molv',
	        shadeClose: true, //点击遮罩关闭层
            content: $('.salary-add'), //捕获的DIV
            btn: ['添加', '取消'],
            cancel: function (index) {

            },
            yes: function (index,layer0) {
                //绑定提交表单时间
                var form = $('#addSalaryForm');
                var url = form.attr('action');
                var data = {
                	id: $("input[name='id']",form).val(),
                	username: $("input[name='username']", form).val(),
                	department:$("#department").find("option:selected").text(),
                	job:$("#job").find("option:selected").val(),
                	date: $("input[name='date']", form).val(),
                	salary: $("input[name='salary']", form).val()
                };
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
            }
        });
	};
</script>

<div class="salary-update" style="display: none;margin-top: 20px;">
	<form id="updateSalaryForm" class="form-horizontal" method="post" action="<?php echo U('salary/update');?>">
		<div class="form-group">
			<label class="col-md-4 control-label">姓名</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="name" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">部门</label>
			<div class="col-md-6">
				<select class="form-control" id="department" name="department">
					<?php if(is_array($delist)): $i = 0; $__LIST__ = $delist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">职务</label>
			<div class="col-md-6">
				<select class="form-control" id="job" name="job">
					<option value="办公室助理">办公室助理</option>
					<option value="会计">会计</option>
					<option value="出纳">出纳</option>
					<option value="销售部助理">销售部助理</option>
					<option value="销售顾问">销售顾问</option>
					<option value="销售内勤">销售内勤</option>
					<option value="薪酬分析师">薪酬分析师</option>
					<option value="人力专员">人力专员</option>
					<option value="行政助理">行政助理</option>
					<option value="行政文员">行政文员</option>
					<option value="架构师">架构师</option>
					<option value="java工程师">java工程师</option>
					<option value="web前端工程师">web前端工程师</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">结算日期</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="date" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">工资</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="salary" >
			</div>
		</div>

		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>


	</form>
</div>
<script type="text/javascript">
	function updateSalary($id) {
        //赋值
        var form=$("#updateSalaryForm");
        var url ="<?php echo U('consumer/update');?>"+'&id='+$id;
        $.get(url,{},function(data){
        	var info=data.info.info;
        	var delist = data.info.delist;
        	$("select[name='department']", form).empty();
        	$.each(delist, function (index, obj) {
        		if (obj == info.department) {
        			$("select[name='department']", form).append("<option selected value=" + obj + ">" + obj + "</option>");
        		} else {
        			$("select[name='department']", form).append("<option value=" + obj + ">" + obj + "</option>");
        		}
        	});
        	$("input[name='id']", form).val(info.id);
        	$("input[name='name']", form).val(info.username);
        	$("select[name='job']", form).val(info.job);
        	$("input[name='date']", form).val(info.redate);
        	$("input[name='salary']", form).val(info.salary);
        }); 
        layer.open({
        	type: 1,
        	area: ['500px', '400px'],
        	title: '编辑工资',
        	shade: [0],
        	skin:'layui-layer-molv',
	        shadeClose: true, //点击遮罩关闭层
	        content: $('.salary-update'), //捕获的DIV
	        btn: ['保存', '取消'],
	        cancel: function (index) {
	        	layer.close(index); 
	        },
	        yes: function (index,layer0) {
	            //绑定提交表单时间
	            var url = form.attr('action');
	            var data = {
	            	id:$id /*$("input[name='id']", form).val()*/,
	            	username: $("input[name='name']", form).val(),
	            	department: $("select[name='department']", form).val(),
	            	job: $("select[name='job']", form).val(),
	            	// department:$("#department").find("option:selected").text(),
              //   	job:$("#job").find("option:selected").text(),
	            	redate: $("input[name='date']", form).val(),
	            	salary: $("input[name='salary']", form).val()  
	            };
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
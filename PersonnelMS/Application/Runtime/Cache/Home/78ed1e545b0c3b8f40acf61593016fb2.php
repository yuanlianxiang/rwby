<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>请假列表</title>
    <!-- Bootstrap core CSS -->
    <link href="/PersonnelMS/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="/PersonnelMS/Public/css/home/sb-admin.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/css/common/page.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/layer/skin/default/layer.css" rel="stylesheet">
    <link href="/PersonnelMS/Public/css/common/reset.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <div class="navbar-user">
    <div class="nav-left">
        <a class="navbar-brand" href="<?php echo U('Index/index');?>">人事管理系统</a>
        <span class="glyphicon glyphicon-list navbar-minimalize" aria-hidden="true" style="color: rgb(239,239,239);margin:15px 12px;font-size: 22px;"></span>
    </div>
    <div class="nav-right">
        <div class="dropdown user-dropdown">
            <img class="img-circle" alt="image" src="/PersonnelMS/Public/images/profile_small.jpg"/>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                你好，<?php echo session('username');?><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="position:absolute;top:5px;margin-left:6px;float: left;font-size: 12px;"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="changePassword()"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span style="margin-left: 15px;">修改密码</span></a></li>
                <!-- <li class="divider"></li> -->
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
            <li class="dropdown">
            <a href="<?php echo U('consumer/index');?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="nav-label">员工信息</span></a>
            </li>       
            <li class="dropdown">
                <a href="<?php echo U('department/index');?>"><span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><span class="nav-label">部门信息</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('salary/index');?>"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span><span class="nav-label">工资信息</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('attendance/index');?>"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="nav-label">考勤签到</span> </a>
            </li>
            <li class="dropdown">
                <a href="<?php echo U('leave/index');?>"><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="nav-label">假期申请</span></a>  
            </li>
        </ul>         
    </div>
</nav>   

    <div class="content">
        <div class="content-top">
            <div class="col-md-4">
                <button type="button" class="btn btn-info" onclick="addLeave();">添加</button>
                <button type="button" class="btn btn-info"><a href="<?php echo U('leave/index');?>" class="col-md-2">全部</a></button>
            </div>
            <div class="col-md-4" style="float:right;">
                <form action="<?php echo U('leave/index');?>" method="post">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" name="key" placeholder="输入用户名关键词搜索">
                        <span class="input-group-btn">
                            <button id="search" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
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
                    <td>起始日期</td>
                    <td>結束日期</td>
                    <td>请假原因</td>
                    <td>状态</td>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($leave)): foreach($leave as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["username"]); ?></td>
                        <td><?php echo ($v["start"]); ?></td>
                        <td><?php echo ($v["end"]); ?></td>
                        <td><a style="margin-right: 10px;"><span class="label label-info" onclick="check(<?php echo ($v["id"]); ?>)">查看</span></a></td>
                        <?php if($v["state"] == 1): ?><td><a href="#" ><span class="label label-success">已批准</span></a> <a href="<?php echo U('leave/delete?id='); echo ($v["id"]); ?>" style="color:red;" onclick="javascript:return del('禁用后用户将不能登陆后台!\n\n请确认!!!');"><span class="label label-warning">删除</span></a> </td>
                            <?php else: ?>
                            <td><a href="#" ><span class="label label-danger">不批准</span></a> <a href="<?php echo U('leave/delete?id='); echo ($v["id"]); ?>" style="color:red;" onclick="javascript:return del('删除后将不能看到该条信息!\n\n请确认!!!');"><span class="label label-warning">删除</span></a></td><?php endif; ?>
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <div class="green-black"><?php echo ($page); ?></div>
</div>
<script type="text/javascript">
    $(function () { 
        var options={
            animation:true,
            trigger:'hover'
        };
        $('.reason').tooltip(options); });
</script>
<div class="leave-add" style="display: none;margin-top: 20px;padding-left:15px;">
	<form id="addLeaveForm" class="form-horizontal" action="<?php echo U('leave/add');?>" method="post" style="padding:0;margin:0;">
		<div class="form-group">
			<label class="col-md-2 control-label">开始时间</label>
			<div class="col-md-6">
				<input class="form-control" type="date" name="start" placeholder="请输入开始时间" required="" aria-required="true"/>	
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">结束时间</label>
			<div class="col-md-6">
				<input class="form-control" type="date" name="end" placeholder="请输入结束时间" required="" aria-required="true"/>	
			</div>
		</div><div class="form-group">
			<label class="col-md-2 control-label">请假原因</label>
			<div class="col-md-6">
				<script id="page-content" name="reason" type="text/plain"></script>
			</div>
		</div>

		<div class="layui-layer-btn" style="display:none;">
			<a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
			<a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
		</div>
	</form>
</div>
<script type="text/javascript" src="/PersonnelMS/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/PersonnelMS/Public/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
	function addLeave(){
		layer.open({
			type: 1,
			area: ['590px', '550px'],
			title: '添加请假条',
			shade: [0],
	        skin:'layui-layer-molv',
	        shadeClose: true, //点击遮罩关闭层
            content: $('.leave-add'), //捕获的DIV
            btn: ['添加', '取消'],
            cancel: function (index) {

            },
            yes: function (index,layer0) {
                //绑定提交表单时间
                var form = $('#addLeaveForm');
                var url = form.attr('action');
                var data = { 
                    start: $("input[name='start']", form).val(),
                    end: $("input[name='end']", form).val(),
                    reason: UE.getEditor('page-content').getContentTxt()          
                };
                $.post(url, {info:data}, function (data) {
                	layer.msg(data.info);
                	if (data.status == 1) {
                		window.location.reload();
                		layer.msg('保存成功',3000);
                	} else {
                		layer.close(index);
                		layer.msg('保存失败',3000);
                	}
                }, 'json');
            }
        });
	};

	var ue = UE.getEditor('page-content',{
        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo','bold', 'italic', 'underline','fontborder', 'strikethrough', '|','simpleupload', 'insertimage','attachment','emotion','link','unlink', '|', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote','searchreplace', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc'],
            ['inserttable','insertrow', 'insertcol','mergeright', 'mergedown','deleterow', 'deletecol','splittorows','splittocols', 'splittocells','deletecaption','inserttitle', 'mergecells', 'deletetable','insertparagraphbeforetable', 'paragraph','fontsize','fontfamily']
        ],
        initialFrameHeight:150,
        initialFrameWidth:350,
        zIndex:100
    }); 
</script>

<div class="leave-check" style="display: none;margin-top: 20px;">
    <form id="checkLeaveForm" class="form-horizontal" action="<?php echo U('leave/check');?>" method="post">
        <div class="form-group">
            <label class="col-md-4 control-label">用户名</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="username"/>   
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">开始时间</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="start" />   
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">结束时间</label>
            <div class="col-md-6">
                <input class="form-control" type="text" name="end" /> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">请假原因</label>
            <div class="col-md-6">
                <textarea name="reason" rows="5" cols="25"></textarea>
            </div>
        </div>

        <div class="layui-layer-btn" style="display:none;">
            <a class="layui-layer-btn0"> <button id="addrole-form-button"  class='layui-layer-btn0 ' style="border:0px;" type='submit'>提交</button></a>
            <a class="layui-layer-btn1"><button id="addrole-form-cancel" class='layui-layer-btn1' style="border:0px;" type='submit'>取消</button></a>
        </div>
    </form>
</div> 
<script type="text/javascript">
    function check($id) {
        //赋值
        var form=$("#checkLeaveForm");
        var url ="<?php echo U('leave/check');?>"+'&id='+$id;
        $.get(url,{},function(data){
            var data=data.info;
            $("input[name='username']",form).val(data.username);
            $("input[name='start']", form).val(data.start);
            $("input[name='end']", form).val(data.end);
            $("textarea[name='reason']", form).val(data.reason);
        }); 
        layer.open({
            type: 1,
            area: ['450px', '450px'],
            title: '查看请假条',
            shade: [0],
            skin:'layui-layer-molv',
            shadeClose: true, //点击遮罩关闭层
            content: $('.leave-check'), //捕获的DIV
        });
    };
</script>
<script src="/PersonnelMS/Public/js/jquery.min.js"></script>
<script src="/PersonnelMS/Public/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="/PersonnelMS/Public/home/js/jquery-ui-1.10.4.min.js"></script>
<script src="/PersonnelMS/Public/home/js/jquery-ui-custom.min.js"></script> -->
<script src="/PersonnelMS/Public/js/home/app.js"></script>
<script src="/PersonnelMS/Public/layer/layer.js"></script>
</body>
</html>
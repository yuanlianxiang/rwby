<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>系统主页</title>
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

    <div class="form-page">
        <div class="indexImg">
            <img src="/PersonnelMS/Public/images/11.jpg" alt="示例图片">
        </div>
        <div class="description">
            <p>欢迎来到豆豆人事管理系统</p>
            <p style="text-indent: 100px;">欢迎加入豆豆大家庭，这里有你们更精彩</p>
        </div>
    </div>
</div>
<script src="/PersonnelMS/Public/js/jquery.min.js"></script>
<script src="/PersonnelMS/Public/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="/PersonnelMS/Public/js/admin/jquery-ui-1.10.4.min.js"></script>
<script src="/PersonnelMS/Public/js/admin/jquery-ui-custom.min.js"></script> -->
<script src="/PersonnelMS/Public/js/admin/app.js"></script>
<script src="/PersonnelMS/Public/layer/layer.js"></script>
</body>
</html>
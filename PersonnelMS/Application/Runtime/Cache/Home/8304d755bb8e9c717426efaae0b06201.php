<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>工资信息</title>
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

    <?php if(is_array($salary)): foreach($salary as $key=>$v): ?><div class="row">
            <div class="col-xs-4 feature">
                <div class="product-container">
                    <div class="name">工 资 信 息</div>
                    <div class="intro">
                        <span class="label col-md-4">编&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp号</span>
                        <span class="percent col-md-6"><?php echo ($v["id"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名</span>
                        <span class="percent col-md-6"><?php echo ($v["username"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp门</span>
                        <span class="percent col-md-6"><?php echo ($v["department"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">职&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp务</span>
                        <span class="percent col-md-6"><?php echo ($v["job"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">工&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp资</span>
                        <span class="percent col-md-6"><?php echo ($v["salary"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">结算时间</span>
                        <span class="percent col-md-6">当月15号</span>
                    </div>
                    <!-- <div class="intro">
                        <span class="label col-md-4">年 龄</span>
                        <span class="percent col-md-6"><?php echo ($v["age"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">部 门</span>
                        <span class="percent col-md-6"><?php echo ($v["department"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">职 务</span>
                        <span class="percent col-md-6"><?php echo ($v["job"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">地 址</span>
                        <span class="percent col-md-6"><?php echo ($v["address"]); ?></span>
                    </div>
                    <div class="intro">
                        <span class="label col-md-4">日 期</span>
                        <span class="percent col-md-6"><?php echo ($v["date"]); ?></span>
                    </div> -->
                    <div class="strong">态度认真 积累财富</div>
                </div>
            </div>
        </div><?php endforeach; endif; ?>
    <!-- <div class="content">
        <div class="content-top">
            <div class="col-md-4">
                <button type="button" class="btn btn-info"><a href="<?php echo U('salary/index');?>" class="col-md-2">全部</a></button>
            </div>
            <div class="col-md-4" style="float:right;">
                <form action="<?php echo U('salary/index');?>" method="post">
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
                    <td>部门</td>
                    <td>职务</td>
                    <td>结算年月</td>
                    <td>工资</td>
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
                    </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="green-black"><?php echo ($page); ?></div>
    </div> -->
</div>
<script src="/PersonnelMS/Public/js/jquery.min.js"></script>
<script src="/PersonnelMS/Public/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="/PersonnelMS/Public/home/js/jquery-ui-1.10.4.min.js"></script>
<script src="/PersonnelMS/Public/home/js/jquery-ui-custom.min.js"></script> -->
<script src="/PersonnelMS/Public/js/home/app.js"></script>
<script src="/PersonnelMS/Public/layer/layer.js"></script>
</body>
</html>
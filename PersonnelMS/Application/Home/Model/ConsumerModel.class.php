<?php
namespace Home\Model;
use Think\Model;
class ConsumerModel extends Model{
    protected $_validate = array(
        array('username','require','请填写用户名！'), //默认情况下用正则进行验证
        array('password','require','请填写密码！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('age','require','请填写年龄！'), //默认情况下用正则进行验证
        array('addresss','require','请填写地址！'), //默认情况下用正则进行验证
        array('department','require','请填写部门！'), //默认情况下用正则进行验证
        array('job','require','请填写职务！'), //默认情况下用正则进行验证

    );
    protected $_auto = array(
        array('password','md5',1,'function') , //添加时用md5函数处理 
    );


}
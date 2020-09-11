<?php
namespace Admin\Model;
use Think\Model;
class SalaryModel extends Model{
    protected $_validate = array(
        array('username','require','请填写用户名！'), //默认情况下用正则进行验证
        array('salary','require','请填写工资！'), //默认情况下用正则进行验证
        array('department','require','请填写部门！'), //默认情况下用正则进行验证
        array('date','require','请填写时间！'), //默认情况下用正则进行验证
    );
}
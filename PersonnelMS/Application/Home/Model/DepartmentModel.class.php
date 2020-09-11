<?php
namespace Home\Model;
use Think\Model;
class DepartmentModel extends Model{
    protected $_validate = array(
        array('name','require','请填写部门！'), //默认情况下用正则进行验证
        array('grade','require','请填写级别！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('pay','require','请填写工资！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('workdays','require','请填写工作时间！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
     	array('name','','部门已存在！',0,'unique',self::MODEL_BOTH), // 在新增的时候验证name字段是否唯一
    );
}
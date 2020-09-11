<?php
namespace Admin\Model;
use Think\Model;
class LeaveModel extends Model{
    protected $_validate = array(
        array('start','require','请填写开始时间！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('end','require','请填写结束时间！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('reason','require','请填写请假理由！','','',self::MODEL_INSERT), //默认情况下用正则进行验证
        array('state',array(0,1),'请勿恶意修改字段',3,'in'),
    );
}
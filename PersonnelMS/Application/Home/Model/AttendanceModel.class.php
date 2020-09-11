<?php
namespace Home\Model;
use Think\Model;
class AttendanceModel extends Model{
    protected $_validate = array(
        array('up','require','上班签到时间不能为空'), //默认情况下用正则进行验证
        array('down','require','下班签到时间不能为空'), //默认情况下用正则进行验证
    );
}
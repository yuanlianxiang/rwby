<?php
namespace Admin\Controller;
use Admin\Controller;

class AttendanceController extends BaseController{

	public function index($key="")
    {

        $where['username'] = array('like',"%$key%");
        //$where['email'] = array('like',"%$key%");
        $where['_logic'] = 'or';
        $model = M('attendance')->where($where);   
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $attendance = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id asc')->select();
        $this->assign('attendance', $attendance);
        $this->assign('page',$show);
        $this->display();     
    }

    public function delete($id)
    {
        $id = intval($id);
        $model = M('attendance');
        $result = $model->where("id=%d",$id)->delete();
        if ($result) {
         $this->redirect("状态更新成功", U('attendance/index'));
     }
 }
}
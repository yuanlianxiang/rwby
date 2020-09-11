<?php
namespace Home\Controller;
use Home\Controller;

class SalaryController extends BaseController{
    public function index(){
       $model = M('consumer');  
       $data['username'] = session('username');
       $salary = M('consumer')->where($data)->select();
       $this->assign('salary', $salary);
       $this->display();
   }
	// public function index($key="")
 //    {
 //        if($key === ""){
 //            $model = M('consumer');  
 //        }else{
 //            $where['username'] = array('like',"%$key%");
 //            $where['department'] = array('like',"%$key%");
 //            $where['job'] = array('like',"%$key%");
 //            $where['salary'] = array('like',"%$key%");
 //            $where['_logic'] = 'or';
 //            $model = M('consumer')->where($where); 
 //        } 
   
 //        $count  = $model->where($where)->count();// 查询满足要求的总记录数
 //        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
 //        $show = $Page->show();// 分页显示输出
 //        $salary = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id asc')->select();
 //        $this->assign('salary', $salary);
 //        $this->assign('page',$show);
 //        $this->display();     
 //    }
}
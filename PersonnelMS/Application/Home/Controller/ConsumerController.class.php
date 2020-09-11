<?php
namespace Home\Controller;
use Home\Controller;

class ConsumerController extends BaseController{

	/*public function index($key="")
    {
        if($key === ""){
            $model = M('consumer');  
        }else{
            $where['username'] = session('username');
            // $where['username'] = array('like',"%$key%");
            // $where['department'] = array('like',"%$key%");
            // $where['age'] = array('like',"%$key%");
            // $where['sex'] = array('like',"%$key%");
            // $where['job'] = array('like',"%$key%");
            // $where['address'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('consumer')->where($where); 
        } 
        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $consumer = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id asc')->select();
        $this->assign('consumer', $consumer);
        $this->assign('page',$show);
        $this->display();     
    }*/
    public function index()
    {

        $model = M('consumer');  
        $data['username'] = session('username');
        $consumer = M('consumer')->where($data)->select();
        $this->assign('consumer', $consumer);
        $this->display();     
    }
}
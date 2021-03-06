<?php
namespace Admin\Controller;
use Admin\Controller;

class ConsumerController extends BaseController{

	public function index($key="")
    {
        if($key === ""){
            $model = M('consumer');  
        }else{
            $where['name'] = array('like',"%$key%");
            $where['department'] = array('like',"%$key%");
            $where['sex'] = array('like',"%$key%");
            $where['age'] = array('like',"%$key%");
            $where['address'] = array('like',"%$key%");
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
    }

    public function add()
    {   
        if (IS_POST) {
            //如果用户提交数据
            $model = D('Consumer');
            $data = I('post.info');
            $check=I('post.info.name');
            if($check!=" "){
                $res = $model->add($data);
            }
            $res ? $this->success('添加成功') : $this->error('添加失败');
        }else{
            $department = D('Department');
            $delist = $department->order('id asc')->getField('id,name', true);
            $this->assign('delist', $delist);
            IS_AJAX ? $this->success($delist) : $this->display('add');
        }
    }

    public function update()
    {
        //默认显示添加表单
        $model = D("Consumer");
        if (IS_POST) {
            $data = I('post.info');
            $res = $model->save($data);
            $res ? $this->success('修改成功') : $this->error('修改失败');
        }else {
         $id = I('get.id');
         $info = $model->where(array('id' => $id))->find();
         $this->assign('info', $info);
         $department = D('Department');
         $delist = $department->order('id asc')->getField('id,name', true);
         $this->assign('delist', $delist);
         IS_AJAX ? $this->success(array('delist' => $delist, 'info' => $info)) : $this->display('update');
     }
 }

public function delete($id)
{
    $id = intval($id);
    $model = M('Consumer');
    $result = $model->where("id=%d",$id)->delete();
    if ($result) {
       $this->redirect("状态更新成功", U('Consumer/index'));
   }
}
}
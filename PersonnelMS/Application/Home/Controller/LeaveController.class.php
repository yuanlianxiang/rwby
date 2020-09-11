<?php
namespace Home\Controller;
use Home\Controller;
/**
 * 单页管理
 */
class LeaveController extends BaseController
{
    /**
     * 请假列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if($key === ""){
            $where['username']=session('username');
            $model = M('leave')->where($where);  
        }else{
            $where['id'] = array('like',"%$key%");
            $where['username']=array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('leave')->where($where); 
        } 
        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $leave = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id ASC')->select();
        $this->assign('leave', $leave);
        $this->assign('page',$show);
        $this->display();     
    }

    /**
     * 更新信息
     * @param  [type] $id [单页ID]
     * @return [type]     [description]
     */
    public function add()
    {   
        if (IS_POST) {
            //如果用户提交数据
            $model = D('Leave');
            $data = I('post.info');
            $data['username']=session('username');
            $res = $model->add($data);
            $res ? $this->success('添加成功') : $this->error('添加失败');
        }else{
            $this->display(add);
        }
    }
    /*查看信息*/
    public function check(){
        $model=D('Leave');
        $id = I('get.id');
        $info = $model->where(array('id'=>$id))->find();
        $this->assign('info', $info);
        IS_AJAX ? $this->success($info) : $this->display('check');
    }
    /**
     * 删除信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $id = intval($id);
        $model = M('leave');
        $result = $model->where("id=%d",$id)->delete();
        if($result){
            $this->success("删除成功", U('Leave/index'));
        }else{
            $this->error("删除失败");
        }
    }
}

<?php
namespace Admin\Controller;
use Admin\Controller;
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
            $model = M('leave');  
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
     * 更新单页信息
     * @param  [type] $id [单页ID]
     * @return [type]     [description]
     */
    public function approve($id)
    {
        $id = intval($id);
        $model = M('leave');
        $result = $model->find($id);
        //更新字段
        if($result['state']==1){
            $data['state']=0;
        }
        if($result['state']==0){
            $data['state']=1;
        }
        $data['id']=$id;
        if($model->save($data)){
            $this->redirect("已批准", U('leave/index'));
        }else{
            $this->error("更新失败");
        }        
    }

    /**
     * 删除信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $id = intval($id);
        $model = M('page');
        $result = $model->where("id=%d",$id)->delete();
        if($result){
            $this->success("删除成功", U('Leave/index'));
        }else{
            $this->error("删除失败");
        }
    }
}

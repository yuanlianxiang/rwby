<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 用户管理
 */
class ManagerController extends BaseController
{
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if($key === ""){
            $model = M('manager');  
        }else{
            $where['username'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model =M('manager')->where($where); 
        } 
        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $manager = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id asc')->select();
        $this->assign('manager', $manager);
        $this->assign('page',$show);
        $this->display();     
    }

    /**
     * 添加用户
     */
    public function add()
    {
        //默认显示添加表单
        if (IS_POST) {
            //如果用户提交数据
            $model = D('Manager');
            $data = I('post.info');
            $data['create_at']=time();
            $check=I('post.info.username');
            // 权限判断
            $username=session('username');
            $type=$model->where(array("username"=>$username))->getField('type');
            if($type==1){
                if($check!=" "){
                    $res = $model->add($data);
                }
                $res ? $this->success('添加成功') : $this->error('添加失败');
            }else{
                $this->error('没有权限');
            }
        }else{
            $this->display(add);
        }
    }
    /**
     * 更新管理员信息
     * @param  [type] $id [管理员ID]
     * @return [type]     [description]
     */
    public function update()
    {
        //默认显示添加表单
        $model = D("Manager");
        if (!IS_POST) {
            $id = I('get.id');
            $info = $model->where(array('id'=>$id))->find();
            $this->assign('info', $info);
            IS_AJAX ? $this->success($info) : $this->display('update');
        }else {
            $data = I('post.info');
            $data['update_at']=time();
             // 权限判断
            $username=session('username');
            $type=$model->where(array("username"=>$username))->getField('type');
            if($type==1){
                $res = $model->save($data);
                $res ? $this->success('修改成功') : $this->error('修改失败');
            }else{
                $this->error('没有权限');
            }
        }
    }
    // public function person()
    // {
    //     //默认显示添加表单
    //     $model = D("Manager");
    //     if (IS_POST) {
    //         $data = I('post.info');
    //         $res = $model->save($data);
    //         $res ? $this->success('修改成功',U('login/loginOut')) : $this->error('修改失败');
    //     }else {
    //         $id = I('get.id');
    //         $info = $model->where(array('id'=>$id))->find();
    //         $this->assign('info', $info);
    //         IS_AJAX ? $this->success($info) : $this->display('update');
    //     }
    // }
    /**
     * 删除管理员
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function control($id)
    {
        $model = M('manager');
        $id = intval($id);
        $res = $model->find($id);
        $data['id']=$id;
        $username=session('username');
        $type=$model->where(array("username"=>$username))->getField('type');
        $type==1;
        if($res['status'] == 1){
            $data['status']=0;
        }else{
            $data['status']=1;
        }
        // if($type){
            if($model->save($data)){
                $this->redirect("状态更新成功", U('manager/index'));
            }else{
                $this->redirect("状态更新失败");
            }
        // }else{
        //     $this->error('没有权限');
        // }
    }
}

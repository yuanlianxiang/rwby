<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 单页管理
 */
class DepartmentController extends BaseController
{
    /**
     * 单页列表
     * @return [type] [description]
     */
    public function index($key="")
    {
      if($key === ""){
        $model = M('department');  
      }else{
        // $where['name'] = array('like',"%$key%");
        $where['workdays'] = array('like',"%$key%");
        // $where['grade'] = array('like',"%$key%");
        $where['_logic'] = 'or';
        $model = M('department')->where($where); 
      } 

        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $department = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id ASC')->select();
        $this->assign('department', $department);
        $this->assign('page',$show);
        $this->display();     
      }

    /**
     * 添加部门
     */
    public function add()
    {
        //默认显示添加表单
      if (IS_POST) {
            //如果用户提交数据
        $model = D('Department');
        $data = I('post.info');
        $check=I('post.info.name');
        if($check!=" "){
          $res = $model->add($data);
        }
        $res ? $this->success('添加成功') : $this->error('添加失败');
      }else{
        $this->display(add);
      }
    }
    /**
     * 更新部门信息
     * @param  [type] $id [单页ID]
     * @return [type]     [description]
     */
    public function update()
    {
      $model = D("Department");
      if (IS_POST) {
        $data = I('post.info');
        $res = $model->save($data);
        $res ? $this->success('修改成功') : $this->error('修改失败');
      }else {
        $id = I('get.id');
        $info = $model->where(array('id'=>$id))->find();
        $this->assign('info', $info);
        IS_AJAX ? $this->success($info) : $this->display('update');
      }
    }
    /**
     * 删除部门
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
      $id = intval($id);
      $model = M('department');
      $result = $model->where("id=%d",$id)->delete();
      if($result){
        $this->redirect("删除成功", U('department/index'));
      }else{
        $this->error("删除失败");
      }
    }
  }

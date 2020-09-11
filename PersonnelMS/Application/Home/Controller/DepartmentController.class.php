<?php
namespace Home\Controller;
use Home\Controller;
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
        $where['name'] = array('like',"%$key%");
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
  }

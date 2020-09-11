<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {
    //登陆主页
    public function index(){
        $this->display();
    }
    //登陆验证
    public function login(){
        $consumer = M('consumer');
        $username =I('post.username');
        $password =I('post.password');
        $code = I('post.verify','','strtolower');
        $check=$this->check_verify($code);
        $check===true;
        $user = $consumer->where("username = '%s' and password= '%s'",array($username,$password))->find();
        if(IS_POST){
            //验证验证码是否正确
            if($check){
                //验证帐号或密码是否正确
                if($user) {
                    session('HomeId',$user['id']);
                    session('username',$user['username']);
                    $this->redirect("登陆成功",U('Index/index'));
                }else{
                    $this->error('账号或密码错误');
                }
            }else{
                $this->error('验证码错误');
            }
        }
    }
    /*修改密码*/
    public function changePassword()
    {   
        if (IS_POST) {
            //如果用户提交数据
            $model = D('Consumer');
            $username=I('post.username');
            $oldpassword=I('post.oldpassword');
            $password=I('post.password');
            $result=$model->where(array("username"=>$username));
            if($result){
                $getPassword=$result->getField('password');
            }
            if ($oldpassword==$getPassword) {
                $data['password']=$password;
                $res = $model->where(array("username"=>$username))->save($data);
                $res ? $this->success('修改成功') : $this->error('修改失败');
            }else{
                $this->error('原密码错误');
            }
        }
    }
    public function verify()
    {
        $verify = new \Think\Verify();
        $verify->imageH = 40;
        $verify->imageW = 120;
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->fontSize = 16;
        return $verify->entry();
    }
    public function check_verify($code,$id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }

    public function loginOut(){
        session('HomeId',null);
        session('username',null);
        redirect(U('Login/index'));
    }
}
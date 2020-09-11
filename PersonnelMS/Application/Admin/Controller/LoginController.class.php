<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    //登陆主页
	public function index(){
		$this->display();
	}
    //登陆验证
	public function login(){
		$manager = M('manager');
		$username =I('post.username');
		$password =I('post.password');
		$code = I('post.verify','','strtolower');
		$check=$this->check_verify($code);
		$check===true;
		$user = $manager->where("username = '%s' and password= '%s'",array($username,$password))->find();
		//更新登陆信息
		$data =array(
			'id' => $user['id'],
			'update_at' => time(),
			'login_ip' =>get_client_ip(),
            // 'login_ip'=>$_SERVER['REMOTE_ADDR']
			);
		if(IS_POST){
			//验证验证码是否正确
			if($check){
                //验证帐号或密码是否正确
				if(!$user) {
					$this->error('账号或密码错误') ;
				}
                //验证账户是否被禁用
				if($user['status'] == 0){
					$this->error('账号被禁用，请联系超级管理员') ;
				}
                //如果数据更新成功  跳转到后台主页
				if($manager->save($data)){
					session('adminId',$user['id']);
					session('username',$user['username']);
					session('login_ip',$user['login_ip']);
					$this->redirect("登陆成功",U('Index/index'));
				}
			}else{
				$this->error('验证码错误');
			}
		}
	}
	public function changePassword()
	{   
		if (IS_POST) {
            //如果用户提交数据
			$model = D('Manager');
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
		session('adminId',null);
		session('username',null);
		redirect(U('Login/index'));
	}
}
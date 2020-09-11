<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
    public function _initialize(){
        $id = session('HomeId');
        //判断用户是否登陆
        if(!isset($id ) ) {
            redirect(U('Login/index'));
        }

    }

}
<?php
namespace Manager\Controller;
use Think\Controller;
use Org\Util\Rabc;

/**
 *后台基类--权限控制
 * zeor 2015-08-01
 */
class BaseController extends Controller{

	/**
	 * [_initialize 初始化函数]
	 * @return [type] [description]
	 */
	public function _initialize(){
		// echo '登陆ID--'.C('USER_AUTH_KEY');
		//未登录
		if(session(C('USER_AUTH_KEY'))==null){
			// $this->redirect('/Manager/Login/index',null,5,'登陆跳转');
		}
	}


}
<?php
namespace Manager\Controller;
use Think\Controller;

/**
* 后台--登陆入口
*/
class LoginController extends Controller
{
	public function index(){
		$this->display('index.html');
	}
}

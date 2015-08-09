<?php
namespace Manager\Controller;
use Think\Controller;

/**
*登陆验证S
*/
class LoginController extends Controller
{
	public function Index()
	{
		$this->display('index');
	}

	/**
	*登录验证
	*/
	public function Login()
	{
		// 获取参数
		$username = I('username');//用户名
		$password=I('password');//密码
		$yzm = I('yzm');//验证码
	
		if(!$this->check_verify($yzm,''))
		{
			$this->error('验证码错误');
		}
		if($username!='admin'||$password!='admin888')
		{
			$this->error('用户名或密码错误');
		}

		$this->success('登录成功','../Index/index',5);
	}

	/**
	*生成验证码图片
	*/
	public function YZM()
	{
		$Verify = new \Think\Verify();
		$Verify->fontSize=12;//设置验证码字体大小
		$Verify->length=4;//验证码长度
		$Verify->useNoise=false;//杂点
		$Verify->useCurve=false;//曲线
		$Verify->imageH=35;//高度
		$Verify->expire=120;//过期实际（秒）
		$Verify->entry();
	}

	/**
	*验证码验证
	*/
	protected function check_verify($code,$id='')
	{
		$Verify = new \Think\Verify();
		return $Verify->check($code,$id); 
	}
}
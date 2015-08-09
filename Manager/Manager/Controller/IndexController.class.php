<?php
namespace Manager\Controller;

/**
*后台主页
*Zeor 2015-5-30
*/
class IndexController extends BaseController
{
	/**
	 * [Index description]首页
	 */
	public function Index()
	{
		$this->assign('loginid','admin');
		$this->assign('Menu','index');
		$this->display('index');
	}
}

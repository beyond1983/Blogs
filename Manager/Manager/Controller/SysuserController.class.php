<?php
namespace Manager\Controller;
use Think\Controller;
use Think\Model;

/**
*用户管理
*Zeor 2015-5-31
*/
class SysuserController extends Controller
{
	/**
	*列表页
	*/
	public function Index()
	{
		// 获取数据列表
		$Model = M('user','Sys_','DB_CONFIG1');

		$count = $Model->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出

		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Model->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('Menu','sysuser');
		$this->display('index');// 输出模板
	}

	/**
	*新增
	*/
	public function Add()
	{
		//获取角色列表
		$Role = M('Role','sys_','DB_CONFIG1');
		$roles = $Role->where('status=1')->select();

		// 赋值输出
		$this->assign('Menu','sysuser');
		$this->assign('Roles', $roles);
		$this->display('add');
	}

	/**
	*保存新增用户
	*/
	public function AddSave()
	{
		//获取参数
		$loginid = I('loginid');
		$username = I('username');
		$password = I('password');
		$email =I('email');
		$mobile =I('mobile');
		$roleid =I('role_id',0,'int');

		// 申明Model
		$UserModel = M('User','sys_','DB_CONFIG1');
		
		// 查找该账号或邮箱是否存在
		$user =$UserModel->where("LoginId='%s'",$loginid)->select();
		if($user!=null)
		{
			$result['result']  = false;
			$result['msg'] = '该用户已存在';
			$this->ajaxReturn($result);
		}
		//权限选择异常
		if(!$roleid){
			$result['result']  = false;
			$result['msg'] = '数据异常';
			$this->ajaxReturn($result);	
		}

		// 实例化Model
		$model = new Model();
		$model->startTrans();

		// 新增对象
		$data['LoginId'] =$loginid;
		$data['UserName']=$username;
		$data['PassWord']=md5($password);
		$data['Email']=$email;
		$data['Mobile']=$mobile;
		$data['CreateTime']=time();//获取当前时间戳
		
		// 新增保存
		$userid = $model->table('sys_user')->add($data);
		if($userid){
			$sql = $model->getLastSql();
			//保存角色表数据
			$UserRole = M('role_user','sys_','DB_CONFIG1');
			$roleData ['role_id'] = $roleid;
			$roleData ['user_id'] = $userid;

			//权限新增
			if($model->table('sys_role_user')->add($roleData)){
				// 事务提交				
				$model->commit();

				//返回JSON对象
				$result['result']  = true;
				$result['msg'] = '新增成功！';
				$this->ajaxReturn($result);
			}
			else{
				//事务回滚
				$model->rollback();

				//返回JSON对象
				$result['result']  = false;
				$result['msg'] = '新增失败,已回滚！';
				$this->ajaxReturn($result);
			}			
		}
		else{
			//事务回滚
			$model->rollback();

			//返回JSON对象
			$result['result']  = false;
			$result['msg'] = '新增失败！';
			$this->ajaxReturn($result);
		}
	}

	/**
	*修改用户
	*/
	public function EditSave()
	{
		//获取参数
		$id = I('id',0,'int');
		$username = I('username');
		$password = I('password');
		$email =I('email');
		$mobile =I('mobile');
		$roleid = I('role_id');

		//是否修改
		if($id==0)
		{
			$result['result']  = false;
			$result['msg'] = '该用户不存在';
			$this->ajaxReturn($result);
		}

		//开启事务
		$model = new Model();
		$model->startTrans();
		$flage===false;

		//申明修改用户对象
		$data['UserName']=$username;
		if(!empty($password)){
			$data['PassWord']=md5($password);
		}
		$data['Email']=$email;
		$data['Mobile']=$mobile;

		//更新
		$flage = $model->table('sys_user')->where('id=%d',$id)->save($data);
		if($flage===false){
			//事务回滚
			$model->rollback();

			$result['result']  = false;
			$result['msg'] = '修改用户资料失败！';
			$this->ajaxReturn($result);
		}
		else{
			$flage=$model->table('sys_role_user')->where('user_id=%d',$id)->delete();
			if($flage===false){
				//事务回滚
				$model->rollback();

				$result['result']  = false;
				$result['msg'] = '修改用户资料失败！';
				$this->ajaxReturn($result);
			}

			//角色处理
			foreach ($roleid as $key => $value) {
				# code...
				$data2['role_id']=$value;
				$data2['user_id']=$id;

				$flage = $model->table('sys_role_user')->add($data2);
				if($flage===false){
					//事务回滚
					$model->rollback();

					$result['result']  = false;
					$result['msg'] = '修改用户资料失败！';
					$this->ajaxReturn($result);
				} 
			}
			
			if($flage){
				//事务提交
				$model->commit();

				$result['result']  = true;
				$result['msg'] = '修改用户资料成功！';
				$this->ajaxReturn($result);
			}
		}
		
	}

	/**
	*删除用户
	*/
	public function Del()
	{
		// 获取参数
		$id =I('id');

		//实例化Model
		$Sysuser =M('user','sys_','DB_CONFIG1');

		// 删除操作
		$result = $Sysuser->where('id=%d',$id)->delete();

		// 返回处理
		if(!$result){
			$data['result']=false;
			$data['msg']='删除失败';

			$this->ajaxReturn($data);
		}
		else{
			//删除角色表关联
			$RoleUser = M('role_user','sys_','DB_CONFIG1');
			$RoleUser->where('user_id=%d',$id)->delete();

			$data['result']=true;
			$data['msg']='删除成功';

			$this->ajaxReturn($data);
		}
	}

	/**
	*修改
	*/
	public function Edit()
	{
		// 获取参数
		$id = I('id',0,'int');

		if(!$id){
			$this->error('参数错误!','/Manager/Sysuser/Index');
		}

		// 获取数据
		$User = M('user','sys_','DB_CONFIG1');
		$Role = M('role','sys_','DB_CONFIG1');
		$RoleUser = M('role_user','sys_','DB_CONFIG1');
		$info = $User->where('id=%d',$id)->find();
		$Roles = $Role->where('status=1')->select();
		$RoleUser = $RoleUser->where('user_id=%d',$id)->select();

		//角色选中处理
		foreach ($Roles as $key => $role) {
			$Roles[$key]['select']="";
			foreach ($RoleUser as $idx => $value) {
				if($role['id']==$value['role_id'])
					$Roles[$key]['select']="selected";
			}
		}

		//绑定
		$this->assign('user',$info);
		$this->assign('Roles',$Roles);
		$this->assign('Menu','sysuser');
		$this->display('edit');
	}
}
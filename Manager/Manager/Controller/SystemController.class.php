<?php
namespace Manager\Controller;
use Org\Extend\Tree;
use Org\Net\Snoopy;

/**
*系统管理
*zeor 2015-6-20
*/
class SystemController extends BaseController{
	
	/**
	*系统管理--角色管理
	*2015-6-20
	*/
	public function Roles(){
		//系统角色对象
		$Roles = M('Role','Sys_','Db_Config1');

		// 获取分页数据列表
		$count = $Roles->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Roles->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		// $snoopy = new Snoopy;
		// $snoopy->fetchlinks('http://huaban.com/');
		// $links = $snoopy->results;
		// var_dump($links);
		// // $snoopy->fetch('http://cl.blos.pw/htm_data/16/1508/1591920.html');
		// foreach ($links as $key => $value) {
		// 	# code...
			
		// 	$snoopy->fetchimage($value);
		// 	$imgs = $snoopy->results;
		// 	foreach ($imgs as $key => $value2) {
		// 		# code...
		// 		echo '<img '.$value2.'\' alt="">';
		// 	}
		// }
		
		//绑定输出
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('Menu','system');//当前模块名称
		$this->display('role');// 输出模板
	}

	/**
	*系统管理--角色管理--新增角色
	*zeor 2015-6-20
	*/
	public function RoleAdd(){
		//绑定输出
		$this->assign('Menu','system');//当前模块名称
		$this->display('role_add');// 输出模板
	}

	/**
	*系统管理--角色管理--角色保存处理
	*zeor 2015-6-20
	*/
	public function RoleSave(){
		// 获取参数
		$id = I('id',0,'int');
		$name =I('name');
		$status =I('status',0,'int');
		$remark=I('remark');

		// 实例化数据对象
		$Role =  M('Role','Sys_','Db_Config1');

		// 绑定数据
		$data['name']=$name;
		$data['pid']='tttt';
		$data['status']=$status;
		$data['remark']=$remark;

		// 新增
		if (!$id) {
			# code...
			$result = $Role->Add($data);
			if($result){

				$returnData['result']=true;
				$returnData['msg']='保存成功';

				//返回
				$this->ajaxReturn($returnData);
			}
			else{
				$returnData['result']=false;
				$returnData['msg']='保存失败！';

				//返回
				$this->ajaxReturn($returnData);
			}
		}else{//修改
			$result = $Role->where('id=%d',$id)->save($data);
			if($result===false){
				$returnData['result']=false;
				$returnData['msg']='保存失败！';

				//返回
				$this->ajaxReturn($returnData);
			}
			else{

				$returnData['result']=true;
				$returnData['msg']='保存成功';

				//返回
				$this->ajaxReturn($returnData);
			}
		}
	}

	/**
	 * [RoleDel 系统管理--角色管理--删除角色]
	 */
	public function RoleDel(){
		// 获取参数
		$id=I('id',0,'int');

		//角色对象
		$Role =  M('Role','Sys_','Db_Config1');

		//删除
		$result = $Role->where('id=%d',$id)->delete();
		if($result===false){
			$returnData['result']=false;
			$returnData['msg']='保存失败！';

			//返回
			$this->ajaxReturn($returnData);
		}else{
			$returnData['result']=true;
			$returnData['msg']='保存成功';

			//返回
			$this->ajaxReturn($returnData);
		}
	}

	/**
	*角色管理-编辑
	*zeor 2015-6-20
	*/
	public function RoleEdit(){
		// 获取参数
		$id = I('id',0,'int');

		// 角色对象
		$Role =  M('Role','Sys_','Db_Config1');

		// 获取数据
		$Info = $Role->where('id=%d',$id)->find();

		//绑定与显示
		$this->assign('info', $Info);
		$this->assign('Menu', 'system');
		$this->display('role_edit');
	}

	/**
	*系统管理--模块管理--列表
	*zeor 2015-6-21
	*/
	public function Nodes(){
		//系统角色对象
		$Nodes =  M('Node','Sys_','Db_Config1');

		// 获取分页数据列表
		$count = $Nodes->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,100);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出

		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Nodes->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();

		// 生成无限树状数组结构
		$tree = new Tree; 
		$tree->tree($list); 

		// 如果使用数组, 请使用 getArray方法
		$list=$tree->getArray();

		//绑定输出
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('Menu','system');//当前模块名称
		$this->display('node');// 输出模板
	}

	/**
	*系统模块-新增
	*zeor 2015-6-21
	*/
	public function NodeAdd(){
		// 模块对象
		$Node =  M('Node','Sys_','Db_Config1');

		// 获取数据列表
		$list = $Node->where('status=1')->select();

		// 生成无限树状数组结构
		$tree = new Tree; 
		$tree->tree($list); 
		// 如果使用数组, 请使用 getArray方法
		$list=$tree->getArray();

		//绑定输出
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('Menu','system');//当前模块名称
		$this->display('node_add');// 输出模板
	}

	/**
	*模块数据保存
	*zeor 2015-6-22
	*/
	public function NodeSave(){
		// 获取参数
		$id = I('id',0,'int');
		$name =I('name');
		$title =I('title');
		$status =I('status',0,'int');
		$pid =I('pid',0,'int');
		$level =I('level',0,'int');
		$sort =I('sort',0,'int');
		$remark=I('remark');

		// 实例化数据对象
		$Node =  M('Node','Sys_','Db_Config1');

		// 绑定数据
		$data['name']=$name;
		$data['title']=$title;
		$data['status']=$status;
		$data['pid']=$pid;
		$data['level']=$level;
		$data['sort']=$sort;
		$data['remark']=$remark;

		// 新增
		if (!$id) {
			# code...
			$result = $Node->Add($data);
			if($result){
				$returnData['result']=true;
				$returnData['msg']='新增成功';

				//返回
				$this->ajaxReturn($returnData);
			}
			else{
				$returnData['result']=false;
				$returnData['msg']='新增失败！';

				//返回
				$this->ajaxReturn($returnData);
			}
		}else{//修改
			$result = $Node->where('id=%d',$id)->save($data);
			if($result===false){
				$returnData['result']=false;
				$returnData['msg']='修改失败！';

				//返回
				$this->ajaxReturn($returnData);
			}
			else{
				$returnData['result']=true;
				$returnData['msg']='修改成功';

				//返回
				$this->ajaxReturn($returnData);
			}
		}
	}

	/**
	*系统模块-修改
	*zeor 2015-6-26
	*/
	public function NodeEdit(){
		// 获取参数
		$id = I('id',0,'int');

		//参数错误
		if($id==0){
			$this->error('参数错误','/Manager/System/Nodes',3);
		}

		// 获取数据
		$Node =  M('Node','Sys_','Db_Cofig1');
		$Info = $Node->where('id=%d',$id)->find();
		$List =$Node->where('id<>%d',$id)->select();

		// 生成无限树状数组结构
		$tree = new Tree; 
		$tree->tree($List); 
		// 如果使用数组, 请使用 getArray方法
		$List=$tree->getArray();

		// 绑定显示
		$this->assign('Menu','System');
		$this->assign('Info', $Info);
		$this->assign('List', $List);
		$this->display('node_edit');
	}

	/**
	 * 系统管理--模块管理--删除
	 * zeor 2015-07-28
	 */
	public function NodeDel(){
		// 获取参数
		$id = I('id',0,'int');

		//角色对象
		$Node =  M('Node','Sys_','Db_Cofig1');

		//删除
		$result = $Node->where('id=%d',$id)->delete();
		if($result){
			$returnData['result']=true;
			$returnData['msg']='删除成功';

			//返回
			$this->ajaxReturn($returnData);
		}else{
			$returnData['result']=false;
			$returnData['msg']='删除失败！';

			//返回
			$this->ajaxReturn($returnData);
		}
	}
}
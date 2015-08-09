<?php
return array(
	//'配置项'=>'配置值'
	'APP_DEBUG'=>true,
	'DEFAULT_MODEL'=>'Index',
    'SHOW_PAGE_TRACE'=>true, 

    // URL配置
    'URL_MODEL'             =>  2,   //URLREWRITER 模式，省略入口文件

	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'blog', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '1990517', // 密码
	'DB_PORT'   => 13306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集

	//RBAC权限认证体系配置
    'USER_AUTH_ON'            =>        true,             //开启认证
    'USER_AUTH_TYPE'        =>        1,              //用户认证使用SESSION标记,1 登陆验证 2 实时验证
    'USER_AUTH_KEY'            =>        'authId',          //设置认证SESSION的标记名称
    'ADMIN_AUTH_KEY'        =>        'admin',        //管理员用户标记
    'USER_AUTH_MODEL'        =>        'User',          //验证用户的表模型u_user
    'AUTH_PWD_ENCODER'        =>        'md5',             //用户认证密码加密方式
    'USER_AUTH_GATEWAY'        =>        '/Manager/Login/Index',//默认的认证网关
    'NOT_AUTH_MODULE'        =>        '/Manager/Login/,Home',          //默认不需要认证的模块'A,B,C'
    'REQUIRE_AUTH_MODULE'    =>        '',              //默认需要认证的模块
    'NOT_AUTH_ACTION'        =>        '',                //默认不需要认证的动作
    'REQUIRE_AUTH_ACTION'    =>        '',                //默认需要认证的动作
    'GUEST_AUTH_ON'            =>        false,            //是否开启游客授权访问
    'GUEST_AUTH_ID'            =>        0,                 //游客标记    
    'RBAC_ROLE_TABLE'        =>        'sys_role',       //角色表
    'RBAC_USER_TABLE'        =>        'sys_role_user', //角色分配表
    'RBAC_ACCESS_TABLE'        =>        'sys_access',   //权限分配表
    'RBAC_NODE_TABLE'        =>        'sys_node',     //节点表

    'DB_CONFIG1'=>array(
    	//数据库配置信息
    	'DB_TYPE'   => 'mysql', // 数据库类型
    	'DB_HOST'   => 'localhost', // 服务器地址
    	'DB_NAME'   => 'blog', // 数据库名
    	'DB_USER'   => 'root', // 用户名
    	'DB_PWD'    => '1990517', // 密码
    	'DB_PORT'   => 13306, // 端口
    	'DB_PREFIX' => '', // 数据库表前缀 
    	'DB_CHARSET'=> 'utf8', // 字符集
    	),
);
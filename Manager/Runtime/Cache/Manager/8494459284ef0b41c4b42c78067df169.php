<?php if (!defined('THINK_PATH')) exit();?><!-- 引入头部文件 -->
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width,initial-scale=1" />
	    <title>后台管理--管理员登陆</title>
		<link rel="stylesheet" type="text/css" href="/Public/js/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/Public/css/manager.css">
		<!--[if lt IE 9]>
		 <script src="/Public/js/html5shiv.min.js" type="text/javascript"></script>
	      <script src="/Public/js/respond.min.js" type="text/javascript"></script>
		<![end if]-->
		<script src="/Public/js/jquery-1.11.2.min.js" type="text/javascript"></script>
		<script src="/Public/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="/Public/js/comm.js"></script>
	</head>
<body>
<!--导航-->
<div class="navbar navbar-inverse" role="navigation">
	<div class="navbar-header">
	 　<!-- .navbar-toggle样式用于toggle收缩的内容，即nav-collapse collapse样式所在元素 -->
	   <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	     <span class="sr-only">Toggle Navigation</span>
	     <span class="icon-bar"></span>
	     <span class="icon-bar"></span>
	     <span class="icon-bar"></span>
	   </button>
	   <!-- 确保无论是宽屏还是窄屏，navbar-brand都显示 -->
	   <a href="##" class="navbar-brand">网站后台管理中心</a>
	</div>
  <!-- 屏幕宽度小于768px时，div.navbar-responsive-collapse容器里的内容都会隐藏，显示icon-bar图标，当点击icon-bar图标时，再展开。屏幕大于768px时，默认显示。 -->
	<div class="collapse navbar-collapse navbar-responsive-collapse">
		<ul class="nav navbar-nav">
	  		<li <?php if(($Menu) == "index"): ?>class="active"<?php endif; ?>><a href="../Index/index">首页</a></li>
	  		<li class="dropdown <?php if(($Menu) == "sysuser"): ?>active<?php endif; ?>">
	  			<a href="##" data-toggle="dropdown" class="dropdown-toggle">
	  			用户管理<span class="caret"></span></a>
	  			<ul class="dropdown-menu">
	  				<li><a href="/Manager/Sysuser/Index">用户列表</a></li>
	  			</ul>
  			</li>
	  		<li class="dropdown <?php if(($Menu) == "weixin"): ?>active<?php endif; ?>">	<a href="##" data-toggle="dropdown" class="dropdown-toggle">微信管理 <span class="caret"></span></a>
	  			<ul class="dropdown-menu">
	  				<li>
	  				<a href="/Manager/Weixin/lists">消息列表</a>
	  				</li>
	  			</ul>
	  		</li>
	  		<li><a href="##">名师介绍</a></li>
	  		<li><a href="##">成功案例</a></li>
	  		<li class="dropdown <?php if(($system) == "system"): ?>active<?php endif; ?>">	<a href="##" data-toggle="dropdown" class="dropdown-toggle">系统管理 <span class="caret"></span></a>
	  			<ul class="dropdown-menu">
	  				<li>
	  					<a href="/Manager/System/Roles">角色管理</a>
	  				</li>
	  				<li class="divider"></li>
	  				<li>
	  					<a href="/Manager/System/Nodes">模块管理</a>
	  				</li>
	  			</ul>
	  		</li>
	 	</ul>
	</div>
</div>

	


<div class="container-fluid">
	<!-- BEGIN PAGE HEADER-->
	<ol class="breadcrumb">
		<li>
			<i class="glyphicon glyphicon-user"></i>
			<a href="index.html">用户管理</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li class="active">用户列表</li>
	</ol>
	<!-- 工具栏 -->
	<div class="row-fluid tool">
		<a href="/Manager/Sysuser/Add" class="btn btn-info" aria-label="Left Align"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增用户</a>		
	</div>
	<!-- 页面主内容 -->
	<div class="row-fluid">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
			<tr><th></th><th>账号</th><th>用户名</th><th>邮箱</th><th>电话</th><th>操作</th></tr>
				<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr><td><?php echo ($key+1); ?></td><td><?php echo ($item["loginid"]); ?></td><td><?php echo ($item["username"]); ?></td><td><?php echo ($item["email"]); ?></td><td><?php echo ($item["mobile"]); ?></td><td><a onclick="Del(<?php echo ($item["id"]); ?>)">删除</a>&nbsp;<a href="/Manager/Sysuser/Edit/id/<?php echo ($item["id"]); ?>">修改</a></tr><?php endforeach; endif; ?>
			</table>
		</div>
		
		<!-- 分页内容 -->
		<?php echo ($page); ?>
	</div>
	<!-- 页面主内容-结束 -->
</div>
<script type="text/javascript" src="/Public/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/Public/js/comm.js"></script>
<script type="text/javascript">
// 删除
function Del(id){
	if(window.confirm("确认删除?")){
		$.AjaxDel({
			url:'/Manager/Sysuser/Del',
			data:{id:id},
			loadUrl:'/Manager/Sysuser/Index'
		});
	}
};	

</script>
<!-- 引入底部文件 -->
<div class="footer">
	<div class="footer-inner text-center">
		2015 &copy; Admin ZEOR.
	</div>
</div>
</body>
</html>
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
			<a href="javascript:void(0);">用户管理</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="<?php echo U('Manager/Sysuser/Index');?>">用户列表</a></li>
		<li class="active">修改用户信息</li>
	</ol>

	<!-- 页面主内容 -->
	<div class="row-fluid">
		<form class="form-horizontal">
			<div class="form-group has-feedback">
				<label for="loginid" class="col-sm-1 control-label">账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</label>
			 	<div class="col-sm-3">
					<input type="hidden" value="<?php echo ($user["id"]); ?>" name="id">
	      			<input type="text" class="form-control " value="<?php echo ($user["loginid"]); ?>" readonly="readonly" disabled="disabled">
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="username" class="col-sm-1 control-label">用&nbsp;户&nbsp;&nbsp;名</label>
			 	<div class="col-sm-3">
		      		<input type="text" class="form-control" id="username" name="username" placeholder="用户名" data-type="required" value="<?php echo ($user["username"]); ?>">
			    </div>
			</div>			
			<div class="form-group has-feedback">
				<label for="password" class="col-sm-1 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
			 	<div class="col-sm-3">
		      		<input type="password" class="form-control" id="password" name="password" placeholder="留空不修改" >
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="email" class="col-sm-1 control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
			 	<div class="col-sm-3">
			      <input type="text" class="form-control" id="email" name="email" placeholder="邮箱" data-type="required email" value="<?php echo ($user["email"]); ?>">
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="mobile" class="col-sm-1 control-label">手机号码</label>
			 	<div class="col-sm-3">
			      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="手机号码" data-type="required mobile"value="<?php echo ($user["mobile"]); ?>">
			    </div>
			</div>
			<div class="form-group has-feedback">
				<legend></legend>
				<label for="mobile" class="col-sm-1 control-label">所属角色</label>
				<div class="col-sm-4">			
					<?php if(is_array($Roles)): foreach($Roles as $key=>$role): ?><label for="role_<?php echo ($role["id"]); ?>" class="checkbox-inline">
						<input type="checkbox" value="<?php echo ($role["id"]); ?>" id="role_<?php echo ($role["id"]); ?>" name="role_id[]" <?php if($role["select"] == 'selected'): ?>checked="checked"<?php endif; ?>><?php echo ($role["name"]); ?>
						</label><?php endforeach; endif; ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-3">
					<button class="btn btn-info btn-md" type="button" onclick="SubmitForm()">保存</button>
				</div>
			</div>
		</form>
	</div>
	<!-- 页面主内容-结束 -->

</div>
<script type="text/javascript">
//表单验证
$('form').FormValider();

// 保存
function SubmitForm(){
	if($('form').FormValider().CheckForm()){
		$.AjaxSave({
			url:'/Manager/Sysuser/EditSave',
			returnHref:'/Manager/Sysuser/Index'
		})
	};
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
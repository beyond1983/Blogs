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
			<i class="glyphicon glyphicon-wrench"></i>
			<a href="javascript:void(0);">系统管理</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="<?php echo U('/Manager/System/Nodes');?>">模块管理</a></li>
		<li class="active">新增模块</li>
	</ol>

	<!-- 页面主内容 -->
	<div class="row-fluid">
		<form class="form-horizontal">
			<div class="form-group has-feedback">
				<label for="name" class="col-sm-1 control-label">模块名称</label>
			 	<div class="col-sm-3">
			      <input type="text" class="form-control" id="name" name="name" placeholder="模块名称" data-type="required">
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="title" class="col-sm-1 control-label">模块别名</label>
			 	<div class="col-sm-3">
			      <input type="text" class="form-control" id="title" name="title" placeholder="模块别名" data-type="required">
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="status" class="col-sm-1 control-label">模块状态</label>
			 	<div class="col-sm-3">
			      <select name="status" id="status" class="form-control">
			      	<option value="0">禁用</option>
			      	<option value="1" selected="selected">启用</option>
			      </select>
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="pid" class="col-sm-1 control-label">父模块</label>
			 	<div class="col-sm-3">
			    	<select name="pid" id="pid" class="form-control">
			      		<option value="0">----</option>
			      		<?php if(is_array($list)): foreach($list as $key=>$item): ?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; ?>
			      	</select>
			    </div>
			</div>
			<div class="form-group has-feddback">
				<label for="pid" class="col-sm-1 control-label">所属功能</label>
			 	<div class="col-sm-3">
					<label class="radio-inline">
						<input type="radio" name="level" id="levelRadio1" value="1"> 项目
					</label>
					<label class="radio-inline">
						<input type="radio" name="level" id="levelRadio2" value="2" checked="checked"> 模块
					</label>
					<label class="radio-inline">
						<input type="radio" name="level" id="levelRadio3" value="3"> 操作
					</label>
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="sort" class="col-sm-1 control-label">排序ID</label>
			 	<div class="col-sm-3">
			      <select name="sort" id="sort" class="form-control">
			      	<option value="1" selected="selected">1</option>
			      	<option value="2">2</option>
			      	<option value="3">3</option>
			      	<option value="4">4</option>
			      	<option value="5">5</option>
			      </select>
			    </div>
			</div>
			<div class="form-group has-feedback">
				<label for="remark" class="col-sm-1 control-label">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</label>
			 	<div class="col-sm-3">
			      <textarea name="remark" id="remark" cols="30" rows="10" class="form-control"></textarea>
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
			url:'NodeSave',
			returnHref:'/Manager/System/Nodes'
		})
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
// 扩展jQuery方法
$.extend({
	// 日志记录
	log:function(txt){
		console.info(txt);
	},
	// 异步删除
	AjaxDel:function(options){
		// 默认值
		this.defaults = {
			url:'',
			data:{id:0},
			dataType:'json',
			type:'post',
			loadUrl:window.location.href
		};

		//设置默认值
		this.settings= $.extend({},this.defaults,options);

		var loadUrl = this.settings.loadUrl;

		return $.ajax({
			url:this.settings.url,
			data:this.settings.data,
			dataType:this.settings.dataType,
			type:this.settings.type,
			success:function(data){
				if(data.result==true){
					// alert(data.msg);
					window.location.href= loadUrl;
				}else{
					alert(data.msg);
				}
			},
			error:function(xrl,textStatus,data){
				alert('网络异常，请刷新重试！');
			}
		});
	},
	// 异步保存
	AjaxSave:function(options){
		// 默认值
		this.defaults = {
			url:'',
			data:$("form").serialize(),
			dataType:'json',
			returnHref:'',
			type:'post'
		};

		//设置默认值
		this.settings= $.extend({},this.defaults,options);

		//成功返回地址
		var returnHref = this.settings.returnHref;

		return $.ajax({
			url:this.settings.url,
			data:this.settings.data,
			dataType:this.settings.dataType,
			type:this.settings.type,
			success:function(data){
				console.info(this);
				if(data.result==true){
					alert(data.msg);
					window.location.href= returnHref;
				}else{
					alert(data.msg);
				}
			},
			error:function(xrl,textStatus,data){
				alert('网络异常，请刷新重试！');
			}
		});
	}
});

// (function($){
// 	$.fn.AjaxDel=function(options){
// 		// 创建默认值
// 		var settings =$.extends({
// 			url:'',
// 			data:'id=0'
// 		},options);

// 		return $.ajax({
// 		url:settings.url,
// 		type:'post',
// 		dataType:'json',
// 		data:settings.data,
// 		success:function(data){
// 			if(data.result==true){
// 				window.location.reload();
// 			}
// 			else{
// 				alert(data.msg);
// 			}
// 		},
// 		error:function(XMLHttpRequest, textStatus, errorThrown){
// 			alert('网络异常！');
// 		}
// 	});
// 	};
// })(jQuery)

// 自定义bootstrap表单验证插件
(function(){
	// 表单验证对象构造函数
	var FormValider = function(ele,options){
		this.$element = ele;
		this.defaults={
			//提示信息
            tips_success: '', //验证成功时的提示信息，默认为空
            tips_required: '不能为空',
            tips_email: '邮箱地址格式有误',
            tips_num: '请填写数字',
            tips_chinese: '请填写中文',
            tips_mobile: '手机号码格式有误',
            tips_idcard: '身份证号码格式有误',
            tips_pwdequal: '两次密码不一致',

            // 错误提示
            inner_error:'<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>',
  		 	inner_success:'<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>',

      		// 提示样式
      		css_error:'has-error',
      		css_success:'has-success',
 
            //正则
            reg_email: /^\w+\@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/i,  //验证邮箱
            reg_num: /^\d+$/,                                  //验证数字
            reg_chinese: /^[\u4E00-\u9FA5]+$/,                 //验证中文
            reg_mobile: /^1[3458]{1}[0-9]{9}$/,                //验证手机
            reg_idcard: /^\d{14}\d{3}?\w$/                     //验证身份证
		};

		// 合并参数
		this.settings=$.extend({},this.defaults,options);
	};

	// 验证函数
	var _check = function(obj,_math,_val){
		 switch(_math){
		 	//非空验证
			case 'required':
				return $.trim(_val)==""?false:true;
			break;
			// 邮箱验证
			case 'email':
				return obj.reg_email.test(_val);
			break;
			//手机号码
			case 'mobile':
				return obj.reg_mobile.test(_val);
			break;
			default:
				return true;
			break;
		}
	};

	// 扩展方法
	FormValider.prototype={
		// 输入完毕验证
		OnBlur:function(){
			var valider = this;
			// 失去焦点验证
			return $(":text,:password,textarea",this.$element).each(function(){
				// 获取当前jQuery对象，不用每次都去调用转换
				var $this = $(this);
				$this.blur(function(){
					// 获取验证类型
					var _validate = $this.attr("data-type");
					if(_validate){
						// 空格分割验证规则数组
						var arr = _validate.split(" ");
						for(var i=0;i<arr.length;i++){
							// 逐个验证，不通过返回false，通过则继续
							if(!_check(valider.settings,arr[i],$this.val())){
								$this.parent('div').addClass(valider.settings.css_error).removeClass(valider.settings.css_success);

								// 是否已存在提示标签
								var feed = $this.next('span.glyphicon');
								if(feed.length!=0){
									feed.removeClass('glyphicon-ok').addClass('glyphicon-remove')
								}
								else{
									$this.after(valider.settings.inner_error).parent('div').addClass(valider.settings.css_error);
								}
								return false;
							}
							else{
								$this.parent('div').removeClass(valider.settings.css_error).addClass(valider.settings.css_success);

								// 是否已存在提示标签
								var feed = $this.next('span.glyphicon');
								
								if(feed.length!=0){
									feed.removeClass('glyphicon-remove').addClass('glyphicon-ok')
								}
								else{
									$this.after(valider.settings.inner_success).parent('div').addClass(valider.settings.css_success);
								}
								continue;
							}
						}
					}
				});
			});
		},
		// 表单提交验证
		OnSubmit:function(){
			var valider = this;
			// 表单提交时验证
			this.$element.submit(function(){
				// 申明返回
				var result = true;

				$(":text,:password,textarea",this.$element).each(function(){
					// 获取当前jQuery对象，不用每次都去调用转换
					var $this = $(this);
					// 获取验证类型
					var _validate = $this.attr("data-type");
					if(_validate){
						// 空格分割验证规则数组
						var arr = _validate.split(" ");
						for(var i=0;i<arr.length;i++){
							// 逐个验证，不通过返回false，通过则继续
							if(!_check(valider.settings,arr[i],$this.val())){
								$this.parent('div').addClass(valider.settings.css_error).removeClass(valider.settings.css_success);

								// 是否已存在提示标签
								var feed = $this.next('span.glyphicon');
								if(feed.length!=0){
									feed.removeClass('glyphicon-ok').addClass('glyphicon-remove')
								}
								else{
									$this.after(valider.settings.inner_error).parent('div').addClass(valider.settings.css_error);
								}
								result =false;
								return;
							}
							else{
								$this.parent('div').removeClass(valider.settings.css_error).addClass(valider.settings.css_success);

								// 是否已存在提示标签
								var feed = $this.next('span.glyphicon');
							
								if(feed.length!=0){
									feed.removeClass('glyphicon-remove').addClass('glyphicon-ok')
								}
								else{
									$this.after(valider.settings.inner_success).parent('div').addClass(valider.settings.css_success);
								}
								continue;
							}
						}
					}
				});
				
				return result;
			});
		},
		// 表单验证
		CheckForm:function(){
			var valider = this;
			
			// 申明返回
			var result = true;
			$(":text,:password,textarea",this.$element).each(function(){
				// 获取当前jQuery对象，不用每次都去调用转换
				var $this = $(this);
				// 获取验证类型
				var _validate = $this.attr("data-type");
				if(_validate){
					// 空格分割验证规则数组
					var arr = _validate.split(" ");
					for(var i=0;i<arr.length;i++){
						// 逐个验证，不通过返回false，通过则继续
						if(!_check(valider.settings,arr[i],$this.val())){
							$this.parent('div').addClass(valider.settings.css_error).removeClass(valider.settings.css_success);

							// 是否已存在提示标签
							var feed = $this.next('span.glyphicon');
							if(feed.length!=0){
								feed.removeClass('glyphicon-ok').addClass('glyphicon-remove')
							}
							else{
								$this.after(valider.settings.inner_error).parent('div').addClass(valider.settings.css_error);
							}
							result =false;
							return;
						}
						else{
							$this.parent('div').removeClass(valider.settings.css_error).addClass(valider.settings.css_success);

							// 是否已存在提示标签
							var feed = $this.next('span.glyphicon');
						
							if(feed.length!=0){
								feed.removeClass('glyphicon-remove').addClass('glyphicon-ok')
							}
							else{
								$this.after(valider.settings.inner_success).parent('div').addClass(valider.settings.css_success);
							}
							continue;
						}
					}
				}
			});
			
			return result;
		}
	};
	
	// 在插件中使用表单验证对象
	$.fn.FormValider = function(options){
		// 创建实体对象
		var _form = new FormValider(this,options);
		_form.OnBlur()
		return _form;
	};
})(jQuery);


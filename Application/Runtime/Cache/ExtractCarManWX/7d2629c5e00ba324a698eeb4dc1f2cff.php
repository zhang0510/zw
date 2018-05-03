<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6,user-scalable=no">
<title>车妥妥</title>
<!-- Bootstrap core CSS -->
<link href="/Public/ExtractWx/style/bootstrap.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="/Public/ExtractWx/style/style.css" rel="stylesheet" type="text/css">
<link href="/Public/ExtractWx/style/style480.css" rel="stylesheet" type="text/css">
<link href="/Public/ExtractWx/style/style320.css" rel="stylesheet" type="text/css">


<script src="/Public/ExtractWx/js/jquery-1.js"></script>
<script src="/Public/ExtractWx/js/bootstrap.js"></script>
<script src="/Public/ExtractWx/js/jquery.SuperSlide.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>

 <style>
 body,html{height:100%;width:100%;overflow:hidden;}
 
 </style>

<body>
<!--content-->
<div class="dengm">
 <div class="deng0">
   <div class="deng1">
   <!--  <h2><img src="images/wq4.png"></h2> -->
   </div>
   <div class="deng2" style="padding:0px;">
     <div class="deng2bo">
	  <div class="deng2b1">
	    <dl>
	    <dt>用户名</dt>
		<dd class="fh1">
			<input type="text" class="txt1" id="tel" onblur="checkTel()"/>
		</dd>
		</dl>
		<dl>
		<dt>输入验证码</dt>
		<dd>
		<input id="VCode" name="VCode" type="text" class="txt2" onblur="checkCode();"/>
		<span class="txt3">
		<img  onclick="verify_img()" src="/ExtractCarManWX/Weixin/verify_c" /></span></dd></dl>
		<dl>
		<dt>短信验证码</dt>
		<dd>
		<input type="text" id="SM_VCode" name="SM_VCode" class="txt2"/>
		<button class="txt6" type="button" id="SMbtn" onclick="sendMobileNote(this)">短信验证码</button>
		</dd>
		</dl>
		<div class="txt4"><input type="submit" value="登录" onclick="Login_Check()"/></div>
	 </div>
	   <div class="deng2b2">
	 </div>
	 </div>
   </div>
 </div>
</div>
<script>
function verify_img(){ 
	var captcha_img = $('.txt3').find('img'); 
	captcha_img.attr("src", '/ExtractCarManWX/Weixin/verify_c?random='+Math.random());
};

 var wait=60;
 function time(o) {
		if (wait == 0) {
			$(o).attr("disabled");           
			$(o).html("获取验证码");
			wait = 60;
		} else { 
			$(o).attr("disabled", true);
			$(o).html("重新发送(" + wait + ")");
			wait--;
			setTimeout(function() {
				time(o)
			},
			1000)
		}
	}
		
    //失焦验证验证码是否正确
	function checkCode(){
		var VCode = $('#VCode').val().trim();
		if(VCode!=""){
			$.post('/ExtractCarManWX/Weixin/verifyCode',{'VCode':VCode},function(data){
				if(!data.flag){
					alert("验证码错误");
					return false;
				}
			});
		}else{
			alert("验证码不能为空");	
			return false;
		}
	}
	//失焦验证手机号是否正确
	function checkTel(){
		var tel = $('#tel').val().trim();
		if(tel!=""){
			if(!$.check_Mobile(tel)){
				$.anewAlert("请输入正确的手机号");	
				return false;
			}else{
				$.post('/ExtractCarManWX/Weixin/verifyPhone',{'tel':tel},function(data){
					if(!data){
						$.anewAlert("对不起 你还不是注册用户");
						return false;
					}
					return true;
				})
			}
		}else{
			$.anewAlert("手机号不能为空");	
			return false;
		}
	}	
//短信发送
function sendMobileNote(obj){
   var tel = $("#tel").val().trim();
   if(tel!=""){
	   var VCode = $('#VCode').val().trim();
	   
		$.post('/ExtractCarManWX/Weixin/tel_SMS',{'tel':tel,VCode:VCode},function(data){
			if(data){
			   time(obj);
		   }else{
			   alert("验证码错误或短信发送失败!");
			   return false;
		   }
		});
	   
	}else{
		$.anewAlert("请输入手机号!");
	}
  
}	


//登录
function Login_Check(){
	var tel		 =$('#tel').val().trim();
	var VCode	 =$('#VCode').val().trim();
	var SM_VCode =$('#SM_VCode').val().trim();
	
	//验证手机号 check_Mobile  手机号暂时没有验证
	if(tel==""){
		$.anewAlert("请输入手机号");	
		return false;
	}
	//验证验证码
	if(VCode==""){
		$.anewAlert("请输入验证码");	
		return false;
	}
	//验证短信验证码
	if(SM_VCode==""){
		$.anewAlert("请输入短信验证码");	
		return false;
	}
	
	//提交
	$.post('/ExtractCarManWX/Weixin/loginUserWx',{'tel':tel,'VCode':VCode,'SM_VCode':SM_VCode},function(data){
		if(data.flag){
			window.location.href="/ExtractCarManWX/Weixin/memberInfo";
		}else{
			$.anewAlert(data.info);
			return false;
		}
	})
}
</script>
</body>
</html>
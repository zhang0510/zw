<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6,user-scalable=no">
<title>个人中心</title>
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
<body class="body1">
<script type="">

</script>

<!--content-->
<div class="wcenter0">
 <div class="wcenter01">
   <div class="wcentera">
  <h2><img src="<?php echo ($userInfo["headimgurl"]); ?>" style="max-width: 33%;"></h2>
   <p><?php echo ($member["car_name"]); ?></p>
   </div>
   <div class="wcenterb">
    <div  class="mm1 mm1a" data-url="/ExtractCarManWX/Order/waitExtractOrder/mark/TC">
	<a>
	 <h2>提车</h2>
	 <span></span>
	 </a>
	</div>
	<div  class="mm1 mm1a"  data-url="/ExtractCarManWX/Order/waitExtractOrder/mark/TD">
	<a >
	 <h2>提短</h2>
	 <span></span>
	 </a>
	</div>
    <div  class="mm1 mm1a" data-url="/ExtractCarManWX/Order/waitExtractOrder/mark/SC">
	<a >
	 <h2>送车</h2>
	 <span></span>
	 </a>
	</div>
	 <div  class="mm1 mm1b" data-url="/ExtractCarManWX/Order/waitExtractOrder/mark/LS">
	<a >
	 <h2>历史提车信息</h2>
	 <span></span>
	 </a>
	</div>
	
	 <!--
	 <div  class="mm1 mm1c">
	 onclick="WeixinJSBridge.call('closeWindow');" 
	 <a href="/ExtractCarManWX/Weixin/ceshi" >
	 <h2>测试</h2>
	 <span></span>
	 </a>
	</div>
	-->
   <div  class="mm1d">
	 <p>提示：如需要更改密码，微信联系管理员协助更改</p>
	</div>
   </div>
 </div>
</div>
 <script>
$(".mm1").click(function(){
	var url=$(this).attr("data-url");
	window.location.href=url;
})
</script>
</body>
</html>
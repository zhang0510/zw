<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6,user-scalable=no">
<title>车妥妥</title>
<!-- Bootstrap core CSS -->
<link href="style/bootstrap.css" rel="stylesheet" type="text/css">
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

 <style>
 body,html{height:100%;width:100%;overflow:hidden;}
 
 </style>

<body >





<!--content-->
<div class="dengm0">

 <div class="nnbb0">
    <div class="nnbb1">
	<h2><img src="<?php echo ($avatar); ?>"/></h2>
	<p><?php echo ($car_name); ?></p>
	</div>
	<form action="/ExtractCarManWX/Order/complete" method="post">
	<input type="hidden" name="yd_id" value="<?php echo ($yd_id); ?>"/>
	<div class="nnbb5"><button type="submit">确定用户提车</button></div>
	</form>
 
 </div>






</div>
  


<!--content-->

<!-- 留言框 -->


<!--footer-->

</body></html>
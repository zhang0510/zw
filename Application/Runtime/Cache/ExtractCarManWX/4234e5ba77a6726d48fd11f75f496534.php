<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6">
<title>验车详情</title>
<!-- Bootstrap core CSS -->
<link href="/Public/ExtractWx/style/bootstrap.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="/Public/ExtractWx/style/style.css" rel="stylesheet" type="text/css">

<link href="/Public/ExtractWx/style/style480.css" rel="stylesheet" type="text/css"/>
<link href="/Public/ExtractWx/style/style320.css" rel="stylesheet" type="text/css"/>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="__CUS__/js/jquery-1.js"></script>
<script src="__CUS__/js/bootstrap.js"></script>
<body>
<!--content-->

<div class="order_body1">
	<div class="order_main container">
		<div class="order_h2"><h2>验车详情</h2></div>
		<!-- <div class="order_navc">
			<ul>
				<li class="on">车钥匙：<?php echo ($list['verify_car_keys']); ?>把</li>
				<li>车辆当前公里数：<?php echo ($list['verify_km']); ?></li>
				<li>提车预计行驶公里数：<?php echo ($list['verify_predict_km']); ?></li>
			</ul>
		</div> -->
		<div class="dengm2">
			<div class="deng0">
					<!-- <div class="deng2e">
						<div class="rr5h">
							<dl><dt>行李工具备注：</dt><dd><p><?php echo ($list['verify_xingli']); ?></p><dd></dl>
						</div>
						<div class="rr5h">
							<dl><dt>车身外观：</dt><dd><p><?php echo ($list['verify_car_wai']); ?></p><dd></dl>
						</div>
						<div class="yyu1">
							<h2>验车照片</h2>
							<ul>
							 <?php if(is_array($imgs)): foreach($imgs as $key=>$vo): ?><li>
									<div class="xxz4"><img  style="height:200px;"  src="<?php echo ($vo['verify_img_upload']); ?>" id="hePic1"/></div>
								</li><?php endforeach; endif; ?>
							</ul>
						</div>
						<div class="rr5h">
							<dl><dt>备注：</dt><dd><p><?php echo ($list['verify_bei']); ?></p><dd></dl>
						</div>
						
					</div> -->
					
					<div class="deng2e">
			<div class="llp1">
				<!-- <div class="llp2">
					<h2>订单详情</h2>
				</div> -->
				<div class="llp10">
					<dl>
						<dd>车钥匙<span>&nbsp;</span></dd>
						<dt><?php echo ($list['verify_car_keys']); ?>把</dt>
					</dl>
					<dl>
						<dd>车辆当前公里数<span></span></dd>
						<dt><?php echo ($list['verify_km']); ?>KM</dt>
					</dl>
					<dl>
						<dd>提车预计行驶公里数<span></span></dd>
						<dt><?php echo ($list['verify_predict_km']); ?>KM</dt>
					</dl>
				</div>
			</div>
			<!-- <div class="rr5h">
				<dl><dt>行李工具备注：</dt><dd><textarea name="special"></textarea></dd></dl>
			</div>
			<div class="rr5h">
				<dl><dt>车身外观：</dt><dd><textarea name="special"></textarea></dd></dl>
			</div> -->
			<div class="yyu1">
				<div class="llp3">
					<h2>验车照片</h2>
				</div>
				<ul>
					<?php if(is_array($imgs)): foreach($imgs as $key=>$vo): ?><li>
									<div class="xxz4"><img  style="height:200px;"  src="<?php echo ($vo['verify_img_upload']); ?>" id="hePic1"/></div>
								</li><?php endforeach; endif; ?>
				</ul>
				
			</div>
		</div>
		<div class="llp4">
			<dl><dt>行李工具：</dt><dd><?php echo ($list['verify_xingli']); ?></dd></dl>
		</div>
		<div class="llp4">
			<dl><dt>车身外观：</dt><dd><?php echo ($list['verify_car_wai']); ?></dd></dl>
		</div>
		<div class="llp4">
			<dl><dt>备注：</dt><dd><?php echo ($list['verify_bei']); ?></dd></dl>
		</div>
		
	</div>
			</div>
		</div>
	</div>
</div>


<!--content-->
</body></html>
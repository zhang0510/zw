<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6">
<title>车妥妥</title>
<!-- Bootstrap core CSS -->
<link href="/Public/ExtractWx/style/bootstrap.css" rel="stylesheet" type="text/css">
<link href="/Public/ExtractWx/style/style.css" rel="stylesheet" type="text/css">
<link href="/Public/ExtractWx/style/style480.css" rel="stylesheet" type="text/css">
<link href="/Public/ExtractWx/style/style320.css" rel="stylesheet" type="text/css">
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="/Public/ExtractWx/js/jquery-1.js"></script>
<script src="/Public/ExtractWx/js/bootstrap.js"></script>
<script src="/Public/JS/Scroll.js"></script>

<body>


<!--content-->
<div class="order_body">
	<div class="order_main">	
		<div class="order_list" id="div_owlist0_id">
		 
		    <?php if(is_array($list)): foreach($list as $k=>$vo): ?><div class="order_lisa" name="div_owlist_<?php echo ($k); ?>">
				<div class="order_lisa1">
					<h2><a href="">订单号：<?php echo ($vo['order_code']); ?></a><span>类型：<?php echo ($vo['yd_type']); ?></span></h2>
				</div>
				<div class="asct">
					<div class="olist2">
						<p><strong>车型：</strong><?php echo ($vo['order_info_type']); ?></p>
						<p><strong>识别号：</strong><?php echo ($vo['order_info_carmark']); ?></p>
						<p><strong>备注：</strong><?php echo ($vo['yd_mark']); ?></p>
					</div>
				</div>
					<div class="asct ssss3">			         
						<!-- <a href="/ExtractCarManWX/Order/complete/yd_id/<?php echo ($vo['yd_id']); ?>"><button>确认完成</button></a> -->
				
						<a href="/ExtractCarManWX/Order/verifyImgs/order_code/<?php echo ($vo['order_code']); ?>"><h2>查看验车照片</h2></a>
			
				</div>
			</div><?php endforeach; endif; ?>
			<input type="hidden" id="size_id" value="<?php echo ($size); ?>" />
		</div>
	</div>
</div> 
<script>
	$("#mark_<?php echo ($mark); ?>").parent().addClass("on").siblings().removeClass("on");
	window.onscroll = function (){
		var sizes = $("#size_id").val();
		var divObj = $("div[name^='div_owlist_']");
		var size = divObj.size();
		if(parseInt(sizes)>size){
			var s = getScrollTop() + getClientHeight();
			var m = getScrollHeight()-2;
			if (m==s||m<s){
				setTimeout(3000);
				var size = size;
				$.post("/ExtractCarManWX/Order/waitExtAjax",{startnum:size,mark:'LS'},function(data){
						$("#div_owlist0_id").append(data);
				});
			}
		}
	}
</script>


<!--content-->

</body></html>
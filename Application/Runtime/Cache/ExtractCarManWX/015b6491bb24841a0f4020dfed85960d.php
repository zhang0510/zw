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
<script>
	$(document).ready(function(){
		//alert(location.href.split('#')[0]);
		var url = location.href.split('#')[0];
		$.post('/ExtractCarManWX/Order/getJsSign',{'url':url},function(data){
			if(data!=''){
				wx.config({
	    		    debug:false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
	    		    appId:data.appId, // 必填，公众号的唯一标识
	    		    timestamp:data.timestamp, // 必填，生成签名的时间戳
	    		    nonceStr:data.nonceStr, // 必填，生成签名的随机串
	    		    signature:data.signature,// 必填，签名，见附录1
	    		    jsApiList: [    // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	    		                   // 'checkJsApi',
	    		                    'getLocation'
	    		                    //'chooseImage',
	    		                    //'uploadImage',
	    		                    //'downloadImage'

	    					   ]

			});
			}
		});
		
	})

</script>

<body>

<!--content-->
<div class="order_body">
	<div class="order_main">	
		<div class="order_list" id="div_owlist0_id">
		    <?php if(is_array($list)): foreach($list as $k=>$vo): ?><div class="order_lisa hjh" name="div_owlist_<?php echo ($k); ?>">
				<div class="order_lisa1">
					<h2>订单号：<?php echo ($vo['order_code']); ?></h2>
				</div>
				<div class="order_lisa2">
					<div class="olist2">
						<p><strong>车型：</strong><?php echo ($vo['order_info_type']); ?></p>
						<p><strong>识别号：</strong><?php echo ($vo['order_info_carmark']); ?></p>
						<p><strong>联系人：</strong>发车人：<?php echo ($vo['faName']); ?> <?php if($vo['faPhone'] != '-'): ?>+ <a tel="<?php echo ($vo['faPhone']); ?>"><?php echo ($vo['faPhone']); ?></a><?php endif; ?></p>
						<p><strong>提车地址：</strong><?php echo ($vo['address']); ?></p>
					</div>
					<div class="fraka2">
							<a class="sfwgwe" data-code="<?php echo ($vo['order_code']); ?>" data-id="<?php echo ($vo['yd_id']); ?>"  ><img src="/Public/ExtractWx/images/pp2.jpg"></a>
					</div>
				</div>
			</div><?php endforeach; endif; ?>
		</div>
	    <input type="hidden" id="size_id" value="<?php echo ($size); ?>" />
	</div>
</div> 
<script>
	$("#mark_<?php echo ($mark); ?>").parent().addClass("on").siblings().removeClass("on");
	
	$(".sfwgwe").click(function(){
		var code = $(this).attr("data-code");
		var id = $(this).attr("data-id");
		wx.getLocation({
		    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
		    success: function (res) {
		        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
		        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
		        var speed = res.speed; // 速度，以米/每秒计
		        var accuracy = res.accuracy; // 位置精度
		        $.post("/ExtractCarManWX/Order/addPosition",{lat:latitude,lon:longitude},function(data){
		        	window.location.href="/ExtractCarManWX/Order/verify/order_code/"+code+"/yd_id/"+id;
		        	/* 
		        	href=""
		        	*/
		        });
		    }
		});
		window.location.href="/ExtractCarManWX/Order/verify/order_code/"+code+"/yd_id/"+id;
	});
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
				$.post("/ExtractCarManWX/Order/waitExtAjax",{startnum:size,mark:'TC'},function(data){
						$("#div_owlist0_id").append(data);
				});
			}
		}
	}
</script>


<!--content-->

</body></html>
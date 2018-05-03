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

<!-- <div class="wxnav">
<a class="get1" href="javascript:;"><</a>
<h2>送车</h2>
</div> -->

<!--content-->
<div class="order_body">
	<div class="order_main">	
		<div class="order_list" id="div_owlist0_id">
		<?php if(is_array($list)): foreach($list as $k=>$vo): ?><div class="order_lisa  poo1" name="div_owlist_<?php echo ($k); ?>">
			 
				<div class="order_lisa1">
					<h2><a href="">订单号：<?php echo ($vo['order_code']); ?></a></h2>
				</div>
				<div class="poo2">
				<div class="asct fraka2">
					<div class="order_lisa2">
						<div class="olist2">
							<p><strong>车型：</strong><?php echo ($vo['order_info_type']); ?></p>
							<p><strong>识别号：</strong><?php echo ($vo['order_info_carmark']); ?></p>
						</div>
					</div>
				
				</div>
				<div class="asct">
					<div class="olist2">
						<p><strong>联系人：</strong><?php echo ($vo['faName']); ?>+<a tel="<?php echo ($vo['faPhone']); ?>"><?php echo ($vo['faPhone']); ?></a></p>
						<p class="tuu">提示：确认车辆信息无误，验车无误以后，方可提走车辆。</p>
					</div>
				
				</div>
					<div class="fraka3">
						<button><a class="sfwgwe" data-id="<?php echo ($vo['yd_id']); ?>" >确认送车</a></button>
					</div>
				</div>
				<div class="poo3">
				<div class="asct">
					<div class="olist2">
						<p><strong>收车人姓名：</strong><?php echo ($vo['recInfo'][0]); ?></p>
						<p><strong>电话：</strong><?php echo ($vo['recInfo'][1]); ?></p>
						<p><strong>身份证号：</strong><?php echo ($vo['recInfo'][2]); ?></p>
						<p><strong>代收运费：</strong><?php echo ($vo['all_price']/100); ?>元</p>
					</div>
				</div>
					<div class="fraka3">
						<a href="/ExtractCarManWX/Order/verifyImgs/order_code/<?php echo ($vo['order_code']); ?>"><h2>查看验车照片</h2></a>
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
		var id = $(this).attr("data-id");
		wx.getLocation({
		    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
		    success: function (res) {
		        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
		        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
		        var speed = res.speed; // 速度，以米/每秒计
		        var accuracy = res.accuracy; // 位置精度
		        $.post("/ExtractCarManWX/Order/addPosition",{lat:latitude,lon:longitude},function(data){
		        	window.location.href="/ExtractCarManWX/Order/complete/yd_id/"+id;
		        	/* 
		        	href=""
		        	*/
		        });
		    }
		});
		window.location.href="/ExtractCarManWX/Order/complete/yd_id/"+id;
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
				$.post("/ExtractCarManWX/Order/waitExtAjax",{startnum:size,mark:'SC'},function(data){
						$("#div_owlist0_id").append(data);
				});
			}
		}
	}
</script>


<!--content-->

</body></html>
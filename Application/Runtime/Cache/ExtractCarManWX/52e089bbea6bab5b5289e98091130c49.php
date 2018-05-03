<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6">
<title>拍照验车</title>
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
<!-- <link href="style/animate.min.css" rel="stylesheet" type="text/css"> -->


<script src="/Public/ExtractWx/js/jquery-1.js"></script>
<script src="/Public/ExtractWx/js/bootstrap.js"></script>
<script src="/Public/JS/jquery.Huploadify.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		//alert(location.href.split('#')[0])
		var url = location.href.split('#')[0];
		$.post('/ExtractCarManWX/Order/getJsSign',{'url':url},function(data){
			//alert(JSON.stringify(data));
			if(data!=''){
				wx.config({
	    		    debug:false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
	    		    appId:data.appId, // 必填，公众号的唯一标识
	    		    timestamp:data.timestamp, // 必填，生成签名的时间戳
	    		    nonceStr:data.nonceStr, // 必填，生成签名的随机串
	    		    signature:data.signature,// 必填，签名，见附录1
	    		    jsApiList: [    // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	    		                    //'checkJsApi',
	    		                    //'getLocation',
	    		                    'chooseImage',
	    		                    'uploadImage',
	    		                    'downloadImage'

	    					   ]

			});
			}
		})
	})

</script>

<body>

<!-- <div class="wxnav">
<a href="/ExtractCarManWX/Order/waitExtractOrder/mark/N" class="get1">&lt;</a>
<h2>拍照验车</h2>

</div> -->
 <!--
<img id="img" src="http://www.thinkphp.cn/Public/new/img/header_logo.png" width="130" height="130" border="0" />
<input id="file_upload" name="file_upload" type="file" multiple="true" value="" />

<img id="img2" src="http://www.thinkphp.cn/Public/new/img/header_logo.png" width="130" height="130" border="0" />
<input id="file_upload2" name="file_upload2" type="file" multiple="true" value="" />
 -->
<!--content-->
<div class="dengm2">
	<div class="deng0">
	
	<form action="/ExtractCarManWX/Order/geVerifyInfo" method="post">
	    <input name="order_code" value="<?php echo ($order_code); ?>" type="hidden"/>
		<input name="yd_id" value="<?php echo ($yd_id); ?>" type="hidden"/>
		<div class="deng2e">
			<div class="llp1">
				<div class="llp2">
					<h2>订单详情</h2>
				</div>
				<div class="llp10">
					<dl>
						<dd>车钥匙<span>&nbsp;</span></dd>
						<dt><input class="dsdt" name="verify_car_keys" type="text" id="head"/>把</dt>
					</dl>
					<dl>
						<dd>车辆当前公里数<span>*</span></dd>
						<dt><input class="dsdt" name="verify_km" type="text" id="verify_km" value=""/>KM</dt>
					</dl>
					<dl>
						<dd>提车预计行驶公里数<span>*</span></dd>
						<dt><input class="dsdt" name="verify_predict_km" type="text" id="verify_predict_km" value=""/>KM</dt>
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
					<h2>拍照验车</h2>
				</div>
				<ul>
					<li id="moreee" name="otherPic">
						<div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd9.png" /></div>
						<div class="xxz0" id="oPic">
							<div class="xxz1">
								<div class="xxz2">
									<img src="/Public/ExtractWx/images/pl2.png"/>
									<p class="poo1">更多照片</p>
								</div>
							</div>
						</div>
					</li>
				</ul>
				
			</div>
		</div>
		<div class="llp4">
			<dl><dt>行李工具：</dt><dd><textarea name="verify_xingli"></textarea></dd></dl>
		</div>
		<div class="llp4">
			<dl><dt>车身外观：</dt><dd><textarea name="verify_car_wai"></textarea></dd></dl>
		</div>
		<div class="llp4">
			<dl><dt>备注：</dt><dd><textarea name="verify_bei"></textarea></dd></dl>
		</div>
		<div class="ee8"><button type="submit" onclick="return sub()">完成验车</button></div>
	</div>
	</form>
</div>



<!--content-->



  <script>
  function sub(){
	  var verify_km=$("#verify_km").val();
	  var verify_predict_km=$("#verify_predict_km").val();
	  if(verify_km==''||verify_km==null){
		  $.anewAlert("车辆当前公里数不能用空");	
		  return false;
	  }
	  if(verify_predict_km==''||verify_predict_km==null){
		  $.anewAlert("提车预计行驶公里数不能为空");	
		  return false;
	  }
  }
  $(".xxz0").click(function(){
		wx.chooseImage({
		    count: 1, // 默认9
		    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
		    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
		    success: function (res) {
		        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
	  		    wx.uploadImage({
	  		    	localId: localIds.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得
	  	  		    isShowProgressTips: 1, // 默认为1，显示进度提示
	  	  		    success: function (res) {
	  	  		        var serverId = res.serverId; // 返回图片的服务器端ID
	  	  		    	if(serverId!=''){
		  	    			$.post('/ExtractCarManWX/Order/gePic',{'pic':serverId},function(data){
		  	    				if(data!=''||data!=null){
		  	    						var xmlss= '<li name="otherPic"><div class="xxz4"><img style="height:200px;"     src="'+data+'"/><input type="hidden" value="'+data+'" name="imgs[]"/></div></li>';
		  	    						$("#moreee").before(xmlss);
		  	    					
		  	    				}
		  	    			})
	  	    			}
	  	  		    }
	  	  		});
		    }
		});
	})

  $(".inko").click(function(){
  $(this).siblings(".selected").show();

  });
   $(".selected li").click(function(){
  $(this).parent().parent().hide();
   var oop= $(this).html();
  $(this).parent().parent().siblings('.inko').val(oop);

  });
  $(".ee32a li").click(function(){

  $(this).addClass("on").siblings().removeClass('on');
  });
  $(".ee71 span").click(function(){
  if($(this).hasClass('on')){
  $(this).removeClass('on');
  }else{
  $(this).addClass("on");
  }

  });


  /* $(function(){
		var up = $('#up_head').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:1,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#head_pic").val(datas.fileurl);
					$("#hePic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#hePic").click(function(){
			$("#file_upload_1-button").click();
		});

	});

  $(function(){
		var up1 = $('#up_left').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:2,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#left_pic").val(datas.fileurl);
					$("#lePic1").attr('src',datas.fileurl);
				}else{
					$.anewAlert(datas.msg);
				}
			},
		});
		$("#lePic").click(function(){
			$("#file_upload_2-button").click();
		});

	});

  $(function(){
		var up2 = $('#up_right').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:3,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#right_pic").val(datas.fileurl);
					$("#rePic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#rePic").click(function(){
			$("#file_upload_3-button").click();
		});

	});

  $(function(){
		var up3 = $('#up_top').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:4,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#top_pic").val(datas.fileurl);
					$("#toPic1").attr('src',datas.fileurl);
				}else{
					$.anewAlert(datas.msg);
				}
			},
		});
		$("#toPic").click(function(){
			$("#file_upload_4-button").click();
		});

	});

  $(function(){
		var up4 = $('#up_tail').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:5,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#tail_pic").val(datas.fileurl);
					$("#taPic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#taPic").click(function(){
			$("#file_upload_5-button").click();
		});

	});

  $(function(){
		var up5 = $('#up_spare').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:6,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#spare_pic").val(datas.fileurl);
					$("#baPic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#baPic").click(function(){
			$("#file_upload_6-button").click();
		});

	});

  $(function(){
		var up6 = $('#up_inside').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:7,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#inside_pic").val(datas.fileurl);
					$("#inPic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#inPic").click(function(){
			$("#file_upload_7-button").click();
		});

	});

  $(function(){
		var up7 = $('#up_other').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.gif;*.png;*.jpeg',
			multi:false,
			fileSizeLimit:1024*1024*100,
			showUploadedPercent:false,
			showUploadedSize:false,
			removeTimeout:1000,
			abs:8,//隐藏按钮序号
			uploader:'<?php echo U("Base/upload");?>',//上传方法路径
			canshu:'OPINION',//特征值:用于进行上传限制
			onUploadStart:function(file){
				console.log(file.name+'开始上传');
			},
			onInit:function(obj){
				console.log('初始化');
				console.log(obj);
			},
			onUploadComplete:function(file,data){
				var datas = $.parseJSON(data);
				if(datas.flag){
					$("#other_pic").val(datas.fileurl);
					var sizes = $("li[name='guacha']").size();
					var title = "刮擦部位"+(sizes+1);
					var xmlss= '<li name="guacha"><div class="xxz4"><img src="'+datas.fileurl+'" id="inPic1"/></div><div class="xxz3"></div><div class="xxz0" id="inPic"><div class="xxz1"><div class="xxz2"><img src="images/pgd8.png"/><p>'+title+'</p></div></div></div></li>';
					$("#moreee").before(xmlss);
					var path = $("#guachatu").val();
					 path = path+";"+datas.fileurl;
					 $("#guachatu").val(path);
					//$("#oPic1").attr('src',datas.fileurl);
				}else{
					alert(datas.msg);
				}
			},
		});
		$("#oPic").click(function(){
			$("#file_upload_8-button").click();
		});

	}); */


  </script>
<!--footer-->

</body></html>
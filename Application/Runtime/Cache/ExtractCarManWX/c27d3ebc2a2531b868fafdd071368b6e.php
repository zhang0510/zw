<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6">
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

<link href="/Public/ExtractWx/style/style480.css" rel="stylesheet" type="text/css"/>
<link href="/Public/ExtractWx/style/style320.css" rel="stylesheet" type="text/css"/>
<!-- <link href="/Public/ExtractWx/style/animate.min.css" rel="stylesheet" type="text/css"> -->


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
	    		                    //'getLocation'
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

<div class="wxnav">
<a href="/ExtractCarManWX/Order/waitExtractOrder/mark/N" class="get1">&lt;</a>
<h2>拍照验车</h2>

</div>
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
   <div class="deng2e">



<div class="llp1">
	 <h2>车辆交接内容</h2>
 <div class="llp10">
  <dl>
  <dd>车钥匙：</dd>
  <dt><input class="dsdt" name="key" type="text" id="head"/>把</dt>
   <dd>公里数：</dd>
  <dt><input class="dsdt" name="km" type="text" id="km"/>KM</dt>
  </dl>
    <dl><dd>备 胎：</dd>
  <dt><input class="dsdt" name="backup" type="text" id="backup"/>个</dt>
<dd>说明书：</dd>
  <dt><input class="dsdt" name="instru" type="text" id="instru"/>本</dt>
  </dl>
    <dl><dd>工具包：</dd>
  <dt><input class="dsdt" name="tool" type="text" id="tool"/>个</dt>
  <dd>警示牌：</dd>
  <dt><input class="dsdt" name="notice" type="text" id="notice"/>个</dt>
  </dl>
     <dl><dd>千斤顶：</dd>
  <dt><input class="dsdt" name="jack" type="text" id="jack"/>个</dt>
   <dd>点烟器：</dd>
  <dt><input class="dsdt" name="lighter" type="text" id="lighter"/>个</dt>
  </dl>
     <dl><dd>脚垫：</dd>
  <dt><input class="dsdt" name="footpad" type="text" id="footpad"/>个</dt>
   <dd>灭火器：</dd>
  <dt><input class="dsdt" name="firee" type="text" id="firee"/>个</dt>
  </dl>

 </div>


   </div>

   <div class="yyu1">
      <h2>拍照验车</h2>

    <ul>
	 <li>
	   <div class="xxz4"><img  style="height:200px;"  src="/Public/ExtractWx/images/pgd1.png" id="hePic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="hePic">
	      <div class="xxz1">

		  <div class="xxz2" >
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>车头、引擎盖</p>
		  </div>

		  </div>

	   </div>
	 </li>
		 <li>
	   <div class="xxz4"><img style="height:200px;"    src="/Public/ExtractWx/images/pgd2.png" id="lePic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="lePic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>左侧</p>
		  </div>
		  </div>

	   </div>
	 </li>
	 	 <li>
	   <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd3.png" id="rePic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="rePic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>右侧</p>
		  </div>
		  </div>

	   </div>
	 </li>
	 	 <li>
	   <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd4.png" id="toPic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="toPic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>车顶</p>
		  </div>
		  </div>

	   </div>
	 </li>
	 	 <li>
	   <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd5.png" id="taPic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="taPic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>车尾</p>
		  </div>
		  </div>

	   </div>
	 </li>
	 	 <li>
	   <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd6.png" id="baPic1"/></div>
	   <div class="xxz3"></div>
	   <div class="xxz0" id="baPic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>后备箱</p>
		  </div>
		  </div>

	   </div>
	 </li>
	 <li>
	    <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd7.png" id="inPic1"/> </div>
		<div class="xxz3"></div>
	   <div class="xxz0" id="inPic">
	      <div class="xxz1">

		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pgd8.png"/>
		   <p>车内行李</p>
		  </div>
		  </div>

	   </div>
	 </li>

	<li id="moreee" name="otherPic">
	   <div class="xxz4"><img style="height:200px;"   src="/Public/ExtractWx/images/pgd9.png" /></div>
	   <div class="xxz0" id="oPic">
	      <div class="xxz1">
		  <div class="xxz2">
		   <img src="/Public/ExtractWx/images/pl2.png"/>
		   <p class="poo1">更多照片<br>（刮擦部位）</p>
		  </div>
		  </div>

	   </div>
	 </li>






	</ul>


   <div id="up_head" style="display:none;"></div>
   <div id="up_left" style="display:none;"></div>
   <div id="up_right" style="display:none;"></div>
   <div id="up_top" style="display:none;"></div>
   <div id="up_tail" style="display:none;"></div>
   <div id="up_inside" style="display:none;"></div>
   <div id="up_spare" style="display:none;"></div>
   <div id="up_other" style="display:none;"></div>









      </div>

   <div class="rr41">
			 <h2 class="rra1">文字描述（无异常可不填写）</h2>
		  <div class="rr41a">
		  <dl><dt>车头、引擎盖</dt><dd><input type="text" name="head" placeholder="" class="rry1"/></dd></dl>
		  <dl><dt>车辆左侧</dt><dd><input type="text" name="left" placeholder="" class="rry1"/></dd></dl>
		  <dl><dt>车辆右侧</dt><dd><input type="text" name="right" placeholder="" class="rry1" style="width:50%;"/></dd></dl>
		  <dl><dt>车顶</dt><dd><input type="text" name="top" placeholder="" class="rry1"/></dd></dl>
		  <dl><dt>车尾</dt><dd><input type="text" name="tail" placeholder="" class="rry1"/></dd></dl>
		  <dl><dt>车内行李</dt><dd><input type="text" name="inside" placeholder="" class="rry1" style="width:50%;"/></dd></dl>
		   <dl><dt>后备箱</dt><dd><input type="text" name="spare" placeholder="" class="rry1" style="width:50%;"/></dd></dl>
		  </div>
		  <input type="hidden" id="hePics" name='head_pic' value=""/>
		  <input type="hidden" id="lePics" name='left_pic' value=""/>
		  <input type="hidden" id="rePics" name='right_pic' value=""/>
		  <input type="hidden" id="toPics" name='top_pic' value=""/>
		  <input type="hidden" id="taPics" name='tail_pic' value=""/>
		  <input type="hidden" id="inPics" name='inside_pic' value=""/>
		  <input type="hidden" id="baPics" name='spare_pic' value=""/>
		  <!-- <input type="hidden" id="other_pic" name='other_pic' value=""/> -->
		  <input type="hidden"  name='other_pic' id="oPics" value="<?php echo ($guachatu); ?>"/>
		  <input type="hidden"  name='ordercode' value="<?php echo ($orderCode); ?>"/>



	</div>
 </div>
 <div class="rr5h">
		  <dl><dt>特别说明</dt><dd><textarea name="special"></textarea></dd></dl>




		  </div>

 <div class="ee8"><button type="submit">完成验车</button></div>
   </div>
   </form>
 </div>
</div>



<!--content-->



  <script>

  $(".xxz0").click(function(){
		var sign = $(this).attr('id');
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
		  	    					if(sign!='hePic'&&sign!='lePic'&&sign!='rePic'&&sign!='toPic'&&sign!='taPic'&&sign!='inPic'&&sign!='baPic'){
		  	    						var content = $('#oPics').val();
		  	    						var sizes = $("li[name='otherPic']").size();
		  	    						//var imgsize = $("img[id^='inPic1_']").size();
		  	    						var title = "刮擦部位"+(sizes);
		  	    						var sizes = parseInt(sizes) - 1;
		  	    						var xmlss= '<li name="otherPic"><div class="xxz4"><img style="height:200px;"     src="'+data+'"/></div><div class="xxz3"></div><div class="xxz0" id="oPic'+sizes+'"><div class="xxz1"><div class="xxz2"><img src="/Public/ExtractWx/images/pl2.png"/><p>'+title+'</p></div></div></div></li>';

		  	    						/* <li id="moreee" name="otherPic"><div class="xxz4"><img src="/Public/ExtractWx/images/pgd9.png" /></div><div class="xxz0" id="oPic"><div class="xxz1"><div class="xxz2"><img src="/Public/ExtractWx/images/pl2.png"/><p class="poo1">更多照片<br>（刮擦部位）</p></div>






		  	    						  </div>

		  	    					   </div>
		  	    					 </li> */

		  	    						$("#moreee").before(xmlss);
		  	    						$('#oPics').val(content+';'+data);
		  	    						//$('#'+sign).find('img').attr('src',data);
		  	    					}else{
		  	    						$('#'+sign).siblings('.xxz4').find('img').attr('src',data);
			  	    					$('#'+sign+'s').val(data);
		  	    					}
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
					var xmlss= '<li name="guacha"><div class="xxz4"><img src="'+datas.fileurl+'" id="inPic1"/></div><div class="xxz3"></div><div class="xxz0" id="inPic"><div class="xxz1"><div class="xxz2"><img src="/Public/ExtractWx/images/pgd8.png"/><p>'+title+'</p></div></div></div></li>';
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
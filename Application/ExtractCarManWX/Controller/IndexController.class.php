<?php
namespace ExtractCarManWX\Controller;
use Think\Controller;
class IndexController extends Controller {

	/**
	 * 入口
	 */
	public function index(){
		//echo 12313123;die();
		//print_log("-------------------进入验证");
		$echoStr = I("echostr");
		$signature = I("signature");
		$timestamp = I("timestamp");
		$nonce = I("nonce");
		//print_log("  echoStr:".$echoStr."|nonce:".$nonce."|timestamp:".$timestamp."|signature:".$signature);
		if($this->checkSignature($signature,$timestamp,$nonce)){
			//print_log('  打印随机数:'.$echoStr);
			echo $echoStr;
			exit;
		}else{
			//print_log("-----点击事件被触发此处-----");
			$this->responseMsg();
		}
	}
	
	/**
	 * 接入验证签名
	 * @param string $signature
	 * @param string $timestamp
	 * @param string $nonce
	 * @return boolean
	 */
	private function checkSignature($signature="",$timestamp="",$nonce=""){
		$token = C('WXTOKEN');
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		//print_log("参与签名数据:".implode( $tmpArr ));
		//print_log("签名数据:".$tmpStr);
		//print_log("前面验证".$tmpStr."-------------".$signature);
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 接收相应数据
	 */
	function responseMsg(){
		$wxObj = A("Login");
		//接收微新传过来的xml消息数据
		print_log("返回信息:".json_encode($GLOBALS));
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		print_log("responseMsg方法接收XML：".$postStr);
		if (!empty($postStr)){
			//将接收的消息处理返回一个对象
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			//从消息对象中获取消息的类型 text  image location voice vodeo link
			$RX_TYPE =  strtolower(trim($postObj->MsgType));
			//消息类型分离, 通过RX_TYPE类型作为判断， 每个方法都需要将对象$postObj传入
			switch ($RX_TYPE){
				case "text":
					print_log("接受类型------------------------".$RX_TYPE);
					//$result =  self::getText($postObj);
					//$result = $this->receiveText($postObj);     //接收文本消息
					break;
				case "image":
					print_log("接受类型------------------------".$RX_TYPE);
					//$result = $this->receiveImage($postObj);   //接收图片消息
					break;
				case "location":
					print_log("接受类型------------------------".$RX_TYPE);
					//$this->receiveLocation($postObj);  //接收位置消息
					break;
				case "voice":
					print_log("接受类型------------------------".$RX_TYPE);
					//$result = $this->receiveVoice($postObj);   //接收语音消息
					break;
				case "video":
					print_log("接受类型------------------------".$RX_TYPE);
					//$result = $this->receiveVideo($postObj);  //接收视频消息
					break;
				case "link":
					print_log("接受类型------------------------".$RX_TYPE);
					//$result = $this->receiveLink($postObj);  //接收链接消息
					break;
				case "event":
					print_log("接受类型------------------------".$RX_TYPE);
					print_log("EventKey------------------------".$postObj->EventKey);
					$result =  $this->getEventReturn($postObj);//关注/取消
					break;
				default:
					print_log("接受类型------------------------".$RX_TYPE);
					$result = 0;//"unknown msg type: ".$RX_TYPE;   //未知的消息类型
					break;
			}
			//将响应的消息再次写入日志， 使用T标记响应的消息！
			//print_log("  T \n".$result);
			//输出消息给微新
			echo $result;
		}else {
			//如果没有消息则输出空，并退出
			echo "";
			exit;
		}
	}
	
	/*
	 * 接收文本类型
	 */
	public function getText($postObj){
		print_log("文本的内容都到这里接收-----------------------".$postObj->Content);
		//$wxair = A('Airlines');
		//$result = $wxair->wx_sent($postObj);
		return null;
	}
	
	/**
	 * 设置菜单
	 */
	function setMenu(){
		//课程
        //$url_k = urlencode(C('REQUEST_PATH')."/ExtractCarManWX/Login/logins"); 
        $url_test = C('REQUEST_PATH')."/ExtractCarManWX/Test/upload";
		//$url_k = C('REQUEST_PATH')."/ExtractCarManWX/Login/logins";
        //print_log("菜单设置URL:".$url_k);
        //$appid = C("APPID");
        //print_log("菜单设置APPID:".$appid);
        
        //$redirect_uri=urlencode(C("REQUEST_PATH")."/ExtractCarManWX/Weixin/weixin");
        //$httpurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
        //$urls = sprintf($httpurl,$appid,$redirect_uri);
        //print_log("菜单地址：".$urls);
        $lwturl5 = $this->getAuthUrl('/ExtractCarManWX/Weixin/weixin');//网站定制
        print_log("菜单地址：".$lwturl5);
        $jsonmenu = '
        {
        	"button":[
	        	{
	        		"type":"click",
	        		"name":"如何验车",
        			"key":"V1001_TODAY_MUSIC"
	        	},
	        	{
	        		"type":"view",
	          		"name":"我要提车",
          			"url":"'.$lwturl5.'"
	        	}
        	]
        }';
		print_log("请求地址：".$jsonmenu);
		$access_token = get_token(C('APPID'),C('SECRET'));
		$menuurl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$result = https_request($menuurl, $jsonmenu);
		$retArr = json_decode($result,true);
		dump($retArr);
		if($retArr['errcode']==0){
			echo "菜单生成成功";
		}else{
			echo "菜单生成失败:".$retArr['errmsg'];
		}
	}
	
	/**
	 * 获取要授权页面的url
	 * $str格式'/模块名/控制器名/方法名';
	 * @param unknown $str
	 * @return string
	 */
	function getAuthUrl($str,$state = "STATE"){
		print_log("----------------------------------------------".$state);
		$domain = C('REQUEST_PATH');
		$url = $domain.$str;
		$encodeUrl = urlencode($url);
		$appid = C("APPID");
		$httpurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state='.$state.'#wechat_redirect';
		$outputUrl = sprintf($httpurl,$appid,$encodeUrl);
		print_log("----------------------------------------------url:".$appid);
		print_log("----------------------------------------------".$domain);
		return $outputUrl;
	}
	/**
	 * 菜单事件回复
	 * @param string $eventType
	 * @param string $mark
	 */
	function getEventReturn($postObj=null){
		print_log("进入自动回复内容");
		$lObj = D("Login");
		$vo = $lObj->eventReturn();
		$mark = $postObj->EventKey;
		$openid = $postObj->FromUserName;
		$fromUser = $postObj->ToUserName;
		$time = time();
		$title1 = $vo['title'];
		$picurl="http://www.tuotuoyunche.com".$vo['picurl'];
		$url=C('REQUEST_PATH')."/ExtractCarManWX/Index/gotocaozuo";//$vo['urlpath'];
		$description1 = "如何通过微信公众号快捷提车、验车、收车？";
		$xml="http://www.baidu.com";
		if($mark=="V1001_TODAY_MUSIC"){
		    
			$xml = '<xml>
					<ToUserName><![CDATA['.$openid.']]></ToUserName>
					<FromUserName><![CDATA['.$fromUser.']]></FromUserName>
					<CreateTime>'.$time.'</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>1</ArticleCount>
					<Articles>
						<item>
							<Title><![CDATA['.$title1.']]></Title> 
							<Description><![CDATA['.$description1.']]></Description>
							<PicUrl><![CDATA['.$picurl.']]></PicUrl>
							<Url><![CDATA['.$url.']]></Url>
						</item>
					</Articles>
					</xml>';
		 }
		print_log("打印回复xml内容：".$xml);
		return $xml;
	}
	/**
	 * 微信分享
	 */
	function wxJssdkAjax(){
		$url = I("url");
		print_log("url:".$url);
		$data = $this->wx_joinupJS_SDK($url);
		$this->ajaxReturn($data);
	}
	
	/**
	 * 获取接入JS-SDK初始化参数
	 * @param string $url
	 */
	function wx_joinupJS_SDK($url=''){
		$appid=C("APPID");   //appid
		$secret=C("SECRET");   //appid
		if($url!=""){
			$appId = C("APPID");
			$timestamp = time();
	
			$nonceStr = S("nonceStr");
			if($nonceStr=="" || $nonceStr==""){
				$nonceStr = create_random_code(8);
				S("nonceStr",$nonceStr,'7000');
			}
			$access_token = "";
			$arr = fileRead('access_token.json');
			$times = time();
			if($times<$arr['expire_time']){
				$access_token = $arr['access_token'];
			}else{
				$access_token = get_token($appid,$secret);
			}
			$jsticket = $this->wx_jsapiticket();
			$signature = $this->wx_jsSDKsign($jsticket,$timestamp,$nonceStr,$url);
			$data['appId'] = $appId;
			$data['timestamp'] = $timestamp;
			$data['nonceStr'] = $nonceStr;
			$data['signature'] = $signature;
			$data['err'] = 0;
			$data['jsticket'] = $jsticket;
			$data['access_token'] = $access_token;
			S(md5(strtolower($url)),$data,'7000');
			print_log("接入JS-SDK初始化参数-----------:".json_encode($data));
			return $data;
		}else{
			print_log("接入JS-SDK初始化参数url不能为空!");
			$data['err'] = 1;
			$data['errmsg'] = '接入JS-SDK初始化参数url不能为空';
			return $data;
		}
	}
	/**
	 * 获取jsapi的ticket
	 */
	function wx_jsapiticket(){
		$appid=C("APPID");   //appid
		$secret=C("SECRET");   //appid
		$ticket = S("jsapiticket");
		if($ticket == "" || $ticket == null){
			$acctoken = "";
			$arr = fileRead('access_token.json');
			$times = time();
			if($times<$arr['expire_time']){
				$acctoken = $arr['access_token'];
			}else{
				$acctoken = get_token($appid,$secret);
			}
			$url= "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi";
			$url = sprintf($url,$acctoken);
			$ret = https_request($url);
			$ret = json_decode($ret, true);
			S("jsapiticket",$ret['ticket'],'7000');
			$ticket = $ret['ticket'];
		}
		return $ticket;
	}
	/**
	 * JS-SDK接入，签名
	 * @param string $ticket
	 * @param string $timestamp
	 * @param string $nonceStr
	 * @param string $url
	 * @return string
	 */
	function wx_jsSDKsign($ticket="",$timestamp="",$nonceStr="",$url=""){
		$table_change = array('amp;'=>'');
		$signature = "";
		if($url!=""&&$ticket!=""&&$timestamp!=""&&$nonceStr!=""){
			$url = strtr($url,$table_change);
			$data = "jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s";
			$data = sprintf($data,$ticket,$nonceStr,$timestamp,$url);
			print_log("js-sdk签名参数：".$data);
			$signature = sha1($data);
			print_log("JS-SDK接入，签22222名:".$signature);
		}
		//print_log("JS-SDK接入，签11111名:".$signature);
		return $signature;
	}
	function gotocaozuo(){
	    $lObj = D("Login");
	    $vo = $lObj->eventReturn();
	    $content=$vo['content'];
	    $this->assign("content",$content);
		$this->display("ddd:caozuo");
	}

}
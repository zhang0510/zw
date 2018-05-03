<?php
namespace ExtractCarManWX\Controller;

class OrderController extends BaseController {
    
    
    /**
     * 查询 提车/提短 历史记录
     */
	function waitExtractOrder(){
		$openid = session("openid")==""?session("userdata")['openid']:session("openid");
		print_log("获取数据待提车数据：".$openid);
		$startnum = I("startnum")==""?0:I("startnum");
		$mark = I("mark");
		print_log("-------".$mark);
		$weoObj = D("Order");
		//'oWRN6wRF39W8YDplPiglS0ZkO3L0'
		$data = $weoObj->waitExtractOrder($openid,$mark,$startnum);
		$this->assign("list",$data['list']);
		$this->assign("size",$data['size']);
		if($mark=="TC"){
		    $this->display("Order:tc_car");
		}else if($mark=="TD"){
		    $this->display("Order:td_car");
		}else if($mark=="SC"){
		    $this->display("Order:sc_car");
		}else{
		    $this->display("Order:ls_car");
		}

	}
	/**
	 * 分页查询待提车
	 */
	function waitExtAjax(){
		$pagesize = I("pagesize");
		$mark = I("mark");
		$openid = session("openid")==""?session("userdata")['openid']:session("openid");
		print_log("页码：".$pagesize);
		$weoObj = D("Order");
		$data = $weoObj->waitExtractOrder($openid,$mark,$pagesize);
		$list = $data['list'];
		$xml="";
		$str="";
		$size = count($list);
		
		$n=$pagesize;
		if($size>0){
			for($i=0;$i<$size;$i++){
					$n++;
					if($mark=="N"){
					    $str = '<div class="owlist3"><p><a href="/ExtractCarManWX/Order/orderTh/orderCode/'.$list[$i]['order_code'].'">我要验车</a></p></div>';
					}
					$xml .='<div class="owlist" name="div_owlist_'.$n.'">
						      <div class="owlist1"><h2>提车时间：'.$list[$i]['tiche_time'].'</h2></div>
							  <div class="owlist2">
							     <div class="owlist2a">
								 <img src="/Public/ExtractWx/images/tche1.png">
								  <p><img src="/Public/ExtractWx/images/tche2.png"></p>
								 </div>
							      <div class="owlist2b">
								   <dl>
								      <dt>用户姓名：</dt>
								       <dd>'.$list[$i]['shouche_name'].'</dd>
								   </dl>
								     <dl>
								      <dt>用户电话：</dt>
								       <dd>'.$list[$i]['shouche_tel'].'</dd>
								   </dl>
								     <dl>
								      <dt>身份证号：</dt>
								       <dd>'.$list[$i]['mam_code_new'].'</dd>
								   </dl>
								     <dl>
								      <dt>约定地点：</dt>
								       <dd>'.$list[$i]['start_address'].'</dd>
								   </dl>
									'.$str.'		
								  </div>
							  </div>
							  
						  </div>';
			}
		}
		$this->ajaxReturn($xml);
	}
	/**
	 * 打开图片上传页面
	 * @date: 2016-9-14 下午5:30:53
	 * @author: liuxin
	 */
	public function orderTh(){
	    $this -> assign('orderCode',I('orderCode'));
	    $this -> display('Order:photo');
	    //$this -> display('Order:test');
	}
	/**
	 * 图片等信息上传并进入确认用户交车页面（倒数第二步）
	 * @date: 2016-9-14 下午5:31:15
	 * @author: liuxin
	 */
	public function geVerifyInfo(){
	    $userInfo = session('userInfo');
	    $this -> assign('avatar',$userInfo['headimgurl']);
	    //dump($userInfo);
	    $usercode = session('userdata')['car_code'];
	    $arrN = array('user_code'=>$usercode,'verify_car_keys'=>I('key'),'verify_spare_tire'=>I('backup'),
	        'verify_tool_kit'=>I('tool'),'verify_lifting_jack'=>I('jack'),'verify_door_mat'=>I('footpad'),
	        'verify_km'=>I('km'),'verify_instructions'=>I('instru'),'verify_warning_sign'=>I('notice'),
	        'verify_lighter'=>I('lighter'),'verify_fire_extinguisher'=>I('firee'),'verify_car_time'=>date('Y-m-d H:i:s',time()),
	        'order_code'=>I('ordercode'),'verify_code'=>get_code('tvci'),
	    );
	    $arrHead = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('head_pic'),
	        'verify_img_describe'=>I('head'),'verify_img_type'=>1,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrLeft = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('left_pic'),
	        'verify_img_describe'=>I('left'),'verify_img_type'=>2,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrRight = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('right_pic'),
	        'verify_img_describe'=>I('right'),'verify_img_type'=>3,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrTop = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('top_pic'),
	        'verify_img_describe'=>I('top'),'verify_img_type'=>4,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrTail = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('tail_pic'),
	        'verify_img_describe'=>I('tail'),'verify_img_type'=>5,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrInside = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('inside_pic'),
	        'verify_img_describe'=>I('inside'),'verify_img_type'=>6,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrSpare = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>I('spare_pic'),
	        'verify_img_describe'=>I('spare'),'verify_img_type'=>7,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $arrOther = array('verify_code'=>get_code('tvci'),'order_code'=>I('ordercode'),'verify_img_upload'=>trim(I('other_pic'),';'),
	        'verify_img_describe'=>I('special'),'verify_img_type'=>8,'verify_img_time'=>date('Y-m-d H:i:s',time()),
	        'user_code'=>$usercode,
	    );
	    $res = D('Order') -> geVerifyInfo($arrN,$arrHead,$arrLeft,$arrRight,$arrTop,$arrTail,$arrInside,$arrSpare,$arrOther);
	    if($res){
	        $this -> assign('orderCode',I('ordercode'));
	        $this -> assign('car_name',session('userdata')['car_name']);
	        $this -> display('Order:confirm');
	    }else{
	        $this -> error("系统错误，请稍后再试");
	    } 
	}
	/**
	 * 进入确认完成提车页面
	 * @date: 2016-9-14 下午5:31:43
	 * @author: liuxin
	 */
	public function complete(){
	    $userInfo = session('userInfo');
	    $this -> assign('avatar',$userInfo['headimgurl']);
	    //$this -> assign('orderCode',I('ordercode'));
	    $this -> assign('yd_id',I('yd_id'));
	    $this -> assign('car_name',session('userdata')['car_name']);
	    $this -> display('Order:complete');
	}
	/**
	 * 更改订单状态
	 * @date: 2016-9-14 下午5:33:11
	 * @author: liuxin
	 */
 	public function tcomplete(){
 	    //$map['order_code'] = array('eq',I('ordercode'));
 	    $map['yd_id'] = array('eq',I('yd_id'));
 	    /* $mapss['car_code'] = array('eq',session('userdata')['car_code']);
 	    $maps['order_code'] = array('eq',I('ordercode'));
 	    $res = M('order') -> where($map) -> setField('order_status','Z');
 	    $ress = M('order_info') -> where($maps) -> setField('order_info_tc','Y');
 	    $resss = M('car_order') -> where($mapss) -> setField('car_info_status','Y'); */
 	    $res =M("yundan") -> where($map) ->setField('status','Y');
 	    if($res){
 	        $this -> display("WeiXin:member_info");
 	    }else{
 	        $this -> error('系统错误请稍后再试');
 	    }
 	}
 	
 	public function test(){
 	    $this -> display('Order:test');
 	}
 	/**
 	 * 获取jsapi的签名并返回相关信息
 	 */
 	
 	function getJsSign(){
 	    
 	    /* $appid=C("APPID");   //appid
 	    $secret=C("SECRET");   //appid
 	    $arr = fileRead('access_token.json');
 	    $times = time();
 	    if($times<$arr['expire_time']){
 	        $access_token = $arr['access_token'];
 	    }else{
 	        $access_token = get_token($appid,$secret);
 	    } */
 	    //parent:: getAccsenToken();
 	    $this -> wx_jsapiticket();
 	    
 	    $url = I('post.url');
 	    //$url = 'http://www.chetuotuo.cn/Customer/Worklwt/memberOrder/';
 	    /*
 	     $ticket = S('ticket');
 	     $access_token = parent::getAccsenToken();
 	     $now = time();
 	     if(!isset($ticket['ticket'])||$now-$ticket['time']>=7200){
 	     $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
 	     $ch = curl_init();
 	     curl_setopt ($ch,CURLOPT_URL,$url);
 	     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 	     curl_setopt($ch, CURLOPT_HEADER, false);
 	     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 	     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 	     $returnInfo = curl_exec($ch);
 	     curl_close ($ch);
 	     $res = json_decode($returnInfo,true);
 	     if($res['errmsg']=='ok'){
 	     $tic['ticket'] = $res['ticket'];
 	     $tic['time'] = time();
 	     S('ticket',$tic);
 	     $jsTic = $res['ticket'];
 	     }
 	     }else{
 	     $jsTic = $ticket['ticket'];
 	     } */
 	    $jsTic = S("jsapiticket");
 	    print_log('js票据-----------------------------------'.$jsTic);
 	    $strs = 'Wm3WZYTPz0wzccnW';//获取随机字符串
 	    $timestamp = time();
 	    //$url = '';
 	    $str = 'jsapi_ticket='.$jsTic.'&noncestr='.$strs.'&timestamp='.$timestamp.'&url='.$url;
 	    $sign = sha1($str);
 	    $appid = C('APPID');
 	    $arr['appId'] = $appid;
 	    $arr['timestamp'] = $timestamp;
 	    $arr['nonceStr'] = 'Wm3WZYTPz0wzccnW';
 	    $arr['signature'] = $sign;
 	    $arr['ticket'] = $jsTic;
 	    $this -> ajaxReturn($arr);
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
 	
 	public function gePic(){
 	    $appid=C("APPID");   //appid
 	    $secret=C("SECRET");
 	    $acctoken = "";
 	    $arr = fileRead('access_token.json');
 	    $times = time();
 	    if($times<$arr['expire_time']){
 	        $acctoken = $arr['access_token'];
 	    }else{
 	        $acctoken = get_token($appid,$secret);
 	    }
 	    $picId = I('post.pic');
 	    $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$acctoken."&media_id=".$picId; 
 	    
 	    $img = file_get_contents($url);
 	    $imgName = get_code(tctp).".jpg";
 	    //$imgName = "1.jpg";
 	    $imgPath = C('IMGWX').$imgName;
 	    $resource = fopen($imgPath , 'w+');
 	    
 	    //将图片内容写入上述新建的文件
 	    fwrite($resource, $img);
 	    //关闭资源
 	    fclose($resource);
 	    $imgPath = trim($imgPath,'.');
 	    $imgPath = C('REQUEST_PATH').$imgPath;
 	    $this -> ajaxReturn($imgPath);
 	}
 	/**
 	 * 验车页面
 	 */
 	public function verify(){
 	    $order_code=I("order_code");
 	    $this->assign("order_code",$order_code);
 	    $this->display();
 	}
 	/**
 	 * ajax保存验车图片
 	 */
 	public function insertVerImgs(){
 	    $this->ajaxReturn('Y');
 	}
}
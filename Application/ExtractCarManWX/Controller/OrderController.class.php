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
		//$openid = 'o-brJvqmpogPBktJ6Go2rxRZfSUk';
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
	    $openid = session("openid")==""?session("userdata")['openid']:session("openid");
	    print_log("获取数据待提车数据：".$openid);
	    $startnum = I("startnum")==""?0:I("startnum");
	    $mark = I("mark");
	    print_log("-------".$mark);
	    $weoObj = D("Order");
	    //'oWRN6wRF39W8YDplPiglS0ZkO3L0'
	    $data = $weoObj->waitExtractOrder($openid,$mark,$startnum);
	    $xml="";
	    $size = $data['size']-$startnum;
	    $list=$data['list'];
	    $n=$startnum;
	    //$this->assign("list",$data['list']);
	    
	    if($mark=="TC"){
	        if($size>0){
	            for($i=0;$i<$size;$i++){
	                $n++;
	               $xml.='<div class="order_lisa hjh" name="div_owlist_'.$n.'">
				<div class="order_lisa1">
					<h2>订单号：'.$list[$i]["order_code"].'</h2>
				</div>
				<div class="order_lisa2">
					<div class="olist2">
						<p><strong>车型：</strong>'.$list[$i]["order_info_brand"].'</p>
						<p><strong>识别号：</strong>'.$list[$i]["order_info_carmark"].'</p>
						<p><strong>联系人：</strong>发车人：'.$list[$i]["faName"].'+<a tel="'.$list[$i]["faPhone"].'">'.$list[$i]["faPhone"].'</a></p>
						<p><strong>提车地址：</strong>'.$list[$i]["address"].'</p>
					</div>
					<div class="fraka2">
							<a class="sfwgwe" data-code="'.$list[$i]["order_code"].'" data-id="'.$list[$i]["yd_id"].'" ><img src="__EXWX__/images/pp2.jpg"></a>
					
					</div>
				</div>
			</div>';
	            }
	        }
	    }else if($mark=="TD"){
	        if($size>0){
	            for($i=0;$i<$size;$i++){
	                $n++;
	                $xml.='<div class="order_lisa" name="div_owlist_'.$n.'">
	                <div class="order_lisa1">
	                <h2>订单号：'.$list[$i]["order_code"].'</h2>
	                </div>
	                <div class="fraka2">
	                <div class="order_lisa2">
	                <div class="olist2">
	                <p><strong>车型：</strong>'.$list[$i]["order_info_brand"].'</p>
	                <p><strong>识别号：</strong>'.$list[$i]["order_info_carmark"].'</p>
	                <p><strong>提车联系人：</strong>'.$list[$i]["yd_other"].'</p>
	                <p><strong>备注：</strong>'.$list[$i]["yd_mark"].'</p>
	                </div>
	                </div>
	                </div>
	                <div class="asct ssss3">
	                <button><a class="sfwgwe" data-id="'.$list[$i]["yd_id"].'" >确认完成</a></button>
	                <a href="/ExtractCarManWX/Order/verifyImgs/order_code/'.$list[$i]["order_code"].'"><h2>查看验车照片</h2></a>
	                </div>
	                </div>';
	            }
	        }
	    }else if($mark=="SC"){
	        if($size>0){
	            for($i=0;$i<$size;$i++){
	                $n++;
	               $xml.='<div class="order_lisa  poo1" name="div_owlist_'.$n.'">
				<div class="order_lisa1">
					<h2><a href="">订单号：'.$list[$i]["order_code"].'</a></h2>
				</div>
				<div class="poo2">
				<div class="asct fraka2">
					<div class="order_lisa2">
						<div class="olist2">
							<p><strong>车型：</strong>'.$list[$i]["order_info_brand"].'</p>
							<p><strong>识别号：</strong>'.$list[$i]["order_info_carmark"].'</p>
						</div>
					</div>
				
				</div>
				<div class="asct">
					<div class="olist2">
						<p><strong>联系人：</strong>'.$list[$i]["faName"].'+<a tel="'.$list[$i]["faPhone"].'">'.$list[$i]["faPhone"].'</a></p>
						<p class="tuu">提示：确认车辆信息无误，验车无误以后，方可提走车辆。</p>
					</div>
				
				</div>
					<div class="fraka3">
						<button><a class="sfwgwe" data-id="'.$list[$i]["yd_id"].'">确认送车</a></button>
					</div>
				</div>
				<div class="poo3">
				<div class="asct">
					<div class="olist2">
						<p><strong>收车人姓名：</strong>'.$list[$i]["recInfo"][0].'</p>
						<p><strong>电话：</strong>'.$list[$i]["recInfo"][1].'</p>
						<p><strong>身份证号：</strong>'.$list[$i]["recInfo"][2].'</p>
						<p><strong>代收运费：</strong>'.($list[$i]["yd_price"]/100).'元</p>
					</div>
				</div>
					<div class="fraka3">
						<a href="/ExtractCarManWX/Order/verifyImgs/order_code/'.$list[$i]["order_code"].'"><h2>查看验车照片</h2></a>
					</div>
				</div>
			</div>';
	            }
	        }
	    }else{
	        if($size>0){
	            for($i=0;$i<$size;$i++){
	                $n++;
	               $xml.='<div class="order_lisa" name="div_owlist_'.$n.'">
				<div class="order_lisa1">
					<h2><a href="">订单号：'.$list[$i]["order_code"].'</a><span>类型：'.$list[$i]["yd_type"].'</span></h2>
				</div>
				<div class="asct">
					<div class="olist2">
						<p><strong>车型：</strong>'.$list[$i]["order_info_type"].'</p>
						<p><strong>识别号：</strong>'.$list[$i]["order_info_carmark"].'</p>
						<p><strong>备注：</strong>'.$list[$i]["yd_mark"].'</p>
					</div>
				</div>
					<div class="asct ssss3">	
						<a href="/ExtractCarManWX/Order/verifyImgs/order_code/'.$list[$i]["order_code"].'"><h2>查看验车照片</h2></a></div></div>';
	            }
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
	    $data=I("post.");
	    $data['user_code']=$usercode;
	    $data['verify_car_time']=date("Y-m-d H:i:s",time());
	    $data['verify_code']=get_code('tvci');
	    $yd_id=$data['yd_id'];
	    $this->verStatus($yd_id);
	    unset($data['yd_id']);
	    $res = D('Order') -> geVerifyInfo($data);
	    if($res){
	        $this -> assign('yd_id',$yd_id);
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
	    $yd_id=I("yd_id");
	    $res=D("Order")->completeYunDan($yd_id);
	    if($res){
	        $userInfo = session('userInfo');
	        $this -> assign('avatar',$userInfo['headimgurl']);
	        $this -> assign('car_name',session('userdata')['car_name']);
	        //$this->redirect('Weixin/memberInfo');
	        $this -> display();
	    }else{
	        $this->error("操作错误");
	    }
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
 	    $imgName = get_img_name().".jpg";
 	    //$imgName = "1.jpg";
 	    $imgPath = C('IMGWX2').$imgName;
 	    $resource = fopen($imgPath , "w+");
 	    //将图片内容写入上述新建的文件
 	    fwrite($resource, $img);
 	    //关闭资源
 	    fclose($resource);
 	    $imgPath = trim($imgPath,'.');
 	    $imgPath = C('REQUEST_PATH')."/".$imgPath;
 	    $this -> ajaxReturn($imgPath);
 	}
 	/**
 	 * 验车页面
 	 */
 	public function verify(){
 	    $order_code=I("order_code");
 	    $yd_id=I("yd_id");
 	    $this->verStatus($yd_id);
 	    $this->assign("yd_id",$yd_id);
 	    $this->assign("order_code",$order_code);
 	    $this->display();
 	}
 	/**
 	 * ajax保存验车图片
 	 */
 	public function insertVerImgs(){
 	    $this->ajaxReturn('Y');
 	}
 	/**
 	 * 查看验车照片
 	 */
 	public function verifyImgs(){
 	    $order_code=I("order_code");
 	    $data=D("Order")->getVerImgs($order_code);
 	    if($data){
 	        $this->assign("list",$data['list']);
 	        $this->assign("imgs",$data['imgs']);
 	        $this->display();
 	    }else{
 	        $this->error("暂无验车照片");
 	    }
 	}
 	/**
 	 * 添加定位
 	 */
 	public function addPosition(){
 	    $lat=I("lat");
 	    $lon=I("lon");
 	    $res=D("Order")->addPosition($lat,$lon);
 	    if($res){
 	        $this->ajaxReturn('Y');
 	    }
 	}
 	/**
 	 * 判断验车状态
 	 */
 	public function verStatus($yd_id){
 	    $where['yd_id']=$yd_id;
 	    $where['status']='Y';
 	    $res=M("yundan")->where($where)->find();
 	    if($res){
 	        $this->redirect('Weixin/memberInfo');
 	        die();
 	    }
 	}
}
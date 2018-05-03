<?php
namespace ExtractCarManWX\Controller;

class WeixinController extends BaseController {
	
	//验证手机号
	function verifyPhone(){
		$tel=I("post.tel");
		$obj = D('LoginAdmin');
		$flag = $obj -> checkPhone($tel);
		$this -> ajaxReturn($flag);
		//echo "123";
	}
	
	//验证验证码
	function verifyCode(){
		$vCode = remove_xss(I('VCode',''));
		print_log("验证码是：".$vCode);
		$data['flag'] = true;
		if(!check_verify($vCode)){
			$data['msg'] = "亲，验证码输错了哦！";
			$data['flag'] = false;
		}
		print_log("验证码是否正确：".json_encode($data));
		$this -> ajaxReturn($data);
	}

    //手机动态登录
    public function weixin(){
		$code= I("code");
		$appid=C("APPID");   //appid
		$secret=C("SECRET");   //appid
		$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code";
		$outputUrl = sprintf($url,$appid,$secret,$code);
		$res=json_decode(https_request($outputUrl),true);
		$openid_s = $res['openid'];
		$arr = fileRead('access_token.json');
		$times = time();
		if($times<$arr['expire_time']){
			$access_token = $arr['access_token'];
		}else{
			$access_token = get_token($appid,$secret);
		}
		session("openid",$openid_s);
		if($openid_s!=""){   //获取openid
			$obj = D('LoginAdmin');
			$ret = $obj->readByOpenid($openid_s);
			if($ret){
				$urls = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid_s.'&lang=zh_CN';
				$ress=json_decode(https_request($urls),true);
				session("userdata",$ret);
				session("userInfo",$ress);
				$this->assign("userInfo",$ress);
				$this->assign("member",$ret);
				$this->display("WeiXin:member_info");
			}else{
				$this->display("WeiXin:weixin");
			}
		}else{
			//暂定
			$this->display("WeiXin:weixin");
		}
    }
    
    //验证码
    public function verify_c() {
        $Verify = new \Think\Verify ();
        $Verify->fontSize = 52;
        $Verify->length = 4;
        $Verify->codeSet = '123456789123456789';
        $Verify->useNoise = false;
        $Verify->entry();
    }
    
	public function tel_SMS(){
        $tel = remove_xss(I("tel"));
        $VCode = I("VCode");
        if(check_verify($VCode)){
	        $rand_num = mt_rand(1000, 9999);
	        $mes = "亲爱的用户！您的验证码为：".$rand_num." 请您尽快填写！";
	        //$result['code'] = $rand_num;
	        $rets = send_mobile_sms($tel,$mes);
	        print_log("短信发送是否成功:".$rets['returnstatus']);
	        print_log("短信发送验证码:".$rand_num);
	        if($rets['status']==0){
	        	session("notecode",$rand_num);
	        	$result =true;
	        }else{
	        	$result =false;
	        }
	        $this -> ajaxReturn($result);
        }else{
        	$this -> ajaxReturn(false);
        }
    }
    
    //手机登录验证
    public function loginUserWx(){
    	$tel = remove_xss(I("tel"));
    	$SM_VCode = I("SM_VCode");//短信验证码
    	$notecode = session("notecode");
    	$openid = session("openid");
    	print_log("测试:".$openid);
    	$data['flag'] = false;
    	$data['info'] = "登陆失败!";
    	if($SM_VCode==$notecode){
    		session("notecode",null);
	    	$obj = D('LoginAdmin');
	    	if($obj->checkPhone($tel)){
		    	$ret = $obj->loginUserWx($openid,$tel);
		    	if($ret){
		    		$appid=C("APPID");   //appid
		    		$secret=C("SECRET");   //appid
		    		$openid = session("openid");
		    		$vo = $obj->readByOpenid($openid);
		    		$arr = fileRead('access_token.json');
		    		$times = time();
		    		if($times<$arr['expire_time']){
		    			$access_token = $arr['access_token'];
		    		}else{
		    			$access_token = get_token($appid,$secret);
		    		}
		    		$urls = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		    		$ress=json_decode(https_request($urls),true);
		    		print_log("用户微信信息:".json_encode($ress));
		    		session("userInfo",$ress);
		    		session("userdata",$vo);
		    		$data['flag'] = true;
		    	}else{
		    		$data['info'] = "绑定失败，请联系客服!";
		    	}
	    	}else{
	    		$data['info'] = "您还不是我们的提车员!";
	    	}
    	}else{
    		$data['info'] = "短信验证码错误!";
    	}
    	$this->ajaxReturn($data);
    }
    /**
     * 个人中心
     */
    function memberInfo(){
    	$userdata = session("userdata");
    	$userInfo = session("userInfo");
    	$this->assign("userInfo",$userInfo);
    	$this->assign("member",$userdata);
    	$this->display("WeiXin:member_info");
    }
  
    function ceshi(){
    	$this->display("WeiXin:ceshi");
    }
}
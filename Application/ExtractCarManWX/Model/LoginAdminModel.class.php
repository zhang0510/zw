<?php
namespace ExtractCarManWX\Model;
class LoginAdminModel extends BaseModel{
    //查找用户-PC方式
    function readByOpenid($openid=""){
        $chObj = M("car_header");
        $chMap['openid'] = array("eq",$openid);
        $ret = $chObj->where($chMap)->find();
        print_log("获取------数据:".json_encode($ret));
        return $ret;
    }
    //手机登录验证
    public function loginUserWx($openid="",$tel=""){
    	$chObj = M("car_header");
    	$cnMap['car_tel'] =array("eq",$tel);
    	$data['openid'] = $openid;
    	$ret = $chObj->where($cnMap)->save($data);
    	if($ret){
    		return true;
    	}else{
    		return false;
    	}
    }
    /**
     * 检测用户手机号是否存在!
     * @param string $tel
     * @return boolean
     */
    function checkPhone($tel=""){
    	$chObj = M("car_header");
    	$chMap['car_tel'] = array("eq",$tel);
    	$ret = $chObj->where($chMap)->find();
    	if($ret){
    		return true;
    	}else{
    		return false;
    	}
    }
}
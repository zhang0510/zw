<?php
namespace ExtractCarManWX\Model;
class OrderModel extends BaseModel{
    //oWRN6wRF39W8YDplPiglS0ZkO3L0    N    0
	function waitExtractOrder($openid="",$car_info_status="",$startnum=0){
	    
		$yunObj = M("yundan");
		$userObj=M("car_header");
		$orderObj=M("order_assistant");
		$userMap['openid'] = array("eq",$openid);
		$userInfo=$userObj->where($userMap)->field("car_tel")->find();
		$yunMap['yd_tel']=$userInfo['car_tel'];
		if($car_info_status=="TC"){
		    $yunMap['yd_type']=array('eq','A');
		    $yunMap['status']=array("neq",'Y');
		}else if($car_info_status=="TD"){
		    $yunMap['yd_type']=array('eq','B');
		    $yunMap['status']=array("neq",'Y');
		}else if($car_info_status=="SC"){
		    $yunMap['yd_type']=array('eq','E');
		    $yunMap['status']=array("neq",'Y');
		}else{
		    $yunMap['yd_type']=array(array('eq','A'),array('eq','B'),array('eq','E'),'or');
		    $yunMap['status']=array("eq",'Y');
		}
		$data['size'] = $sizes = $yunObj->where($yunMap)->count();//总数
		if($startnum<$sizes){
		    $data['list'] = $yunObj->where($yunMap)->limit($startnum,5)->order("yd_time asc")->select();
		    $arr=array(
		        'A' => '提车',
		        'B' => '提短',
		        'E' => '送车'
		    );
		    foreach ($data['list'] as &$va){
		         $orderCode=$va['order_code'];
		         $orderInfo=M("order_assistant")->where("order_code ='".$orderCode."'")->field("order_info_type,order_info_brand,order_info_carmark,order_info_tclxr,order_info_sclxr,order_info_star,order_info_star_address")->find();
		         $va['order_info_brand']=$orderInfo['order_info_brand'];
		         $va['order_info_type']=$orderInfo['order_info_type'];
		         $va['order_info_carmark']=$orderInfo['order_info_carmark'];
		         $faUserInfo=explode(",",$orderInfo['order_info_tclxr']);
		         $recInfo=explode(",",$orderInfo['order_info_sclxr']);
		         $va['faName']=$faUserInfo[0];
		         $va['faPhone']=$faUserInfo[1];
		         $va['recInfo']=$recInfo;
		         $va['yd_type']=$arr[$va['yd_type']];
		         $areaArr=explode(",",$orderInfo['order_info_star']);
		         $area_M=M("area");
		         $area='';
		         foreach($areaArr as $vo){
		             $area_name=$area_M->where("area_id = ".$vo)->field("area_name")->find();
		             $area.=$area_name['area_name'];
		         }
		         $area.='('.$orderInfo['order_info_star_address'].')';
		         $va['address']=$area;
		         $va['all_price']=0;
		         if(!empty($va['yd_cover_code'])){
		             $priceArr=explode(",",$va['yd_cover_code']);
		             foreach ($priceArr as $vo){
		                 $priMap['yd_code']=$vo;
		                 $res=$yunObj->where($priMap)->find();
		                 $va['all_price']=$va['all_price']+$res['yd_price'];
		             }
		         }
		    }
		}else{
		    $data['list']=null;
		}    
		
		return $data;
	}
	/**
	 * 写入提车信息
	 * @date: 2016-9-14 下午5:33:40
	 * @author: liuxin
	 * @param string $arrN
	 * @param string $arrHead
	 * @param string $arrLeft
	 * @param string $arrRight
	 * @param string $arrTop
	 * @param string $arrTail
	 * @param string $arrInside
	 * @param string $arrSpare
	 * @param string $arrOther
	 * @return unknown
	 */
   public function geVerifyInfo($data){
       $obj = M('verify_car_info');
       $imgsArr=$data['imgs'];
       unset($data['imgs']);
       $where['order_code']=$data['order_code'];
       $is=$obj->where($where)->find();
       if($is){
           $res = $obj ->where($where) -> save($data);
       }else{
           $res = $obj -> add($data);
       }
       if($res){
           if($imgsArr!=''&&$imgsArr!=null){
               foreach ($imgsArr as $va){
                   $add['verify_code']=$data['verify_code'];
                   $add['order_code']=$data['order_code'];
                   $add['verify_img_upload']=$va;
                   $add['verify_img_time']=date("Y-m-d H:i:s",time());
                   $add['verify_img_code']=explode(".",substr($va,strrpos($va,"/")+1))[0];
                   $insertImg=M("verify_car_img")->add($add);
               }
           }
       }
       return $res;
   }
   public function insertInfo($res='',$data=''){
       $obj = M('verify_car_img');
       for($i=0;$i<8;$i++){
           $ress = $obj -> add($data[$i]);
           $res = $res && $ress;
       }
       return $res;
   }
   /**
    * 验车照片列表(详情)
    */
   public function getVerImgs($order_code){
       $map['order_code']=$order_code;
       $info=M("verify_car_info")->where($map)->find();
       $imgs=M("verify_car_img")->where($map)->select();
       if($info){
           $data['list']=$info;
       }else{
           $data['list']=null;
       }
       if($imgs){
           $data['imgs']=$imgs;
       }else{
           $data['imgs']=null;
       }
       return $data;
   }
   /**
    * 运单完成操作
    */
   public function completeYunDan($yd_id){
       $obj = M("yundan");
       $objs = M("order_assistant");
       $map['yd_id']=$yd_id;
       $data['status']='Y';
       $info = $obj->where($map)->find();
       $res=$obj->where($map)->save($data);
       $infos = $objs->where(array('order_code'=>$info['order_code']))->find();
       $us = M("user")->where(array("tel"=>$infos['user_code']))->find();
       if($res){
           if($info['yd_type'] == 'A'){
               $datas['order_status'] = 'Y';
               $str = "%s先生/女士，您的订单%s，%s到%s， %s（车型）接车顾问%s验车已完成，托运合同已生效，保单会在下午18时统一上传（届时会另行告知），“妥妥保驾护航”行程已开始。";
               $strs = sprintf($str,
                   $us['user_name'],
                   $infos['order_code'],
                   $this->getPlaceName(explode(",",$infos['order_info_star'])[1]),
                   $this->getPlaceName(explode(',',$infos['order_info_end'])[1]),
                   $infos['order_info_type'],
                   $info['yd_name']);
               print_log("------------------提车完成:".$strs);
               $arr = explode(";",$infos['mess_rec_man']);
               foreach ($arr as $k=>$v){
                   $ret = send_mobile_sms($v,$strs);
               }
               if($ret['status']==0){
                   //$data['msg']="发送成功";
               }else{
                   //$data['msg']="发送失败";
               }
               //-----提车完成日志
               $strsh = "订单%s：司机-%s 手机端确认提车";
               $strshs = sprintf($strsh,$infos['order_code'],$info['yd_name'].'，'.$info['yd_tel']);
               $cobj = M('log');
               $datas['admin_code'] = $info['yd_name'];
               $datas['log_code'] = get_code('tl');
               $datas['log_time'] = date('Y-m-d H:i:s',time());
               $datas['log_content'] = $strshs;
               $datas['log_operation'] = "完成提车";
               $datas['order_code'] = $infos['order_code'];
               $datas['log_back_cont'] = "-";
               $ress = $cobj -> add($datas);
           }else if($info['yd_type'] == 'E'){
               $datas['order_status']='D';
               $str = "%s先生/女士，您的订单%s到%s，%s（车型）托运服务已完成，感谢您的信任；下次托运请直接拨打：400-8771107下单，“车妥妥”为您保驾护航！";
               $strs = sprintf($str,
                   $us['user_name'],
                   $this->getPlaceName(explode(",",$infos['order_info_star'])[1]),
                   $this->getPlaceName(explode(',',$infos['order_info_end'])[1]),
                   $infos['order_info_type']);
               print_log("------------------交车完成:".$strs);
               $arr = explode(";",$infos['mess_rec_man']);
               foreach ($arr as $k=>$v){
                   $ret = send_mobile_sms($v,$strs);
               }
               if($ret['status']==0){
                   //$data['msg']="发送成功";
               }else{
                   //$data['msg']="发送失败";
               }
           }
           $objs->where(array('order_code'=>$info['order_code']))->save($datas);
       }
       return $res;
   }
   /**
    * 将地名code转换成名称
    * @date: 2016-9-27 下午7:47:20
    * @author: liuxin
    * @param string $id
    * @return 地区名称
    */
   public function getPlaceName($id=''){
       //查询
       $map['area_id'] = array('eq',$id);
       $data = M('area') -> where($map) -> find();
       //返回地区名称
       return $data['area_name'];
   }
   /**
    * 添加定位
    */
   public function addPosition($lat,$lon){
           $posData['car_lat']=$lat;
           $posData['car_lon']=$lon;
           $posData['time']=date("Y-m-d H:i:s",time());
           $posData['carh_flag']='S';
           $usercode = session('userdata')['car_code'];
           $posData['car_code']=$usercode;
           $rss=M("position_car")->add($posData);
           return $rss;
       
   }
}
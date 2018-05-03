<?php
namespace ExtractCarManWX\Model;
class OrderModel extends BaseModel{
    //oWRN6wRF39W8YDplPiglS0ZkO3L0    N    0
	function waitExtractOrder($openid="",$car_info_status="",$startnum=0){
		$toObj = M("order");
		$oiObj = M("order_info");
		$chObj = M("car_header");//提车员信息表
		$coObj = M("car_order");//提车员订单
		$chMap['openid'] = array("eq",$openid);
		
		$chVo = $chObj->where($chMap)->field("car_code")->find();
		$comap['car_code'] = array("eq",$chVo['car_code']);
		$comap['car_info_status'] = array("eq",$car_info_status);
		
		$d = $coObj->field("order_code,car_jc_time")->where($comap)->order("car_jc_time asc")->select();
		$data['size'] = $sizes = $coObj->field("order_code,car_jc_time")->where($comap)->order("car_jc_time asc")->count();//总数
		$data['list'] =null;
		
		if($startnum<$sizes){
			$list = $coObj->field("order_code,car_jc_time")->where($comap)->limit($startnum,5)->order("car_jc_time asc")->select();
			$size = count($list);
			if($size>0){
				for($i=0;$i<$size;$i++){
					$oiMap['order_code'] = array("eq",$list[$i]['order_code']);
					print_log("--提车--".$i."----:".json_encode($oiMap));
					$vos = $oiObj->where($oiMap)->field('order_info_tclxr,order_info_star_address,max(order_info_id)')->group('order_code')->select();
					if($vos[0]['order_info_tclxr']!=""){//发车人
							$fArr = explode(",", $vos[0]['order_info_tclxr']);
							$mam_code = $fArr[1];
							$mam_code_new="";
							if($mam_code!=""&&strlen($mam_code)>15){
							$mam_code_new = substr($mam_code,0,4)."****".substr($mam_code,-4);
							}
							$list[$i]['mam_code_new'] = $mam_code_new;
							$list[$i]['shouche_name'] = $fArr[0];
							$list[$i]['shouche_code'] = $fArr[1];
							$list[$i]['shouche_tel'] = $fArr[2];
					}
					$list[$i]['start_address'] = $vos[0]['order_info_star_address'];
					$list[$i]['tiche_time'] = date("Y-m-d H点",strtotime($list[$i]['car_jc_time']));
				}
			}
			
			$data['list'] = $list;
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
   public function geVerifyInfo($arrN='',$arrHead='',$arrLeft='',$arrRight='',$arrTop='',$arrTail='',$arrInside='',$arrSpare='',$arrOther=''){
       $obj = M('verify_car_info');
       $res = $obj -> add($arrN);
       $data[]=$arrHead;
       $data[]=$arrLeft;
       $data[]=$arrRight;
       $data[]=$arrTop;
       $data[]=$arrTail;
       $data[]=$arrInside;
       $data[]=$arrSpare;
       $data[]=$arrOther;
       $res = $this -> insertInfo($res,$data);
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
}
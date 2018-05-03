<?php
namespace ExtractCarManWX\Controller;

class LoginController extends BaseController {
    
    function logins(){
    	$code = I("code");
    	print_log("进来没有获取code:".$code);
    	
    }
}
<?php
return array(
		//appid 秘钥 微信TOKEN
		'APPID'=>'wxc3c1ba13b8231198',
		'SECRET'=>'42ff39fb81b20eeef0cfffa505b2866f',
		//'WXTOKEN' =>'tuotuotoken',
                  'WXTOKEN' =>'tuotuoyunche',
		//域名
		'REQUEST_PATH' =>'http://www.521fangting.com',

		//缓存文件路径
		'PW' =>'./Public/WxFile/',
		
		'TMPL_PARSE_STRING' => array (
				'__EXWX__' => '/Public/ExtractWx', // 增加新的WX端路径替换规则
				'__JS__' => '/Public/JS', // 增加新的JS类库路径替换规则
				'__CUS__' => '/Public/Customer',
		),
				//加载App下Common配置
		'LOAD_EXT_FILE'=>'functions',
		//配置加载APP下自定义配置
		"LOAD_EXT_CONFIG" => array('STATIC_PROPERTY'=>'staticproperty'),
		//配置上传图片相关数据
		'UPLOAD_CONFIG' => array(
				'mimes'         =>  array(), //允许上传的文件MiMe类型
				'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
				'exts'          =>  array('jpg','png','gif','jpeg','mp4'), //允许上传的文件后缀
				'autoSub'       =>  true, //自动子目录保存文件
				'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
				'rootPath'      =>  './Upload/', //保存根路径
				'savePath'      =>  '', //保存路径
				'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
				'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
				'replace'       =>  true, //存在同名是否覆盖
				'hash'          =>  true, //是否生成hash编码
				'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
				'driver'        =>  'Local', // 文件上传驱动
				'driverConfig'  =>  array(), // 上传驱动配置
		),
		//图片根路径
		'IMGPATH' => '/Upload/',
		'IMGWX' => '/Upload/imgwx/',
        'IMGWX2' => 'Upload/imgwx/',
		'TMPL_PARSE_STRING' => array (
				'__HTTP__' => 'http://',
				'__JS__' => '/Public/JS', // 增加新的JS类库路径替换规则
				'__BACK__' => '/Public/Back', // 增加新的后台路径替换规则
				'__FRONT__' => '/Public/Front', // 增加新的前端路径替换规则
				'__EXWX__' => '/Public/ExtractWx', // 增加新的WX端路径替换规则
				'__UPIMG__' => '/Upload', // 上传图片跟路径替换规则
				'__MDP__'=>'/Public/My97DatePicker',//日期插件
				'__UE__'=>'/Public/ueditor',//日期插件
				'__UET__'=>'/Public/ueditor1',//日期插件
		),
		/* 数据库设置 */
		'DB_TYPE' =>  'mysql',     // 数据库类型
		'DB_HOST' =>  '120.27.96.249', // 服务器地址
		'DB_NAME' =>  'ttyc',          // 数据库名
		'DB_USER' =>  'root',      // 用户名
		'DB_PWD'  =>  'tuotuo123sql&',          // 密码
		'DB_PORT' =>  '3306',        // 端口
		'DB_PREFIX' =>  'tuo_',    // 数据库表前缀
		
		'DB_PATH_NAME'=> 'DBbackups',        //备份目录名称,主要是为了创建备份目录
		'DB_PATH'     => './DBbackups/',     //数据库备份路径必须以 / 结尾；
		'DB_PATH_DP'  => 'DBbackups/',    //数据库备份路径
		//设置SESSION超时时间
		'STATIC_PROPERTY' => array('BACK_LOGIN_TIME'=>'600'),
		
		//短信接口账户密码
		//'DUAN_ADMIN'=>'98a900',
		//'DUAN_PASWORD'=>'p9vyrblgwh',
		
                   'DUAN_ADMIN'=>'98a9b7',
                   'DUAN_PASWORD'=>'g3ae8wu0rz',

		//短信模板
		'DUANXIN_MOBAN' => array(
				'' => '@您好，您的@从@到@托运订单，审核通过，稍后将为您安排提车员，详询客服：400-8771107【妥妥运车】', //审核通过模板
				'' => '@您好，您咨询的@从@到@托运价格为@，客服电话：400-8771107，期待为您服务【妥妥运车】', //来电短信回复
				'' => '@您好，您的@从@到@托运订单@已到达@祝您生活愉快【妥妥运车】', //位置跟踪
				'' => '@您好，您的@从@到@托运订单，保险单已提供，详询客服：400-8771107【妥妥运车】', //保险购买成功
				'' => '@您好，您的@从@到@托运订单，提车员@已验车完成，即将开启爱车托运行程【妥妥运车】', //交车确认
				'' => '您的@从@到@托运订单，提车司机@-@身份证号@司机上门后请一定核对司机信息。【妥妥运车】',//提车员告知
				'' => '@您好，您的@从@到@托运订单已生成，稍后客服会审核该笔订单，期待为您服务：400-8771107【妥妥运车】',//下单成功
				'' => '您的登陆验证码是@15分钟内有效【妥妥运车】',//登陆验证码
				'' => '您本次修改密码验证码为@15分钟内有效【妥妥运车】',//修改密码
				'' => '您的验证码是@15分钟内有效【妥妥运车】',//注册验证码
		
		),
    'POSITION_CONFIG' => array(
        'OPINION' => array('W'=>100000000,'H'=>100000000),//观点、课堂、专栏缩略图
        'A' => array('W'=>1000,'H'=>1000),//测试
        'B' => array('W'=>1000,'H'=>1000),//测试2
        'NUMIMG' => array('W'=>1200,'H'=>1200),//系统管理数量输入
        'XWZX' => array('W'=>1000,'H'=>1000),//新闻中心
        'LINKIMG' => array('W'=>1000,'H'=>1000),//友情链接
        'C' => array('W'=>1200,'H'=>451),//优惠路路线banner
        'SLT' => array('W'=>386,'H'=>234),//优惠路线图片
    ),
);
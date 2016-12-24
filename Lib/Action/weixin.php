<?php
/*
使用方法：
 $arr = array(
	'account' => '公众平台帐号',
	'password' => '密码'
);
$w = new Weixin($arr);
$w->getAllUserInfo();//获取用户信息
$w->sendMessage('群发内容'); //群发给所有用户
$w->sendMessage('群发内容',$userId); //群发给特定用户
*/
class Weixin {
	const WX_LOGIN = 'wx_login_token';
	const WX_COOKIE = 'wx_cookie';
	private $_account;//用户名
	private $_password;//密码
	private $send_data;//提交的数据
	private $getHeader = 0;//是否显示Header信息
	private $token = null;//公共帐号TOKEN
	private $host = 'mp.weixin.qq.com';//主机
	private $origin = 'https://mp.weixin.qq.com';
	private $referer;//引用地址
	private $cookie;
	private $pageSize = 100000;//每页用户数（用于读取所有用户）
	private $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36';
	private $fansList = array();
	
	public function __construct($options){
		$this->_account = isset($options['account'])?$options['account']:'';
		$this->_password = isset($options['password'])?$options['password']:'';
		$cache = Cache::getInstance('Db');
		$this->token = $cache->get(self::WX_LOGIN);
		$this->cookie = $cache->get(self::WX_COOKIE);
		if($this->token === false){
			$this->login();
		}
	}
	
	//登录
	private function login(){
		$url = 'https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN';
		$this->send_data = array('username' => $this->_account, 'pwd' => md5($this->_password), 'f'=>'json');
		$this->referer = "https://mp.weixin.qq.com/";
		$this->getHeader = 1;
		$document = $this->curlPost($url);	
		//Log::write("login:{$document}");
		$lineList = explode("\n", $document);
		foreach($lineList as $line){
			$line = trim($line);
			if(preg_match('/^set-cookie/i', $line)){
				$array = explode(':', $line);
				$cookieValues = explode(';', $array[1]);
				foreach($cookieValues as $value){
					if(strpos($value, '=') === false) continue;
					$this->cookie .=  "{$value}; ";
				}				
			}elseif(!empty($line) && (strpos($line, '{') === 0)){
				$wechatResult = json_decode($line, true);
				$code = $wechatResult['base_resp']['ret'];
				if($code == 0){
					$redirectUrl = $wechatResult['redirect_url'];
					if(preg_match('/token=(\d+)/i', $redirectUrl, $matches)){
						$this->token = $matches[1];
						$cache = Cache::getInstance('Db');
						$cache->set(self::WX_LOGIN, $this->token, 1200);
						$cache->set(self::WX_COOKIE, $this->cookie, 1200);
					}
					//$indexDocument = $this->vget("{$this->origin}{$redirectUrl}");
					//Log::write("index:$indexDocument");
				}else{
					Log::write("微信登陆失败，错误代码：{$code}, {$wechatResult['base_resp']['err_msg']}");
				}
			}
		}
	}

	public function sendMessage($openId, $content){
		$this->referer = "https://mp.weixin.qq.com/cgi-bin/singlesendpage?t=message/send&action=index&tofakeid={$openId}&token={$this->token}&lang=zh_CN";		
		//$sendPage = "https://mp.weixin.qq.com/cgi-bin/singlesendpage?t=message/send&action=index&tofakeid={$openId}&token={$this->token}&lang=zh_CN";
		//$this->getHeader = 1;
		//$document = $this->vget($sendPage);
		//Log::write("aaa:{$document}");
		//$array = explode("\r\n\r\n", $document);
		//$header = explode("\r\n", $array[0]);
		/*foreach($header as $line){
			if(preg_match('/^set-cookie/i', $line)){
				$kvArray = explode(':', $line);
				$cookieValues = explode(';', $kvArray[1]);
				foreach($cookieValues as $value){
					if(strpos($value, '=') === false) continue;
					$this->cookie .=  "{$value}; ";
				}
			}
		}
		Log::write("cookie:{$this->cookie}");*/
		$url = "https://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response&f=json&token={$this->token}&lang=zh_CN";
		$this->send_data = array(
			'token'=>$this->token,
			'lang'=>'zh_CN',
			'f'=>'json',
			'ajax'=>'1',
			'random'=>microtime(),
			'type'=>'1',
			'content'=>$content,
			'tofakeid'=>$openId,
			'imgcode'=>''
		);
		$this->getHeader = 0;
		$document = $this->curlPost($url);
		//Log::write("document:{$document}");
		$result = json_decode($document, true);//{"base_resp":{"ret":0,"err_msg":"ok"}}		
		return $result['base_resp']['ret'] == 0;
	}
	
    /**
     * curl模拟登录的post方法
     * @param $url request地址
     * @param $header 模拟headre头信息
     * @return json
     */
    private function curlPost($url, $gzip = true) {
		$header = array(
            'Accept:*/*; q=0.01',
            'Accept-Charset: utf-8;q=0.7,*;q=0.3',
            'Accept-Encoding: gzip,deflate,sdch',
            'Accept-Language: zh-CN,zh;q=0.8',
            'Connection: keep-alive',
            'Host: '.$this->host,
            'Origin: '.$this->origin,
            'Referer: '.$this->referer,
            'X-Requested-With: XMLHttpRequest'
        );
        $curl = curl_init(); //启动一个curl会话
        curl_setopt($curl, CURLOPT_URL, $url); //要访问的地址
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //设置HTTP头字段的数组
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent); //模拟用户使用的浏览器
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //使用自动跳转
		}
		if($gzip) curl_setopt($curl, CURLOPT_ENCODING, "gzip");
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); //自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); //发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->send_data); //Post提交的数据包
        curl_setopt($curl, CURLOPT_COOKIE, $this->cookie); //读取储存的Cookie信息
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, $this->getHeader); //显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //获取的信息以文件流的形式返回
        $result = curl_exec($curl); //执行一个curl会话
        curl_close($curl); //关闭curl
        return $result;
    }
	
	private function vget($url, $gzip = true){ // 模拟获取内容函数
		$header = array(
            'Accept:*/*; q=0.01',
            'Accept-Charset: utf-8;q=0.7,*;q=0.3',
            'Accept-Encoding: gzip,deflate,sdch',
            'Accept-Language: zh-CN,zh;q=0.8',
            'Connection: keep-alive',
			'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Host: '.$this->host,
            'Origin: '.$this->origin,
            'Referer: '.$this->referer,
            'X-Requested-With: XMLHttpRequest'
		);
		
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //设置HTTP头字段的数组
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent); // 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_REFERER, $this->referer);
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
		}
		if($gzip) curl_setopt($curl, CURLOPT_ENCODING, "gzip");
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
		curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的GET请求
		curl_setopt($curl, CURLOPT_COOKIE, $this->cookie); // 读取上面所储存的Cookie信息
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_HEADER, $this->getHeader); // 显示返回的Header区域内容
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
		$tmpInfo = curl_exec($curl); // 执行操作
		if (curl_errno($curl)) {
			// echo 'Errno'.curl_error($curl);
		}
		curl_close($curl); // 关闭CURL会话
		return $tmpInfo; // 返回数据
	}
}
?>
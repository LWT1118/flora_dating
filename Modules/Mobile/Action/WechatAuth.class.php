<?php

include("wechat.class.php");
class wxauth {
	private $options;
	public $open_id;
	public $wxuser;
	
	public function __construct($options){
		$this->options = $options;
		$this->wxoauth();
		session_start();
		//die('come on');
	}

	public static function getOpenId($token, $appid, $appsecret){
		if(session('?open_id')){
			return session('open_id');
		}
		$code = isset($_GET['code']) ? $_GET['code'] : '';
		$options = array('token'=>$token, 'appid'=>$appid, 'appsecret'=>$appsecret);
		$we_obj = new Wechat($options);
		if(empty($code)){
			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$scope = 'snsapi_base';
			$oauth_url = $we_obj->getOauthRedirect($url, "wxbase",$scope);
			header('Location: ' . $oauth_url);
		}else{			
			$accessInfo = $we_obj->getOauthAccessToken();
			if($accessInfo === false)	return false;
			session('open_id', $accessInfo['openid']);
			return $accessInfo['openid'];
		}
	}
	
	public function wxoauth(){
		$scope = 'snsapi_base';
		$code = isset($_GET['code'])?$_GET['code']:'';
		$token_time = isset($_SESSION['token_time'])?$_SESSION['token_time']:0;
		if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600)
		{
			if (!$this->wxuser) {
				$this->wxuser = $_SESSION['wxuser'];
			}
			$this->open_id = $_SESSION['open_id'];
			return $this->open_id;
		}
		else
		{
			$options = array(
					'token'=>$this->options["token"], //填写你设定的key
					'appid'=>$this->options["appid"], //填写高级调用功能的app id
					'appsecret'=>$this->options["appsecret"] //填写高级调用功能的密钥
			);
			$we_obj = new Wechat($options);
			if ($code) {
				$json = $we_obj->getOauthAccessToken();
				if (!$json) {
					unset($_SESSION['wx_redirect']);
					//die('获取用户授权失败，请重新确认');
					return false;
				}
				$_SESSION['open_id'] = $this->open_id = $json["openid"];
				$access_token = $json['access_token'];
				$_SESSION['user_token'] = $access_token;
				$_SESSION['token_time'] = time();
				$userinfo = $we_obj->getUserInfo($this->open_id);
				if ($userinfo && !empty($userinfo['nickname'])) {
					$this->wxuser = array(
							'open_id'=>$this->open_id,
							'subscribe'=>$userinfo['subscribe'],
							'nickname'=>$userinfo['nickname'],
							'sex'=>intval($userinfo['sex']),
							'location'=>$userinfo['province'].'-'.$userinfo['city'],
							'avatar'=>$userinfo['headimgurl']
					);
				} elseif (strstr($json['scope'],'snsapi_userinfo')!==false) {
					$userinfo = $we_obj->getOauthUserinfo($access_token,$this->open_id);
					if ($userinfo && !empty($userinfo['nickname'])) {
						$this->wxuser = array(
								'open_id'=>$this->open_id,
								'subscribe'=>$userinfo['subscribe'],
								'nickname'=>$userinfo['nickname'],
								'sex'=>intval($userinfo['sex']),
								'location'=>$userinfo['province'].'-'.$userinfo['city'],
								'avatar'=>$userinfo['headimgurl']
						);
					} else {
						return $this->open_id;
					}
				}
				if ($this->wxuser) {
					$_SESSION['wxuser'] = $this->wxuser;
					$_SESSION['open_id'] =  $json["openid"];
					unset($_SESSION['wx_redirect']);
					return $this->open_id;
				}
				$scope = 'snsapi_userinfo';
			}
			if ($scope=='snsapi_base') {
				$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$_SESSION['wx_redirect'] = $url;
			} else {
				$url = $_SESSION['wx_redirect'];
			}
			if (!$url) {
				unset($_SESSION['wx_redirect']);
				//die('获取用户授权失败');
				return false;
			}
			$oauth_url = $we_obj->getOauthRedirect($url,"wxbase",$scope);
			header('Location: ' . $oauth_url);
		}
	}
}

?>
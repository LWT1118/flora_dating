<?php
class HomeAction extends PublicAction {

	function __construct(){
		parent::__construct();
		//if(isMobile())$this->redirect('/Mobile/Index/',0);
		$this->myheader();
		$this->myfooter();
		$this->InitOpenId();
	}

	protected function InitOpenId(){
		require_once('WechatAuth.class.php');
		$options = parent::wechat_cfg();
		$this->open_id = wxauth::getOpenId($options['token'], $options['appid'] , $options['appsecret']);		
		if($this->open_id === false){
			$this->error('请在微信中打开我们的公众号');
		}
	}

	protected function userinfo($id){
		$m = M('user')->find($id);
		//var_dump($m);exit;
		if($m){
			return $m;
		}else{
			return false;
		}
	}

	protected function myheader(){
		$this->site = parent::cfg();
		$this->topnav = M('nav')->where('cat=0 and status=1')->order('pos asc,id asc')->select();
		//p($this->topnav);
		$userId = $this->getUserId();
		if($userId > 0){
			$u = M('user')->find($userId);
			$member['tel'] = $u['tel'];
			$member['yes']='block';
			$member['no']='none';
		}else{
			$member['tel']='';
			$member['yes']='none';
			$member['no']='block';
		}
		$this->member = $member;
		$category = M('news_cat')->field('id,cat')->order('pos')->limit('20')->select();
		$this->cat_nav = $category;
		$this->ads1 = M('ads')->find(1);
		$this->ads2 = M('ads')->find(2);
		$this->ads3 = M('ads')->find(3);		
		//$this->cat_nav = node_merge($category);
		//p($this->cat_nav);
	}

	protected function myfooter(){
		$this->bottomnav = M('nav')->where('cat=1 and status=1')->order('pos asc,id asc')->select();
		//p($this->bottomnav );
	}

 	public function isMemberLogin(){
		$userId = $this->GetUserId();
		if($userId == 0){
			/*$cfg = parent::cfg();
			if($cfg['wx_login']==1){
				$this->redirect('Member/wxlogin');
			}else{*/
				$this->redirect('Member/login');
			//}
			
		}else{
			//$this->assign('m', $this->userinfo(session(C('USER_AUTH_KEY')));
			$this->m = $this->userinfo($userId);
			//var_dump($this->m);exit;
		}
	}
}
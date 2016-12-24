<?php

class UserAction extends HomeAction{

	public function index(){

		$Cat = M('news_cat');
		$Data = M('news');


		$cat = I('cat',0,'intval');
		if($cat>0){
			$catinfo = $Cat->where('id='.$cat)->getField('cat');
			$where = 'status=1 and cat =  '.$cat;
		}else{
			$catinfo = '全部活动';
			$where = "status=1";
		}


		$perpage = 6;
		import('ORG.Util.Page');

		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$this->data = $Data->where($where)->order('pos asc,id desc')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		$this->page = $Page->show();
		$this->page_title = $catinfo;
		$this->display();
	}

	public function detail(){
		R('Member/isMemberLogin');
		$id = I('id',0,'intval');
		if($id==0){
			$this->error('您查看的会员不存在');
		}else{
			$user = M('user')->find($id);
			if($user['status'] == 0){
				$this->error('该用户资料还未通过管理员审核');
			}
			$this->user = $user;
			
			/*$where['pid'] = array('eq',$user['id']);
			$where['uid'] = array('eq',session(C('USER_AUTH_KEY')));
			$follow = M('bookmark')->where($where)->find();
			if(is_null($follow)){
				$this->isfollow = '0';
				$more = 0;
			}else{
				$this->isfollow = '1';
				if($follow['wechat']==1){
					$wechat = M('user')->where('id='.$user['id'])->getField('wechat');
					$this->wechat = $wechat;
					$more = 1;
				}else{
					$this->wechat = '查看用户的微信号，将会消耗您一根红线！';
					$more = 0;
				}
			}*/
			$where['pid'] = array('eq',$id);
			$where['uid'] = array('eq',$this->m['id']);
			$follow = M('bookmark')->where($where)->find();
			$this->msg = empty($follow) ? '您确定要花费1根红线或使用一次免费机会查看微信号？' : '您已经支付过红线或使用过免费机会，请点击确定显示微信号';
			$this->paid = empty($follow) ? 0 : 1;

			//$this->more = M('user')->field('content',true)->where("id<>".$id)->limit(6)->order('reg desc')->select();
			//$this->page_title = $this->user['realname'];
			$this->page_title = '用户信息';
			/*if($more==1){
				$this->display('detailMore');
			}else{
				$this->display();
			}*/
			$this->display();
		}
	}


}

?>
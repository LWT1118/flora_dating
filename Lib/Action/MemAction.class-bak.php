<?php

class MemAction extends HomeAction{
	

	public function index(){
		R('Member/isMemberLogin');
		//p($this->m);
		$this->ok = M('record')->where('user_id='.$this->m['id'])->count();
		//p($this->ok);
		$this->follow = M('bookmark')->where('uid='.$this->m['id'])->count();
		$this->page_title = '会员中心';
		$this->display();
	}

	public function myShow(){
		$this->page_title = '微展示';
		$this->display();
	}

	public function redline(){
		R('Member/isMemberLogin');
		$this->page_title = '我的红线';
		$this->display();
	}

	public function redlineDetail(){
		R('Member/isMemberLogin');
		$type = I('types');
		$Data = M('redline_log');
		$perpage = 10;
		import('ORG.Util.Page');
		$where['uid'] = array('eq',session(C('USER_AUTH_KEY')));
		if($type=='free'){
			$where['types'] = array('eq','AdminFree');
			$this->page_title = '免费红线获取记录';
		}else{
			$where['types'] = array('eq','UserBuy');
			$this->page_title = '付费红线获取记录';
		}
		

		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$data = $Data->where($where)->order('id desc')->page($page.','.$Page->listRows)->select();
		$this->data = $data;
		
		$this->display();
	}

	public function redlinebuy(){
		R('Member/isMemberLogin');

		$this->page_title = '付费红线获取记录';
		$this->display();
	}


	public function yybDetail(){
		R('Member/isMemberLogin');
		$Data = M('yyb_log');
		$perpage = 10;
		import('ORG.Util.Page');
		$where['uid'] = array('eq',session(C('USER_AUTH_KEY')));

		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$data = $Data->where($where)->order('id desc')->page($page.','.$Page->listRows)->select();
		$this->data = $data;
		$this->page_title = '姻缘币消费记录';
		$this->display();
	}


	public function myUser(){
		R('Member/isMemberLogin');
		$this->follow = M('bookmark')->where('uid='.$this->m['id'])->count();
		$this->fans = M('bookmark')->where('pid='.$this->m['id'])->count();
		$this->page_title = '我的关注';
		$this->display();
	}

	public function follow(){
		R('Member/isMemberLogin');
		$db = D('followView');
		$follow = $db->where('uid='.$this->m['id'])->group('id')->select();
		//echo $db->getLastSql();
		$this->follow =$follow;
		$this->page_title = '我的关注';
		$this->display();
	}

	public function followTa(){
		R('Member/isMemberLogin');
		$db = M('bookmark');
		$pid = I('pid');
		$uid = $this->m['id'];
		$action = I('action','follow');
		$where['pid'] = array('eq',$pid);
		$where['uid'] = array('eq',$uid);
		$follow = $db->where($where)->select();
		//echo $db->getLastSql();
		//die;
		$data['pid'] = $pid;
		$data['uid'] = $uid;
		if($action=='follow'){
			if(is_null($follow)){
				$db->data($data)->add();
			}
			$data['status'] = 1;
			$data['info'] = '关注成功';
		}
		if($action=='unfollow'){
			if(is_array($follow)){
				$db->where($where)->delete();
			}
			$data['status'] = 1;
			$data['info'] = '取消关注';
		}
		
						
		$this->ajaxReturn($data,'JSON');
	}

	public function fans(){
		R('Member/isMemberLogin');
		$db = D('fansView');
		$follow = $db->where('pid='.$this->m['id'])->group('id')->select();
		//echo $db->getLastSql();
		$this->follow =$follow;
		$this->page_title = '关注我的';
		$this->display('follow');
	}

	private function order_id_gen(){	
		$id_start = date("Ymd")."000001";
		$id_end = date("Ymd")."999999";
		$db = M('orders');
		$r = $db->field('id')->where("id between '".$id_start."' and '".$id_end."'")->order('id desc')->limit(1)->select();
		if($r){
			return $r[0]['id']+1;
		}else{
			return $id_start;
		}		
	}

	public function orderPay(){
		R('Member/isMemberLogin');
		session('oid',null);
		session('oprice',null);
		$oid = I('id');
		$Data = M('orders');
		$data = $Data->find($oid);
		if(!$data){
			$this->error('订单不存在');
		}		
		if ($data['uid']!=session(C('USER_AUTH_KEY'))) {
			$this->error('没有权限');
		}

		$uid = session(C('USER_AUTH_KEY'));

		$order = $Data->find($oid);
		if(!$order)$this->error('订单出错2');
		session('oid',$order['id']);
		session('oprice',$order['pay_price']);			
		$this->redirect('/wechatPay/unifiedorder.php');				
	}


	public function order(){

		R('Member/isMemberLogin');
		$status = I('status',2,'intval');
		if($status==2){
			$where = '1';
			$where .= ' AND uid='.$this->m['id'];
		}else{
			$where = 'status='.$status;
			$where .= ' AND uid='.$this->m['id'];
		}
		$txt = array('待付款订单','已付款订单','全部订单');
		$Data = M('orders');
		$perpage = 10;
		import('ORG.Util.Page');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$data = $Data->where($where)->order('status asc,id desc')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		for ($i=0; $i < count($data); $i++) { 
			$goods = json_decode($data[$i]['goods'],true);
			$data[$i]['goods'] = $goods;
			$data[$i]['goods_count'] = count($goods);
		}
		$this->data = $data;
		//p($data);
		$this->page = $Page->show();
		$this->page_title = $txt[$status];
		$this->display();	
	}

	public function orderAdd(){
		R('Member/isMemberLogin');
		$yyb = I('yyb',1,'intval');
		if($yyb<1 ||$yyb>100){
			$this->error('请输入1-100之间的额度');
		}
		$id = $this->order_id_gen();
		$db = M('orders');
		$db->create();
		$db->goods = "充值".$yyb."姻缘币";
		$db->pay_price = $yyb;
		$db->add_time = time();
		$db->uid = $this->m['id'];
		$db->id = $id;
		$db->add();
		session('oid',$id);
		session('oprice',$yyb);
		//p($_SERVER);
		//die;
		$this->redirect('/wechatPay/unifiedorder.php');
	}

	public function orderDel(){
		R('Member/isMemberLogin');
		$id = I('id');
		M('orders')->where('id='.$id.' and status=0 and uid='.session(C('USER_AUTH_KEY')))->delete();
		$this->redirect('order');
	}

	public function vip(){
		R('Member/isMemberLogin');
		if($this->m['vip']==0){
			$this->txt1 = "您还没有开通过会员服务";
			$this->txt2 = "开通会员";
		}else{
			if($this->m['vip']<time()){
				$this->txt1 = "您的会员服务已于".date('Y/m/d H:i',$this->m['vip'])."到期";
				$this->txt2 = "重新开通会员";
			}else{
				$this->txt1 = "您的会员服务将于".date('Y/m/d H:i',$this->m['vip'])."到期";
				$this->txt2 = "我要续期";
			}
		}
		$this->page_title = '开通会员';
		$this->display();
	}

	public function vipPrice(){
		R('Member/isMemberLogin');
		$cfg = $this->cfg();
		$this->cfg = $cfg;
		$this->page_title = 'VIP价格';
		$this->display();
	}

	public function vipPay(){
		R('Member/isMemberLogin');
		$cfg = $this->cfg();
		$this->cfg = $cfg;
		$type = I('type');
		$db = M('user');
		$yybLog = M('yyb_log');
		$vip = $this->m['vip'];
		//die;
		switch ($type) {
			case 'month':
				if($this->m['balance']<$cfg['vip_price_month'])$this->error('姻缘币余额不足');
				$yyb = $cfg['vip_price_month'];
				$balance = $this->m['balance'] - $yyb;
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('balance',$balance);
				$data['uid'] = session(C('USER_AUTH_KEY'));
				$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 30*24*3600;
				}else{
					$vip = $vip + 30*24*3600;
				}
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('vip',$vip);
				break;
			case 'quarter':
				if($this->m['balance']<$cfg['vip_price_quarter'])$this->error('姻缘币余额不足');
				$yyb = $cfg['vip_price_quarter'];
				$balance = $this->m['balance'] - $yyb;
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('balance',$balance);
				$data['uid'] = session(C('USER_AUTH_KEY'));
				$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 3*30*24*3600;
				}else{
					$vip = $vip + 3*30*24*3600;
				}
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('vip',$vip);				
				break;
			case 'halfyear':
				if($this->m['balance']<$cfg['vip_price_half_year'])$this->error('姻缘币余额不足');
				$yyb = $cfg['vip_price_half_year'];
				$balance = $this->m['balance'] - $yyb;
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('balance',$balance);
				$data['uid'] = session(C('USER_AUTH_KEY'));
				$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 6*30*24*3600;
				}else{
					$vip = $vip + 6*30*24*3600;
				}
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('vip',$vip);
				break;
			case 'year':
				if($this->m['balance']<$cfg['vip_price_year'])$this->error('姻缘币余额不足');
				$yyb = $cfg['vip_price_year'];
				$balance = $this->m['balance'] - $yyb;
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('balance',$balance);
				$data['uid'] = session(C('USER_AUTH_KEY'));
				$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 12*30*24*3600;
				}else{
					$vip = $vip + 12*30*24*3600;
				}
				$db->where('id='.session(C('USER_AUTH_KEY')))->setField('vip',$vip);
				break;
		}
		$this->success('VIP会员续期成功',U('vip'));
	}

	public function newsAdd(){
		R('Member/isMemberLogin');
		$this->catlist = parent::_list2('news_cat',"1",0);
		$this->page_title = '发布活动';
		$this->display();
	}

	public function newsUpload(){
		R('Member/isMemberLogin');

		$start_time = I('start_time');
		$end_time = I('end_time');
		$start_time = strtotime($start_time);
		$end_time = strtotime($end_time);

		$p1 = '100,200,360,720';
		$p2 = '100,200,200,400';
		$prefix = 'thumb_,thumb200_,thumb300_,thumb400_';
		$img = parent::_upload('news/',$p1,$p2,$prefix);
		$db = M('news');
		$data = $db->create();

		$db->start_time = $start_time;
		$db->end_time = $end_time;
		$db->addtime = time();

		$db->userid = session(C('USER_AUTH_KEY'));
		$db->status = $this->m['status'];
		$db->img = $img;
		$db->addtime = time();
		$db->add();
		$this->success('活动发布成功，等待管理员审核',U('myNews','status=0'));
	}


	public function myNews(){
		R('Member/isMemberLogin');
		$where = "1";
		//$where = 'news.userid='.session(C('USER_AUTH_KEY'));
		//$cat = I('cat',false,'intval');
		//$status = I('status',0,'intval');
		// if($cat){
		// 	$where .= ' AND news.cat='.$cat;
		// }
		//$where .= ' AND news.status='.$status;
		//die($where);
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('recordView');
		$total = $Data->field('id')->where($where)->count();
		
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");		
		$data = $Data->where($where)->order('reg_time desc')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		//var_dump($data);
		//p($data);
		$this->data = $data;
		$this->page = $Page->show();
		$this->page_title='我的活动';
		$this->display();
	}

	public function myReg(){
		R('Member/isMemberLogin');
		$where = 'user_id='.session(C('USER_AUTH_KEY'));
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('arrivalView');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");		
		$this->data = $Data->where($where)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		//p($this->data);
		$this->page = $Page->show();
		$this->page_title='我的报名';
		$this->display();
	}


	public function myArrival(){
		R('Member/isMemberLogin');
		$where = 'arrival_time>0 AND user_id='.session(C('USER_AUTH_KEY'));
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('arrivalView');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->where($where)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		//p($this->data);
		$this->page = $Page->show();
		$this->page_title='我的签到';
		$this->display();
	}

	public function face(){
		R('Member/isMemberLogin');
		//p($this->m);
		$this->page_title = '修改头像';	
		$this->display();
	}


	public function faceUpdate(){
		R('Member/isMemberLogin');
		$img = I('img');
		$img_old = I('img_old');
		if(strlen($img_old)>0){
			$file = "./Upload/user/thumb_".$img_old;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb200_".$img_old;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb300_".$img_old;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb400_".$img_old;
			if(file_exists($file))unlink($file);
		}		
		M('user')->where('id='.session(C('USER_AUTH_KEY')))->setField('img',$img);
		$data['status'] = 1;
		$data['info'] = '上传成功';				
		$this->ajaxReturn($data,'JSON');
		//$this->success('头像设置成功',U('face'));
	}

	public function uploadRemove(){
		$img = I('img');
		if(!session('?'.C('USER_AUTH_KEY'))){
			$data['status']=0;
			$data['info']='请先登录';
			$this->ajaxReturn($data,'JSON');
		}else{		

			$file = "./Upload/user/thumb_".$img;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb200_".$img;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb300_".$img;
			if(file_exists($file))unlink($file);
			$file = "./Upload/user/thumb400_".$img;
			if(file_exists($file))unlink($file);

			$data['status']=1;
			$data['info']='删除成功';				
			$this->ajaxReturn($data,'JSON');
		}			
	}

	public function upload(){
		$p1 = '100,200,300,400';
		$p2 = '100,200,300,400';
		$prefix = 'thumb_,thumb200_,thumb300_,thumb400_';
		parent::_upload('user/',$p1,$p2,$prefix);
	}

	private function getInfo(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find(session(C('USER_AUTH_KEY')));
		$this->data = $data;
	}


	public function info(){
		
		$this->getInfo();
		$this->page_title = '会员信息';	
		$this->display();
	}

	public function info_base(){
		$this->getInfo();
		$this->page_title = '基础资料';	
		$this->display();
	}	

	public function infoUpdate(){		
		$Form = D('user');
		if($Form->create()) {
			$id = session(C('USER_AUTH_KEY'));
			$Form->save();		
			$this->success('更新成功！',U('info'));
		}else{
			$this->error($Form->getError());
			//p($Form->getError());
		}
	}

	public function pwd(){
		R('Member/isMemberLogin');
		parent::_edit('user',session(C('USER_AUTH_KEY')));
		$this->page_title = '修改密码';	
		$this->display();
	}

	public function pwdUpdate(){
		$p = I('p');
		if(strlen($p)<6)$this->error('密码不小于6位');
		$p1 = I('p1');
		$p2 = I('p2');
		if(strlen($p1)<6)$this->error('新密码必须不小于6位');
		if($p1!==$p2)$this->error('两次输入新密码不一致');
		$db = M('user');
		$map['id'] = session(C('USER_AUTH_KEY'));
		$map['password'] = md5($p);
		$map['_logic'] = 'AND';
		$result = $db->where($map)->select();
		if($result!=NULL){
			$data['id'] = $result[0]['id'];
			$data['password'] = md5($p2);
			if($db->data($data)->save()){
				$this->success('修改成功',U('index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('当前密码错误');	
		}
	}


	public function register(){
		if(session('?'.C('USER_AUTH_KEY'))){
			$this->redirect('/Member/');
		}
		$this->page_title = '用户注册';
		$this->display();
/*		$openid = I('openid',false);
		$db = M('user');
		$result = $db->where("username='".$openid."'")->select();
		if(is_null($result)){
			if(!$openid || strlen($openid)!=28)$this->error('请从微信入口进入',U('Index/index'));
			$this->openid = $openid;
			$this->page_title = '会员注册';	
			$this->display();
		}else{
			$r = $result[0];
			session('lastlogtime',$r['logtime']);
			session('lastlogip',$r['ip']);
    		$data['id'] = $r['id'];
    		$data['logtime'] = time();
    		$data['ip'] = get_client_ip();
    		$id = $db->save($data);			

			session(C('USER_AUTH_KEY'),$r['id']);
			if($r['username']==C('RBAC_SUPERADMIN')){
				session(C('ADMIN_AUTH_KEY'),true);
			}
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();

			$this->redirect('/Member/');
		}*/

	}


	public function checkregister(){


		if($this->isPost()){

	    	//$openid = I('post.openid');
	    	$email = I('post.email');
	    	$pwd = I('post.p1');
	    	$pwd2 = I('post.p2');
	    	//$promote = I('post.promote',0,'intval');

	    	if(strlen($pwd)<6||strlen($pwd)>12){
	    		$this->error('密码请使用6-12位的字符');
	    	}

	    	if($pwd!=$pwd2){
	    		$this->error('两次密码不一致');
	    	}

/*	    	if(strlen($tel)!=11){
	    		$this->error('手机号码11位');
	    	}*/
	    	$db = M('user');
	    	$map['email'] = array('eq',$email);
	    	//$map['username'] = array('eq',$openid);
	    	$map['_logic'] = 'OR';
	    	$r = $db->where($map)->find();
	    	//echo $db->getLastSql();
	    	//dump($r);
	    	//die;
	    	if(is_null($r)){
	    		$data = $db->create();
	    		//p($data);
	    		//die;
	    		$db->username = $email;
	    		$db->password = md5($pwd2);
	    		$db->email = $email;
	    		//$db->promote = $promote;
	    		$db->logtime = time();
	    		$db->ip = get_client_ip();
	    		$db->regtime = time();
	    		$id = $db->add();
	    		//echo $db->getLastSql();
	    		//dump($id);
	    		//die;
	    		if($id){
	    			session(C('USER_AUTH_KEY'),$id);
	    			$this->success('注册成功',U('index'));
	    		}else{
	    			$this->error($db->error());
	    		}
	    	}else{
	    		$this->error('注册失败，邮箱或者微信号已注册过');
	    	}
		}else{
			$this->error('参数错误');
		}

	}

	//微信登陆，插入新用户数据

	private function wxUserInsert($r){
		$db = M('user');
		$data = $db->create();
		$db->realname = $r['nickname'];
		$db->gender = $r['sex'];
		$db->openid = $r['open_id'];
		$db->address = $r['location'];
		$db->logtime = time();
		$db->ip = get_client_ip();
		$db->regtime = time();
		$id = $db->add();


		if($id){
			$pic = $this->getAvatar($r['avatar']);
			$db->where('id='.$id)->setField('img',$pic);
			return $db->find($id);
		}else{
			//$this->error($db->error());
			return false;
		}
	}


	private function getAvatar($url){
		$str = uniqid();
		$img = './Upload/user/'.$str;
		//$url = "http://wx.qlogo.cn/mmopen/ibfOkDPoWicJhkuklT0icXmMjtgBSDIyTFUIvk7oDzmn9AaEW9epS8Crct98fS6CyZEwLoQK5IA0MhhgOUCzn1WydZhxTaj2zH7/0";
		import('ORG.Net.Http');
		Http::curlDownload($url,$img);
		import('ORG.Util.Image');
		$temp = Image::getImageInfo($img);
		//var_dump($temp);
		//p($temp);
		//die;
		if($temp){
			$fn = $str.'.'.$temp['type'];
			$img400 = './Upload/user/thumb400_'.$fn;
			$img300 = './Upload/user/thumb300_'.$fn;
			$img200 = './Upload/user/thumb200_'.$fn;
			$img100 = './Upload/user/thumb_'.$fn;
			Image::thumb2($img, $img400, $temp['type'], $maxWidth=400, $maxHeight=400, $interlace=true);
			Image::thumb2($img, $img300, $temp['type'], $maxWidth=300, $maxHeight=300, $interlace=true);
			Image::thumb2($img, $img200, $temp['type'], $maxWidth=200, $maxHeight=200, $interlace=true);
			Image::thumb2($img, $img100, $temp['type'], $maxWidth=100, $maxHeight=100, $interlace=true);
			unlink($img);
			return $fn;
		}else{
			return "no_face.gif";
		}
	}


	//用户登陆，更新登陆信息

	private function wxUserUpdate($r){
		$db = M('user');
		session('lastlogtime',$r['logtime']);
		session('lastlogip',$r['ip']);
		$data['id'] = $r['id'];
		$data['logtime'] = time();
		$data['ip'] = get_client_ip();
		$db->save($data);
		return $db->find($r['id']);
	}


	//用户授权

	private function userAuth($r){
		session(C('USER_AUTH_KEY'),$r['id']);
		if($r['username']==C('RBAC_SUPERADMIN')){
			session(C('ADMIN_AUTH_KEY'),true);
		}
		import('ORG.Util.RBAC');
		RBAC::saveAccessList();
	}

	public function wxlogin(){
		//R('Member/isMemberLogin');
		if(session('?'.C('USER_AUTH_KEY'))){
			$this->redirect('/Mobile/Member/index');
		}
		import("@.Action.WechatAuth");
		$options = parent::wechat_cfg();
		$auth = new wxauth($options);
		$temp = $auth->wxuser;
		//p($temp);
		//die();
		if(is_array($temp) && $temp['subscribe']==1){
			$db = M('user');
			$re = $db->where(array('openid'=>$temp['open_id']))->find();
			//p($re);
			//echo $db->getLastSql();
			//die;
			if(is_null($re)){
				//初次登陆
				$ok = $this->wxUserInsert($temp);
				if($ok){
					$this->userAuth($ok);
					$this->redirect('index');
				}else{
					$this->error('微信授权登录失败');
				}
			}else{
				//更新登陆信息
				$this->wxUserUpdate($re);
				$this->userAuth($re);
				$this->redirect('index');
			}
			
		}else{
			$this->page_title = '请关注我们的公众号';	
			$this->display();
		}

	}

	public function login(){
		if(session('?'.C('USER_AUTH_KEY'))){
			$this->redirect('Member/index');
		}	
		$this->page_title = '会员登录';	
		$this->display();

	}

	private function _login(){
		$user = I('user','','htmlspecialchars');
    	$pwd = I('pwd');
    	$db = M('user');
    	$map['password'] = array('eq',md5($pwd));
		$map['_query'] = 'username='.$user.'&tel='.$user.'&email='.$user.'&_logic=or';
		$r = $db->where($map)->find();
		//echo $db->getLastSql();
		//die;
		if(!is_null($r)){
			/*更新用户登录信息*/

			session('lastlogtime',$r['logtime']);
			session('lastlogip',$r['ip']);
    		$data['id'] = $r['id'];
    		$data['logtime'] = time();
    		$data['ip'] = get_client_ip();
    		$id = $db->save($data);			

			session(C('USER_AUTH_KEY'),$r['id']);
			if($r['username']==C('RBAC_SUPERADMIN')){
				session(C('ADMIN_AUTH_KEY'),true);
			}
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();
			return $r;
		}else{
			return FALSE;
		}
	}


 	public function isLogin(){		
		if(session('?'.c('USER_AUTH_KEY'))){
			$data['status']=1;
			$data['id']=session(C('USER_AUTH_KEY'));
			$data['realname'] = ($this->m['realname']==''?$this->m['username']:$this->m['realname']);
			$data['tel'] = $this->m['tel'];
			$data['address'] = $this->m['address'];
		}else{
			$data['status']=0;			
		}
		$this->ajaxReturn($data,'JSON');
	}



	public function checklogin(){

			$r = $this->_login();
	    	if($r===FALSE){
	    		$this->error('账号或密码错误');
	    	}else{
				$this->redirect('/Mobile/Member/index');	
	    	}			
	}



	public function logout(){
		session_unset();
		session_destroy();
		if($cfg['wx_login']==1){
			$this->redirect('wxlogin');
		}else{
			$this->redirect('login');
		}
		//$this->redirect('login');
    }

    private function checkRole($id){
    	$m = $this->userinfo($id);
    	if($m && C('RBAC_SUPERADMIN')==$m['username']){
    		/*--超级管理员--*/
    		return -1;
    	}else{
		    $db2 = M('role_user');
			$result = $db2->where('user_id='.$id)->getField('role_id');
			if(!$result){
				/*--会员--*/
				return 0;
			}else{
				/*--员工--*/
				return $result['role_id'];			
			}
		}
    }
 	public function isMemberLogin(){		
		if(!session('?'.C('USER_AUTH_KEY'))){
			$cfg = parent::cfg();

			if($cfg['wx_login']==1){
				$this->redirect('Member/wxlogin');
			}else{
				$this->redirect('Member/login');
			}
			
		}else{
			$this->m = $this->userinfo(session(C('USER_AUTH_KEY')));
		}
	}

	public function userinfo($id){
		$m = M('user')->find($id);
		if($m){
			return $m;
		}else{
			return false;
		}
	}

	public function checkInfoComplete(){
		if(($m['realname']=='' || $m['address']=='' || $m['hub']==0) && ACTION_NAME!='info'){
			$this->error('请完善配送信息','info');
		}
	}

}

?>
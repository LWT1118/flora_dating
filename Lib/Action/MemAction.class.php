<?php
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Notify.php";
require_once "WxPay.JsApiPay.php";
require_once "./Lib/Action/weixin.php";

class MemAction extends HomeAction{

	private $account = array('account'=>'yinyuan.de@hotmail.com','password' => 'testtest1234');

	public function index(){
		R('Member/isMemberLogin');
		$timeStamp = time();
		$data = M('record')->query("select count(a.news_id) as count from wjw_record a inner join wjw_news b on a.news_id=b.id where a.user_id={$this->m['id']} and b.end_time>{$timeStamp}");
		$this->ok = $data[0]['count'];
		$baseInfo = array('nickname'=>'昵称','age'=>'年龄','gender'=>'性别','height'=>'身高','edu'=>'学历','love'=>'婚姻状况','area'=>'所在地区','realname'=>'真实姓名','wechat'=>'微信号','city'=>'所在城市','blood'=>'血型','income'=>'月薪','buyhouse'=>'购房情况','buycar'=>'购车情况','com_type'=>'公司类型','income2'=>'收入描述','Professional'=>'专业','nation'=>'民族','faith'=>'信仰','interest'=>'兴趣及爱好');
		foreach($baseInfo as $key=>$value){
			if(strval($this->m[$key]) == ''){
				$this->script = "$('#showBase').modal('show');";
				$this->scriptMsg = "您的{$value}等基本信息尚未完善，现在就去完善信息";
			}
		}
		$cfg = parent::cfg();
		$this->audit_url = empty($cfg['audit_url']) ? '未认证' : "<a href='{$cfg['audit_url']}'>未认证</a>";
		$this->follow = M('bookmark')->where('uid='.$this->m['id'])->count();
		$this->page_title = '会员中心';

		$this->display();
	}

	public function myShow(){
		R('Member/isMemberLogin');
		$this->page_title = '微展示';

		import("@.Action.WechatJssdk");
		$cfg = parent::wechat_cfg();
		$jssdk = new JSSDK($cfg['appid'], $cfg['appsecret']);
		$this->signPackage = $jssdk->GetSignPackage();	

		$this->show = M('show')->where("user_id={$this->m['id']}")->order('upload_time desc')->limit(3)->select();
		$this->display();
	}

	public function showUpload(){
		R('Member/isMemberLogin');
		if($this->isAjax()){
			//$uploadPath = dirname(__FILE__) . '/../../Upload/show/';
			$mediaId = I('serverId');
			$path = './Upload/show/';
			$filename = R('Wechat/media2server', array($mediaId, $path));
			$file = $path . $filename;
			//import('ORG.Util.Image');
			//Image::thumb2($uploadPath, $filename, '', 720, 1280, true);
			//if(file_exists($path.$old))unlink($path.$old);
			M('show')->add(array('user_id'=>$this->m['id'], 'img'=>$filename, 'upload_time'=>time()));
			$data['status'] = 1;
			$data['info'] = '上传成功';
			$data['img'] = $filename;
			$data['url'] = "/Upload/show/" . $filename;
			$this->ajaxReturn($data, 'JSON');
		}else{
			echo 'error';
		}
	}

	public function redline(){
		R('Member/isMemberLogin');
		$this->page_title = '我的红线';
		$this->display();
	}

	public function redlineDetail(){
		import('ORG.Util.Page');
		R('Member/isMemberLogin');
		$type = I('types');
		$Data = D('RedlineLog');
		$curPage = isset($_GET['p']) && intval($_GET['p']) > 0? intval($_GET['p']) : 1;
		$pageSize = 10;
		$where['uid'] = array('eq', $this->m['id']);
		$where['types'] = $type == 'free' ? array('eq','showWechatPayFree') : array('eq','showWechatPay');
		$data = $Data->relation('user')->where($where)->order('id desc')->page("{$curPage},{$pageSize}")->select();
		$this->data = $data;

		$total = $Data->where($where)->count();		
		$Page = new Page($total, $pageSize);
		/*$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");*/		
		$this->page = $Page->show();		
		$this->page_title = $type == 'free' ? '免费机会消费记录' : '付费红线消费记录';
		$this->display();
	}

    public function yyb(){
		R('Member/isMemberLogin');
		$cfg = $this->cfg();
		$this->cfg = $cfg;
		$this->page_title = '购买红线';
		$this->display();
	}

	public function yybDetail(){
		R('Member/isMemberLogin');
		$Data = M('yyb_log');
		$perpage = 10;
		import('ORG.Util.Page');
		$where['uid'] = array('eq', $this->m['id']);

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
		//var_dump($data);exit;
		$this->page_title = '红线消费记录';
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

	/*public function followTa(){
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
	}*/
	public function showWechat(){
		R('Member/isMemberLogin');
		$db = M('bookmark');
		$pid = I('pid');
		$uid = $this->m['id'];
		$user = M('user');
		$user->where($pid)->find();
		$where['pid'] = array('eq',$pid);
		$where['uid'] = array('eq',$uid);
		$follow = $db->where($where)->find();
		if(is_null($follow)){ //没查看过，或者是使用的免费机会
			//$data['status'] = 0;
			//$data['info'] = '请先关注TA';
			$wechat = M('user')->where('id='.$pid)->getField('wechat');
			if(strlen($wechat)==0){
				$data['status'] = 0;
				$data['info'] = '用户还没填写微信号';				
			}else{
				if($this->m['redlinefree'] > 0){
					M('user')->where('id='.$uid)->setDec('redlinefree');
					//if(is_null($follow)){
					$db->data(array('pid' => $pid, 'uid'=>$uid, 'wechat'=>'0'))->add();//写入bookmark表，标记已使用过免费机会
					//}
					$red['num'] = 1;
					$red['uid'] = $uid;
					$red['types'] = 'showWechatPayFree';
					$red['remarks'] = '查看微信号';
					$red['addtime'] = time();
					$red['pid'] = $pid;
					M('redline_log')->data($red)->add();
					$data['status'] = 1;
					$data['info'] = '微信号：'.$wechat;
				}elseif($this->m['redline'] > 0){
					M('user')->where('id='.$uid)->setDec('redline');
					//if(is_null($follow)){
						$db->data(array('pid' => $pid, 'uid'=>$uid, 'wechat'=>'1'))->add();//写入bookmark表，标记已付费查看过
					//}elseif($follow['wechat'] == 0){
					//	$db->where($where)->setField('wechat', 1);
					//}
					$red['num'] = 1;
					$red['uid'] = $uid;
					$red['types'] = 'showWechatPay';
					$red['remarks'] = '查看微信号';
					$red['addtime'] = time();
					$red['pid'] = $pid;
					M('redline_log')->data($red)->add();
					$data['status'] = 1;
					$data['info'] = '微信号: '.$wechat;
				}else{
					$data['status'] = 0;
					$cfg = parent::cfg();
					$days = intval($cfg['redline_free_frequence_days']);
					$lastsendtime = $this->m['lastsendtime'];
					if((time() - $lastsendtime) > $days*86400){ //修改lastsendtime用来计算剩余小时数
						$user->where("id={$uid}")->save(array('lastsendtime'=>time()));
						$lastsendtime = time();
					}					
					$hours = ceil($days * 24 - (time() - $lastsendtime)/3600);
					$data['info'] = "道具不足,{$hours}小时后赠送免费机会。点我购买红线";
				}
			}			
		}else{
			$wechat = M('user')->where('id='.$pid)->getField('wechat');
			$data['status'] = 1; //已经付费查看过，直接显示微信号
			$data['info'] = '微信号：'.$wechat;			
		}

		/*if($action=='follow'){
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
		}*/
		$this->ajaxReturn($data,'JSON');
	}

	public function complain(){
		R('Member/isMemberLogin');
		$pid = I('pid');
		$uid = $this->m['id'];
	    $redline_log = M('redline_log');
		$where['uid'] = array('eq',$uid);
		$where['pid'] = array('eq',$pid);
		//$redline_log->where($where)->find();
		if($redline_log->where($where)->find()){
			$redline_log->status  = -1;
			$redline_log->save();
			$this->success("投诉成功，请等待管理员审核");
        }
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
		$oid = I('id');
		$data = M('orders')->find($oid);
		if(is_null($data)){
			$this->error('订单不存在');
		}		
		if ($data['uid']!=$this->m['id']) {
			$this->error('没有权限');
		}
		if ($data['status']>0) {
			$this->error('该订单已经付款');
		};		
		$price = number_format(floatval($data['pay_price']), 2, '.','');
		$tools = new JsApiPay();
		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("姻缘德国-红线订单，订单总额{$price}元");
		$input->SetAttach("姻缘德国-红线订单，订单总额{$price}元");
		$input->SetOut_trade_no($oid);
		$input->SetTotal_fee($price*100);
		//$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("姻缘德国-订单，订单总额".$price."元");
		$input->SetNotify_url("http://yinyuan.de/Mobile/Wechatpay/payNotify/");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($this->open_id);
		$order = WxPayApi::unifiedOrder($input);
		if($order['result_code'] == 'FAIL'){
			$this->error($order['err_code_des']);			
		}
		//echo '<font color="#f00"><b>姻缘德国-姻缘币订单</b></font><br/>';
		//printf_info($order);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		$this->jsApiParameters = $jsApiParameters;
		//$editAddress = $tools->GetEditAddressParameters();
		$this->price = $price;
		$this->page_title = '姻缘德国-红线订单支付';
		$this->display();
	}


	public function order(){		
		R('Member/isMemberLogin');
		$oid = I('oid');
		$status = intval(I('status'));
		$order = M('orders');
		$where = "uid={$this->m['id']}";
		$txt = array('待付款订单','已付款订单','全部订单');
		//$Data = M('orders');
		$perpage = 10;
		import('ORG.Util.Page');
		$total = $order->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('上一页','&lt;');
		$Page->setConfig('首页','&lt;&lt;');
		$Page->setConfig('下一页','&gt;');
		$Page->setConfig('末页','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$data = $order->where($where)->order('add_time desc')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		for ($i=0; $i < count($data); $i++) { 
			$goods = json_decode($data[$i]['goods'],true);
			$data[$i]['goods'] = $goods;
			$data[$i]['goods_count'] = count($goods);
		}
		$this->data = $data;
		//p($data);
		$this->page = $Page->show();
		$this->page_title = '我的订单';
		$this->display();	
	}

	public function orderAdd(){
		R('Member/isMemberLogin');
		$redline = intval(I('redline',1));
		$cfg = $this->cfg();
		$redpay = $cfg['redline_price'];
		if($redline<0 ||$redline>1000){
			$this->error('请输入1-1000之间的额度');
		}
		$price = $redline*$redpay;
		$id = $this->order_id_gen();
		$db = M('orders');
		$db->create();
		$db->goods = "购买红线{$redline}根";
		$db->pay_price = $price;
		$db->add_time = time();
		$db->uid = $this->m['id'];
		$db->id = $id;
		$db->ship_fee = $redline;
		$db->status = 0;
		$db->add();
		//session('oid', $id);
		//session('oprice', $price);
		$this->redirect("/Mobile/Member/order");
	}

	public function orderDel(){
		R('Member/isMemberLogin');
		$id = I('id');
		//M('orders')->where('id='.$id.' and status=0 and uid='.$this->m['id'])->delete();
		M('orders')->where("id='{$id}'")->delete();
		$this->redirect('/Mobile/Member/order');
	}

	public function vip(){
		R('Member/isMemberLogin');
		$this->txt2 = "购买红线";
		if($this->m['vip']==0){
			$this->txt1 = "您还没有开通过会员服务";
			//$this->txt2 = "开通会员";
		}else{
			if($this->m['vip']<time()){
				$this->txt1 = "您的会员服务已于".date('Y/m/d H:i',$this->m['vip'])."到期";
				//$this->txt2 = "重新开通会员";
			}else{
				$this->txt1 = "您的会员服务将于".date('Y/m/d H:i',$this->m['vip'])."到期";
				
			}
		}
		$this->page_title = '购买红线';
		$this->display();
	}

	public function vipPrice(){
		R('Member/isMemberLogin');
		$cfg = $this->cfg();
		$this->cfg = $cfg;
		$this->page_title = '买红线赠VIP';
		$this->display();
	}

	public function vipPay(){
		R('Member/isMemberLogin');
		$cfg = $this->cfg();
		$this->cfg = $cfg;
		$type = I('type');
		$User = M('user');
		$yybLog = M('yyb_log');
		$vip = $this->m['vip'];
		//die;
		switch ($type) {
			case 'month':
				if($this->m['redline']<$cfg['vip_price_month'])$this->error('账户余额不足');
				$redpay = $cfg['vip_price_month'];
				//$redlinefree = $cfg['vip_price_month_redline'];
				$redline = $this->m['redline'] - $redbpay;

				$data['uid'] = $this->m['id'];
				//$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 30*24*3600;
				}else{
					$vip = $vip + 30*24*3600;
				}
				$temp = array('redline'=>$redline,'vip'=>$vip);
				$User->where('id='.$this->m['id'])->setField($temp);
				break;
			case 'quarter':
				if($this->m['redline']<$cfg['vip_price_quarter'])$this->error('红线余额不足');
				$redpay = $cfg['vip_price_quarter'];
				//$redlinefree = $cfg['vip_price_quarter_redline'];
				$redline = $this->m['redline'] - $redpay;
				$User->where('id='.$this->m['id'])->setField('redline',$redline);
				$data['uid'] = $this->m['id'];
				//$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 3*30*24*3600;
				}else{
					$vip = $vip + 3*30*24*3600;
				}
				$temp = array('redline'=>$redline,'vip'=>$vip);
				$User->where('id='.$this->m['id'])->setField($temp);			
				break;
			case 'halfyear':
				if($this->m['redline']<$cfg['vip_price_half_year'])$this->error('红线余额不足');
				$redpay = $cfg['vip_price_half_year'];
				//$redlinefree = $cfg['vip_price_half_year_redline'];
				$redline = $this->m['redline'] - $redpay;
				$User->where('id='.$this->m['id'])->setField('redline',$redline);
				$data['uid'] = $this->m['id'];
				//$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 6*30*24*3600;
				}else{
					$vip = $vip + 6*30*24*3600;
				}
				$temp = array('redline'=>$redline,'vip'=>$vip);
				$User->where('id='.$this->m['id'])->setField($temp);
				break;
			case 'year':
				if($this->m['redline']<$cfg['vip_price_year'])$this->error('红线余额不足');
				$redpay = $cfg['vip_price_year'];
				//$redlinefree = $cfg['vip_price_year_redline'];
				$redline = $this->m['redline'] - $redpay;
				$User->where('id='.$this->m['id'])->setField('redline',$redline);
				$data['uid'] = $this->m['id'];
				//$data['yyb'] = $yyb;
				$data['remarks'] = '购买VIP服务';
				$data['addtime'] = time();
				$yybLog->data($data)->add();
				if($vip<time()){
					$vip = time() + 12*30*24*3600;
				}else{
					$vip = $vip + 12*30*24*3600;
				}
				$temp = array('redline'=>$redline,'vip'=>$vip);
				$User->where('id='.$this->m['id'])->setField($temp);
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

		$db->userid = $this->m['id'];
		$db->status = $this->m['status'];
		$db->img = $img;
		$db->addtime = time();
		$db->add();
		$this->success('活动发布成功，等待管理员审核',U('myNews','status=0'));
	}


	public function myNews(){
		R('Member/isMemberLogin');
		$where = "record.user_id={$this->m['id']} and news.status=1";
		//$where = "1";
		//$where = 'news.user_id='.$this->m['id'];
		//$cat = I('cat',false,'intval');
		//$status = I('status',0,'intval');
		// if($cat){
		// 	$where .= ' AND news.cat='.$cat;
		// }
		//$where .= ' AND news.status=1';
		//die($where);
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('recordView');
		$total = $Data->field('id')->where($where)->count();		
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('上一页','&lt;');
		$Page->setConfig('首页','&lt;&lt;');
		$Page->setConfig('下一页','&gt;');
		$Page->setConfig('末页','&gt;&gt;');	
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
		$where = 'user_id='.$this->m['id'];
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
		$where = 'arrival_time>0 AND user_id='.$this->m['id'];
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
		
		import("@.Action.WechatJssdk");
		$cfg = parent::wechat_cfg();
		$jssdk = new JSSDK($cfg['appid'], $cfg['appsecret']);
		$this->signPackage = $jssdk->GetSignPackage();	

		$this->page_title = '修改头像';	
		$this->display();
	}

	public function WechatFaceUpload(){		
		R('Member/isMemberLogin');		
		if($this->isAjax()){
			//$uploadPath = dirname(__FILE__) . '/../../Upload/user/';
			$mediaId = I('serverId');
			$path = './Upload/user/';
			$filename = R('Wechat/media2server', array($mediaId, $path));
			$file = $path . $filename;
			//import('ORG.Util.Image');
			//Image::thumb2($uploadPath.$filename, $filename, '', 100, 100, true);
			$old = $this->m['img'];
			if(file_exists($path.$old))unlink($path.$old);
			$this->m['img'] = $filename;
			M('user')->where('id='.$this->m['id'])->setField('img',"/Upload/user/".$filename);
			$data['status'] = 1;
			$data['info'] = '上传成功';
			$data['img'] = $filename;
			$data['url'] = "/Upload/user/".$filename;
			$this->ajaxReturn($data,'JSON');		
		}else{
			echo 'error';
		}
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
		M('user')->where('id='.$this->m['id'])->setField('img',$img);
		$data['status'] = 1;
		$data['info'] = '上传成功';				
		$this->ajaxReturn($data,'JSON');
		//$this->success('头像设置成功',U('face'));
	}

	public function uploadRemove(){
		$img = I('img');
		$userId = $this->GetUserId();
		if($userId == 0){
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

	


	public function info(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		// $agent_list = M('role_user')->where('role_id=2')->getField('user_id',true);
		// //p($agent_list);
		// $map['id'] = array('in',$agent_list);
		// $this->agent = $db->where($map)->select();
		// if(is_numeric($data['hub']) && $data['hub']>0){
		// 	$this->hub_name = $db->where('id='.$data['hub'])->getField('realname');
		// }else{
		// 	$this->hub_name = '点击这里选择';
		// }
		// //$this->area = M('city')->where('class_parent_id = 233')->select();
		// $this->area = M('city')->find(1963);
		// //p($this->area);
		$this->page_title = '会员信息';	
		$this->display();
	}

	public function info_heart(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		// $agent_list = M('role_user')->where('role_id=2')->getField('user_id',true);
		// //p($agent_list);
		// $map['id'] = array('in',$agent_list);
		// $this->agent = $db->where($map)->select();
		// if(is_numeric($data['hub']) && $data['hub']>0){
		// 	$this->hub_name = $db->where('id='.$data['hub'])->getField('realname');
		// }else{
		// 	$this->hub_name = '点击这里选择';
		// }
		// //$this->area = M('city')->where('class_parent_id = 233')->select();
		// $this->area = M('city')->find(1963);
		// //p($this->area);
		$this->page_title = '内心独白';	
		$this->display();
	}

	public function info_base(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		$this->page_title = '基本信息';	
		$this->display();
	}

	public function info_request(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		$this->page_title = '择偶要求';	
		$this->display();
	}


	public function info_family(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		$this->page_title = '家庭资料';	
		$this->display();
	}

	public function info_plan(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		$this->page_title = '爱情规划';	
		$this->display();
	}

	public function info_friend(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find($this->m['id']);
		$this->data = $data;
		$this->page_title = '交友状态';	
		$this->display();
	}

	public function infoUpdate(){		
		R('Member/isMemberLogin');
		$Form = M('user');
		if($Form->create()) {			
			$Form->id = $this->m['id'];
			$Form->save();	
			M('user')->query("update wjw_user set status =0 where id=$id");
			$this->success('更新成功！',U('info'));
			//$status='待审核';
		}else{
			$this->error($Form->getError());
			//p($Form->getError());
		}
	}

	public function pwd(){
		R('Member/isMemberLogin');
		parent::_edit('user', $this->m['id']);
		$this->page_title = '修改密码';	
		$this->display();
	}

	public function pwdUpdate(){
		R('Member/isMemberLogin');
		$p = I('p');
		if(strlen($p)<6)$this->error('密码不小于6位');
		$p1 = I('p1');
		$p2 = I('p2');
		if(strlen($p1)<6)$this->error('新密码必须不小于6位');
		if($p1!==$p2)$this->error('两次输入新密码不一致');
		$db = M('user');
		$map['id'] = $this->m['id'];
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
		require_once('wechat.class.php');
		$this->cfg();
		$userId = $this->GetUserId();
		if($userId > 0){
			$this->redirect('/Mobile/Member/index');
		}

		$options = parent::wechat_cfg();
		$we_obj = new Wechat($options);
		$userInfo = $we_obj->getUserInfo($this->open_id);
		if($userInfo == false){
		}
		if($userInfo['subscribe'] == 0){
			$this->display('subscribe');
			die();
		}
		$this->img = rtrim($userInfo['headimgurl'], '0') . '132';
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
			/*if(empty($this->open_id)){
				$this->error('请先关注我们的公众号');
			}*/
	    	$email = I('post.email');
			$wechat = I('post.wechat');
	    	$pwd = I('post.p1');
	    	$pwd2 = I('post.p2');
			$telphone = I('post.tel');
			$img = I('post.img');
			$gender = I('post.gender');
			$nickname = I('post.nickname');
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
			if(empty($email)){
				$this->error('邮箱不能为空');
			}elseif(empty($wechat)){
				$this->error('微信号不能为空');
			}elseif(empty($telphone)){
				$this->error('电话不能为空');
			}elseif(empty($nickname)){
				$this->error('昵称不能为空');
			}
	    	$map['email'] = array('eq',$email);
	    	//$map['username'] = array('eq',$openid);
			if(!empty($wechat)){
				$map['wechat'] = array('eq', $wechat);
	    		$map['_logic'] = 'OR';
			}
	    	$r = $db->where($map)->find();
	    	//echo $db->getLastSql();
	    	//dump($r);
	    	if(is_null($r)){
	    		$data = $db->create();
	    		//p($data);
	    		//die;
	    		$db->username = $email;
	    		$db->password = md5($pwd2);
				$db->tel = $telphone;
	    		$db->email = $email;
				$db->gender = $gender;
	    		//$db->promote = $promote;
	    		$db->logtime = time();
				$db->img = $img;
	    		$db->ip = get_client_ip();
	    		$db->regtime = time();
				$db->openid = $this->open_id;
				$db->nickname = $nickname;
				$db->age = '0';
				$db->height = '0';
				$db->edu = '不详';
				$db->blood = '不详';
				$db->com_type = '不详';
				$db->ranking = '不详';
				$db->parent_sta = '保密';
				$cfg = parent::cfg();
				$db->redlinefree = $cfg['new_user_redline_free'];
	    		$id = $db->add();
	    		if($id){
					$weObj = $this->wechat();
					$result = $weObj->updateUserRemark($this->open_id, $this->open_id);
					$this->SetUserSession($id);
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
		$db->gender = ($r['sex']==1?'男生':'女生');
		$db->openid = $r['open_id'];
		$db->address = $r['location'];
		$db->logtime = time();
		$db->ip = get_client_ip();
		$db->regtime = time();
		$id = $db->add();



		

		if($id){
			$pic = $this->getAvatar($r['avatar']);
			$db->where('id='.$id)->setField('img',$pic);

			$arr['openid'] = $r['open_id'];
			$arr['template_id'] = parent::getTemplateid('注册成功通知');
			$arr['url'] = 'http://'.$this->_server('HTTP_HOST').'/Mobile/Member/info';
			$arr['first'] = '您已注册成功';
			$arr['kw1'] = $r['nickname'];
			$arr['kw2'] = '请尽快完善信息';
			$arr['kw3'] = date('Y-m-d');
			$arr['remark'] = '信息越丰富，获得越多关注！';
			$arr['color'] = '#0000ff';
			parent::wechatMsg($arr);

			return $db->find($id);
		}else{
			//$this->error($db->error());
			return false;
		}
	}

	private function avatarGen($img){
		$path = './Upload/user/';
		$str = uniqid();
		import('ORG.Util.Image');
		$temp = Image::getImageInfo($img);
		if($temp){
			$fn = $str.'.'.$temp['type'];
			$img400 = $path.'thumb400_'.$fn;
			$img300 = $path.'thumb300_'.$fn;
			$img200 = $path.'thumb200_'.$fn;
			$img100 = $path.'thumb_'.$fn;
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

	private function getAvatar($url){
		$str = uniqid();
		$img = './Upload/user/'.$str;
		//$url = "http://wx.qlogo.cn/mmopen/ibfOkDPoWicJhkuklT0icXmMjtgBSDIyTFUIvk7oDzmn9AaEW9epS8Crct98fS6CyZEwLoQK5IA0MhhgOUCzn1WydZhxTaj2zH7/0";
		import('ORG.Net.Http');
		Http::curlDownload($url,$img);
		import('ORG.Util.Image');
		$temp = Image::getImageInfo($img);
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
		$this->SetUserSession($r['id']);
		if($r['username']==C('RBAC_SUPERADMIN')){
			session(C('ADMIN_AUTH_KEY'),true);
		}
		import('ORG.Util.RBAC');
		RBAC::saveAccessList();
	}

	public function wxlogin(){
		//R('Member/isMemberLogin');
		$userId = $this->GetUserId();
		if($userId > 0){
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
		$userId = $this->GetUserId();
		if($userId > 0){
			$this->redirect('/Mobile/Member/index');
		}	
		$this->username = cookie('yinyuan_username');
		$this->page_title = '会员登录';	
		$this->display();

	}

	private function _login(){
		$user = I('user','','htmlspecialchars');
    	$pwd = I('pwd');
		$remember = I('remember');
    	$db = M('user');
    	$map['password'] = md5($pwd);
		//$map['_query'] = 'username='.$user.'&tel='.$user.'&email='.$user.'&_logic=or';
		$map['email'] = $user;
		$r = $db->where($map)->find();
		//echo $db->getLastSql();
		if(!is_null($r)){
			/*更新用户登录信息*/
			session('lastlogtime',$r['logtime']);
			session('lastlogip',$r['ip']);
    		$data['id'] = $r['id'];
    		$data['logtime'] = time();
    		$data['ip'] = get_client_ip();
			$lastsendtime = $r['lastsendtime'];//赠送机会
			$cfg = parent::cfg();
			$days = intval($cfg['redline_free_frequence_days']);
			if($days > 0 && time() - $r['lastsendtime'] >= 86400 * $days && $r['redlinefree'] == 0)
			{
				$data['redlinefree'] = 1;
				$data['lastsendtime'] = time();
			}	
			
    		$id = $db->save($data);
			$this->SetUserSession($r['id']);
			if($r['username']==C('RBAC_SUPERADMIN')){
				session(C('ADMIN_AUTH_KEY'),true);
			}
			if(!empty($remember)){
				cookie('yinyuan_username', $user, 999999999);
			}else{
				cookie('yinyuan_username', null);
			}
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();
			return $r;
		}else{
			return FALSE;
		}
	}


 	public function isLogin(){		
		$userId = $this->GetUserId();
		if($userId > 0){
			$data['status']=1;
			$data['id']=$userId;
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
				$this->redirect('/Mobile/Classify/index');	
	    	}			
	}
	public function sendMail(){
		$email = I('mail');
		$user = M('user');
       	if(($user->where('email="'.$email.'"')->find()) == null)
		{ 
			$this->error("该邮箱没有注册过");	
		}
		else
		{
		 $newPwd = rand(100000,999999);
		 $user->password = md5($newPwd);
		 $user->save();

	     require_once "email.class.php";
	     $smtpserver = "smtp.mxhichina.com";//SMTP服务器
	     $smtpserverport =25;//SMTP服务器端口
	     $smtpusermail = "postmaster@maibiandeguo.com";//SMTP服务器的用户邮箱
	     $smtpemailto = $email;//发送给谁
	     $smtpuser = "postmaster@maibiandeguo.com";//SMTP服务器的用户帐号
	     $smtppass = "Test123456";//SMTP服务器的用户密码
	     $mailtitle = "姻缘德国密码重置成功";//邮件主题
	     $mailcontent = "<body>尊敬的先生/女士，您好：<br>&nbsp; 您姻缘德国临时登录密码重置为:".$newPwd."，请尽快登录姻缘德国修改密码。</body>";//邮件内容
	     $mailtype = "HTML";
	     $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	     $smtp->debug = false;//是否显示发送的调试信息
	     $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	     echo "<div style='width:300px; margin:36px auto;'>";
	     if($state==""){
		    echo '<meta http-equiv=Content-Type content="text/html;charset=utf-8">';
		    echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
		    echo "<a href='index.html'>点此返回</a>";
		    exit();
	      }
		  else{
	          echo '<meta http-equiv=Content-Type content="text/html;charset=utf-8">';
	          echo "重置密码已发送至您邮箱，请查看邮件！<br>";
	          echo "<a href='index.html'>点此返回</a>";
	          echo "</div>";
         }
	  }
	}
	public function getBackPWD(){
		$this->page_title = '找回密码';
		$this->display();
	}

	public function logout(){
		session_unset();
		session_destroy();
		$this->UnsetUserSessoin();
		/*if($cfg['wx_login']==1){
			$this->redirect('wxlogin');
		}else{*/
			$this->redirect('/Mobile/Member/login');
		//}
		//$this->redirect('login');
    }

	public function wakeup(){
		R('Member/isMemberLogin');
		if($this->m['vipendtime'] < time()){
			$this->error('您不是VIP会员，不能使用唤醒功能');
		}
		$id = I('id');
		$dateModel = M('date_record');
		$record = $dateModel->where("id={$id}")->find() or die();
		$dateModel->where("id={$id}")->data(array('to_user_time'=>time()+480))->save();
		$cache = Cache::getInstance('Db');
		$cache->set("date_{$record['from_user_id']}", $record['id'], time());
		$cache->set("date_{$record['to_user_id']}", $record['id'], time());
		$wxMsger = new Weixin($this->account);
		$toUserId = $record['from_user_id'] == $this->m['id'] ? $record['to_user_id'] : $record['from_user_id'];
		$toOpenId = M('user')->where("id={$toUserId}")->getField('openid');
		$wxMsger->sendMessage($toOpenId, '对方已使用VIP功能唤醒上次约会');
		$this->message = '您已经成功唤醒';
		$this->display('wakeup');
	}


	public function protocol(){
		$this->page_title = '注册协议';
		$this->display();
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

	private function checkInfoComplete(){
		if(($m['realname']=='' || $m['tel']=='' || $m['wechat']=='') && ACTION_NAME!='info'){
			$this->error('请完善基本信息','info');
		}
	}

}

?>
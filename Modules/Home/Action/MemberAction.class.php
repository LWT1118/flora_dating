<?php

class MemberAction extends PublicAction{
	

	public function index(){
		R('Member/isMemberLogin');
		$this->ok = M('news')->where('userid='.$this->m['id'].' and status=1')->count();
		$this->bad = M('news')->where('userid='.$this->m['id'].' and status=0')->count();
		$this->page_title = '会员中心';
		$this->display();
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
		$where = 'userid='.session(C('USER_AUTH_KEY'));
		$cat = I('cat',false,'intval');
		$status = I('status',0,'intval');
		if($cat){
			$where .= ' AND news.cat='.$cat;
		}
		$where .= ' AND news.status='.$status;
		//die($where);
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = D('newsView');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");		
		$this->data = $Data->where($where)->order('id desc')->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
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


	public function info(){
		R('Member/isMemberLogin');
		$db = M('user');
		$data = $db->find(session(C('USER_AUTH_KEY')));
		$this->data = $data;
		$agent_list = M('role_user')->where('role_id=2')->getField('user_id',true);
		//p($agent_list);
		$map['id'] = array('in',$agent_list);
		$this->agent = $db->where($map)->select();
		if(is_numeric($data['hub']) && $data['hub']>0){
			$this->hub_name = $db->where('id='.$data['hub'])->getField('realname');
		}else{
			$this->hub_name = '点击这里选择';
		}
		//$this->area = M('city')->where('class_parent_id = 233')->select();
		$this->area = M('city')->find(1963);
		//p($this->area);
		$this->page_title = '会员信息';	
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
			$this->redirect('Home/Member/');
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

			$this->redirect('Home/Member/');
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


	public function login(){
		/*if(session('?'.C('USER_AUTH_KEY'))){
			$this->redirect('Home/Member/');
		}*/	
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

			/*session('lastlogtime',$r['logtime']);
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
			return $r;*/
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
				switch ($this->checkRole($r['id'])) {
					case '-1':
					case '1':
						$this->redirect('/Admin/Index/index');
						break;
					case '0':
						$this->redirect('/Home/Member/index');
						break;
					default:
						$this->redirect('/Home/Member/index');
				}	
	    	}			
	}



	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect('login');
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
			$this->error('请先登录',U('Home/Member/login'));
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

/*	public function isAdminLogin(){	
		if(!session('?'.C('USER_AUTH_KEY'))){
			$this->error('请先登录',U('Home/Member/login'));
		}else{
			if(C('USER_AUTH_ON')){
				import('ORG.Util.RBAC');
		    	RBAC::AccessDecision(GROUP_NAME)||$this->error('没有权限');
		    	//p($_SESSION);
			}
			$this->m = M('user')->find(session(C('USER_AUTH_KEY')));
		}
	}*/


}

?>
<?php

Class UserAction extends AdminAction{
	public function index(){
		$where = "1";
		$kw = I('kw','');
		if(strlen($kw)>0){
			$where .= " AND (nickname like '%".$kw."%' or address like '%".$kw."%' or email like '%".$kw."%')";
		}

		$perpage = 20;
		import('ORG.Util.Page');
		$userModel = M('user');
		$total = $userModel->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");

		
		$db = D('userRelation');
		$this->data = $db->relation(true)->where($where)->order('id desc')->page($page.','.$Page->listRows)->select();
		$this->tpl = M('wechat_tplmsg')->select();
		$this->location='用户列表';
		$this->page = $Page->show();
		$this->total = $total;
		$this->display();
	}

	public function arrivalEmpty(){
		M('user')->where('1')->setField('arrival',0);
		$this->success('修改成功！',U('index'));
	}

	public function add(){
		$this->role = M('role')->select();
		$this->location='添加成员';
		$this->display();	
	}

	public function edit($id=0){
		parent::_edit('user');
		if($this->data['vip'] == 0){
			$this->vip_type = 0;
		}else{
			$this->vip_type = ($this->data['vipendtime'] - $this->data['vip']) / 86400;
		}
		$this->role = M('role')->select();
		$this->location='成员信息编辑';
		$this->display();
	}
	public function complain(){
		import('ORG.Util.Page');
		$Data = D('RedlineLog');
		$curPage = isset($_GET['p']) && intval($_GET['p']) > 0? intval($_GET['p']) : 1;
		$pageSize = 10;
		$data = $Data->relation(true)->where("status='-1' and(types='showWechatPayFree' or types='showWechatPay')")->order('id desc')->page("{$curPage},{$pageSize}")->select();
		$total = $Data->where("status='-1' and(types='showWechatPayFree' or types='showWechatPay')")->count();		
		$Page = new Page($total, $pageSize);		
		$this->page = $Page->show();	
		$this->data = $data;
		$this->display();
	}

	public function audit(){
		$id = I('rid', 0);
		$status = I('status', 0);
		$redlineModel = M('RedlineLog');
		$redlineModel->find($id);
		$redlineModel or die();
		if($status == '2'){			
			$redlineModel->status = '2';
			$redlineModel->save();
			echo json_encode(array("err_code"=>"0"));
		}elseif($status == '1'){
			$field = '';
			if($redlineModel->types == 'showWechatPay') $field = 'redline';
			elseif($redlineModel->types == 'showWechatPayFree') $field = 'redlinefree';
			$field or die();
			M('user')->where("id={$redlineModel->uid}")->setInc($field, $redlineModel->num);
			$redlineModel->status = '1';
			$redlineModel->save();
			echo json_encode(array("err_code"=>"0"));
		}
	}

	public function redlinefree(){
		$num = I('num',0,'intval');
		$idlist = I('idlist');
		$alluser = I('alluser');
		
		if($num<1)$this->error('至少赠送1根红线');
		$redlineDB = M('redline_log');
		$userDB = M('user');
		if($alluser==1){
			$userDB->where('id>1')->setInc('redlinefree',$num);
			$data['num'] = $num;
			$data['uid'] = 0;
			$data['types'] = 'AdminFree';
			$data['remarks'] = '系统赠送红线';
			$data['addtime'] = time();
			$redlineDB->data($data)->add();
		}else{
			if($idlist=='')$this->error('至少勾选一个会员');
			$list = explode(',', $idlist);
			$where = 'id in (' . $idlist . ')';
			$userDB->where($where)->setInc('redlinefree',$num);
			//echo $userDB->getLastSql();
			foreach ($list as $v) {
				$data['num'] = $num;
				$data['uid'] = $v;
				$data['types'] = 'AdminFree';
				$data['remarks'] = '系统赠送红线';
				$data['addtime'] = time();
				$redlineDB->data($data)->add();				
			}

		}
		$this->success('红线赠送成功',U('index'));
	}


	public function tplMsgSend(){
		$title = I('title');
		$remark = I('remark');
		$template_id = I('tpl');
		$idlist = I('idlist');
		$alluser = I('alluser');
		$userDB = M('user');
		if($alluser==1){
			$openid = $userDB->where('openid is not null')->getField('openid',true);	
			//echo $userDB->getLastSql();		
		}else{
			if($idlist=='')$this->error('至少勾选一个会员');
			$list = explode(',', $idlist);
			$where = 'id in (' . $idlist . ')';
			$openid = $userDB->where($where.' AND openid is not null')->getField('openid',true);
			//echo $userDB->getLastSql();

		}
		p($openid);
		die;
		
		$this->success('消息发送完毕',U('index'));
	}

	public function statusUpdateBatch(){
		$status = I('status');
		$idlist = I('idlist');
		$alluser = I('alluser');
		$userDB = M('user');
		if($alluser==1){
			$userDB->where('id>1')->setField('status',$status);
		}else{
			if($idlist=='')$this->error('至少勾选一个会员');


			$list = explode(',', $idlist);
			$where = 'id in (' . $idlist . ')';
			$userDB->where($where)->setField('status',$status);
		}
		$this->success('审核完毕',U('index'));
	}
	

	public function update(){
		$action = I('get.action');
		
		$Form = M('user');
			//var_dump($Form);exit;;
		//$cfg=M('cfg');
		$Form->create();
		// $r['username'] = I('username');
		// $r['password'] = I('password','','md5');
		// $r['nickname'] = I('nickname','');
		// $r['position'] = I('position','');
		if($action=='add'){
			$uid = $Form->data($r)->add();
			if($uid) {
				if(isset($_POST['role'])){
					$role = I('role');
					if(is_array($role)){
						$db = M('role_user');
						$db->where("user_id=".$uid)->delete();
						foreach ($role as $value) {
							$r['role_id'] = $value;
							$r['user_id'] = $uid;
							$db->add($r);
						}
						//$db->addAll($r);
					}
				}
			}
			$this->success('添加成功！',U('index'));

		}elseif($action=='save'){
			$uid = I('id');
			//var_dump($uid);
			if(isset($_POST['role'])){
				$role = I('role');
				if(is_array($role)){
					$db = M('role_user');
					$db->where("user_id=".$uid)->delete();
					foreach ($role as $value) {
						$r['role_id'] = $value;
						$r['user_id'] = $uid;
						$db->add($r);
					}
					//$db->addAll($r);
				}
			}
			if($Form->vip > 0){
				$timestamp = time();
				$Form->vipendtime = $timestamp + 86400 * $Form->vip;
				$Form->vip = $timestamp;
			}elseif($Form->vip == 0){
				$Form->vipendtime = 0;
			}
			$Form->save();
			//$Form->error();
			$this->success('修改成功！',U('edit','id='.$uid));
		}else{
			$this->error('请选择新增还是更新！');
		}
	}

	function statusUpdate(){
		$url = $this->_server('HTTP_REFERER');
		parent::_statusUpdate('user',$url);
	}	

	function auditUpdate(){
		$url = $this->_server('HTTP_REFERER');
		parent::_auditUpdate('user',$url);
	}	

	function pwdUpdate(){
		$id = I('id',0,'intval');
		$pwd = I('pwd');
		$Data = M('user');
		$data = array('password'=>md5($pwd));
		$Data->where('id='.$id)->setField($data);
		echo "1";
	}

	function posUpdate(){
		$Data = M('user');
		foreach ($_POST as $key => $value) {
			$Data->where('id='.$key)->setField('pos',$value);
		}
		$this->success('更新成功',U('index'));
	}

	function upload(){
		parent::_upload('user/','600,300','600,300');
	}
	
	function del($id=0){
		$id = I('id',0,'intval');
		$Data = M('user');
		$data = $Data->find($id);
		if($data['username']==C('RBAC_SUPERADMIN'))$this->error('超级管理员，不能删除');
		if(strlen($data['img'])>0){
			$file = './Upload/user/'.$data['img'];
			if(file_exists($file))unlink($file);
		}
		//$where2['user_id'] = $id;
		$Data->where('id='.$id)->delete();
		//M('role_user')->where($where2)->delete();
		$this->success('操作成功！',U('index'));
	}


	function access(){
		$rid = I('rid',0,'intval');
		$role = M('role')->find($rid);
		$this->nodes = array(1=>'应用',2=>'控制器',3=>'方法');
		$access = M('access')->where('role_id='.$rid)->getField('node_id',true);
		//p($access);
		$data = M('node')->order('sort')->select();
		$data = node_merge($data,$access);
		$this->rid = I('rid',0,'intval');
		$this->data = $data;
		//p($data);
		$this->location='<b>'.$role['name'].'</b> 权限分配';
		$this->display();
	}

	function accessUpdate(){

		$rid = I('rid',0,'intval');
		$db = M('access');
		$db->where('role_id='.$rid)->delete();//删除现有权限
		foreach ($_POST['access'] as $v) {
			$temp = explode('/', $v);
			$data[] = array(
				'role_id' => $rid,
				'node_id' => $temp[0],
				'level'	  => $temp[1]
			);
		}
		//p($data);
		if($db->addAll($data)){
			$this->success('操作成功！',U('role'));
		}
	}


	function node(){
		$this->nodes = array(1=>'应用',2=>'控制器',3=>'方法');
		$data = M('node')->order('sort')->select();
		$data = node_merge($data);
		$this->data = $data;
		$this->location='节点列表';
		$this->display();
	}

	function nodeEdit(){
		$nodes = array(1=>'应用',2=>'控制器',3=>'方法');
		parent::_edit('node');
		$this->levelname = $nodes[$this->data['level']];
		$this->location = $this->levelname.'修改';
		$this->display();
	}	

	function nodeAdd(){
		$this->nodes = array(1=>'应用',2=>'控制器',3=>'方法');
		$this->pid = I('pid',0,'intval');
		$this->level = I('level',1,'intval');
		$this->location='添加'.$this->nodes[$this->level];
		$this->display();
	}

	function nodeDel(){
		$id = I('id');
		$where['id'] = $id;
		$where['pid'] = $id;
		$where['_logic'] = 'OR';
		M('node')->where($where)->delete();
		$this->success('操作成功！',U('node'));
	}

	function nodeUpdate(){
		parent::_update('node',U('node'),0);
	}

	function role(){
		$where = '1';
		parent::_list('role',$where,20,$order='id');
		$this->location='角色列表';
		$this->display();
	}

	function roleAdd(){
		$this->location='添加角色';
		$this->display();
	}

	function roleEdit(){
		parent::_edit('role');
		$this->location='角色编辑';
		$this->display();
	}	

	function roleUpdate(){
		parent::_update('role',U('role'),0);
	}

	function roleDel(){
		$id = I('id');
		$where['id'] = $id;
		$where['pid'] = $id;
		$where2['role_id'] = $id;
		$where['_logic'] = 'OR';
		M('role')->where($where)->delete();
		M('role_user')->where($where2)->delete();
		$this->success('操作成功！',U('role'));
	}

}

?>
<?php

Class IndexAction extends AdminAction{
	function index(){
		$this->location='仪表盘';
		$this->display();
	}

	function cfg(){
		parent::_edit('cfg');
		$this->location='网站参数设置';
		//p($_SERVER);
		$this->display();		
	}

	function cfgUpdate(){
		parent::_update('cfg',U('cfg','id=1'),0);
	}

	function pwd(){
		//dump($this->m);
		$this->location='修改密码';
		$this->display();
	}

	function pwdUpdate(){
		//dump($this->m);
		//die;
		$p = I('p');
		if(strlen($p)<6)$this->error('密码不小于6位');
		$p1 = I('p2');
		$p2 = I('p2');
		if(strlen($p1)<6)$this->error('新密码必须不小于6位');
		if($p1!==$p2)$this->error('两次输入新密码不一致');
		$db = M('user');
		$map['username'] = $this->m['username'];
		$map['password'] = md5($p);
		$map['_logic'] = 'AND';
		$result = $db->where($map)->select();
		if($result!=NULL){
			$data['id'] = $result[0]['id'];
			$data['password'] = md5($p2);
			if($db->data($data)->save()){
				$this->success('修改成功',U('pwd'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('当前密码错误');	
		}
		

	}

}

?>
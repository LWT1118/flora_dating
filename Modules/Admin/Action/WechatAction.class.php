<?php

Class WechatAction extends AdminAction{

	public function wechat(){
		$cfg = M('wechat_cfg')->find();
		import("@.Action.wechat");
		$options = array(
			'token'=>$cfg['token'], //填写你设定的key
	        'encodingaeskey'=>$cfg['encodingaeskey'], //填写加密用的EncodingAESKey，如接口为明文模式可忽略
	        'appid'=>$cfg['appid'], //填写高级调用功能的app id, 请在微信开发模式后台查询
			'appsecret'=>$cfg['appsecret']
		);
		return new Wechat($options);
	}

	public function menuAdd(){
		$pid = I('pid',0);
		if($pid==0){
			$this->location='添加自定义菜单';
		}else{		
			$title = M('wechat_menu')->where('id='.$pid)->getField('title');
			$this->alert = '添加了子菜单的菜单的现有属性会被自动屏蔽';
			$this->location='为菜单 '.$title.' 添加子菜单';
		}
		$this->pid = $pid;
 		$this->display();		
	}

	public function tplMsg(){
		$where = "1";
		$perpage = 20;
		import('ORG.Util.Page');
		$Data = M('wechat_tplmsg');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->where($where)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		$this->page = $Page->show();
		$this->location='消息模板';
		$this->display();
	}

	public function tplMsgAdd(){
		$this->location='添加新消息模板';
		$this->display();
	}

	public function tplMsgEdit(){
		parent::_edit('wechat_tplmsg');
		$this->location='编辑消息模板';
		$this->display();
	}

	public function tplMsgEditHandle(){
		parent::_update('wechat_tplmsg',U('tplMsg'),0);
	}

	function tplMsgAddHandle(){
		$db = M('wechat_tplmsg');
		//$db->create();
		$data['id'] = I('id');
		$data['title'] = I('title');
		$data['cat'] = I('cat');
		$data['addtime'] = time();
		$db->data($data)->add();
		$this->success('添加成功',U('tplMsg'));
	}


	function menuAddHandle(){
		$db = M('wechat_menu');
		$pid = I('pid',0);

		$count = $db->where('pid='.$pid)->count();

		if($pid==0 && $count>=3){
			$this->error('顶级菜单最多3个');
		}elseif($pid>0 && $count>=5){
			$this->error('二级菜单最多5个');
		}else{
			$data = $db->create();
			$db->add();
			$this->success('添加成功',U('menu'));
		}
	}

	function menuEdit(){
		parent::_edit('wechat_menu');
 		$this->display();		
	}

	function menuEditHandle(){
		$db = M('wechat_menu');
		$id = I('id',0);
		$pid = I('pid',0);


			$data = $db->create();
			$db->save();
			$this->success('修改成功',U('menu'));

	}

	function menuCreate(){
		$db = M('wechat_menu');
		$menu = $db->where('pid=0')->order('pos')->select();
		$submenu = $db->where('pid>0')->order('pos')->select();
		//p($submenu);
		$arr = array();
		foreach ($menu as $v) {
			$sb = false;
			$subarr = array();
			foreach ($submenu as $sub) {
				if($sub['pid']==$v['id']){
					$sb = true;
					if($sub['types']=='view'){
						$subarr[] = array(
							"type"=>"view",
							"name"=>$sub['title'],
							"url"=>$sub['val']
						);
					}else{
						$subarr[] = array(
							"type"=>"click",
							"name"=>$sub['title'],
							"key"=>$sub['val']
						);						
					}

				}
			}
			if($sb){//有子菜单的
				$arr[] = array(
					'name' => $v['title'],
					'sub_button' => $subarr
				);
			}else{//没有子菜单

				if($v['types']=='view'){
					$arr[] = array(
						"type"=>"view",
						"name"=>$v['title'],
						"url"=>$v['val']
					);
				}else{
					$arr[] = array(
						"type"=>"click",
						"name"=>$v['title'],
						"key"=>$v['val']
					);						
				}

			}
		}
		$data = array("button"=>$arr);
		$weObj = $this->wechat();
		if($weObj->createMenu($data))
			$this->success('自定义菜单设置成功',U('menu'));
		else
			$this->error('自定义菜单设置失败:'. $weObj->errMsg,U('menu'));
	}

	function menu(){
 		parent::_list('wechat_menu','1',100,'pos',1);
 		$this->location='微信自定义菜单';
 		//p($this->data);
 		$this->display();
	}

	function menuDel(){
		$id = I('id');
		M('wechat_menu')->where('id='.$id)->delete();
		$this->success('删除成功',U('menu'));
	}

	function menuPosUpdate(){//更新排序
		$p = I('p',1);
		$Data = M('wechat_menu');
		$id = I('id');
		$pos = I('pos');
		for($i=0;$i<count($id);$i++){
			$data['pos'] = $pos[$i];
			$Data->where('id='.$id[$i])->save($data);
		}
		$this->success('更新成功',U('menu','p='.$p));
	}


	function cfg(){
		parent::_edit('wechat_cfg');
		$this->location='微信接口设置';
		//p($_SERVER);
		$this->display();		
	}

	function cfgUpdate(){
		parent::_update('wechat_cfg',U('cfg','id=1'),0);
	}

	function index(){
		$where='1';
		$Data = M('wechat');
		$this->data = $Data->where($where)->select();
		//echo $Data->getLastSql();
		$this->pid = $cat;
		$this->location=' 图文列表';
		$this->display();
	}

	function add(){
		$Data = M('wechat');
		$this->reply = $Data->where("img<>''")->select();
		//echo $Data->getLastSql();
		$this->location='添加图文';
		$this->display();
	}

	function edit($id=0){
		$Data = M('wechat');
		$this->reply = $Data->where("img<>'' and id<>".I('id'))->select();
		parent::_edit('wechat');
		//dump($this->catlist);
		$this->location='文章编辑';
		$this->display();
	}



	function update(){
		parent::_update('wechat',U('index'),0);
	}

	function statusUpdate(){
		parent::_statusUpdate('wechat',U('index'));
	}


	function upload(){
		$p1 = '720,200';
		$p2 = '400,200';
		$prefix = 'thumb_,thumb200_';
		parent::_upload('wechat/',$p1,$p2,$prefix);
	}


	function del(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$obj = M('wechat');
		$data = $obj->find($id);
		$img = './Upload/wechat/thumb200_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);
		$img = './Upload/wechat/thumb_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);			
		$obj->where('id='.$id)->delete();//删除主表中数据
		$this->success('操作成功',U('index','p='.$p));
	}
}

?>
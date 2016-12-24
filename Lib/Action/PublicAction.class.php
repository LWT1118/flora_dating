<?php

class PublicAction extends Action{

	protected $open_id = null;
	//配置信息

	public function cfg(){
		$cfg = M('cfg')->find(1);
		//var_dump($cfg);exit;
		//p($cfg);
		return $cfg;
	}

	public function wechat_cfg(){
		$cfg = M('wechat_cfg')->find(1);
		//p($cfg);
		return $cfg;
	}

	protected function SetUserSession($userId){
		$cache = Cache::getInstance('Db');
		$cache->set($this->open_id, $userId, intval(C('DATA_CACHE_TIME')));
	}

	protected function UnsetUserSessoin(){
		$cache = Cache::getInstance('Db');
		$cache->rm($this->open_id);
	}

	protected function GetUserId($openId = null){
		$key = $openId == null ? $this->open_id : $openId;
		$cache = Cache::getInstance('Db');
		$userId = intval($cache->get($key));
		if($userId > 0){
			$cache->set($key, $userId, intval(C('DATA_CACHE_TIME'))); //访问一次将缓存延长30分钟，模拟session
		}
		return $userId;
	}

	public function wechat(){
		$cfg = $this->wechat_cfg();
		import("@.Action.wechat");		
		$options = array(
			'token'=>$cfg['token'], //填写你设定的key
	        'encodingaeskey'=>$cfg['encodingaeskey'], //填写加密用的EncodingAESKey，如接口为明文模式可忽略
	        'appid'=>$cfg['appid'], //填写高级调用功能的app id, 请在微信开发模式后台查询
			'appsecret'=>$cfg['appsecret']
		);
		return new Wechat($options);
	}


	public function getTemplateid($title){
		$db = M('wechat_tplmsg');
		$tpl = $db->where(array('title'=>$title))->find();
		//echo $db->getLastSql();
		return $tpl['id'];
	}

	public function wechatMsg($arr){

		$weObj = $this->wechat();
		$str = array(
			"touser" => $arr['openid'],
			"template_id" => $arr['template_id'],
			"url" => $arr['url'],
           	"topcolor" => "#0000FF",
			"data" => array(
				"first" => array(
					"value" => $arr['first'],
					"color" => $arr['color'],
				),
				"keyword1" => array(
					"value" => $arr['kw1'],
					"color" => $arr['color'],
				),
				"keyword2" => array(
					"value" => $arr['kw2'],
					"color" => $arr['color'],
				),
				"keyword3" => array(
					"value" => $arr['kw3'],
					"color" => $arr['color'],
				),
				"keyword4" => array(
					"value" => $arr['kw4'],
					"color" => $arr['color'],
				),
				"remark" => array(
					"value" => $arr['remark'],
					"color" => $arr['color'],
				),
			),
		);
		$result = $weObj->sendTemplateMessage($str);
		//var_dump($result);
	}



	/*购物车*/
	public function bonycart(){
		import("@.Action.BonyCart");
		$cart = new mycart();
		return $cart;
	}

	/*图片验证码*/
	Public function verify(){
	    import('ORG.Util.Image');
	    Image::buildImageVerify(4,1,'png',60,32);
	}

	/*带有分页的内容列表*/
	public function _list($table='',$where='1',$perpage=10,$order='pos asc,id desc',$recursion=0){
		import('ORG.Util.Page');
		$Data = M($table);	
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$data = $Data->field(true)->where($where)->order($order)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		if($recursion==1)$data = infiniteCategory($data);
        $this->data = $data;
		$this->page = $Page->show();
	}


	/*有递归功能的列表*/
	public function _list2($table='',$where='1',$recursion=0){
		$Data = M($table);
		$data = $Data->where($where)->select();
		if($recursion==1)$data = infiniteCategory($data);
        return $data;
	}

	/*最新N条记录的列表*/
	public function _last($table='',$where='1',$order='',$limit=10){
		$Data = M($table);
		$data = $Data->where($where)->order($order)->limit($limit)->select();
		return $data;
	}


	public function _edit($table='',$session=false){
		if($this->isGet()){
			if($session){
				$id = $session;
			}else{
				$id = I('id');
			}
			$Data = M($table);
			$data = $Data->find($id);
			if($data){
				$this->data =$data;
			}else{
				$this->error('内容不存在');
			}
			 
		}else{
			$this->error('参数错误');
		}
	}


	public function _statusUpdate($table='',$url='#'){
		$id = I('id',0,'intval');
		$status = I('status',0,'intval');
		if($status==0){
			$value=1;
		}else{
			$value=0;
		}
		$Data = M($table);
		$Data->where('id='.$id)->setField('status',$value);
		$this->success('更新成功',$url);
	}	
	
	public function _auditUpdate($table='',$url='#'){
		$id = I('id',0,'intval');
		$audit = I('audit',0,'intval');
		if($audit==0){
			$value=1;
		}else{
			$value=0;
		}
		$Data = M($table);
		$Data->where('id='.$id)->setField('audit',$value);
		$this->success('更新成功',$url);
	}	

	public function _update($table='',$url='#',$ext=0){
		$action = I('get.action','save');
		$Form   =   D($table);
		if($Form->create()) {
			if($action=='add'){
				$result = $Form->add();
				if($result) {

					if($ext){
						$c = I('c');
						if(is_array($c)){
							$db = M('relationship');
							$db->where("pid=".$id)->delete();
							foreach ($c as $key => $value) {
								$r['pid'] = $result;
								$r['cid'] = $value;
								$db->data($r)->add();
								//echo $db->getLastSql();
							}
							//die;
						}
					}
					$this->success('操作成功！',$url);
				}else{
					$this->error('写入错误！');
				}
			}elseif($action=='save'){
				$id = I('post.id',0,'intval');
				if($ext){
					$c = I('c');
					if(is_array($c)){
						$db = M('relationship');
						$db->where("pid=".$id)->delete();
						foreach ($c as $key => $value) {
							$r['pid'] = $id;
							$r['cid'] = $value;
							$db->data($r)->add();
							//echo $db->getLastSql();
						}
						//die;
					}
				}
				$result = $Form->save();
				$this->success('操作成功！',$url);
			}else{
				$this->error('请选择新增还是更新！');
			}
		}else{
			$this->error($Form->getError());
		}	
	}

	public function _upload($path,$w=200,$h=200,$prefix='thumb_'){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 2*1024*768 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Upload/' . $path;// 设置附件上传目录
		$upload->thumb = true;
		$upload->thumbMaxWidth = $w;
		$upload->thumbMaxHeight = $h;
		$upload->thumbRemoveOrigin = true;
		$upload->thumbPrefix = $prefix; //缩略图前缀
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			echo $info[0]['savename'];
			return $info[0]['savename']; 
		}
	}	

	public function _del($table,$url){
		$id = I('id',0,'intval');
		$Data = M($table);
		$Data->where('id='.$id)->delete();
		$this->success('操作成功！',$url);
	}

}


?>
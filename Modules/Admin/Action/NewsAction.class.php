<?php
require_once('./Modules/Home/Action/weixin.php');
require_once('./Modules/Admin/Action/Excel_XML.php');
Class NewsAction extends AdminAction{

	private $account = array('account'=>'yinyuan.de@hotmail.com','password' => 'testtest1234');

	function test(){
		$db = M('record');
		$where['reg_time']=array('gt',0);
		$x = $db->where($where)->getField('user_id',true);	
		echo $db->getLastSql();
		p($x);
	}

	function regList(){
		$news_id = I('newsid');
		$this->news = M('news')->field('id,title')->find($news_id);
		$db = M('record');
		$where['news_id']=array('eq',$news_id);
		$where['reg_time']=array('gt',0);
		$arr = array();
		$userlist = $db->where($where)->field('user_id')->select();
		foreach ($userlist as $key => $value) {
			$arr[]=$value['user_id'];
		}
		$where2['id'] = array('in',$arr);
		$db = D('userRelation');
		$this->data = $db->relation(true)->where($where2)->select();
		//p($this->data);
		$this->location='报名清单';
		$this->display();
	}

	function excel(){
		$news_id = $_GET['id'];
		$news = M('news')->field('id,title')->find($news_id);
		$db = M('record');
		$where['news_id']=array('eq',$news_id);
		$where['reg_time']=array('gt',0);
		$arr = array();
		$userlist = $db->where($where)->field('user_id')->select();
		foreach ($userlist as $key => $value) {
			$arr[]=$value['user_id'];
		}
		$where2['id'] = array('in',$arr);
		$db = D('userRelation');
		$data = $db->relation(true)->where($where2)->select();
		$array = array('nickname'=>'昵称', 'realname'=>'真实姓名', 'gender'=>'性别', 'tel'=>'电话', 'username'=>'email', 'wechat'=>'微信号');
		$rows = array(1 => array_values($array));
		foreach($data as $value){
			$row = array();
			foreach($array as $key=>$v){
				$row[] = $key == 'gender' ? ($value[$key] == '0' ? '男' : '女') : $value[$key];
			}
			$rows[] = $row;
		}
		$xls = new Excel_XML('UTF-8', false, "用户列表-{$news['title']}");
		$xls->addArray($rows);
		$xls->generateXML("用户列表-{$news['title']}");
	}

	function msg(){		
		$newsId = $_GET['id'];
		$content = I('content');
		if(empty($content)){
			$this->error('发送内容不能为空');
		}
		$where['news_id'] = array('eq', $newsId);
		$where['reg_time'] = array('gt', 0);
		$userList = M('record')->where($where)->field('user_id')->select();
		$userModel = M('user');
		$wxMsger = new Weixin($this->account);
		foreach ($userList as $key => $value) {
			$openId = $userModel->where("id={$value['user_id']}")->getField('openid');
			$wxMsger->sendMessage($openId, $content);
		}
		$this->success('发送成功');
	}

	function arrList(){
		$news_id = I('newsid');
		$this->news = M('news')->field('id,title')->find($news_id);
		$db = M('record');
		$where['news_id']=array('eq',$news_id);
		$where['reg_time']=array('gt',0);
		$where['arrival_time']=array('gt',0);
		$arr = array();
		$userlist = $db->where($where)->field('user_id')->select();
		//echo $db->getLastSql();
		//p($userlist);
		foreach ($userlist as $key => $value) {
			$arr[]=$value['user_id'];
		}
		$where2['id'] = array('in',$arr);
		$db = D('userRelation');
		$this->data = $db->relation(true)->where($where2)->select();
		$this->location='签到清单';
		$this->display();
	}



	function index(){
		$cat = I('cat',false,'intval');
		if($cat){
			$where='news.cat='.$cat;
		}else{
			$where='1';
		}
		//$where = '1';
		$perpage = 20;
		import('ORG.Util.Page');
		$Data = D('newsView');
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$this->data = $Data->where($where)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		$this->page = $Page->show();
		$this->location='活动列表';
		$this->display();
	}

	function add(){
		$this->catlist = parent::_list2('news_cat',"1",0);
		$this->location='添加活动';
		$this->display();
	}

	function edit($id=0){
		parent::_edit('news');	
		$this->catlist = parent::_list2('news_cat',"1",0);
		//dump($this->catlist);
		$this->location='活动编辑';
		$this->display();
	}

	function qrcode(){
		$id = I('id');
		$str = 'http://'.$this->_server('HTTP_HOST').'/'.U('Home/News/arrival','id='.$id);
		//$str = urlencode('http://'.$this->_server('HTTP_HOST').'/'.U('Home/News/arrival','id='.$id));
/*		$src = "./Upload/qrcode/qr_".$id.".png";
		if(!file_exists($src)){
			$str = urlencode('http://'.$this->_server('HTTP_HOST').'/'.U('Home/News/arrival','id='.$id));
			//echo $str;
			$url = "http://qr.liantu.com/api.php?w=640&h=640&text=".$str;
			import('ORG.Net.Http');
			$img = Http::curlDownload($url,$src);	
		}
		$this->src = "/Upload/qrcode/qr_".$id.".png";
		$this->display();*/

		vendor("phpqrcode.phpqrcode");
        //$data = 'http://www.baidu.com';
        // 纠错级别：L、M、Q、H
        $level = 'L';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 10;
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        //$path = "images/";
        // 生成的文件名
        //$fileName = $path.$size.'.png';
        QRcode::png($str, false, $level, $size);


	}


	function update(){
		$id = I('id',NULL);
		$p = I('p',1);
		$start_time = I('start_time');
		$end_time = I('end_time');
		$start_time = strtotime($start_time);
		$end_time = strtotime($end_time);
		$db = M('news');
		$data = $db->create();
		$db->start_time = $start_time;
		$db->end_time = $end_time;
		$db->addtime = time();
		if(is_null($id)){
			$db->add();
			$this->success('发布成功',U('index'));
		}else{
			$db->save();
			$this->success('更新成功',U('index','p='.$p));
		}
	}

	function statusUpdate(){
		parent::_statusUpdate('news',U('index'));
	}

	function posUpdate(){//更新排序
		$p = I('p',1);
		$Data = M('news');
		$id = I('id');
		$pos = I('pos');
		for($i=0;$i<count($id);$i++){
			$data['pos'] = $pos[$i];
			$Data->where('id='.$id[$i])->save($data);
		}
		$this->success('更新成功',U('index','p='.$p));
	}


	function upload(){
		$p1 = '100,200,360,720';
		$p2 = '100,200,200,400';
		$prefix = 'thumb_,thumb200_,thumb300_,thumb400_';
		parent::_upload('news/',$p1,$p2,$prefix);
	}

	function del(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$obj = M('news');
		$data = $obj->find($id);

		$img = './Upload/news/thumb_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);

		$img = './Upload/news/thumb200_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);

		$img = './Upload/news/thumb300_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);

		$img = './Upload/news/thumb400_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);
			
		$obj->where('id='.$id)->delete();//删除主表中数据
		M('record')->where('news_id='.$id)->delete();//删除记录表中的相关数据
		
		$this->success('操作成功',U('index','p='.$p));
	}


	function catList(){
		parent::_list('news_cat',1,20,'pos asc',1);
		$this->location='活动分类';
		$this->display();
	}

	function catAdd(){
		$this->location='添加活动分类';
		$this->display();
	}

	function catEdit($id=0){
		parent::_edit('news_cat');
		//dump($this->data);
		if($this->data['header']==1)$this->header = 'checked=checked';
		if($this->data['footer']==1)$this->footer = 'checked=checked';
		if($this->data['home']==1)$this->home = 'checked=checked';	
		$this->location='活动分类编辑';
		$this->display();
	}

	function catUpdate(){
		$action = I('get.action','save');
		$data['cat'] = I('cat');
		$data['remarks'] = I('remarks');
		$data['pos'] = I('pos');
		$data['img'] = I('img');
		if(isset($_POST['header'])){
			$data['header'] = 1;
		}else{
			$data['header'] = 0;
		}
		if(isset($_POST['footer'])){
			$data['footer'] = 1;
		}else{
			$data['footer'] = 0;
		}
		if(isset($_POST['home'])){
			$data['home'] = 1;
		}else{
			$data['home'] = 0;
		}		
		$Form   =   D('news_cat');
		if($Form->create()) {
			if($action=='add'){
				$result = $Form->add($data);
				if($result) {
					$this->success('操作成功！',U('News/catList'));
				}else{
					$this->error('写入错误！');
				}
			}elseif($action=='save'){
				$id = I('post.id',0,'intval');
				$result = $Form->where('id='.$id)->save($data);
				$this->success('操作成功！',U('News/catList'));
			}else{
				$this->error('请选择新增还是更新！');
			}
		}else{
			$this->error($Form->getError());
		}
	}

	function catStatusUpdate(){
		$id = I('id');
		$pos = I('pos');
		$v = I('v');
		$v == 0 ? $v = 1 : $v = 0 ;
		$data[$pos] = $v;
		$Form   =   M('news_cat');
		$result = $Form->where('id='.$id)->save($data);
		if($result) {
			$this->success('操作成功！',U('News/catList'));
		}else{
			$this->error($Form->getError());
		}
	}

	function catPosUpdate(){
		$Data = M('news_cat');
		foreach ($_POST as $key => $value) {
			$data['pos'] = $value;
			$Data->where('id='.$key)->save($data);
		}
		$this->success('更新成功',U('catList'));
	}



	function catUpload(){
		$w = I('w',1200,'intval');
		$h = I('h',600,'intval');
		$w2 = I('w2',300,'intval');
		$h2 = I('h2',150,'intval');
		$p1 = $w.','.$w2;
		$p2 = $h.','.$h2;
		parent::_upload('cat/',$p1,$p2);
	}

	function catDel(){
		$id = I('id',0,'intval');
		$p = I('p',1,'intval');
		$obj = M('news_cat');
		$data = $obj->find($id);
		$img = './Upload/cat/'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);
		$img = './Upload/cat/thumb_'.$data['img'];
		if(strlen($data['img'])>0 && file_exists($img))unlink($img);			
		$obj->where('id='.$id)->delete();//删除主表中数据
		$this->success('操作成功',U('catList','p='.$p));
	}


}

?>
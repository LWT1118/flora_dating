<?php

class NewsAction extends PublicAction{

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
		$id = I('id',0,'intval');
		if($id==0){
			$this->error('您查看的内容不存在');
		}else{
			if(session('?'.C('USER_AUTH_KEY'))){
				$user_id = session(C('USER_AUTH_KEY'));
				$Record = M('record');
				$reg = $Record->where("user_id='".$user_id."' and news_id='".$id."'")->count();
				if($reg>0){
					$this->reg = 1;
				}else{
					$this->reg = 0;
				}
			}else{
				$this->reg = 0;
			}
			$news = M('news')->find($id);
			if($news['status']==0)$this->error('该活动还未通过管理员审核');
			$this->news = $news;			
			$this->more = M('news')->field('content',true)->where("id<>$id and status=1")->limit(6)->order('reg desc')->select();
			$this->page_title = $this->news['title'];
			$this->display();
		}
	}


	public function search(){
		$kw = I('kw','','htmlspecialchars');
		if($kw=='')$this->error('请输入搜索关键词');
		$where['title|summary|content'] = array('like','%'.$kw.'%','OR');
		//$where['summary'] = array('like','%'.$kw.'%','OR');
		//$where['content'] = array('like','%'.$kw.'%','OR');
		$where['status'] = array('eq',1,'AND');

		$order = "id desc";
		$perpage = 6;
		import('ORG.Util.Page');
		$Data = M('news');	
		$total = $Data->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);

		$Page->setConfig('prev','&lt;');
		$Page->setConfig('first','&lt;&lt;');
		$Page->setConfig('next','&gt;');
		$Page->setConfig('last','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		
		$data = $Data->field('content',true)->where($where)->order($order)->page($page.','.$Page->listRows)->select();
		//echo $Data->getLastSql();
		//p($data);
		$this->data = $data;
		$this->page_title = '关键词 '.$kw.' 搜索结果';
		$this->assign('empty','<p class="text-center pd24">没有数据</p>');	
		$this->page = $Page->show();
		$this->display();
	}



	public function reg(){
		$this->redirect('/Home/Index/qrcode');
		// R('Member/isMemberLogin');
		// $news_id = I('id',0,'intval');
		// $user_id = session(C('USER_AUTH_KEY'));
		// $News = M('news');
		// $User = M('user');
		// $Record = M('record');
		// $result = $News->where('status=1')->find($news_id);
		// if($result){

		// 	$reg = $Record->where("user_id='".$user_id."' and news_id='".$news_id."'")->count();

		// 	/*如果没有记录，就报名*/
		// 	if($reg==0){
		// 		$data['news_id'] = $news_id;
		// 		$data['user_id'] = $user_id;
		// 		$data['reg_time'] = time();
		// 		$data['arrival_time'] = 0;
		// 		$Record->data($data)->add();
		// 		/*更新活动的报名人数*/
		// 		$News->where('id='.$news_id)->setInc('reg');
		// 		/*更新用户的报名次数*/
		// 		$User->where('id='.$user_id)->setInc('reg');


		// 		$this->success('恭喜你，报名成功',U('Home/News/detail','id='.$news_id));
				
				
		// 	}else{
		// 		$this->error('您已经报过名到了');
		// 	}
		// }else{
		// 	$this->error('活动不存在或者已经结束');
		// }
	}



	public function arrival(){
		R('Member/isMemberLogin');
		$news_id = I('id',0,'intval');
		$user_id = session(C('USER_AUTH_KEY'));
		$News = M('news');
		$User = M('user');
		$Record = M('record');
		$result = $News->where('status=1 and id='.$news_id)->find();
		if($result){

			$reg = $Record->where("user_id='".$user_id."' and news_id='".$news_id."'")->count();

			/*如果没有记录，就是报名签到一起来*/
			if($reg==0){
				$data['news_id'] = $news_id;
				$data['user_id'] = $user_id;
				$data['reg_time'] = time();
				$data['arrival_time'] = time();
				$Record->data($data)->add();
				/*更新活动的签到人数和报名人数*/
				$News->where('id='.$news_id)->setInc('reg');
				$News->where('id='.$news_id)->setInc('arrival');
				/*更新用户的签到次数和报名次数*/
				$User->where('id='.$user_id)->setInc('reg');
				$User->where('id='.$user_id)->setInc('arrival');


				$this->success('恭喜你，报名并签到成功',U('Home/News/detail','id='.$news_id));
				
				
			}else{
				/*如果有记录，检查签到时间*/
				$reg2 = $Record->where("user_id='".$user_id."' and news_id='".$news_id."'")->getField('arrival_time');
				//die($reg2);
				/*签到时间为0，签到，更新数据*/
				if($reg2==0){
					$Record->where("user_id='".$user_id."' and news_id='".$news_id."'")->setField('arrival_time',time());
					$User->where('id='.$user_id)->setInc('arrival');
					$News->where('id='.$news_id)->setInc('arrival');
					$this->success('恭喜你，签到成功',U('Home/News/detail','id='.$news_id));
				}else{
					$this->error('您已经签过到了');
				}
			}
		}else{
			$this->error('活动不存在或者已经结束');
		}
	}

}

?>
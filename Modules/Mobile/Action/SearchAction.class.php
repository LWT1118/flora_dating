<?php

class SearchAction extends HomeAction{

	public function index(){
		$this->user = M('user')->field('id,realname,img,age,height,edu,income,love,interest,area,city')->where("1")->order('arrival desc')->limit(5)->select();
		//p($this->user);
		$this->page_title = '会员搜索';
		$this->display();
	}

	public function advance(){
		R('Member/isMemberLogin');
		// if($this->m['vip']<time){
		// 	$this->error('高级搜索只对VIP会员开放');
		// }
		$this->edu = C('edu');
		$this->income = C('income');
		$this->love = C('love');
		//p($this->edu);
		$this->page_title = '高级搜索';
		$this->display();
	}

	public function search(){
		$kw = I('kw');
		$gender = I('gender');
		//$where['realname'] = array('like','%'.$kw.'%');
		if(strlen($gender)>0){
			$where['gender'] = array('eq',$gender);
		}
		$where['status'] = array('eq','1');
		$where['interest'] = array('like','%'.$kw.'%');
		$where['_logic'] = 'AND';
		$db = M('user');
		$data = $db->field('id,realname,img,age,height,edu,income,love,interest,area,city')->where($where)->limit(10)->select();
		//var_dump($data);
		if(is_null($data)){
			$this->notice = "推荐用户";
			$data = $db->field('id,realname,img,age,height,edu,income,interest,area,city')->where("status=1")->limit(10)->select();
		}else{
			$this->notice = "搜索结果";
		}
		$this->user = $data;
		$this->kw = $kw;
		$this->gender = $gender;
		//echo $db->getlastSql();
		$this->page_title = '搜索';
		$this->display();
	}

	public function getRandValues($array, $length){
		if(count($array) <= $length){
			return $array;
		}
		$randKeys = array_rand($array, $length);
		$data = array();
		foreach($randKeys as $key){
			$data[] = $array[$key];
		}
		return $data;
	}

	public function vipsearch(){
		R('Member/isMemberLogin');
		$this->h3 = '搜索结果';
		$this->page_title = '高级搜索';
		// if($this->m['vip']<time()){
		// 	$this->error('高级搜索只对VIP会员开放');
		// }
		$kw = I('kw');
		$gender = I('gender');
		$height1 = intval(I('height1'));
		$height2 = intval(I('height2'));
		$age1 = intval(I('age1'));
		$age2 = intval(I('age2'));
		$edu = I('edu');
		$income = I('income');
		//$love = I('love');
		$area = I('area');
		$where['id'] = array('neq', $this->m['id']);		
		if(strlen($area)>0){
			$where['area'] = array('eq',$area);
		}
		if(strlen($edu)>0){
			$where['edu'] = array('eq',$edu);
		}
		if(strlen($income)>0){
			$where['income'] = array('eq',$income);
		}		
		if(is_array($_POST['love'])){
			$where['love'] = array('in', $_POST['love']);
		}
		if($gender != ''){
			$where['gender'] = array('eq',$gender);
		}
		if($age1 > 0 && $age2 == 0){
			$where['age'] = array('between',array($age1, 9999));
		}elseif($age1 == 0 && $age2 > 0){
			$where['age'] = array('between',array(0, $age2));
		}elseif($age1 > 0 && $age2 > 0){
			$where['age'] = array('between',array($age1, $age2));
		}
		if($height1 > 0 && $height2 == 0){
			$where['height'] = array('between',array($height1, 9999));
		}elseif($height1 == 0 && $height2 > 0){
			$where['height'] = array('between',array(0, $height2));
		}elseif($height1 > 0 && $height2 > 0){
			$where['height'] = array('between',array($height1, $height2));
		}
		$where['status'] = array('eq','1');
		$where['wechat'] = array('neq', '');
		if(!empty($kw)){
			$where['interest'] = array('like', '%'.$kw.'%');
		}
		$where['_logic'] = 'AND';	
		$db = M('user');

		$perpage = 20;
		import('ORG.Util.Page');
		$total = $db->field('id')->where($where)->count();
		$page = isset($_GET['p'])?$_GET['p']:1;
		$Page = new Page($total,$perpage);
		$Page->setConfig('上一页','&lt;');
		$Page->setConfig('首页','&lt;&lt;');
		$Page->setConfig('下一页','&gt;');
		$Page->setConfig('末页','&gt;&gt;');	
		$Page->setConfig('theme',"%first%%upPage%%linkPage%%downPage%%end%");
		$data = $db->field('id,realname,img,gender,age,height,edu,income,love,interest,nickname')->order('regtime desc')->where($where)->page($page.','.$Page->listRows)->select();
		//var_dump($where);
		if(is_null($data)){ 
			$data = array();			
			$recommendWhere = array("gender"=>$this->m['gender'] == '0' ? '1' : '0', "income"=>$income,"wechat"=>array('neq', ''),"status"=>"1");
			while(count($recommendWhere) > 1){				
				if($db->where($recommendWhere)->count() > 0){
					$data = $db->field('id,realname,img,gender,age,height,edu,income,interest,nickname')->where($recommendWhere)->select();
					break;
				}
				array_shift($recommendWhere);
			}	
			$count = count($data);
			if($count > 10){
				$count = 10;
			}
			$this->user = $this->getRandValues($data, 10); //随机10条
			$this->h3 = empty($data) ? '没有搜索到符合条件的会员' : "没有搜索到符合条件的会员，系统自动为您推荐了以下{$count}位会员";
		}else{
			$this->user = $data;
		}	
		$cfg = $this->cfg();
		//$this->audit_url = empty($cfg['audit_url']) ? '未认证' : "<a href='{$cfg['audit_url']}'>未认证</a>";
		$this->page = $Page->show();			
		$this->display('vipsearch');
	}


	public function user(){
		$id = I('id',0,'intval');
		if($id==0)$this->error('用户信息不存在');
		$this->m = R('Member/userinfo',array($id));
		$this->display();
	}

}

?>
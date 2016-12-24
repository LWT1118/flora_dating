<?php
Class VoteAction extends AdminAction
{
    const IMG_URL = '/Upload/vote/';
	//添加投票
    public function add()
	{
        //$this->catlist = parent::_list2('vote',"1",0);
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;				
		if($id > 0){
			$this->data = VoteModel::getInstance()->find($id);		        
			$listRes = VoteSelectModel::getInstance()->where("vote_id=".$id)->order("id desc")->select();						
			$this->assign("list",$listRes);
		}
		if(!empty($_GET['sid'])){
            $sid = intval($_GET['sid']);
            $selectRes = VoteSelectModel::getInstance()->find($sid);			
            $this->assign("voteinfo",$selectRes);	
			$this->sid = $sid;			
        }
		
		$this->catlist = parent::_list2('vote_select',"1",0);		
		$this->vote_id = $id;		
        $this->location='添加投票';
		$this->display();
	}

    //处理添加投票
    public function doadd()
    {
        if(empty($_POST))return false;		
		$id = intval($_POST['id']);
		$title = trim($_POST['title']);
        $start_time = strtotime($_POST['start_time']);
        $end_time = strtotime($_POST['end_time']);
		$content = $_POST['content'];
		$img = trim($_POST['img']);
		$status = isset($_POST['select_type']) ? 1 : 0;
		$data = array();
		if($title == ''){
			$this->error("投票主题不能为空");
		}
		if($start_time == ''){
			$this->error("开始时间不能为空");
		}        
		if($end_time == ''){
			$this->error("结束时间不能为空");
		}
		if($end_time <= $start_time){
			$this->error("结束时间不能小于开始时间");
		}
		$data = array(
				'title' =>$title,
				'start_time'=>$start_time,
				'end_time'=>$end_time,
				'content'=>$content,
				'image'=>$img,
				'status'=>$status,
		        'desc'=>$_POST['desc']
		);		
		$res = $id > 0 ? VoteModel::getInstance()->where("id=".$id)->save($data) : VoteModel::getInstance()->add($data);
		if(!empty($res)){
			$this->success("保存成功", U('Vote/add', array('id'=>$id > 0 ? $id : $res)));
		}else{
			$this->error("保存失败");
		}
		                                                  
    }

    //投票列表
    public function voteList(){

        import('ORG.Util.Page');
        $perpage = 15;
        $total = VoteModel::getInstance()->count("id");
        $page = isset($_GET['p'])?$_GET['p']:1;
        $Page = new Page($total,$perpage);
        $pageShow = $Page->show();
        $list = VoteModel::getInstance()->page($page.','.$Page->listRows)->order("id desc")->select();
        foreach($list as $key => &$val){
            $list[$key]['start_time'] = date("Y-m-d H:i:s",$val['start_time']);
            $list[$key]['end_time'] = date("Y-m-d H:i:s",$val['end_time']);
            $list[$key]['status'] = $this->voteType($val['status']);
        }
        $this->assign("page",$pageShow);
        $this->assign("list",$list);
        $this->display();
    }
	
	 //添加选项
    public function addSelect()
    {
        if(empty($_POST))return false;				
        $image = trim($_POST['img']);
        $title = trim($_POST['title']);
        $vote_id = intval($_POST['vote_id']);
		
        $sid = intval($_POST['select_id']);      

        if($title == ''){
            $this->error("选项标题不能为空");
        }
       
        $data = array(
            'image'=>$image,
            'title'=>$title,
            'vote_id'=>$vote_id,
			'order'=>intval($_POST['order']),
            'add_num'=>intval($_POST['add_num'])
        );
        $oneSelect =  VoteSelectModel::getInstance()->find($sid);
        if(empty($oneSelect)){
            $res = VoteSelectModel::getInstance()->add($data);
        }else{
            $res =  VoteSelectModel::getInstance()->where("id=".$sid)->save($data);
        }

        if(!empty($res))
        {
            $this->success("操作成功",U('Vote/add', array('id'=>$vote_id)));
        }else{
            $this->error("操作失败");
        }
    }

    //删除投票
    public function selectDelete()
    {
        if(empty($_GET['sid']) || empty($_GET['id']))return false;
        $sid = intval($_GET['sid']);
        $vote_id = intval($_GET['id']);
        $res = VoteSelectModel::getInstance()->delete($sid);
        if($res == true)
        {
            $this->success("删除成功",U('Vote/add', array('id'=>$vote_id)));
        }else{
            $this->error("删除失败");
        }
    }  

    //编辑投票
    public function voteUpdate(){
        if(empty($_GET['id']))return false;
        $id = intval($_GET['id']);
        $voteInfo = VoteModel::getInstance()->getVoteList($id);

        $this->assign('voteinfo',$voteInfo);
        $this->display();
    }

    //处理编辑
    public function doUpdate(){
        if(empty($_POST))return false;
        $vote_id = intval($_POST['vote_id']);
        $title = trim($_POST['title']);
        $start_time = strtotime($_POST['start_time']);
        $end_time = strtotime($_POST['end_time']);
        $content = trim(htmlspecialchars($_POST['content']));
        $img = trim($_POST['img']);
        $status = intval($_POST['select_type']);
        if($title == ''){
            $this->error("投票主题不能为空");
        }

        if($start_time == ''){
            $this->error("请添加开始时间");
        }

        if($end_time == ''){
            $this->error("请添加结束时间");
        }

        if($content == ''){
            $this->error("投票详情不能为空");
        }

        if($img == ''){
            $this->error("请上传主题图片");
        }
        if(strpos($img,'thumb300_') != false){
            $image = $img;
        }else{
            $image = self::IMG_URL."thumb300_".$img;
        }
        $data = array(
            'title' =>$title,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'content'=>$content,
            'image'=>$image,
            'status'=>$status
        );
        $updateRes = VoteModel::getInstance()->where("id=".$vote_id)->save($data);
        if($updateRes == true){
            $this->success("修改成功","voteList");
        }else{
            $this->error("修改失败");
        }
    }

    //删除投票
    public function voteDelete(){
        if(empty($_GET['id']))return false;
        $id = intval($_GET['id']);
        $delRes = VoteModel::getInstance()->where("id=".$id)->delete();
        if($delRes == true){
            $this->success("删除成功",U('voteList'));
        }else{
            $this->error("删除失败");
        }
    }

    //上传图片
    public function upload(){        	
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 2*1024*768 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Upload/vote/';// 设置附件上传目录
		$upload->thumb = false;		
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			echo $info[0]['savename'];
			return $info[0]['savename']; 
		}
		       
    }

    //投票类型
    public function voteType($tid){
        $typeArr = array(0=>'单选',1=>'多选');
        return $typeArr[$tid];
    }
}
?>
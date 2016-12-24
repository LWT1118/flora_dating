<?php
class VoteSelectAction extends AdminAction
{
    const IMG_URL = '/Upload/voteselect/';
    public function index()
    {
        if(!empty($_GET['id'])){
            $id = intval($_GET['id']);
        }
        if(!empty($_GET['sid'])){
            $sid = intval($_GET['sid']);
            $selectRes = VoteSelectModel::getInstance()->find($sid);
            $this->assign("voteinfo",$selectRes);
        }
        $vote_res = VoteModel::getInstance()->getVoteList($id);
        $this->catlist = parent::_list2('vote_select',"1",0);
        $this->location='添加投票选项';

        import('ORG.Util.Page');
        $perpage = 15;
        $total = VoteSelectModel::getInstance()->where("vote_id=".$id)->count("id");
        $page = isset($_GET['p'])?$_GET['p']:1;
        $Page = new Page($total,$perpage);
        $pageShow = $Page->show();
        $listRes = VoteSelectModel::getInstance()->where("vote_id=".$id)->page($page.','.$Page->listRows)->order("id desc")->select();
        $this->assign("page",$pageShow);
        $this->assign("list",$listRes);
        $this->assign("votes",$vote_res);
        $this->display();
    }

    
}
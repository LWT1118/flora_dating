<?php
class VoteModel extends Model
{
    static public function getInstance()
    {
        static $ins;
        if(false == $ins instanceof self)
        {
            $ins = new self();
        }
        return $ins;
    }

    //获取投票的活动
    public function getVoteAction()
    {
        $current_time = time();
        $res = $this->field('id,title')->where("end_time" > $current_time)->order("end_time desc")->select();
        return $res;
    }

    //获取投票列表
    public function getVoteList($id = 0){
        if($id == 0){
            $listRes = $this->field(true)->select();
        }else{
            $listRes = $this->field(true)->find($id);
        }
        return $listRes;
    }
}
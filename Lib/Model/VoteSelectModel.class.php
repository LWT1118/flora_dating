<?php
class VoteSelectModel extends Model
{
    protected $tableName = 'vote_select';

    static public function getInstance()
    {
        static $ins;
        if(false == $ins instanceof self)
        {
            $ins = new self();
        }
        return $ins;
    }

    //查询投票选项
    public function getList($vote_id)
    {
          if(empty($vote_id))return false;
          $sql = "select vs.id,vs.title,vs.image from wjw_vote_select vs join wjw_vote v on vs.vote_id = v.id where v.id=".$vote_id;
          $res = VoteSelectModel::getInstance()->query( $sql);
          return $res;
    }
}
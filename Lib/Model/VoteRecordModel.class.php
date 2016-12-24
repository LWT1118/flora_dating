<?php
class VoteRecordModel extends Model
{
    protected $tableName = 'vote_record';

    static public function getInstance()
    {
        static $ins;
        if(false == $ins instanceof self)
        {
            $ins = new self();
        }
        return $ins;
    }    
}
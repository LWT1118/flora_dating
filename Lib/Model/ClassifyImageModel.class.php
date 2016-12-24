<?php
class ClassifyImageModel extends Model
{
    protected $tableName = 'classify_image';

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
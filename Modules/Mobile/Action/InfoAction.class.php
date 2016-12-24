<?php
class InfoAction extends AdminAction
{
    public function index()
    {
        $classifyModel = M("classify_info");
        $allClass = array();
        $mainClass = $classifyModel->where("pid=0")->select();
        foreach($mainClass as $key => $val){
            $allClass[$val['id']]['main'] = $val['classname'];
            $allClass[$val['id']]['url'] = $val['url'];
            $childClass = $classifyModel->where("pid=".$val['id'])->select();
            $allClass[$val['id']]['child'] = $childClass;
        }

        $this->assign("allclass",$allClass);
        $this->display();
    }
}
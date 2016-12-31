<?php
class ClassifyAction extends AdminAction
{
    public function index()
    {
        $this->display();
    }
    //添加主类
    public function addParentClass()
    {
        if (empty($_POST)) return false;
        $main = trim($_POST['mainclass']);
        $url = trim($_POST['mainurl']);
        $pid = 0;
        if($this->check_url($url) == false){
            $this->error("非法的url");
        }

        $data = array(
            'classname' => $main,
            'pid' => $pid,
            'url'=>$url
        );
        $classifyRes = M('classify_info')->add($data);
        if ($classifyRes) {
            $this->redirect("index");
        } else {
            $this->error("添加失败");
        }
    }

    public function childIndex()
    {
		$classifyModel = M('classify_info');
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;		
		$currentClass = $id > 0 ? $classifyModel->where("id={$id}")->limit(1)->select() : array(array());			
		$this->assign('current_class', $currentClass[0]);
		
        $classifyRes = $classifyModel->where("pid = 0")->select();
        $this->assign("mainclass", $classifyRes);
		
		$model = new Model();
		$list = $model->query("select a.*,b.classname as parent from wjw_classify_info a left join wjw_classify_info b on a.pid=b.id");
		$this->assign('list', $list);
		
        $this->display();
    }
    //添加子类
    public function addChildClass()
    {
        if (empty($_POST['childname'])) return false;
        $classname = trim($_POST['childname']);
        $pid = intval($_POST['pid']);
        $url = trim($_POST['childurl']);
		$no = intval($_POST['no']);
        /*if($this->check_url($url) == false){
            $this->error("非法的url");
        }*/
        $data = array(
            'classname' => $classname,
            'pid' => $pid,
            'url'=>$url,
			'no'=>$no
        );
		$id = intval($_POST['id']);
		if($id > 0){
			$classifyRes = M('classify_info')->where("id={$id}")->save($data);
		}else{
			$classifyRes = M('classify_info')->add($data);
		}
        if ($classifyRes) {
            $this->redirect("childIndex", array('id'=>$id));
        } else {
            $this->error("保存失败");
        }
    }
	
	public function url()
	{
		$id = intval($_GET['id']);
		$url = isset($_GET['url']) ? urldecode($_GET['url']) : '';
		$idAds = isset($_GET['is_ads']) ? intval($_GET['is_ads']) : 0;
		$msg = M('classify_image')->where("id={$id}")->save(array('url'=>$url, 'is_ads'=>$idAds)) ? '保存成功' : '保存失败';
		die(json_encode(array('err_code'=>$msg)));
	}
	
    //验证url合法性
    public function check_url($url){
        if(!preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$url)){
            return false;
        }
        return true;
    }
	
	public function image(){
		$classifyImageModel = M('classify_image');
		if(isset($_FILES['image'])){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 2*1024*768 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Upload/classify/';// 设置附件上传目录
			$upload->thumb = false;		
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();				
				$path = "/Upload/classify/{$info[0]['savename']}";
				$isAds = intval($_POST['is_ads']);
				$classifyImageModel->add(array('image'=>$path, 'create_time'=>time(), 'is_ads'=>$isAds));
			}			
		}				
		$imageList = $classifyImageModel->select();
		$this->assign('image_list', $imageList);
		$this->display();
	}

	public function del(){
		if(empty($_GET['id']))return false;
		$id = intval($_GET['id']);
        $delRes = ClassifyImageModel::getInstance()->where("id=".$id)->delete();
        if($delRes == true){
            $this->success("删除成功",U('image'));
        }else{
            $this->error("删除失败");
        }
	}	
	
	public function classdelete(){
		if(empty($_GET['id']))return false;
		$id = intval($_GET['id']);
        $delRes = M('classify_info')->where("id=".$id)->delete();
        if($delRes == true){
            $this->success("删除成功",U('childIndex'));
        }else{
            $this->error("删除失败");
        }
	}	
}
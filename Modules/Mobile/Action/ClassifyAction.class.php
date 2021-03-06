<?php
class ClassifyAction extends PublicAction {
	public function index(){
	    $classifyImageModel = M('classify_image'); 
		$bannerList = $classifyImageModel->where('is_ads=0')->select();
		$adsList = $classifyImageModel->where('is_ads=1')->select();
		$this->assign('banner_list', $bannerList);
		$this->assign('ads_list', $adsList);
		
		$classifyModel = new Model();
		$relationCatalog = $classifyModel->query('select * from wjw_classify_info where pid=0 and id in (select distinct pid from wjw_classify_info) order by no');
		foreach($relationCatalog as $key=>$catalog){
			$children = $classifyModel->query("select * from wjw_classify_info where pid={$catalog['id']} order by no");
			$catalog['children'] = array_chunk($children, 2);
			$relationCatalog[$key] = $catalog;
		}		
		$this->assign('relation_catalog', $relationCatalog);
		
		$singleCatalog = $classifyModel->query('select * from wjw_classify_info where pid=0 and id not in (select distinct pid from wjw_classify_info) order by no');
		$this->assign('single_catalog', array_chunk($singleCatalog, 2));
		
		$this->display();
	}
}	
?>
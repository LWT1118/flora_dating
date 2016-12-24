<?php

class AdminAction extends PublicAction{

	public function _initialize(){	
		$userId = $this->GetUserId();
		if($userId == 0){
			$this->error('请先登录',U('Home/Member/login'));
		}else{
			$this->m = M('user')->find($userId);
		}
		$notAuth = in_array(MODULE_NAME,explode(',', C('NOT_AUTU_MODULE'))) || in_array(ACTION_NAME,explode(',', C('NOT_AUTU_ACTION'))) ;
		if(C('USER_AUTH_ON') && !$notAuth){
			import('ORG.Util.RBAC');
	    	RBAC::AccessDecision(GROUP_NAME)||$this->error('没有权限');
	    	//p($_SESSION);
		}
	}
}

?>
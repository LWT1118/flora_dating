<?php

	function isMobile() {
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
	        return true;
	    }
	    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset($_SERVER['HTTP_VIA'])) {
	        //找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    }
	    //判断手机发送的客户端标志,兼容性有待提高
	    if (isset($_SERVER['HTTP_USER_AGENT'])) {
	        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
	        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
	            return true;
	        }
	    }
	    //协议法，因为有可能不准确，放到最后判断
	    if (isset($_SERVER['HTTP_ACCEPT'])) {
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
	            return true;
	        }
	    }
	    return false;
	}

	function income($i){
		$arr = C('INCOME');
		return $arr[$i];
	}

	function edu($i){
		$arr = C('EDU');
		return $arr[$i];
	}

	function love($i){
		$arr = C('LOVER');
		return $arr[$i];
	}

	function p($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}

	function br2nl($text) {    
		return preg_replace('/<br\\s*?\/??>/i', "", $text);   
	}

	function gender($value) {    
		return ($value==0?'女士':'先生');   
	}

	function left_title($str,$num){
		$len = mb_strlen($str,'utf-8');
		if($len>$num){
			return mb_substr($str,0,$num,'utf-8')."...";
		}else{
			return $str;
		}
	}

	function trimall($str){
		$qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
		return str_replace($qian,$hou,$str);    
	}

	function left_content($str,$num){
		$str = stripslashes($str);
		$str = strip_tags($str);
		$str = trim($str);
		$str = trimall($str);
		$len = mb_strlen($str,'utf-8');
		return mb_substr($str,0,$num,'utf-8')."...";
	}

	function rand_letter($len){
		$output = "";
		$letters = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
		$letter = explode(",",$letters);
		for($i=0;$i<$len;$i++)
		{
			$output .= $letter[mt_rand(0,51)];
		}
		return $output;
	}

	function front_zero($v,$len){
		$temp = '';
		if(strlen($v)<$len){
			for($i=0;$i<$len-strlen($v);$i++){
				$temp.='0';
			}
		}
		return $temp.$v;
	}

	function getdistance($lng1,$lat1,$lng2,$lat2){ 
		//将角度转为狐度
		$radLat1=deg2rad($lat1);//deg2rad()函数将角度转换为弧度
		$radLat2=deg2rad($lat2);
		$radLng1=deg2rad($lng1);
		$radLng2=deg2rad($lng2);
		$a=$radLat1-$radLat2;
		$b=$radLng1-$radLng2;
		$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137*1000;
		return $s;
	}


	function is_active($n,$txt,$url='#'){
		$style = array('btn-danger','btn-success');
		return "<a class='my-white btn btn-xs ".$style[$n]."' href='".$url."'>".$txt."</a>";
	}


	function is_status($n,$url){
		if($n==0){
			return "<a href='".$url."' class='btn btn-xs btn-danger'>待审核</a>";
		}else{
			return "<a href='".$url."' class='btn btn-xs btn-success'>已审核</a>";
		}
	}
	
	function is_audit($n,$url){
		if($n==0){
			return "<a href='".$url."' class='btn btn-xs btn-danger'>未认证</a>";
		}else{
			return "<a href='".$url."' class='btn btn-xs btn-success'>已认证</a>";
		}
	}


	function order_status_txt($status=0){
		switch ($status) {
			case 0:
				return "待付款";
				break;
			case 1:
				return "已付款";
				break;			
			default:
				return "全部";
				break;
		}
	}




	function order_status($status,$url){
		switch($status){
			case 0:
				return "<a class='btn btn-xs btn-success' href='".$url."'>马上付款</a>";
			break;
			case 1:
				return "<span class='text-success'>交易成功</span>";
			break;
		}
	}


	function order_status_agent($status,$url){
		switch($status){
			case 0:
			return "<a class='btn btn-xs btn-success' href=\"javascript:sure('".$url."')\">收到货款并完成发货</a>";
			break;
			case 1:
			return "<a class='btn btn-xs btn-success' href='".$url."'>确认发货</a>";
			break;
			case 2:
			return "<span class='btn btn-xs btn-default'>等待用户确认</span>";
			break;
			case 3:
			return "<span class='btn btn-xs btn-default'>交易完成</span>";
			break;
			case 4:
			return "<a class='btn btn-xs btn-' href='".$url."'>用户退款</a>";
			break;
		}
	}


	function nav_type($type){
		switch($type){
			case 0:
			return "顶部导航";
			break;
			case 1:
			return "底部文本";
			break;
			case 2:
			return "首页图文";
			break;
		}
	}

	function wechat_type($type){
		switch($type){
			case 0:
			return "纯文本";
			break;
			case 1:
			return "单图文";
			break;
			case 2:
			return "多图文";
			break;
		}
	}


	function is_checked($n,$l,$css=0,$url='#'){
		$style = array('btn-success','btn-danger','btn-primary','btn-warning','btn-info');
		if($n>0){
			return "<a class='my-white btn btn-xs ".$style[$css]."' href='".$url."'>".$l."</a>";
		}
	}

	function infiniteCategory($arr,$pid=0,$level=0,$html='&nbsp;——&nbsp;'){
		$array = array();
		foreach ($arr as $v) {
			if($v['pid']==$pid){
				$v['level'] = $level + 1;
				$v['html'] = str_repeat($html, $level);
				$array[] = $v;
				$array = array_merge($array,infiniteCategory($arr,$v['id'],$level+1,$html));
			}
		}
		return $array;
	}

	function node_merge($arr,$access=null,$pid=0){
		$array = array();
		foreach ($arr as $v) {
			if(is_array($access)&&in_array($v['id'], $access)){
				$v['access'] = 1;
			}else{
				$v['access'] = 0;
			}
			if($v['pid']==$pid){
				$v['child'] = node_merge($arr,$access,$v['id']);
				$array[] = $v;
			}
		}
		return $array;
	}	

?>
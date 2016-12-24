function sure(url){
	var x = confirm('确定要执行该操作？');
	if(x){
		document.location=url;
	}
}
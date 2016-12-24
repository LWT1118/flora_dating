    function bookmark($id,$url,$type){
        $.post($url,{id:$id,type:$type},function(data){
            $('.bookmark-class').show();
            $('.cart-class').hide();
            $('.my-alert').text(data.info);
            $('#myModal').modal('show');
        });
    }
    function addtocart($id,$url){
        $.post($url,{id:$id},function(data){
            if(data.status==1){
                $('.bookmark-class').hide();
                $('.cart-class').show();
                $('.my-alert').text(data.info);
                $('#myModal').modal('show');
                var $num = $('#cart-total').text();
                if($num.length>0){
                    $num = parseInt($num)+1;
                }else{
                    $num = 1;
                }
                $('#cart-total').text($num);
            }
        });       
    }


function sure(url){
    var x = confirm('确定要执行该操作？');
    if(x == true){
        window.location.href=url;
    }
}    
$(document).ready(function () {
    function myfunc(){
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/getbaskets',
            type:'POST',
            data:{_token:token},
            success: function (data) {
                if(data.basketcount != 0){
                    $('.mybasket').text(data.basketcount);
                    $('.mybasket').attr('count',data.basketcount);
                }else {
                    $('.mybasket').text('');
                    $('.mybasket').attr('count',0);
                }
            }
        });
    }

    setInterval(myfunc, 3000);
    
    $('.buymyproduct').click(function () {
        var productid = $(this).attr('id');
        var quantity = $(this).val();
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/buymyproduct',
            type:'POST',
            data:{_token:token,productid:productid,quantity:quantity},
            success: function (data) {
                if(data.data = 1){
                    $('#myProduct_'+productid).remove();
                }
            }
        });
    });
    
    $('.buyall').click(function () {
        var data = [];
        var token = $("input[name=_token]").val();
       var myfind =  $(".myactions").find("button");
       if(myfind.length>0){
           $.each(myfind,function (key,value) {
               data.push($(value).attr('id'));
           });
           $.ajax({
               url:'/buyall',
               type:'POST',
               data:{_token:token,data:data},
               success: function (data) {
                   if(data.data = 1){
                       $('.clearetable').empty();
                   }
               }
           });
       }

    })
});
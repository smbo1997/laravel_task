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
        var basketid = $(this).val();
        var token = $("input[name=_token]").val();
        var count = $('.count_'+basketid).attr('id');
        var price = $('.price_'+basketid).attr('id');
        var total =count*price;
        $.ajax({
            url:'/buymyproduct',
            type:'POST',
            data:{_token:token,basketid:basketid,total:total},
            success: function (data) {
                if(data.data = 1){
                    $('#myProduct_'+basketid).remove();
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
               data.push($(value).val());
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
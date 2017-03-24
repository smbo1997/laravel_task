$(document).ready(function () {

    // $(document).on('click','.pagination li',function (e) {
    //     $('.pagination li').removeClass('active');
    //     $(this).addClass('active');
    // });
   $(document).on('click','.pagination li a',function (e) {
       e.preventDefault();
       var page = $(this).attr('href').split('page=')[1];
       var setpage = $(this).attr('href').split('=')[0];
       var language = $('.mypaginate').attr('lang');
       $('.pagination li').removeClass('active');
       $(this).parent().addClass('active');
       $.ajax({
           url:'?page=' + page,
           type:'get',
           beforeSend: function() { $('#loader').show(); },
           complete: function() { $('#loader').hide(); },
           success: function (data) {
               var JsonData = $.parseJSON(data);
               if(JsonData.paginate.data){
                   var html = '';
                   $.each(JsonData.paginate.data,function (key,value) {

                           html += '<a href="'+language+'/store/' + value.post_id + '">' +
                               '<li class="licontents">' +
                               '<div>' +
                               '<img   src="/post_images/' + value.image + '" width="100px" height="100px" style="border-radius: 10px; float:left;">' +
                               '<p style="color:#01A4E0 ; float: right">'+value.name+'</p>' +
                               '</div>' +
                               '</li>' +
                               '</a>';
                       $(".addpaginate").html(html);

                   });
                   $('.pagination li:eq(1)').html('<a href="'+setpage+'=1">1</a>');
                   if(JsonData.paginate.next_page_url !== null){
                       $('.pagination li:last-child').removeClass('disabled');
                       $('.pagination li:last-child').html('<a href="'+JsonData.paginate.next_page_url+'">'+'»'+'</a>');
                   }else{
                       $('.pagination li:last-child').html('<span>'+'»'+'</span>');
                       $('.pagination li:last-child').addClass('disabled');
                   }

                  // $('.pagination li:eq(0)').removeClass('disabled');
                   if(JsonData.paginate.prev_page_url !== null){
                       $('.pagination li:eq(0)').removeClass('disabled')
                       $('.pagination li:eq(0)').html('<a href="'+JsonData.paginate.prev_page_url+'">'+'«'+'</a>');
                   }else{
                       $('.pagination li:eq(0)').addClass('disabled');
                       $('.pagination li:eq(0)').html('<span>'+'«'+'</span>');
                   }

               }
           }
           });
   })

$('.logoutform').click(function () {
    localStorage.clear();
})


    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

    $('.typeselect').change(function() {
        var productid = $(this).val();
        var token = $("input[name=_token]").val();
        var language = $('.myproducts').attr('lang');
        $.ajax({
            url:'/selectproducts',
            type:'POST',
            data:{productid:productid,_token:token},
            success: function (data) {
                var JsonData = $.parseJSON(data);
                $('.myproducts').empty();
                    var html = '';
                    if(JsonData.selectproducts.length>0){
                        $.each(JsonData.selectproducts,function (key,value) {
                            html =  '<tr>'+
                                    '<td>'+value.product_name+'</td>'+
                                    '<td>'+value.product_content+'</td>'+
                                    '<td>'+value.product_price+'</td>'+
                                    '<td><img src="/products_images/'+value.product_image+'" width="60px" height="60px" style="border-radius: 8px"/></td>'+
                                    '<td><a href="/'+language+'/deleteproduct/'+value.product_id+'">Delete Product</a></td>'+
                                    '</tr>';
                            $('.myproducts').append(html);
                        })


                    }
            }
        });
    });

    $('.getproduct').click(function () {
        var id = $(this).val();
        var storeid= $('.getstoreid').attr('storeid');
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/getproductsbystore',
            type:'POST',
            data:{id:id,_token:token,storeid:storeid},
            success: function (data) {
                 var JsonData = $.parseJSON(data);
                 var html = '';
                $('#products').empty();
                if(JsonData.getproducts.length>0){
                    $.each(JsonData.getproducts,function (key,value) {
                        html = '<div class="item  col-xs-4 col-lg-4" id="product_'+value.product_id+'">'+
                                '<div class="thumbnail">'+
                                '<img class="group list-group-image" width="200px" height="200px" src="/products_images/'+value.product_image+'" alt="" />'+
                                '<div class="caption">'+
                                '<h4 class="group inner list-group-item-heading">'+value.product_name+'</h4>'+
                            '<p class="group inner list-group-item-text">'+value.product_content+'</p>'+
                            '<div class="row">'+
                                '<div class="col-xs-12 col-md-6">'+
                                '<p class="lead">'+value.product_price+'$</p>'+
                                '<button type="button" class="btn btn-success buyproduct" id="'+value.product_id+'">Buy</button>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                        $('#products').append(html);
                    });
                }
            }
        });
    });



    $(document).on('click','.buyproduct',function () {
        var productId = $(this).attr('id');
        var token = $("input[name=_token]").val();
        $(".mycount").val('');
        $(".mycount").attr('id');
        $("#myModal").modal('show');
        $(".mycount").attr('id',productId);
    });



    $(document).on('click','.buybycount',function () {
        var token = $("input[name=_token]").val();
        var count =  $(".mycount").val();
        var productId =  $(".mycount").attr('id');
        if(count > 0 && count != ''){
            $.ajax({
                url:'/buyproduct',
                type:'POST',
                data:{productId:productId,_token:token,count:count},
                success: function (data) {
                    $("#myModal").modal('hide');
                    var a = $('.mybasket').attr('count');
                     var b =  eval(parseInt(a) + parseInt(count));
                    $('.mybasket').text(b);
                    $('.mybasket').attr('count',b);
                    $.bootstrapGrowl(' Your purchases were completed successfully.',{
                        type: 'success',
                        delay: 6000,
                    });

                 },
                error: function(data){
                    var errors = data.responseJSON;
                    if(errors.error){
                        $(".mycount").val('');
                        $("#myModal").modal('hide');
                        $.bootstrapGrowl('Login please',{
                            type: 'danger',
                            delay: 6000,
                        });
                    }
                }

            });
        }


    });






    $('.adminselectshop').change(function () {
        var userid = $(this).val();
        var token = $("input[name=_token]").val();
        $('.admintypeselect').empty();
        var datatable=$('#mydatatable').DataTable();
        datatable.clear();
        if(userid !=0){
            $.ajax({
                url:'/gettypeswithadmin',
                type:'POST',
                data:{userid:userid,_token:token},
                success: function (data) {
                   var JsonData = $.parseJSON(data);
                   if(JsonData.products.length>0){
                       var html = '<option></option>';
                       $('.admintypeselect').removeAttr("disabled");
                       $.each(JsonData.products,function (key,value) {
                           html += '<option value="'+value.type_id+'">'+value.typename+'</option>';
                       });
                       $('.admintypeselect').append(html);
                   }
                }
            });
        }else{
            $('.admintypeselect').attr("disabled","disabled");
            var datatable=$('#mydatatable').DataTable();
            $('#mydatatable').dataTable().fnDestroy();
            datatable.clear();
        }
    });

    $('.admintypeselect').change(function () {
        var typeid = $(this).val();
        var lang =  $('.mytable').attr('lang')
        var token = $("input[name=_token]").val();
        var datatable=$('#mydatatable').DataTable();
        var shopid = $('.adminselectshop').val();
        if(typeid !='noselect' || shopid !=0){
            datatable.clear();
            $.ajax({
                url:'/getproductsbyadmin',
                type:'POST',
                data:{typeid:typeid,_token:token,shopid:shopid},
                success: function (data) {
                    var JsonData = $.parseJSON(data);
                    if(JsonData.getproducts.length>0){
                        var html = [];
                        $.each(JsonData.getproducts,function (key,value) {
                            html.push([value.product_name,value.product_content,value.product_price,'<img src="/products_images/'+value.product_image+'" width="100px" height="100px" style="border-radius: 8px">','<a href="/'+lang+'/updateproductbtadmin/'+value.product_id+'">Update Product</a>']);
                        });
                        datatable.rows.add(html);
                        datatable.draw();
                    }
                }
            });
        }
    });


    $('.typeselect1').change(function() {
        var productid = $(this).val();
        var token = $("input[name=_token]").val();
        var language = $('.myproducts1').attr('lang');
        $.ajax({
            url:'/selectproductswithworkers',
            type:'POST',
            data:{productid:productid,_token:token},
            success: function (data) {
                var JsonData = $.parseJSON(data);
                $('.myproducts1').empty();
                var html = '';
                if(JsonData.selectproducts.length>0){
                    $.each(JsonData.selectproducts,function (key,value) {
                        html =  '<tr>'+
                            '<td>'+value.product_name+'</td>'+
                            '<td>'+value.product_content+'</td>'+
                            '<td>'+value.product_price+'</td>'+
                            '<td><img src="/products_images/'+value.product_image+'" width="60px" height="60px" style="border-radius: 8px"/></td>'+
                            '<td><a href="/'+language+'/deleteproductwithworker/'+value.product_id+'">Delete Product</a> | '+
                            '<a href="/'+language+'/updateproductwithworker/'+value.product_id+'">Update Product</a></td>'+
                            '</tr>';
                        $('.myproducts1').append(html);
                    })
                }
            }
        });
    });


    $('.searchproducts').click(function () {
        var product_type = $('select.typeselect option:selected').val();
        var minprice = $('.min-slider-handle').attr('aria-valuenow');
        var maxprice = $('.max-slider-handle').attr('aria-valuenow');
        var token = $("input[name=_token]").val();
        var language = $('.myproducts').attr('lang');
        $.ajax({
            url:'/getproductsByprice',
            type:'POST',
            data:{_token:token,minprice:minprice,maxprice:maxprice,product_type:product_type},
            success: function (data) {
                var JsonData = $.parseJSON(data);
                $('.myproducts').empty();
                var html = '';
                if(JsonData.productByPrice.length>0){
                    $.each(JsonData.productByPrice,function (key,value) {
                        html =  '<tr>'+
                            '<td>'+value.product_name+'</td>'+
                            '<td>'+value.product_content+'</td>'+
                            '<td>'+value.product_price+'</td>'+
                            '<td><img src="/products_images/'+value.product_image+'" width="60px" height="60px" style="border-radius: 8px"/></td>'+
                            '<td><a href="/'+language+'/deleteproduct/'+value.product_id+'">Delete Product</a>'+
                            '</tr>';
                        $('.myproducts').append(html);
                    })
                }
            }
        });
    });


    $('.answer').click(function () {
        var email = $(this).attr('email');
        var chatid = $(this).attr('chatid');
        var userid = $(this).attr('userid');
        $('.senduser').attr('id',email);
        $('.senduser').attr('chatid',chatid);
        $('.senduser').attr('userid',userid);
    });

    $('.sendmessagebyadmin').click(function () {
        var message =   $('.senduser').val();
        var email = $('.senduser').attr('id');
        var chatid = $('.senduser').attr('chatid');
        var userid = $('.senduser').attr('userid');
        var token = $("input[name=_token]").val();
        if(message !== ''){
            $.ajax({
                url:'/sendmessagetouser',
                type:'POST',
                data:{_token:token,message:message,email:email,chatid:chatid,userid:userid},
                success: function (data) {
                    $('.senduser').val('');
                    $("#myModal").modal('hide');
                }
            });
        }
    });

    $('.getstoresbyservice').click(function () {
        var typeid = $(this).val();
        var token = $("input[name=_token]").val();
        $.ajax({
            url: '/getstoresbyservice',
            type: 'post',
            data: {_token: token, typeid: typeid},
            success: function (data) {
               if(data.getstores){
                   $('.showstores').show();
                   var html ='';
                   $('.showedstores').empty();
                   $.each(data.getstores,function (key,value) {
                        html+='<div class="item  col-xs-4 col-lg-4" id="product_'+value.user_id+'">'+
                            '<div class="thumbnail">'+
                            '<img class="group list-group-image" width="200px" height="200px" src="/\post_images/'+value.image+'" alt="" />'+
                            '<div class="caption">'+
                            '<h4 class="group inner list-group-item-heading">'+value.name+'</h4>'+
                            '<div class="row">'+
                            '<div class="col-xs-12 col-md-6">'+
                            '<button type="button" class="btn btn-success getproductsbyid" userid="'+value.user_id+'" typeid="'+value.type_id+'" >See</button>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                   });
                   $('.showedstores').append(html);
               }
            }
        });
    });

    $(document).on('click','.getproductsbyid',function () {
       var typeid = $(this).attr('typeid');
       var userid = $(this).attr('userid');
       $('.setmydata').attr('typeid',typeid);
       $('.setmydata').attr('userid',userid);
        var token = $("input[name=_token]").val();
       $.ajax({
           url:'/getproductbystoreandtypeid',
           type:'post',
           data:{_token:token,typeid:typeid,userid:userid},
           success:function (data) {
               var Jsondata = $.parseJSON(data);
               var html = '';
               $('.setdata').empty();
               $("#exampleModal").modal('show');
               if(Jsondata.getproduct.length>0){
                   $.each(Jsondata.getproduct,function (key,value) {
                       html+='<div class="item  col-xs-4 col-lg-4" id="product_'+value.product_id+'">'+
                           '<div class="thumbnail">'+
                           '<img class="group list-group-image" width="200px" height="200px" src="/products_images/'+value.product_image+'" alt="" />'+
                           '<div class="caption">'+
                           '<h4 class="group inner list-group-item-heading">'+value.product_content+'</h4>'+
                           '<div class="row">'+
                           '<div class="col-xs-12 col-md-6">'+
                           '<p class="lead">'+value.product_price+'$</p>'+
                           '<button type="button" class="btn btn-success buyproductbyservice" id="'+value.product_id+'" >Buy</button>'+
                           '</div>'+
                           '</div>'+
                           '</div>'+
                           '</div>'+
                           '</div>';

                   });
                   $('.setdata').html(html);
               }
           }
       });
    });


    $(document).on('click','.buyproductbyservice',function () {
        var productId = $(this).attr('id');
        var count = 1;
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/buyproduct',
            type:'post',
            data:{_token:token,productId:productId,count:count},
            dataType: 'json',
            success:function (response) {
                $.bootstrapGrowl(' Your purchases were completed successfully.',{
                    type: 'success',
                    delay: 6000,
                });
                // $(".mysuccessal").show();
                // setTimeout(closeSuccess, 6000);
            },
            error: function(data){
            var errors = data.responseJSON;
            if(errors.error){
                $.bootstrapGrowl('Login please',{
                    type: 'danger',
                    delay: 6000,
                });
                // $(".mydangeraler").show();
                // setTimeout(closeError, 6000);
            }
        }
        });
    });

    function closeError() {
        $(".mydangeraler").hide();
    }

    function closeSuccess() {
        $(".mysuccessal").hide();
    }

});



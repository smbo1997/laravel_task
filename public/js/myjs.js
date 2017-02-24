$(document).ready(function () {
   // $(document).on('click','.pagination a',function (e) {
   //     e.preventDefault();
   //     var page = $(this).attr('href').split('page=')[1];
   //     $.ajax({
   //         url:'nextpaginate/'+page,
   //         type:'GET',
   //         success: function (data) {
   //              $(".mypaginate").html(data);
   //              location.hash = page;
   //         }
   //         });
   // })




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
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/getproductsbystore',
            type:'POST',
            data:{id:id,_token:token},
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

                 }
            });
        }


    });






    $('.adminselectshop').change(function () {
        var userid = $(this).val();
        var token = $("input[name=_token]").val();
        $('.admintypeselect').empty();
        if(userid !=0){
            $.ajax({
                url:'/gettypeswithadmin',
                type:'POST',
                data:{userid:userid,_token:token},
                success: function (data) {
                   var JsonData = $.parseJSON(data);
                   if(JsonData.products.length>0){
                       var html = '<option></option>';
                       $.each(JsonData.products,function (key,value) {
                           html += '<option value="'+value.type_id+'">'+value.typename+'</option>';

                       });
                       $('.admintypeselect').append(html);
                   }
                }
            });
        }
    });

    $('.admintypeselect').change(function () {
        var typeid = $(this).val();
        var lang =  $('.mytable').attr('lang')
        var token = $("input[name=_token]").val();
        if(typeid !='noselect'){
            $.ajax({
                url:'/getproductsbyadmin',
                type:'POST',
                data:{typeid:typeid,_token:token},
                success: function (data) {
                    var JsonData = $.parseJSON(data);
                    if(JsonData.getproducts.length>0){
                        var datatable=$('#mydatatable').DataTable();
                        datatable.clear();
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

});
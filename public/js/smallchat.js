//glyphicon icon_minim glyphicon-minus


$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
    size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    $( "#chat_window_1" ).remove();
    localStorage.setItem("notopen", 1);
});


$('.messagecontent').keyup(function (e) {
    $('.panel-body').slideDown();
    $(".sendmessage").removeAttr('disabled');
    var messagecontent = $('.messagecontent').val();
    if(e.keyCode == 8 || e.keyCode == 46){
        if($('.messagecontent').val() == ''){
            setTimeout(notewrite, 5000);
        }
    }
});



function notewrite() {
    if($('.messagecontent').val() == '') {
        $('#minim_chat_window').removeClass('glyphicon-minus').addClass('panel-collapsed glyphicon-plus');
        $('.panel-body').slideUp();
    }
}

function smalchat() {
    var notopen = localStorage.getItem("notopen");
    if (notopen !== '1') {
    var getitem = localStorage.getItem("action");
    $('#chat_window_1').show("Fold");
        var getmymessage = localStorage.getItem("message");
        if(getmymessage !==null){
            var gotmessage = JSON.parse(getmymessage);
            var html ='';
            $.each(gotmessage, function (key,value) {
                console.log(value);
                html+= '<div class="row msg_container base_receive">'+
                    '<div class="col-md-2 col-xs-2 avatar">'+
                    '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">'+
                    '</div>'+
                    '<div class="col-md-10 col-xs-10">'+
                    '<div class="messages msg_receive">'+
                    '<p>'+value+'</p>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
            });
            $('.addcontent').append(html);
        }

    if (getitem == null) {
        setTimeout(slidedown, 2000);
    }
}
}

function slidedown(){
    $('.panel-body').slideDown();
}

setTimeout(smalchat, 3000);


    $(".sendmessage").click(function(){
        $(".sendmessage").attr('clicked',1);
        var messagecontent = $('.messagecontent').val();
        var userid = $('#chat_window_1').attr('user');
        var token = $("input[name=_token]").val();

       var getmymessage = localStorage.getItem("message");
       console.log(getmymessage);
       if(getmymessage == null){
           var data = [];
           data.push(messagecontent);
           localStorage.setItem("message",JSON.stringify(data));
       }else{
           var gotmessage = JSON.parse(getmymessage);
           var newarray = [];
           $.each(gotmessage, function (key,value) {
               newarray.push(value);
           });
           newarray.push(messagecontent);
           localStorage.setItem("message",JSON.stringify(newarray));
       }
        setTimeout(getmessagesByadmin,20000);
        if(messagecontent !== ''){
            $.ajax({
                        url:'/sendmessageAdmin',
                        type:'post',
                        data:{_token:token,messagecontent:messagecontent,userid:userid},
                        success: function (data) {
                                    if(data.data == true){
                                    var html='';
                                    html+= '<div class="row msg_container base_receive">'+
                                        '<div class="col-md-2 col-xs-2 avatar">'+
                                        '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">'+
                                        '</div>'+
                                        '<div class="col-md-10 col-xs-10">'+
                                        '<div class="messages msg_receive">'+
                                        '<p>'+messagecontent+'</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>';
                                    $('.addcontent').append(html);
                                    $('.messagecontent').val('');
                                }
                        }
            });
        }

    });


    function getmessagesByadmin() {
        var token = $("input[name=_token]").val();
        $.ajax({
            url:'/getmessagesbyadminsmall',
            type:'post',
            data:{_token:token},
            success:function (data) {
                var html = '';
                $('.panel-body').slideDown();
                if(data.selectmessage.length>0){
                    $.each(data.selectmessage,function (key,value) {

                        html += '<div class="row msg_container base_sent">'+
                            '<div class="col-md-10 col-xs-10">'+
                            '<div class="messages msg_sent">'+
                            '<p>'+value.content+'</p>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-2 col-xs-2 avatar">'+
                            '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">'+
                            '</div>'+
                            '</div>';
                        $('.addcontent').append(html);
                    });
                }else{
                    html += '<div class="row msg_container base_sent">'+
                        '<div class="col-md-10 col-xs-10">'+
                        '<div class="messages msg_sent">'+
                        '<p>Admin is not online</p>'+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-2 col-xs-2 avatar">'+
                        '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">'+
                        '</div>'+
                        '</div>';
                    $('.addcontent').append(html);
                }
            }
        });
    }

    function clickedfunction() {
        var click = $(".sendmessage").attr('clicked');
        if($('.messagecontent').val() == ''){
            $('.panel-body').slideUp();
            //setTimeout(slideclose,2000);
            localStorage.setItem("action", 1);
        }
    }

    // function slideclose(){
    //     $( "#chat_window_1" ).hide("Fold");
    // }


setTimeout(clickedfunction,20000);
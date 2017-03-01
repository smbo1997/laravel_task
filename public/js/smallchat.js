//glyphicon icon_minim glyphicon-minus


$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    console.log($this);
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
    localStorage.setItem("action", 1);
});


$('.messagecontent').keypress(function () {
    $(".sendmessage").removeAttr('disabled');
})

function smalchat() {
    var getitem = localStorage.getItem("action");
    if(getitem == null){
        $('#chat_window_1').show("Fold");
        setTimeout(slidedown, 2000);
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
                                    $('.msg_container_base').append(html);
                                        $('.messagecontent').val('');
                                }
                        }
            });
        }

    });

    function clickedfunction() {
        var click = $(".sendmessage").attr('clicked');
        if(click == 0){
            localStorage.setItem("action", 1);
            $('.panel-body').slideUp();
            $( "#chat_window_1" ).hide("Fold");
        }
    }


setTimeout(clickedfunction,20000);
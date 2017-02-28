$(document).ready(function () {
    var conn = new WebSocket('ws://task.dev:8080');
    conn.onopen =function (e) {
        console.log('connected successfuly');
    };

    conn.onmessage =function (e) {
        var msg = JSON.parse(e.data);
       var to_name= $('.msg-wrap').attr('to_username');
        var html ='<div class="media msg">'+
            '<div class="media-body">'+
            '<h5 class="media-heading" style="color: #00dd00;">'+to_name+'</h5>'+
            '<small class="col-lg-10">'+msg.content+'</small>'+
            '</div>'+
            '</div>';
        $('#content_'+msg.user_id).append(html);
        //console.log(msg);
    };


    $('.getstore').click(function () {
       var id = $(this).attr('id');
       $('.send-message').attr('to_id',id);
       $('.msg-wrap').attr('id','content_'+id);
       var to_name = $('.getstore').attr('toname');
       $('.msg-wrap').attr('to_username',to_name);
       $('.msg-wrap').empty();
       $('.send-message').removeAttr('disabled');

    });

    $('.send-message').bind('keypress', function (e) {
        var content =  $('.send-message').val();
        if (e.keyCode == 13) {
            if(content !== ''){
                var user_id = $('.send-message').attr('userid');
                var to_id = $('.send-message').attr('to_id');
                var data = {content:content,user_id:user_id,to_id:to_id};
                conn.send(JSON.stringify(data));
                //console.log('Sended'+data);
                var name = $('.msg-wrap').attr('username');
                var html ='<div class="media msg">'+
                    '<div class="media-body">'+
                    '<h5 class="media-heading">'+name+'</h5>'+
                '<small class="col-lg-10">'+content+'</small>'+
                '</div>'+
                '</div>';
                $('#content_'+to_id).append(html);
                $('.send-message').val('');
            }
        }
    });
});
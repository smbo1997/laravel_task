$(document).ready(function () {

function myinterval() {
    var token = $("input[name=_token]").val();
    $.ajax({
        url:'/mynotification',
        type:'POST',
        data:{_token:token},
        success: function (data) {
            if(data.setcount>0){
                console.log(data.setcount);
                $('.notification').text(data.setcount);
            }
        }
    });
}
    setInterval(myinterval, 3000);

$('.seenupdate').click(function () {
    var updateid = $(this).attr('id');
    var token = $("input[name=_token]").val();
    $.ajax({
        url:'/seenupdate',
        type:'POST',
        data:{updateid:updateid,_token:token},
        success: function (data) {
            if(data.true = 'true'){
                $('#product_'+updateid).remove();
                $('.notification').text('');
            }
        }
    });
});

});
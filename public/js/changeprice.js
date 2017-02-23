$(document).ready(function () {
    $('#changeprice').change(function () {
        var to = $(this).val();
        if(to !=0){
            var ownprice = $('.productprice').val();
            var amount = 1;
           var endpoint = 'convert';
           var access_key = '8dd34d291f114f7e7ed514f9b64f4dbc';
           var from = 'USD';
            $.ajax({
                url: 'http://apilayer.net/api/live?access_key='+access_key+'&currencies='+to+'&source='+from+'&format='+amount+'',
                dataType: 'jsonp',
                success: function(json) {
                    if(json){
                        var newprice;
                        $.each(json.quotes,function (key,value) {
                              newprice = value;

                        });
                       var price = Math.round(ownprice * newprice);
                        $('.productprice').val(price);
                    }
                }
            });
        }

    })


    $('.trname').keyup(function () {
        var to = $(this).val();
        var key = 'AIzaSyDyT1FVXjNKasd8ruEJSI4pn9PUf9fjrxI';
        $.ajax({
            //url:'https://translation.googleapis.com/language/translate/v2?key='+key+'',
            url:'https://www.googleapis.com/language/translate/v2?key='+key+'&source=fr&target=en&q=bonjour"',
            dataType: 'jsonp',
            //data: {'source':'en','target':'ru', 'q': 'Hello'},
            success: function(callback ) {
                console.log(callback);
            }
        });
    });



});
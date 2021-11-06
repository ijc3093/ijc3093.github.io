// (getOrPost, data, idForSpinner)
function XHR_ajax(t, d, id){
    return $.ajax({
        type: t,
        url: 'proxy.php', 
        dataType: 'json', 
        data: d,
        cache: false,
        async: true,
        beforeSend: function(){
            $(id).append('<img src="assets/img/gears.gif" class="spin"/>');
        }
        }).always(function(){ // always fires when it comes back, no matter what. so this is where we turn off the spinner
        $(id).find('.spin').fadeOut(500, function(){
            $(this).remove();
        });
    }).fail(function(){
        //handle failure
    });
}

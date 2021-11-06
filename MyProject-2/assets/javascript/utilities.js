//Build back modals only
function getAttributesByName(arr, name, val){
    var result = null;

    $.each(arr, function(){
        if(this[name] === val){
            result = this;
        }
    });

    return result;
}

// Utility can run AJAX 
function ajax(t, d, id){
 	return $.ajax({
 		type: t,
 		cache: false,
 		dataType: 'json',
 		data: d,
 		url: 'http://serenity.ist.rit.edu/~plgics/proxy.php',
 		beforeSend: function() {
 		}
 	})
 	.always(function(){

 	})
 	.fail(function(err){
 		alert("There is something wrong right now.");
 		console.log(err);
 	})
 }
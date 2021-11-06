


/*This is for action to be performed when the document is read*/
      let xhr = new XMLHttpRequest(),
          /*This is for connect to html only*/
          url = "assets/JSON/data.json";
    
//Request is the URL string to flickr containings when user enters tag.
      xhr.onreadystatechange = function() 
      {
        if ( xhr.readyState === 4 && xhr.status === 200 ) 
        {
            var json = JSON.parse( xhr.responseText );

            console.log("Display full json")
            console.log(json);

            getFooter(json);
            // getEmployment( json );
         
        }
        else {
            console.log( "Request failed" );
        }
      };
    /* This represent the URL as sending the request to*/
      xhr.open( "GET", url, true );
      xhr.send();


//FOOTER
function getFooter( json ){
    
        var left = '';
        var right = '';
        var bottom = '';
        var modal = '';

        //social
        left = left + '<h4>' + json.social.title + '</h4>';
        left = left + '<blockquote>' + json.social.tweet + '</blockquote>';
        left = left + '<p>' + json.social.by + '</p>';
        left = left + '<a href="' + json.social.twitter + '" class="social"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a>';
        left = left + '<a href="' + json.social.facebook + '" class="social"><i class="fa fa-facebook fa-3x" aria-hidden="true"></i></a>';

        //quicklinks
        right = right + '<ul>';
        $.each(json.quickLinks, function(){
            right = right + '<li class="quickLinks"><a href="' + this.href + '">' + this.title + '</a></li>';
        });

        //news
        right = right + '<li class="quickLinks"><a href="#news" onclick="getNews();" class="modal-trigger" data-name="news">News</a></li>';
        right = right + '<li class="quickLinks"><a href="#contact" class="modal-trigger" data-name="contact">Contact Us</a></li>';
        right = right + '</ul>';

        // news modal
        modal = modal + '<div class="modal" id="news"><span class="right"><a href="#!" class="modal-action modal-close x-close"><i class="fa fa-times" aria-hidden="true"></i></a></span><div class="modal-content clearfix" id="news-content"></div></div>';

        // contact modal
        modal = modal + '<div class="modal" id="contact"><span class="right"><a href="#!" class="modal-action modal-close x-close"><i class="fa fa-times" aria-hidden="true"></i></a></span><div class="modal-content clearfix" id="contact-content"><iframe name="contact" class="contact"  src="http://www.ist.rit.edu/api/contactForm/"></iframe></div></div>';

        //copyright
        bottom = bottom + '<div class="container">';
        bottom = bottom + json.copyright.html;
        bottom = bottom + '</div>';
    
        document.getElementById( "footer-left" ).innerHTML = left;
        document.getElementById( "footer-right" ).innerHTML = right;
        document.getElementById( "footer-bottom" ).innerHTML = bottom;
        document.getElementById( ".container-main" ).innerHTML = modal;
        $('.modal-trigger').leanModal();
    
}


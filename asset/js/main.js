jQuery(document).ready(function() {
    // switching display mode responsive and non-responsive
    var key = 'display_mode';
    var current = localStorage.getItem(key);
    if(current == 'responsive'){
        jQuery('#viewport').attr('content','width=device-width, initial-scale=1, shrink-to-fit=yes');
        jQuery('html').removeClass('non-responsive');
        jQuery('html').addClass('responsive');
        jQuery('#desktop-mode').removeClass('active');
        jQuery('#mobile-mode').addClass('active');
    }
    if(current == 'non-responsive'){
        jQuery('#viewport').attr('content','width=device-width, initial-scale=0, shrink-to-fit=yes');
        jQuery('html').removeClass('responsive');
        jQuery('html').addClass('non-responsive');
        jQuery('#mobile-mode').removeClass('active');
        jQuery('#desktop-mode').addClass('active');
    }
    var current_mode = localStorage.getItem(key);
    jQuery('#mobile-mode').on('click', function(){
        localStorage.setItem(key, 'responsive');
        location.reload();
    });
    jQuery('#desktop-mode').on('click', function(){
        localStorage.setItem(key, 'non-responsive');
        location.reload();
    });
    
    // action on responsive and mobile mode
    jQuery('.nav-button').on('click', function() {
        jQuery('.content').toggleClass('isOpen');
        jQuery(this).toggleClass("hamberger x");
    });
    
    // adding html from desktop menu to sm menu
    jQuery('.sm-navbar ul').html(jQuery('.lg-main-nav ul').html());
    jQuery('.mobile-top-menu ul').html(jQuery('.desktop-top-menu ul').html());
    
    // sm nav menu
    jQuery(".sm-navbar .menu-item-has-children").append("<span class='oi oi-chevron-bottom right'></span>");
    jQuery(".sm-navbar .menu-item-has-children ul").hide();
    jQuery(".sm-navbar .menu-item-has-children ul").parent(".current-menu-ancestor").find("ul").show();
    jQuery(".sm-navbar .menu-item-has-children ul").parent(".current-menu-ancestor").find(".right").toggleClass("oi-chevron-top oi-chevron-bottom");
    jQuery(".sm-navbar .menu-item-has-children span").click(function () {
        jQuery(this).parent(".menu-item-has-children").children("ul").slideToggle("slow");
        jQuery(this).parent(".menu-item-has-children").find(".right").toggleClass("oi-chevron-top oi-chevron-bottom");
    });
    
    // slick slideshow
    jQuery(".slick-slideshow").slick({
        speed: 500,
        autoplay: true,
        adaptiveHeight: true,
        mobileFirst: true,
        nextArrow: '<div class="slick-arrow slick-next"><span class="oi oi-chevron-right"></span></div>',
        prevArrow: '<div class="slick-arrow slick-prev"><span class="oi oi-chevron-left"></span></div>'
    });
    jQuery('.non-responsive .slick-slideshow-responsive').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        infinite: true,
        adaptiveHeight: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4
    });
    jQuery('.responsive .slick-slideshow-responsive').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        infinite: true,
        adaptiveHeight: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
        ]
    });
    
    // tab collapse
    jQuery(".tab-collapse > li > ul").hide();
    jQuery(".tab-collapse > li.active > ul").show(); 
    jQuery(".tab-collapse > li > a").click(function () {
        if ( jQuery(this).parent("li").hasClass("active") ){
            return false;
        }
        
        // if your want to maintain the height
        //height = jQuery(this).closest(".tab-collapse").height();
        //$('.tab-collapse').css('min-height', height);
        
        jQuery(this).closest(".tab-collapse").children("li").children("ul").slideUp("slow"); 
        jQuery(this).closest(".tab-collapse").children("li").removeClass("active");
        
        jQuery(this).parent("li").addClass("active");
        jQuery(this).parent("li").children("ul").slideToggle("slow");
        return false;
    });


    // collapsible action
    jQuery('.collapsible-action').on('click', function() {
        jQuery(this).closest('li').children('ul').slideToggle();
        jQuery(this).children('.oi').toggleClass("oi-chevron-bottom oi-chevron-right");
    });

    jQuery( '.google-map-api' ).each( function( index, Element ) {
        var latlng = jQuery( this ).attr( 'data-latlng' );
        var title = jQuery( this ).attr( 'data-title' );
        latlng = latlng.replace(/\s/g, '');

        latlng = latlng.split(',');
        //console.log(parseFloat(latlng[1]));
        // The map, centered at latlng
        var map = new google.maps.Map(
            Element, { 
                zoom: 14, 
                center: {
                    lat: parseFloat(latlng[0]),
                    lng: parseFloat(latlng[1])
                }
            }
        );
		var infowindow = new google.maps.InfoWindow({
			content: '<div style="padding:0px 10px;text-align:center;"><h6 class="font-moul">'+title+'</h6><a target="_blank" href="https://maps.google.com/maps?ll='+parseFloat(latlng[0])+','+parseFloat(latlng[1])+'&cid=6475309677667705757">View larger map</a></div>'
        });
        //The marker, positioned at latlng
        var marker = new google.maps.Marker( {
            position: {
                lat: parseFloat(latlng[0]),
                lng: parseFloat(latlng[1])
            },
			map: map
        } );
		
		marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
		infowindow.open(map, marker);
    } );

    jQuery( '.collapse-category .action-group' ).on( 'click', function() {
        jQuery(this).closest('li').children('ul').slideToggle();
        jQuery(this).children('.oi').toggleClass("oi-plus oi-minus");
    } );
});

jQuery(document).ready(function() {
    jQuery('.nav-button').on('click', function() {
        jQuery('.content').toggleClass('isOpen');
        jQuery(this).find(".nav-icon").toggleClass("oi-menu oi-x");
    });
    
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
    $(".slick-slideshow").slick({
        //dots: true,
        speed: 500,
        autoplay: true,
        adaptiveHeight: true,
        mobileFirst: true,
        nextArrow: '<div class="primary-background-color slick-arrow slick-next"><span class="oi oi-chevron-right"></span></div>',
        prevArrow: '<div class="primary-background-color slick-arrow slick-prev"><span class="oi oi-chevron-left"></span></div>'
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
});
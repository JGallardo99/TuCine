jQuery(document).ready(function($){
	
    /*Dropdown*/
    $('.AADrpd').each(function() {
        var $AADrpdwn = $(this);
        $('.AALink', $AADrpdwn).click(function(e){
          e.preventDefault();
          $AADrpdDv = $('.AACont', $AADrpdwn);
          $AADrpdDv.parent('.AADrpd').toggleClass('open');
          $('.AACont').not($AADrpdDv).parent('.AADrpd').removeClass('open');
          return false;
        });
    });
    $(document).on('click', function(e){
        if ($(e.target).closest('.AACont').length === 0) {
            $('.AACont').parent('.AADrpd').removeClass('open');
        }
    });
       
    /*Toggle*/
    $('.AATggl').on('click', function(){
        var shwhdd = $(this).attr('data-tggl');
        $('#'+shwhdd).toggleClass('open');
        $(this).toggleClass('open');
    });
    
    /*Accordion*/
    $('.AACrdn').find('.AALink').click(function(){
        $(this).toggleClass('on');
        $('.AALink').not($(this)).removeClass('on');
    });
    
    /*Sl*/
    $(".MovieListSld").owlCarousel({
        items:1,autoHeight:true,loop:true, autoplay: $( '.MovieListSld' ).data( "autoplay" )
    });
    $('.MovieListTop').owlCarousel({
        margin:10,
        autoplay: $( '.MovieListTop' ).data( "autoplay" ),
        responsive:{
            0:{items:2},
            360:{items:3},
            560:{items:4},
            760:{items:6},
            960:{items:8},
            1360:{items:10},
            1600:{items:12}
        }
    });

    if ( $( ".RelatedList" ).length ) {
    $('.RelatedList').owlCarousel({
        margin:10,
        responsive:{
            0:{items: $( ".RelatedList" ).data( "r0" ) },
            360:{items: $( ".RelatedList" ).data( "r360" ) },
            560:{items: $( ".RelatedList" ).data( "r560" ) },
            760:{items: $( ".RelatedList" ).data( "r760" ) },
            960:{items: $( ".RelatedList" ).data( "r960" ) },
            1360:{items: $( ".RelatedList" ).data( "r1360" ) },
            1600:{items: $( ".RelatedList" ).data( "r1600" ) }
        }
    });  
    }
    
    /*lg*/$(document).keyup(function(a){if(a.keyCode==27)$('.lgtbx-on').toggleClass('lgtbx-on');});	
    $('.lgtbx').click(function(event){event.preventDefault();$('body').toggleClass('lgtbx-on');});	
    $('.lgtbx-lnk').click(function(event){event.preventDefault();$('body').toggleClass('lgtbx-on');});
    
    /*tabs*/
    $('.ListOptions>li').click(function(){
        $('.on_iframe').html(btoa($('.on_iframe').html()));
        var tab_id = $(this).attr('data-VidOpt');
        $('.ListOptions>li').removeClass('on');
        $('.Video').removeClass('on on_iframe');
        $(this).addClass('on');
        $("#"+tab_id).addClass('on on_iframe');
        $('.on_iframe').html(atob($('.on_iframe').html()));
        $('#VidOpt').removeClass('open');
    });
    
    /*scroll*/
    (function(a){var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,false);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,false);else this.onmousewheel=null}};a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}});function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=true,g=0,h=0;b=a.event.fix(c);b.type="mousewheel";if(c.wheelDelta)e=c.wheelDelta/120;if(c.detail)e=-c.detail/3;h=e;if(c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS){h=0;g=-1*e}if(c.wheelDeltaY!==undefined)h=c.wheelDeltaY/120;if(c.wheelDeltaX!==undefined)g=-1*c.wheelDeltaX/120;d.unshift(b,e,g,h);return(a.event.dispatch||a.event.handle).apply(this,d)}})(jQuery);$(function(){$(".ListOptions").mousewheel(function(a,b){this.scrollLeft-=b*30;a.preventDefault()})})
    
    /*trailer*/
    // open
    $(document.body).on('click', '.TPlay' ,function(){
        var iframe = $( this ).data( "trailer" );
        $('.Ttrailer').show().addClass('on');
        $('.Ttrailer').find('.Modal-Content').prepend(iframe);
    });
    
    // close
    $(document.body).on('click', '.Ttrailer .Modal-Close,.Ttrailer .AAOverlay' ,function(){
        $('.Ttrailer').hide().removeClass('on');
        $('.Ttrailer .Modal-Content iframe').remove();
    });
    
    // iframe encode
    
    if ( $( ".TrvideoFirst" ).length ) { $('.TrvideoFirst').html(atob($('.TrvideoFirst').html())); }
   
    // links downloads
    $(document.body).on('click', '.TrLnk' ,function(){
        var href = $(this).data('id');
        window.open(href);
    });    
});
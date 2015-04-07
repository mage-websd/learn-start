
$sns_jq(document).ready(function($){
	var currentdevice = '';
	var currentdevice2 = '';
	var bootstrap_elements = $('#bd [class*="span"]');
	var item_g_elements = $('#bd [class*="sns-item-g"]');
	// Build data
	bootstrap_elements.each ( function(){
		var $this = $(this);
		// With attr data-*
		$this.data();
		// Make the source better view in inspector
		$this.removeAttr ('data-default data-wide data-normal data-tablet data-mobile');
		// For element no attr data-default
		if (!$this.data('default'))
			$this.data('default', $this.attr('class'));
	});

	function updateBootstrapElementClass(newdevice){
  		if (newdevice == currentdevice) return ;
		bootstrap_elements.each(function(){
			var $this = $(this);
			// Default
			if ( !$this.data('default') || (!$this.data(newdevice) && (!currentdevice || !$this.data(currentdevice))) )
				return;
			// Remove current
			if ($this.data(currentdevice)) $this.removeClass($this.data(currentdevice));
			else $this.removeClass ($this.data('default'));
			// Add new
			if ($this.data(newdevice)) $this.addClass ($this.data(newdevice));
			else $this.addClass ($this.data('default'));
		});
    	currentdevice = newdevice;
	};

	function viewport() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}
	function detectDevice () {
		var width = viewport().width; //console.log(width);
		if( width > 1200 ){
			return 'wide';
		}else if( width >= 980 ){
			return 'normal';
		/*}else if( width >= 640 && width < 980 ){
			return 'stablet';*/
		}else if(  width >= 768 ){
			return 'tablet';
		}else if(  width > 0 ){
			return 'mobile';
		}
		/*
		Mobile portrait (320x480)
		Mobile landscape (480x320)
		Small tablet portrait (600x800)
		Small tablet landscape (800x600)
		Tablet portrait (768x1024
		Tablet landscape (1024x768)
		*/
	}
	function spotlight(el){
		h = 0;
		i = 0;
		$(el).each(function(){ //console.log($(this).height());
			i++;
			if(i==1){
				h = $(this).height();
			}
			if(h < $(this).height()){
				h = $(this).height();
			}
		});
		$(el).each(function(){
			$(this).css('height', h);
		});
	}
	menuOsetTop = 0;
	if($('#sns_menu') && KEEP_MENU == 1){
		// fix sub nav on scroll
		menuOsetTop = $('#sns_menu').offset().top;
		processScroll();
		$(window).scroll(function(){
			processScroll();
		});
	}
	function processScroll() {
		var scrollTop = $(window).scrollTop();
		if (scrollTop >= menuOsetTop) {
			$('#sns_menu').addClass('keep-menu');
			if($('body#bd').hasClass('open-stickynote-top')){
				$('#sns_menu.keep-menu').stop().animate({top:$('.stickynote-top').outerHeight()}, {duration:200});
			}
			if($('body.boxed-layout').length){
				$('#sns_menu').css('width', $('#sns_wrapper').outerWidth());
				$('#sns_menu').css('left', $('#sns_wrapper').offset().left);
			}
		} else if (scrollTop <= menuOsetTop) {
			$('#sns_menu').removeClass('keep-menu');
			$('#sns_menu.keep-menu').stop().animate({top:'0px'}, {duration:200});
			//if($('body#bd').hasClass('open-stickynote-top')){
				$('#sns_menu').stop().animate({top:'0px'}, {duration:0});
			//}
			if($('body.boxed-layout').length){
				$('#sns_menu').css('width', '');
				$('#sns_menu').css('left', '');
			}
		}
	}

  	updateBootstrapElementClass (detectDevice());
  	// With window resize
  	$(window).resize(function(){
    	if ($.data(window, 'detect-device-time'))
      		clearTimeout($.data(window, 'detect-device-time'));
    	$.data(window, 'detect-device-time',
      		setTimeout(function(){
        		updateBootstrapElementClass (detectDevice());
        		if($('#sns_menu') && KEEP_MENU == 1){
					// fix sub nav on scroll
					menuOsetTop = $('#sns_menu').offset().top;
					processScroll();
					$(window).scroll(function(){
						processScroll();
					});
				}
      		}, 200)
    	);
  	});
});

$sns_jq(window).load(function(){
	function viewport() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}
	
	if( $sns_jq('.stickynote-top').length ){
		if($sns_jq('body.boxed-layout').length){
			$sns_jq('.stickynote-top').css({'width': $sns_jq('#sns_wrapper').outerWidth(), 'left':$sns_jq('#sns_wrapper').offset().left});
		}
		if(!$sns_jq('.stickynote-top').hasClass('loaded')) $sns_jq('.stickynote-top').addClass('loaded');
		if(getCookie(TMPL_NAME + '_prstatus')!='close'){
			$sns_jq('body#bd').addClass('open-stickynote-top', {duration:200});
			$sns_jq('.stickynote-top').stop().animate({top:'0px'}, {duration:200});
			$sns_jq('#sns_wrapper').stop().animate({paddingTop:$sns_jq('.stickynote-top').outerHeight()}, {duration:200});
		}else{
			$sns_jq('.stickynote-top').stop().animate({top: - $sns_jq('.stickynote-top').outerHeight()}, {duration:0});
			$sns_jq('#sns_wrapper').stop().animate({paddingTop:'0px'}, {duration:0});
		}
		$sns_jq('.stickynote-top .btn-close').bind('click', function(){
			if($sns_jq('body#bd').hasClass('open-stickynote-top')){
				$sns_jq('body#bd').removeClass('open-stickynote-top', {duration:200});
				$sns_jq('.stickynote-top').stop().animate({top: - $sns_jq('.stickynote-top').outerHeight()}, {duration:200});
				$sns_jq('#sns_wrapper').stop().animate({paddingTop:'0px'}, {duration:200});
				if($sns_jq('#sns_menu').hasClass('keep-menu')){
					$sns_jq('#sns_menu.keep-menu').stop().animate({top:'0px'}, {duration:200});
				}
				createCookie(TMPL_NAME + '_prstatus', 'close', 1);
			}else{
				$sns_jq('body#bd').addClass('open-stickynote-top', {duration:200});
				$sns_jq('.stickynote-top').stop().animate({top:'0px'}, {duration:200});
				$sns_jq('#sns_wrapper').stop().animate({paddingTop:$sns_jq('.stickynote-top').outerHeight()}, {duration:200});
				if($sns_jq('#sns_menu').hasClass('keep-menu')){
					$sns_jq('#sns_menu.keep-menu').stop().animate({top:$sns_jq('.stickynote-top').outerHeight()}, {duration:200});
				}
				createCookie(TMPL_NAME + '_prstatus', 'close', -1);
			}
		});
	}
	$sns_jq(window).resize(function(){
		if( $sns_jq('.stickynote-top').length ){
			if($sns_jq('body.boxed-layout').length){
				$sns_jq('.stickynote-top').css({'width': $sns_jq('#sns_wrapper').outerWidth(), 'left':$sns_jq('#sns_wrapper').offset().left});
			}
			if(getCookie(TMPL_NAME + '_prstatus')!='close'){
				$sns_jq('#sns_wrapper').stop().animate({paddingTop:$sns_jq('.stickynote-top').outerHeight()}, {duration:200});
			}else{
				$sns_jq('.stickynote-top').stop().animate({top: - $sns_jq('.stickynote-top').outerHeight()}, {duration:0});
			}
		}
	});
});
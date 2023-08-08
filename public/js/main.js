/* CUSTOM FUNCTION WRITE HERE	*/
"use strict";
jQuery(document).on('ready', function() {
	/* MOBILE MENU*/
	function collapseMenu(){
		jQuery('.dc-navigation ul li.menu-item-has-children, .dc-navdashboard ul li.menu-item-has-children, .dc-navigation ul li.menu-item-has-mega-menu').prepend('<span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>');
		jQuery('.dc-navigation ul li.menu-item-has-children span, .dc-navigation ul li.menu-item-has-mega-menu span').on('click', function() {
			jQuery(this).parent('li').toggleClass('dc-open');
			jQuery(this).next().next().slideToggle(300);
		});
		jQuery('.dc-navdashboard ul li.menu-item-has-children').on('click', function(){
			jQuery(this).toggleClass('dc-open');
			jQuery(this).find('.sub-menu').slideToggle(300);
		});
	}
	collapseMenu();
	/* Google Map */
	if(jQuery('#dc-locationmap').length > 0){
		var _dc_locationmap = jQuery('#dc-locationmap');
		_dc_locationmap.gmap3({
			marker: {
				address: '1600 Elizabeth St, Melbourne, Victoria, Australia',
				options: {
					title: 'Robert Frost Elementary School'
				}
			},
			map: {
				options: {
					zoom: 16,
					scrollwheel: false,
					disableDoubleClickZoom: true,
				}
			}
		});
	}
	/*OPEN CLOSE */
	jQuery('#dc-loginbtn, .dc-loginheader a').on('click', function(event){
		event.preventDefault();
		jQuery('.dc-loginarea .dc-loginformhold').slideToggle();
	});
	jQuery('.dc-forgot-password').on('click', function (e) {
		jQuery('.do-login-form').addClass('dc-hide-form');
		jQuery('.dc-loginheader span').html('Reset Password');
		jQuery('.do-forgot-password-form').removeClass('dc-hide-form');
	});
	jQuery('.dc-show-login').on('click', function (e) {       
		jQuery('.do-login-form').removeClass('dc-hide-form');
		jQuery('.dc-loginheader span').text('Login');
		jQuery('.do-forgot-password-form').addClass('dc-hide-form');
	});
	/* DASHBOARD MENU */
	if(jQuery('#dc-btnmenutoggle').length > 0){
		jQuery("#dc-btnmenutoggle").on('click', function(event) {
			event.preventDefault();
			jQuery('#dc-wrapper').toggleClass('dc-closemenu');
			jQuery('body').toggleClass('dc-noscroll');
			jQuery('.dc-navdashboard ul.sub-menu').hide();
		});
	}
	/* ADD AND REMOVE CLASS  */
	if(jQuery('.dc-docsearch').length > 0){
		var _dc_docsearch = jQuery('.dc-docsearch');
		_dc_docsearch.on('click',function () {
			jQuery(this).parents('.dc-innerbanner-holder').addClass('dc-open');
			jQuery(this).parents('.dc-innerbanner-holder').addClass('dc-opensearchs');
		});
		var _dc_home = jQuery('.dc-home');
		_dc_home.on('click',function () {
			jQuery('.dc-home').parents('.dc-innerbanner-holder').removeClass('dc-opensearchs');
		});
	}
	/* Toggle Filter Area */
	$(document).on('click',function(e) 
		{
		    var container = $(".dc-advancedsearch-holder");
		    var form_container = $(".dc-innerbannerform");
		    var btn_filter = $(".dc-docsearch");
		    if (!container.is(e.target) 
		    	&& container.has(e.target).length === 0
		    	&& !form_container.is(e.target) && form_container.has(e.target).length === 0
		    	&& !btn_filter.is(e.target) && btn_filter.has(e.target).length === 0
		    ) 
		    {
		        container.slideUp(400);
		        e.stopPropagation();
	   		}
		});
	jQuery(document).on('click', '.dc-docsearch', function(e){
		e.preventDefault();
		var _this = jQuery(this);
		_this.parents('.dc-opensearchs').find('.dc-advancedsearch-holder').slideToggle(400);
	});
	/* BANNER SLIDER V TWO	*/
	var _dc_bannervtwo = jQuery("#dc-bannervtwo")
	_dc_bannervtwo.owlCarousel({
		items:1,
		loop:true,
		nav:false,
		autoplay:true,
		smartSpeed:450,
		mouseDrag: false,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
		autoplayHoverPause:false
	});
	
    /* THEME VERTICAL SCROLLBAR */
	if(jQuery('.dc-verticalscrollbar').length > 0){
		var _dc_verticalscrollbar = jQuery('.dc-verticalscrollbar');
		_dc_verticalscrollbar.mCustomScrollbar({
			axis:"y",
		});
	}
	/* THEME HORIZANTAL SCROLLBAR */
	if(jQuery('.dc-horizontalthemescrollbar').length > 0){
		var _dc_horizontalthemescrollbar = jQuery('.dc-horizontalthemescrollbar');
		_dc_horizontalthemescrollbar.mCustomScrollbar({
			axis:"x",
			advanced:{autoExpandHorizontalScroll:true},
		});
	}
	
	/* SEARCH CHOSEN */
	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
			jQuery(selector).chosen(config[selector]);
	}
	/* THEME ACCORDION */
	function themeAccordion() {
		jQuery('.dc-panelcontent').hide();
		jQuery('.dc-accordion .dc-paneltitle:first').addClass('active').next().slideDown('slow');
		jQuery('.dc-accordion .dc-paneltitle').on('click',function() {
			if(jQuery(this).next().is(':hidden')) {
				jQuery('.dc-accordion .dc-paneltitle').removeClass('active').next().slideUp('slow');
				jQuery(this).toggleClass('active').next().slideDown('slow');
			}
		});
	}
	themeAccordion();
	function childAccordion() {
		jQuery('.dc-subpanelcontent').hide();
		jQuery('.dc-childaccordion .dc-subpaneltitle:first').addClass('active').next().slideDown('slow');
		jQuery('.dc-childaccordion .dc-subpaneltitle').on('click',function() {
			if(jQuery(this).next().is(':hidden')) {
				jQuery('.dc-childaccordion .dc-subpaneltitle').removeClass('active').next().slideUp('slow');
				jQuery(this).toggleClass('active').next().slideDown('slow');
			}
		});
	}
	childAccordion();
	/* JRATE STARS  */
	jQuery(function () {
		var that = this;
		var toolitup = $("#dc-jrate").jRate({
			rating: 2.0,
			strokeColor: '#dadadacc',
			precision: 1,
  			height: 16,
  			width:16,
			startColor: "#fecb02",
			endColor: "#fecb02",
			backgroundColor: '#ddd',
			minSelected: 1,
			shapeGap: '5px',
			count: 5,
			onChange: function(rating) {
				jQuery('.counter').text(rating + '');
			},
			onSet: function(rating) {
				console.log("OnSet: Rating: "+rating);
			}
		});
	});
	/* CONSULTATION FEE SLIDER */
	$( function() {
		jQuery( "#dc-productrangeslider" ).slider({
		  range: "max",
		  min: 1,
		  max: 4,
		  value: 1,
		  slide: function( event, ui ) {
		    $( "#amount" ).val( ui.value );
		  }
		});
		jQuery( "#amount" ).val( jQuery( "#dc-productrangeslider" ).slider( "value" ) );
	} );
	/*OPEN CLOSE */
	jQuery('.dc-popupdropdown').on('click', function(event){
		event.preventDefault();
		jQuery('.dc-docinfoform').slideToggle();
	});
	/* ADD Class */
	jQuery('.dc-popupdropdown').on('click', function() {
		var _this = jQuery(this);
		_this.parents('.dc-tabbtns').toggleClass('dc-tabbtnsactive');
	});
	/* BANNER VIDEO */
	jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		autoplay_slideshow: false,	
		social_tools: false
	});
	/* ADD Class */
	jQuery('.dc-myskills .dc-addinfo').on('click', function() {
		var _this = jQuery(this);
		_this.parents('li').addClass('dc-skillsaddinfo');
	});
	jQuery('.dc-myskills .dc-deleteinfo').on('click', function() {
		var _this = jQuery(this);
		var _val = _this.parents('li').find('.skill-dynamic-field input').val();
		_this.parents('li').find('.skill-dynamic-html .skill-val').html(_val);
		_this.parents('li').removeClass('dc-skillsaddinfo');
	})
	/* FIXED SIDEBAR */
	function fixedNav(){			
		$(window).scroll(function () {			
		var $pscroll = $(window).scrollTop();						
			if($pscroll > 76){
			 $('.dc-sidebarwrapper').addClass('dc-fixednav');
			}else{
			 $('.dc-sidebarwrapper').removeClass('dc-fixednav');
			}
		});
	}
	fixedNav();
	/* DELETE li */
	jQuery('.dc-closediv').on('click', function(){
	   jQuery(this).closest("li").remove();
	});
	/* DELETE SPACES */
	jQuery('.dc-spaces i, .dc-dayscontent li a i').on('click', function(){
	   jQuery(this).closest(".dc-spaces,.dc-dayscontent li").remove();
	});
	/* TINYMCE WYSIWYG EDITOR */
	if(jQuery('#dc-tinymceeditor').length > 0){
		tinymce.init({
			selector: 'textarea#dc-tinymceeditor',
			height: 300,
			theme: 'modern',
			plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak'],
			menubar: false,
			statusbar: false,
			toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify',
			image_advtab: true,
		});
	}
	/*OPEN CLOSE */
	jQuery('.dc-btnaddays').on('click', function(event){
		event.preventDefault();
		jQuery('.dc-addays').slideToggle();
	});
	/*  APPOINTMENTS CALENDER  */
	jQuery('#dc-calendar').fullCalendar({
		height: 'auto',
		dayClick: function(date, jsEvent, view) {
			alert('Clicked on: ' + date.format());
		}
	});	
});
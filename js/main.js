jQuery(document).ready(function($){
	
	var localDev = true;

	if(localDev == true) {
		loadReload();
	}
	
	var desktopEmailPlaceholder = $('#global_footer .news_signup input[type="email"]').attr('placeholder');
	var mobileEmailPlaceholder = "Enter your email address";
	
	$('.mobile_menu_btn').click(function(){
		if($(this).hasClass('menu_open')){
			$('.mobile_menu').slideUp(500, function(){
				$('.mobile_menu_btn').removeClass('menu_open');
				$('.mobile_menu').css('display', 'none');
			});
		} else {
			$('.mobile_menu').css('display', 'block');
			$('.mobile_menu').slideDown(500);
			$(this).addClass('menu_open');
		}
	});
	
	$('.mobile_menu ul li').click(function(){
		if($(this).hasClass('menu-open')) {
			$(this).removeClass('menu-open');
			$(this).children('.sub-menu').slideUp(500);
			$(this).children('.sub-menu').css('display', 'none');
		} else {
			$(this).children('.sub-menu').css('display', 'block');
			$(this).addClass('menu-open');
			$(this).children('.sub-menu').slideDown(500);
		}
	});
	
	function mobileMenu() {
		$('.mobile_header_menu > li > a').click(function(e){
			e.preventDefault();
			e.stopPropagation();
			
			if(!$(this).parent().hasClass('menu-open')){
				$(this).parent().addClass('menu-open');
				$(this).siblings('ul').css('display', 'block');
			} else {
				var linkLocation = $(this).attr('href');
				window.location = linkLocation;
			}
		});
	}
	mobileMenu();
	
	function tabletMenu() {
		$('.tablet_menu ul li .sub-menu').addClass('tablet_sub_menu');
		$('.tablet_menu > ul > li > a').click(function(e) {	
			e.preventDefault();
			e.stopPropagation();
			
			if(!$(this).parent().hasClass('default_off')) {
				$(this).parent().addClass('default_off');
				$(this).parent().addClass('sub-menu-open');
			} else {
				var linkLocation = $(this).attr('href');
				window.location = linkLocation;
			}
		});
	}
	
	$('html, body, a').click(function() {
		$('.tablet_menu ul li').removeClass('default_off');
	});
	
	$(window).resize(function(){
		var windowWidth = $(window).width();
		if(windowWidth <= 768) {	
			tabletMenu();	
		}
		
		if(windowWidth > 670){
			$('.mobile_menu').css('display', 'none');
			$('#global_footer .news_signup input[type="email"]').attr('placeholder', desktopEmailPlaceholder);
		} else {
			$('#global_footer .news_signup input[type="email"]').attr('placeholder', mobileEmailPlaceholder);
		}
		
		if(windowWidth > 768) {
			$('.tablet_menu ul li .sub-menu').removeClass('tablet_sub_menu');
		}
		
	});
	
	$('.sub-menu').click(function(e){
		e.stopPropagation();
	});
	
	$('.fancybox').fancybox({
		width: 'auto',
	});
	
	$('.log_in').fancybox({
		autoWidth: false,
		width: '480',
		wrapCSS: 'login_form',
	});
	
	$(window).load(function(){
		$('.flexslider_events').flexslider({
			directionNav: false,
			start: function(){
		    	$('.flexslider_events').css('display', 'block'); 
		    },
		});
	});
	
	$('.map img').rwdImageMaps();
	
	var bgImage = document.getElementById('search'), 
		style = window.getComputedStyle(bgImage),
		bg = style.getPropertyValue('background');
	
	$('#search').focus(function(){
		
		if(!this.value){
			$(this).css('background','none');
		}
	});
	
	$('#search').blur(function(){
		
		if(this.value.length === 0){
			$(this).css('background',bg);
		}
	});
	
	$('.transportation_alert img').click(function(e) {
		$('.transportation_alert').fadeOut();
	});
	
	//ddslick drop down variables
	
	var sqft = [
		{ text: "Sq. Ft.", value: null },
	    { text: "0 - 1,000 Sq. Ft.", value: '0 - 1,000', },
	    { text: "1,000 - 2,500 Sq. Ft.", value: '1,000 - 2,500', },
	    { text: "2,500 - 5,000 Sq. Ft.", value: '2,500 - 5,000', },
	    { text: "5,000 - 20,000 Sq. Ft.", value: '5,000 - 20,000', },
	    { text: "20,000+ Sq. Ft.", value: '20,000', }
	];
	
	var roomNumbers = [ {text: "0", value: 0} ];
	for(i = 1; i <= 10; i++) {
		roomNumbers.push({ text: i, value: i, });
	}
	
	$('#home_sqft').ddslick({
	    data: sqft,
	    selectText: "Sq. Ft.",
	    onSelected: function(data) {
			$('#avail_form #sqft').val(data.selectedIndex);	
		}
	});
	
	$('#home_complex').ddslick({
		onSelected: function(data) {
			$('#avail_form #complex').val(data.selectedIndex);	
		}
	});
	
	$('#private_offices').ddslick({
		data: roomNumbers,
		defaultSelectedIndex: 0
	});
	
	$('#work_stations').ddslick({
		data: roomNumbers,
		defaultSelectedIndex: 0
	});
	
	$('#small_conference').ddslick({
		data: roomNumbers,
		defaultSelectedIndex: 0
	});
	
	$('#large_conference').ddslick({
		data: roomNumbers,
		defaultSelectedIndex: 0
	});
	
	$('.gfield_select').ddslick({
	});
	
	$('.clear_left').click(function(e) {
		e.preventDefault();
		var i = 0;
		$('#private_offices').ddslick('select', {index: i });
		$('#work_stations').ddslick('select', {index: i });
		$('#small_conference').ddslick('select', {index: i });
		$('#large_conference').ddslick('select', {index: i });
	});
	
	$('.clear_right').click(function(e) {
		e.preventDefault();
		$('.available_spaces .right_calc input[type="checkbox"]').each(function(e) {
			$(this).attr('checked', false);	
		});
	});
	
	$('#avail_form button').click(function(e) {
		$('#avail_form').submit();
	});
	
	$('#business_industry').ddslick({
		selectText: 'View by Industry',
	});
	
	$('#business_sortby').ddslick({
		selectText: 'View Alphabetically',
	});

    $('#billing_country').ddslick({
        //selectText: 'United States(US)',
    });

    $('#shipping_country').ddslick({
        //selectText: 'United Stated(US)',
    });
    $('#billing_state').ddslick({
        //selectText: 'State',
    });
    $('#input_7_29_3').ddslick({
        //selectText: AM/PM
    });
    $('#input_7_30_3').ddslick({
        //selectText: AM/PM
    });
    
    if ($('a[href="/my-account/#cim-my-payment-methods"]').length ) {
	    $('a[href="/my-account/#cim-my-payment-methods"]').attr('href', '/payment');
    }
	
	var mySwiper = new Swiper('.swiper-container', {
	    mode:'horizontal',
	    slidesPerView: 5,
	    loop: false
    });
    
    $('.directory_left').click(function(){
		mySwiper.swipePrev();
	});
	
	$('.directory_right').click(function(){
		mySwiper.swipeNext();
	});

});
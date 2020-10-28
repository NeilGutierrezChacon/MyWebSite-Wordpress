//  DMS RICARDO CUSTOM JS
(function($) {

	// --- GLOBAL VARS ---------------------------- 

		// COLOR SCROLLBAR
		var color_1 = "rgba(0,0,0,0.7)";

		// COLOR SCROLLBAR IN BOX
		var color_2 = "rgba(0, 0, 0, 1)";

		// WIDTH TO DISPLAY MENU
		var widthDisplayMenu = 1280; // CHANGE IN SASS GENERIC VARS IF CHANGE THIS

		var oldWidth = window.innerWidth;

		// ARRAY CUSTOM SELECTS
		var array_custom_selects = [];
		var selector_dms_custom_select = '.js-dms-custom-select';
		var selector_dms_custom_select__dropdown = '.js-dms-custom-select__dropdown';

	// END GLOBAL VARS -----------------------------

	// --- GLOBAL FUNCTIONS ---------------------------- 


		function isEventSupported(eventName) {
		    var el = document.createElement('div');
		    eventName = 'on' + eventName;
		    var isSupported = (eventName in el);
		    if (!isSupported) {
		        el.setAttribute(eventName, 'return;');
		        isSupported = typeof el[eventName] == 'function';
		    }
		    el = null;
		    return isSupported;
		}
		var wheelEvent = isEventSupported('mousewheel') ? 'mousewheel' : 'wheel';

		// RETURN CORRECT TRANSITION EVENT NAME
		function whichTransitionEvent(){
			var t,
				el = document.createElement("fakeelement");
			var transitions = {
				"transition"      : "transitionend",
				"OTransition"     : "oTransitionEnd",
				"MozTransition"   : "transitionend",
				"WebkitTransition": "webkitTransitionEnd"
			}
			for (t in transitions){
				if (el.style[t] !== undefined){
					return transitions[t];
				}
			}
		}
		var transitionEvent = whichTransitionEvent();

		// RETURN CORRECT ANIMATION EVENT NAME
		function whichAnimationEvent(){
			var t,
				el = document.createElement("fakeelement");
			var animations = {
				"animation"      : "animationend",
				"OAnimation"     : "oAnimationEnd",
				"MozAnimation"   : "animationend",
				"WebkitAnimation": "webkitAnimationEnd"
			}
			for (t in animations){
				if (el.style[t] !== undefined){
					return animations[t];
				}
			}
		}
		var animationEvent = whichAnimationEvent();






		// DMS CALL FN -- SHORTHAND
		function dmsCallFn(selector, fn, args){ if( $(selector).length>0 ) fn(args); }




		// TOGGLE MENU MOBILE ON CLICK
		function dmsMenuMobileToggle(){

			// elements
			var $page = $('#dms-page'),
				$body = $('body'),
				$mobile_menu = $(".js-mobile-menu"),
				$icon_menu = $(".dms-hamburger");

			$('.dms-mobile-menu-toggle').on('click', function(event){
				event.stopPropagation();
			  	$body.toggleClass('menu-mobile-open');
			  	$page.toggleClass('menu-mobile-open');
			  	$icon_menu.toggleClass('menu-mobile-open');
			  	$mobile_menu.toggleClass('dms-active');
			});
			$('#dms-page').on('click', function(){
			  	$body.removeClass('menu-mobile-open');
			  	$page.removeClass('menu-mobile-open');
			  	$icon_menu.removeClass('menu-mobile-open');
			  	$mobile_menu.removeClass('dms-active');
			});

			$(".dms-menu-overlay").click(function(){

				$('.dms-mobile-menu-toggle').click();
				
			});

		}

		function display_image_popup(target){

	        var image = target.css("background-image");

	        if( $("#gallery-overlay").length>0 ){
	            $("#gallery-popup").css({ "background-image": image });
	        }else{

	            var $overlay = $("<div>", {id: "gallery-overlay", style: "display: none;"});
	            var $popup = $("<div>", {id: "gallery-popup", style: "background-image:"+image+";"});
	            var $close = $("<a>", {id: "gallery-close", href: "javascript:void(0)", class: "fa fa-times-circle"});

	            $("body").append($overlay);
	            $("#gallery-overlay").append($popup);
	            $("#gallery-popup").append($close);

	        }

	        $("#gallery-overlay").fadeIn();
	        $('body').on('click', '#gallery-close', function() {
	            $("#gallery-overlay").fadeOut();
	        });

	        $('body').on('click', '#gallery-overlay', function() {
	            if( $("#gallery-overlay").is( ':visible' ) ){
	                $("#gallery-overlay").fadeOut();
	            }
	        });

	    }

		// SLIDES PER VIEW RESPONSIVE
		function slidesPerViewSwiper() {

			var w = window.innerWidth;

			if(w <= 5000 && w > 2559) {
				return 3;
			}else if (w <= 2559 && w > 1980) {
				return 3;
			} else if (w <= 1980 && w > 1440) {
				return 3;
			} else if (w <= 1440 && w > 1366) {
				return 3;
			} else if (w <= 1366 && w > 1024) {
				return 2;
			} else if (w <= 1024 && w > 980) {
				return 2;
			} else if (w <= 980 && w > 800) {
				return 2;
			} else if(w <= 800){
				return 1;
			}

		}




		// BUTTON SEARCH EVENT
		function searchFormAction(){

			$(".js-dms-button-search").click(function(){

				$(".dms-search-form").submit();

			});
			
		}


		// CUSTOM RGL POPUP
		function dms_r_popup(dms_obj){

			var dms_popup_container_classes = dms_obj.dms_popup_container_classes;
			var dms_content 				= dms_obj.dms_content;
			var dms_icon_classes 			= dms_obj.dms_icon_classes;

			if (typeof( dms_obj.dms_popup_container_classes ) 	=== 'undefined' || dms_obj.dms_popup_container_classes == "") 	dms_popup_container_classes 	= "animated zoomIn";
			if (typeof( dms_obj.dms_content ) 					=== 'undefined' || dms_obj.dms_content == "") 					dms_content 					= "content default";
			if (typeof( dms_obj.dms_icon_classes ) 				=== 'undefined' || dms_obj.dms_icon_classes == "") 				dms_icon_classes 				= "fa fa-times";

			$(".js-dms-r-popup__open").click(function(){



		        var info = dms_content;
		        var the_html = "<div class='dms-popup-addedd__content'>" + info + "</div><div class='dms-popup-addedd__close js-dms-r-popup__close'><span class='" + dms_icon_classes + "'></span></div>";
		        $("<div class='dms-popup-addedd js-dms-r-popup__overlay'><div class='dms-popup-addedd__box js-dms-r-popup__container " + 
		        	dms_popup_container_classes + "'>" + the_html + "</div></div>").appendTo("body");

		        $(".js-dms-r-popup__overlay").click(function(){
		        	$(this).fadeOut(400,function(){
		        		$(this).remove();
		        	});
		        });

		        $(".js-dms-r-popup__container").click(function(e){
		        	e.stopPropagation();
		        });

		        $(".js-dms-r-popup__close").click(function(e){
		        	$(".js-dms-r-popup__overlay").fadeOut(400,function(){
		        		$(this).remove();
		        	});
		        });

	      	});

		}


		function dms_button_to_top(){

			// browser window scroll (in pixels) after which the "back to top" link is shown
			var offset = 20,
				//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
				offset_opacity = 60,
				//duration of the top scrolling animation (in ms)
				scroll_top_duration = 1000,
				//grab the "back to top" link
				$back_to_top = $('.dms-to-top');

			//hide or show the "back to top" link
			$(window).scroll(function(){
				( $(this).scrollTop() > offset ) ? $back_to_top.addClass('dms-is-visible') : $back_to_top.removeClass('dms-is-visible dms-fade-out');
				if( $(this).scrollTop() > offset_opacity ) { 
					$back_to_top.addClass('dms-fade-out');
				}
			});

			//smooth scroll to top
			$back_to_top.on('click', function(event){
				event.preventDefault();
				$('body, html').animate({
					scrollTop: 0 ,
				 	}, scroll_top_duration
				);
			});

		}


		function createLoader(){

			if($("#dms-loader").length==0){

				if($("#dms-loader").length==0){
	                var htmlLoader = '<div class="box">' +
	                                      '<div class="loader loader--size-128 loader--thickness-10"></div>' +
	                                    '</div>';
	                $("body").append('<div id="dms-loader" class="animated fadeIn"><div class="overlay">' + htmlLoader + '</div></div>');
	            }

			}

		}

		function removeLoader(){

			$("#dms-loader").remove();

		}

		function removeFirstLoader(){

			$("#dms-loader").addClass("animated fadeOut");
			$("#dms-loader").one(animationEvent, function(){
				$("#dms-loader").remove();
			});
			
		}

		// AJAX MORE POSTS
		function dms_ajax_more_posts() {

			$(".js-dms-ajax-more-posts__button").click( function(){

				if ($(this).hasClass("disable")== false){

					createLoader();

					var button 	= $(this);
					var query 	= button.attr("data-query");
					var paged 	= button.data("paged");
					var post_type 	= button.data("post_type");
					var next 	= parseInt( paged ) + 1;

					console.log("Post type: " + post_type);
					var data = {
						"action" 	: "dms_ajax_more_posts",
						"query" 	: query,
						"paged" 	: paged,
						"post_type" : post_type
					};

					$.ajax({
						type: "POST",
						url: custom_data.dms_ajax_url,
						data : data,
						dataType: 'json',
					})
					.done(function(result) {

						var html = result.html;
						var ajax_status = result.ajax_status;
						var debug = result.debug;
						var type = result.type;
						console.log(html);
						if(debug) console.log(debug);
						console.log(result);

						if( ajax_status == 200 || ajax_status == 601 ){

							button.attr( "paged", next );
							button.data( "paged", next );

							$(".cajas").append( html );

							if( ajax_status == 601 ){
								button.hide(100); // NO MORE PAGES - BUTTON DISABLED
								button.addClass("disable");
							}  

						}else{

							button.hide(100); // NO MORE PAGES - BUTTON DISABLED
							button.addClass("disable");
						}

						removeLoader();

					})
					.fail(function(jqXHR, textStatus, errorThrown) {
						console.log("error = "+jqXHR.status);
						console.log("error = "+textStatus);
						console.log("error = "+errorThrown);
						removeLoader();
					});


				}
			});
			
		}

		/* // AJAX MORE NEWS
		function dms_ajax_more_news() {

			$(".js-dms-ajax-more-news__button").click( function(){

				createLoader();

				var button 	= $(this);
				var query 	= button.attr("data-query");
				var paged 	= button.data("paged");
				var next 	= parseInt( paged ) + 1;

				console.log("paged: " + paged);
				var data = {
					"action" 	: "dms_ajax_more_news",
					"query" 	: query,
					"paged" 	: paged,
				};

				$.ajax({
					type: "POST",
					url: custom_data.dms_ajax_url,
					data : data,
					dataType: 'json',
				})
				.done(function(result) {

					var html = result.html;
					var ajax_status = result.ajax_status;
					var debug = result.debug;
					console.log(html);
					if(debug) console.log(debug);

					if( ajax_status == 200 || ajax_status == 601 ){

						button.attr( "paged", next );
						button.data( "paged", next );

						$(".cajas").append( html );

						if( ajax_status == 601 ) button.hide(100); // NO MORE PAGES - BUTTON DISABLED

					}else{

						button.hide(100); // NO MORE PAGES - BUTTON DISABLED

					}

					removeLoader();

				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					console.log("error = "+jqXHR.status);
				    console.log("error = "+textStatus);
				    console.log("error = "+errorThrown);
				    removeLoader();
				});
			});
			
		} */


		function addSocialShareEvents(){

			// FACEBOOK
			if( $(".apss-facebook > a").length>0 ){

				$(".dms-social-sharing .fa-facebook").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-facebook").click(function(){
					$(".apss-facebook > a").click();
				});

			}

			// TWITTER
			if( $(".apss-twitter > a").length>0 ){

				$(".dms-social-sharing .fa-twitter").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-twitter").click(function(){
					$(".apss-twitter > a").click();
				});
				
			}

			// GOOGLE PLUS
			if( $(".apss-google-plus > a").length>0 ){

				$(".dms-social-sharing .fa-google-plus").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-google-plus").click(function(){
					$(".apss-google-plus > a").click();
				});
				
			}

			// LINKEDIN
			if( $(".apss-linkedin > a").length>0 ){

				$(".dms-social-sharing .fa-linkedin").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-linkedin").click(function(){
					$(".apss-linkedin > a").click();
				});
				
			}

			// PINTEREST
			if( $(".apss-pinterest > a").length>0 ){

				$(".dms-social-sharing .fa-pinterest-p").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-pinterest-p").click(function(){
					var href = $(".apss-pinterest > a").attr("href");
					window.location.href = href;
				});
				
			}

			// EMAIL
			if( $(".apss-email > a").length>0 ){

				$(".dms-social-sharing .fa-envelope").removeClass("dms-inactive");
				$(".dms-social-sharing .fa-envelope").click(function(){
					var href = $(".apss-email > a").attr("href");
					window.location.href = href;
				});

			}

		}

		// CUSTOM SELECT
		function DropDown(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find(selector_dms_custom_select__dropdown + ' > li');
			this.the_text = this.dd.attr("data-label");
			this.val = this.dd.attr("data-value");
			this.index = -1;
			this.initEvents();
		}

		DropDown.prototype = {
			initEvents : function() {
				var obj = this;
				obj.dd.on('click', function(event){
					var status_active = $(this).hasClass("dms-active");
					$(selector_dms_custom_select).each(function() {
						if( $(this).hasClass("dms-active") ) $(this).removeClass('dms-active');
					});
					if(!status_active) $(this).toggleClass('dms-active');
					return false;
				});
				obj.opts.on('click',function(){
					var opt = $(this);
					obj.the_text = opt.attr("data-label");
					obj.val = opt.attr("data-value");
					obj.index = opt.index();
					obj.placeholder.text(obj.the_text);
				});
			},
			getValue : function() {
				return this.val;
			},
			getIndex : function() {
				return this.index;
			}
		}

		function dms_custom_select() {
			$(selector_dms_custom_select).each(function(){
				var obj = new DropDown( $(this) );
				array_custom_selects.push(obj);
			});

			$(document).click(function() {
				// all dropdowns
				$(selector_dms_custom_select).removeClass('dms-active');
			});
		}

		function dms_parallax_scene_custom(){
			var scene = document.getElementById('scene');
			var parallax = new Parallax(scene);
		}

		var dms_primary_slider;
		function dms_create_primary_slider(){

			dms_primary_slider = new Swiper(".js-dms-primary-slider .swiper-container", {
				// Optional parameters
				slidesPerView: 3,
				direction: 'horizontal',
				loop: true,
				speed: 1200,
				autoplayDisableOnInteraction: false,
				/*slidesPerView: slidesPerViewSwiper(),*/
				autoplay: 6000,
				spaceBetween: 30,
				pagination: '.js-dms-primary-slider .swiper-pagination',
				paginationClickable: true,
				nextButton: '.js-dms-primary-slider .swiper-button-next',
			    prevButton: '.js-dms-primary-slider .swiper-button-prev',
				effect: 'fade',
				fade: {
				  crossFade: true
				}
			});

		}

		// CHECK SELECTS (CUSTOM SELECT)
		// function dms_check_custom_selects(){
		// 	console.log(array_custom_selects);
		// 	$.each( array_custom_selects, function( key, obj ) {

		// 		var current_val_select = obj.getValue();
		// 		console.log(current_val_select);

		// 	});
		// }
	


		// function dmsExample(args){

		// 	console.log(args);

		// }

		/* Con javascript */

		/* function eventShowTextDescription(){
			document.getElementById("verMasDesplegable").addEventListener("click",function (){
				var elementShow = document.getElementById("desplegableContenido");
				if(elementShow.style.display=="block"){
					elementShow.style.display="none";
				}else{
					elementShow.style.display="block";
				}
			});
		} */

		/* Con Jquery */

		function eventShowTextDescription(){
			$("#verMasDesplegable").click(function (){

				if($("#desplegableContenido").hasClass("active")){
					$("#desplegableContenido").hide("slow");
					$("#desplegableContenido").removeClass("active");
				}else{
					$("#desplegableContenido").show("slow");
					$("#desplegableContenido").addClass("active");
				}
				
			});
		}

		function finalScroll(){
			$(window).scroll(function() {
				if($(window).scrollTop() == $(document).height() - $(window).height()) {
					   $(".js-dms-ajax-more-posts__button").click();
				}
			});
		}

		function eventClickReCreate(){
			$(".js-test").click(function(){
				
				$(this).detach();
				var new_element = $("<div></div>").text("Loremp").addClass("js-test");

				$(".dms-template-about-us").append(new_element);

				console.log("cambio...");
				eventClickReCreate();
			});
		}
		function redirectCaja(){
			$(".caja").click(function(){
				var id = $(this).data("id");
				var post_type = $(this).data("post-type");
				/* console.log(id);
				console.log(post_type);
				console.log("/?post_type="+post_type+"&p="+id); */
				window.location.replace("/?post_type="+post_type+"&p="+id);
			});
		}





	// END GLOBAL FUNCTIONS ---------------------------- 





	// --- ON LOAD --------------------------------------
	$(function () {

		// REGISTER TRIGGER WHEEL
		
		// Now bind the event to the desired element
	    // $('.element_target').on(wheelEvent, function(e) {
	    //  	// EVENT IN RESPONSIVE HAVE TRIGGER - ALL TIME EXECUTE THIS
	    //     var oEvent = e.originalEvent,
	    //         delta  = oEvent.deltaY || oEvent.wheelDelta;
	    //     // deltaY for wheel event
	    //     // wheelData for mousewheel event
	    //     if (delta > 0) {
	    //         // Scrolled down
	    //     } else {
	    //         // Scrolled up
	    //     }
		// });
		
		eventShowTextDescription();

		/* $(document).ready(function(){
			var swiper = new Swiper('.swiper-container');
			finalScroll();
			eventClickReCreate();
			redirectCaja();
		}); */
		// TRANSITION END
		// $('.element_target').one(transitionEvent, function(event) {
	    	// Do something when the transition ends
	  	// });
		// ANIMATION END
		// $('.element_target').one(animationEvent, function(event) {
	    	// Do something when the animation ends
	  	// });

		// POPUP IMG
		$(".dms-popup-for-bg-img").click(function(){
			display_image_popup($(this));
		});

		dmsCallFn(selector_dms_custom_select, dms_custom_select);

		// CALL FUNCTION - FOR SEARCH BUTTON
		dmsCallFn(".js-dms-search", searchFormAction);

		// CALL FUNCTION - BUTTON TO TOP
		dmsCallFn(".js-dms-to-top", dms_button_to_top);


		dmsCallFn(".js-home-swiper-container", dms_create_primary_slider);


		// CALL FUNCTION - FOR CUSTOM RGL POPUP
		// NEED HOOK CLASS .js-dms-r-popup__open, this elem is the click open popup
		// dms_popup_container_classes: [container classes for animation]
		// dms_content: [html content]
		// dms_icon_classes: [classes for icon close]
		var dms_r_popup_obj = {

			// dms_popup_container_classes: "animated zoomIn",
			dms_content : custom_data.dms_legal_advice_content_in_popup,
			// dms_icon_classes: "fa fa-times"

		};
		dmsCallFn(".js-dms-r-popup__open", dms_r_popup, dms_r_popup_obj);

		// AJAX MORE POSTS
		dmsCallFn(".js-dms-ajax-more-posts__button", dms_ajax_more_posts);

		/* // AJAX MORE NEWS
		dmsCallFn(".js-dms-ajax-more-news__button", dms_ajax_more_news); */

		// SOCIAL SHARE EVENTS
		dmsCallFn(".js-dms-apss-social", addSocialShareEvents);

		dmsCallFn(".js-dmsMenuMobileToggle", dmsMenuMobileToggle);


		// CALL FUNCTION - PARALLAX SCENE

		// IF NOT HAVE PARALLAX, REMOVE FIRST LOADER ON LOAD ALL
		if($(".dms-parallax-scene #scene .layer").length==0){
			removeFirstLoader();
		}else{
			dms_parallax_scene_custom();
			removeFirstLoader();
		}




		// CALL FUNCTION - FOR EXAMPLE
		// var dmsExample_args = {

		// 	x: "arg_1",
		// 	y: "arg_2"

		// };

		// dmsCallFn(".js-example", dmsExample, dmsExample_args);

		










		// --- ON RESIZE WINDOW EVENT --------------------------------
		$(window).resize(function(){
			
			// RESET MENU MOBILE
			// elements
			var $page = $('#dms-page'),
				$body = $('body'),
				$mobile_menu = $(".js-mobile-menu"),
				$icon_menu = $(".dms-hamburger");
			$body.removeClass('menu-mobile-open');
		  	$page.removeClass('menu-mobile-open');
		  	$icon_menu.removeClass('menu-mobile-open');
		  	$mobile_menu.removeClass('dms-active');

	  		// if(dms_primary_slider!=undefined){
		  	// 	dms_primary_slider.params.slidesPerView = slidesPerViewSwiper();
		  	// 	dms_primary_slider.update(true);
		  	// }


		});
		// END ON RESIZE WINDOW EVENT --------------------------------






	});
	// END ON LOAD --------------------------------------





})(jQuery);
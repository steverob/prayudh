
/*	CUSTOM.JS
------------------------------------------------------------------------------- */

jQuery(document).ready(function() {




/*	THUMBNAIL OVERLAY
------------------------------------------------------------------------------- */

/*	function thumbnail_overlay() {

		jQuery('.portfolio-thumbnail a, .related-thumb a, .latest-thumb-home a, .portfolio-thumbnail-no-lightbox a, .portfolio-content ').hover(function () {
				jQuery(this).find('.overlay').stop().animate({ opacity : 1 }, 350);
			},
			function () {
				jQuery(this).find('.overlay').stop().animate({ opacity : 0 }, 400);
			}
		);
	}

	thumbnail_overlay();
*/



/*	THUMBNAIL OVERLAY (FORUM)
------------------------------------------------------------------------------- */
	
	function thumbnail_overlay() {
		$(document).ready(function(){
			$(".overlay").fadeTo("fast", 0); // This sets the opacity of the thumbs to fade down to 60% when the page loads

			$(".overlay").hover(function() {
				$(this).fadeTo(300, 1); // This should set the opacity to 100% on hover
				},function(){
					$(this).fadeTo(300, 0); // This should set the opacity back to 60% on mouseout
				});
			});
		}

		thumbnail_overlay();

//	<span class="overlay" style="opacity:0">text, if you wish</span>




/*	SUPERFISH - MENU
------------------------------------------------------------------------------- */

	// $('#access ul').superfish();		// Call superfish() on the containing ul element

	$('#access ul').superfish({
		delay: 100,						// one second delay on mouseout
    	animation: {opacity:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
		speed: 'normal',				// faster animation speed
		dropShadows: false,				// completely disable drop shadows by setting this to false
		autoArrows: true				// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
	}); 




/*	CONTACT FORM VALIDATION
------------------------------------------------------------------------------- */

	$("#contactForm").validate();




/*	PRETTYPHOTO - http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
------------------------------------------------------------------------------- */

	function prettyphoto_function() {

		// $(document).ready(function(){
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				theme: 'pp_default',
				opacity: 0.90, /* Value between 0 and 1 */
				show_title: false, /* true/false */
				social_tools: false /* html or false to disable */
			});
		// });
	}

	prettyphoto_function();




/*	PORTFOLIO FILTER
------------------------------------------------------------------------------- */

	$clientsHolder = $('ul.portfolio-list'); // get original list
	$clientsClone = $clientsHolder.clone(); // clone it so it can be reverted back to
	
	$('.portfolio-filter a').click(function(e) {
		e.preventDefault(); // stop anchor tags from doing anything
		//alert($(this).attr('href'));

		$filterClass = $(this).attr('class'); // gets class from clicked anchor

		$('.portfolio-filter li').removeClass('active'); // remove active class from all filter links
		$(this).parent().addClass('active'); // add active class to clicked link

		if($filterClass == 'all'){
			$filters = $clientsClone.find('li'); // get all li's from original cloned list and assign them to variable
		} else {
			$filters = $clientsClone.find('li[data-type~='+ $filterClass +']'); // get li's from ul.source with data-type containing $filterclass
		}

		$clientsHolder.quicksand($filters, {
			duration: 1500, // 1000
			adjustHeight: 'dynamic',
			easing: 'easeOutQuint',
			enhancement: function() { // callback function
				thumbnail_overlay();
				prettyphoto_function();
				equalheight_function();
			}
		}

		); // initiate quicksand fn

	});




/*	w3c 'rel' attribute
------------------------------------------------------------------------------- */
	
	jQuery('a[data-rel]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('rel'));
	});




/*	SHORTCODES - TABS
------------------------------------------------------------------------------- */

	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();
	
	$("ul.tabs li").click(function() {
	
		$("ul.tabs li").removeClass("active");
		$(".tab_content").hide();
		$(this).addClass("active");
		var tabNum = ($(this).find("a").attr("href")).replace('#tab', '');
		$(this).parent().next().find("div:nth-child(" + tabNum + ")").fadeIn();

		return false;
	});




/*	SHORTCODES - TOGGLE
------------------------------------------------------------------------------- */

	$("h3.toggle").click(function() {
		$(this).toggleClass("active").next(".toggle_container").slideToggle("fast");
	});




/*	FONT REPLACEMENT - CUFON (I've used @font-face instead, more elegant...)
------------------------------------------------------------------------------- */

//	Cufon.replace('h1, h2, h3, h4, h5');




/*	CSS Equal Height Columns
------------------------------------------------------------------------------- */

	function equalheight_function() {
		
		$(function(){
    		var H = 0;
    		$("ul.portfolio-list li.item").each(function(i){
        		var h = $("ul.portfolio-list li.item").eq(i).height();
        		if(h > H) H = h;
    		});
    		$("ul.portfolio-list li.item").height(H);
		});

		$(function(){
    		var H = 0;
    		$("#latest-blog-posts-home li.item").each(function(i){
        		var h = $("#latest-blog-posts-home li.item").eq(i).height();
        		if(h > H) H = h;
    		});
    		$("#latest-blog-posts-home li.item").height(H);
		});

	}
	equalheight_function();



/*	UItoTop jQuery dynamic scroll-to-Top plugin
------------------------------------------------------------------------------- 

	$(document).ready(function() {
		$().UItoTop({ easingType: 'easeOutQuart' });	
	});
*/




/*	IMG FADE
------------------------------------------------------------------------------- */

/*	$("img").addClass("img_fade");

	// Image preloading fade
	$(document).ready(function () {
		$('.img_fade').hide().fadeIn(400);
 	});
*/



/*	SLIDE TOGGLE FOOTER
------------------------------------------------------------------------------- 

	// Footer slideToggle
	jQuery(document).ready(function(){

		// Hide (Collapse) the toggle containers on load
//		$("#homepage-widget-area").hide();

		// Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
		jQuery("a.slideToggle").click(function(){
			jQuery(this).toggleClass("active").next().slideToggle("slow");
			return false; // Prevent the browser jump to the link anchor
		});

	});
*/








/*	END CUSTOM.JS
------------------------------------------------------------------------------- */

});


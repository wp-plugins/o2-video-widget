var o2VideoObject = ('<div id="o2-video-pop-up" class="o2animate"><div id="o2-video-close"></div> \
		<object width="560" height="315"> \
			<param name="movie" value="http://www.youtube.com/v/Hb8Ep7SpRnY?version=3&amp;hl=en_GB"></param> \
			<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param> \
			<embed src="http://www.youtube.com/v/Hb8Ep7SpRnY?version=3&amp;hl=en_GB" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed> \
		</object> \
	</div>');

jQuery(function() {
	jQuery('body').append('<div id="o2-video-overlay"></div>');
	jQuery('#o2-video-overlay').css('opacity','.8');
	jQuery('#o2-vid-widget-container li a').click(function(event) {
		event.preventDefault();
		link = this.href.replace(/.*watch\?v=(.*)/,'"http://www.youtube.com/v/$1?version=3&amp;hl=en_GB"');
		o2VideoObject = o2VideoObject.replace(/"http:\/\/.*?"/g,link);
		jQuery('body').append(o2VideoObject);
		//jQuery('#o2-video-pop-up').css('top',jQuery(window).scrollTop() + 200).removeClass('o2fadeInDown').addClass('o2fadeInDown');
		//if (!jQuery.support.transition) {
			jQuery('#o2-video-pop-up').css('top','-555px');
			jQuery('#o2-video-pop-up').animate({top:jQuery(window).scrollTop() + 240},{queue:false,duration:480,complete:function() {
			 jQuery('#o2-video-pop-up').animate({top:jQuery(window).scrollTop() + 200},{queue:false,duration:120});
			}});
		//} 
		jQuery('#o2-video-pop-up, #o2-video-overlay').show();
	});
	jQuery('#o2-video-overlay, #o2-video-close').live('click', function() {
		jQuery('#o2-video-overlay, #o2-video-pop-up').hide(); 
		jQuery('#o2-video-pop-up').remove();
	});
	
	jQuery(window).resize(function() {
		if (jQuery('#o2-vid-widget-container').width() > 430) {
				jQuery('#o2-vid-widget-container li')
		}
	});
	//
	 DD_belatedPNG.fix('.overlay, img');
	if (window.PIE) {
		$("#o2-vid-widget-container, #o2-vid-widget-container li, #o2-vid-widget-container li .duration, #o2-vid-widget-container .clip").each(function () {
			PIE.attach(this);
		});
	}
});

/*

jQuery(function() {

	jQuery('<div id="o2-video-pop-up" class="o2animate"><div id="o2-video-close"></div> \
		<object width="560" height="315"> \
			<param name="movie" value="http://www.youtube.com/v/Hb8Ep7SpRnY?version=3&amp;hl=en_GB"></param> \
			<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param> \
			<embed src="http://www.youtube.com/v/Hb8Ep7SpRnY?version=3&amp;hl=en_GB" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed> \
		</object> \
	</div> \
	<div id="o2-video-overlay"></div>').appendTo('body');
	jQuery('#o2-video-overlay').css('opacity','.8');
	jQuery('li a').click(function(event) {
		event.preventDefault();
		link = this.href.replace(/.*watch\?v=(.*)/,'http://www.youtube.com/v/$1?version=3&amp;hl=en_GB');
		jQuery('#o2-video-pop-up param[name=movie]').attr('value',link);
		jQuery('#o2-video-pop-up embed').attr('src',link);
		jQuery('#o2-video-pop-up').css('top',jQuery(window).scrollTop() + 200).removeClass('o2fadeInDown').addClass('o2fadeInDown');
		if (jQuery.browser.msie) {
			userAgent = jQuery.browser.version;
			userAgent = userAgent.substring(0,userAgent.indexOf('.'));
			jQuery('#o2-video-pop-up').css('top','-555px');
			jQuery('#o2-video-pop-up').animate({top:jQuery(window).scrollTop() + 240},{queue:false,duration:480,complete:function() {
			 jQuery(this).animate({top:jQuery(window).scrollTop() + 200},{queue:false,duration:120});
			}});
		}
		jQuery('#o2-video-pop-up, #o2-video-overlay').show();
	});
	jQuery('#o2-video-overlay, #o2-video-close').click(function() {
		jQuery('#o2-video-overlay, #o2-video-pop-up').hide(); 
	});
	jQuery('#o2-vid-widget-container li').css('background','rgba(113,164,200,0.3)'); 
});

*/

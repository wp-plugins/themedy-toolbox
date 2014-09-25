jQuery(function() {
	
	/* Accordion */
	jQuery('.themedy-shortcode-toggle-active').each(function() {
		jQuery(this).find('.themedy-shortcode-toggle-content').show();
	});
	jQuery('.themedy-shortcode-toggle .themedy-shortcode-toggle-heading').click(function() {
		var toggle = jQuery(this).parent('.themedy-shortcode-toggle');
		if(jQuery(this).parent('.themedy-shortcode-toggle').parent('div').hasClass('themedy-shortcode-accordion')) {
			toggle.parent('div').find('.themedy-shortcode-toggle').find('.themedy-shortcode-toggle-content:visible').slideUp();
			toggle.parent('div').find('.themedy-shortcode-toggle-active').removeClass('themedy-shortcode-toggle-active');
			toggle.toggleClass('themedy-shortcode-toggle-active');
			toggle.find('.themedy-shortcode-toggle-content').slideToggle(500);
		} else {
			toggle.toggleClass('themedy-shortcode-toggle-active');
			toggle.find('.themedy-shortcode-toggle-content').slideToggle(500);
		}
	});
	
	
	/* Tabs */
	jQuery('.themedy-shortcode-tabs').each(function() {
		
		jQuery(this).prepend('<div class="themedy-shortcode-tab-buttons"></div>');
		jQuery(this).find('.themedy-shortcode-tabpane').each(function() {
			
			jQuery(this).parent('.themedy-shortcode-tabs').find('.themedy-shortcode-tab-buttons').append('<a href="#">'+jQuery(this).find('.themedy-shortcode-tab-label').text()+'</a>');
			jQuery(this).find('.themedy-shortcode-tab-label').remove();
			
		});
		
		jQuery(this).find('.themedy-shortcode-tab-buttons').find('a:first').addClass('active');
		jQuery(this).find('.themedy-shortcode-tabpane').hide();
		jQuery(this).find('.themedy-shortcode-tabpane:first').show();
		
	});
	
	var tab_to_show = 0;
	jQuery('.themedy-shortcode-tab-buttons a').live("click", function() {
		tab_to_show = jQuery(this).parent('.themedy-shortcode-tab-buttons').find('a').index(jQuery(this));
		jQuery(this).parent('.themedy-shortcode-tab-buttons').parent('.themedy-shortcode-tabs').find('.themedy-shortcode-tabpane').hide();
		jQuery(this).parent('.themedy-shortcode-tab-buttons').parent('.themedy-shortcode-tabs').find('.themedy-shortcode-tabpane').eq(tab_to_show).show();
		jQuery(this).parent('.themedy-shortcode-tab-buttons').find('a').removeClass('active');
		jQuery(this).parent('.themedy-shortcode-tab-buttons').find('a').eq(tab_to_show).addClass('active');
		return false;
	});
	
	
	/* FitVids */
	
	"use strict";

    jQuery.fn.fitVids = function( options ) {
        var settings = {
            customSelector: null
        };

        var div = document.createElement('div'),
            ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

        div.className = 'fit-vids-style';
        div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

        ref.parentNode.insertBefore(div,ref);

        if ( options ) {
            jQuery.extend( settings, options );
        }

        return this.each(function(){
            var selectors = [
                "iframe[src*='player.vimeo.com']",
                "iframe[src*='www.youtube.com']",
                "iframe[src*='www.kickstarter.com']",
                "object",
                "embed"
            ];

            if (settings.customSelector) {
                selectors.push(settings.customSelector);
            }

            var $allVideos = jQuery(this).find(selectors.join(','));

            $allVideos.each(function(){
                var $this = jQuery(this);
                if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
                var height = ( this.tagName.toLowerCase() === 'object' || $this.attr('height') ) ? parseInt($this.attr('height'), 10) : $this.height(),
                    width = $this.attr('width') ? parseInt($this.attr('width'), 10) : $this.width(),
                    aspectRatio = height / width;
                if(!$this.attr('id')){
                    var videoID = 'fitvid' + Math.floor(Math.random()*999999);
                    $this.attr('id', videoID);
                }
                $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
                $this.removeAttr('height').removeAttr('width');
            });
        });
    };
	
	jQuery('.themedy-shortcode-video-embed').fitVids({ customSelector: ""});
	
});
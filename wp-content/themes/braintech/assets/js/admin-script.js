/**
*
* -----------------------------------------------------------------------------
*
* Template : rs - JS for Admin
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/

(function($) {

	"use strict";

	 $('.radio-select label').on('click', function(event) {   
	    $('.radio-select label').removeClass('active');
	    $(this).addClass('active');
	      
	});

	$('#meta-image-button').on('click', function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $('#meta-image').val(attachment.url);
	 		 $('#meta-image-preview').attr('src',attachment.url);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;
	});
	
	$(".meta-img-wrap i").on('click', function(){
		$('.meta-img-wrap').hide();
	    $("#meta-image").val('');
	});
	
})(jQuery);
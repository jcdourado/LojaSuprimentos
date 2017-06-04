/*
*
*	Image widget upload
*	------------------------------------------------
*
*/

(function($){
    $('document').ready(function() {
        
        $( 'body' ).on( 'click', '.kt_image_upload', function ( e ){
            e.preventDefault();
            
                
            var $button = $( this ),
                $widget = $button.closest('.widget-content'),
                $preview = $widget.find('.kt_image_preview'),
                $preview_img = $preview.find('img'),
                $attachment = $widget.find('.kt_image_attachment'),
                frame,
                frameOptions = {
    				className: 'media-frame rwmb-file-frame',
    				multiple : true,
    				title    : kt_image_lange.frameTitle
    			};
                
            frame = wp.media( frameOptions );
            
            // Open media uploader
            frame.open();
            
            frame.off( 'select' );
            
            // When an image is selected in the media frame...
            frame.on( 'select', function() {
              
              // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();
              console.log(attachment);
              
              $attachment.val(attachment.id);
              
              $preview_img
                .attr('src', attachment.url)
                .attr('alt', attachment.alt);
                
              $preview.show();
              
              
            });
        });
    });
})(jQuery);
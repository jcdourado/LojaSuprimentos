/*
*
*	Admin $ Mega menu
*	------------------------------------------------
*
*/

(function($){
    "use strict";
    
    $(document).ready(function() {
        
        $(document).on('click', "input[name^='menu-item-megamenu-enable']:checkbox", function(){
    		reloadItems();
        });
        
        reloadItems();
        
        function reloadItems(){
            var activeMega = false;
            $('li.menu-item').each( function(){
                var objMenuItem = $(this),
                    currentMega = objMenuItem.find(".edit-menu-item-enable"),
                    currentWidth = objMenuItem.find(".edit-menu-item-width"),
                    objPosition = objMenuItem.find('p.description-position'),
                    objId = currentMega.data('id');
                    
                if(objMenuItem.hasClass('menu-item-depth-0') ) {
                    if(currentMega.prop('checked')){ 
                        activeMega = true;
                        $('#content-megamenu-'+objId).show();
                    }else{
                        activeMega = false;
                        $('#content-megamenu-'+objId).hide();
                    } 
                    if(currentWidth.val() == 'full'){
                        objPosition.hide();
                    }else{
                        objPosition.show();
                    }
                }
                
                if(activeMega && objMenuItem.hasClass('menu-item-depth-1')){
                    objMenuItem.find('.megamenu-layout').show();
                }
                if(activeMega){
                    objMenuItem.addClass('megamenu');
                }else{
                    objMenuItem.removeClass('megamenu');
                }
            });
        }
        $(document).on('change', "select[name^='menu-item-megamenu-width']", function(){
            var $objPosition = $(this).closest('.megamenu-layout').find('p.description-position');
    		($(this).val() == 'full') ? $objPosition.hide() : $objPosition.show();
        });
        
        $( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
    		if( ! $( event.target ).is( 'a' )) {
    			setTimeout( reloadItems, 300 );
    		}
    	});
        $( 'body' ).on( 'click', '.kt_image_preview i', function ( e ){
            var $close = $( this ),
                $field = $close.closest('.field-image'),
                $preview = $field.find('.kt_image_preview'),
                $preview_img = $field.find('img'),
                $attachment = $field.find('.edit-menu-item-image');
                
            $attachment.val('');
            $preview_img.attr('src', '').attr('alt', '');
            $preview.hide();
        });
        
        
        
        
        $( 'body' ).on( 'click', '.kt_image_menu', function ( e ){
            e.preventDefault();
            
                
            var $button = $( this ),
                $field = $button.closest('.field-image'),
                $preview = $field.find('.kt_image_preview'),
                $preview_img = $field.find('img'),
                $attachment = $field.find('.edit-menu-item-image'),
                frame,
                frameOptions = {
    				className: 'media-frame rwmb-file-frame',
    				multiple : true
    			};
                
                
            frame = wp.media( frameOptions );
            
            // Open media uploader
            frame.open();
            
            frame.off( 'select' );
            
            // When an image is selected in the media frame...
            frame.on( 'select', function() {
              
              // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();
              
              $attachment.val(attachment.id);
              
              $preview_img
                .attr('src', attachment.url)
                .attr('alt', attachment.alt);
                
              $preview.css( 'display', 'block' );
              
              
            });
        });
        
        
        
        
    });
        
})(jQuery);
/*
*
*	Admin $ Functions
*	------------------------------------------------
*
*/



(function($){
    $('document').ready(function() {

        /* SIDEBAR =====================================================*/
        var $sidebar_config = $('#_kt_sidebar'),
            $sidebar_left = $('#_kt_left_sidebar').closest('.rwmb-field'),
            $sidebar_right = $('#_kt_right_sidebar').closest('.rwmb-field');
            
            
        function kt_sidebar(){
            $sidebar_value = $sidebar_config.val();
            if ($sidebar_value == "left") {
                $sidebar_left.show();
                $sidebar_right.hide();
            }else if($sidebar_value == "right"){
                $sidebar_left.hide();
                $sidebar_right.show();
            }else{
                $sidebar_left.hide();
                $sidebar_right.hide();
            }
        }
        kt_sidebar();
    	$sidebar_config.change(function() {
            kt_sidebar();
    	});
        
        /* Slideshow source =====================================================*/
        var $slideshow_config = $('#_kt_slideshow_source'),
            $rev_slider = $('#_kt_rev_slider').closest('.rwmb-field'),
            $layerslider = $('#_kt_layerslider').closest('.rwmb-field'),
            $custom_bg = $('._kt_custom_bg');

        function kt_slideshow(){
            $slideshow_value = $slideshow_config.val();
            if ($slideshow_value == "revslider") {
                $rev_slider.show();
                $layerslider.hide();
                $custom_bg.hide();
            }else if($slideshow_value == "layerslider"){
                $rev_slider.hide();
                $layerslider.show();
                $custom_bg.hide();
            }else if($slideshow_value == "custom_bg"){
                $rev_slider.hide();
                $layerslider.hide();
                $custom_bg.show();
            }else{
                $rev_slider.hide();
                $layerslider.hide();
                $custom_bg.hide();
            }
        }
        kt_slideshow();
    	$slideshow_config.change(function() {
            kt_slideshow();
    	});
        
        
        jQuery(document).on('click', '.btn-plus', function(){
           $this = jQuery(this);
           $parent =  $this.parent( '.btn-template' );
           $template = $parent.find('.template').clone();
           $template.find('.widget-name').each(function($i, $item){
                $control = jQuery($item);
                $control.attr("name", $control.attr("tpl-name"));
                $control.removeAttr('tpl-name');
           });
           $parent.before($template.html());
           
        });
        
        jQuery(document).on('click','.multi-item .item .remove', function(){
            jQuery(this).parent('.item').remove();
        });
    });
})(jQuery);
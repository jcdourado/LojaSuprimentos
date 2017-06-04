(function($){
    "use strict"; // Start of use strict
    var rtl = jQuery( 'body' ).hasClass( 'rtl' );
    
    var first_lazy = jQuery( '.container-tab .active .kt-template-loop .owl-lazy' );
    /**==============================
    ***  Change Color tab Category
    ===============================**/
    var $style = jQuery('head style').first();
    
    function settingCarousel($this, $selector){
        var config = $this.data();
        config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
        if( config.smartspeed != 'undefined'){
          config.smartSpeed = config.smartspeed;
        }
        if( config.allitems != "undefined"){
           if(config.allitems <=1){
              config.loop = false;
           }
        }
        config.lazyLoad = true;
        if( $this.hasClass('owl-style2') ){
            config.animateOut="fadeOut";
            config.animateIn="fadeIn";    
        }

        config.rtl = rtl;
        config.onInitialized = function( event ){
            var $item_active = $this.find( '.tab-panel.active .owl-item.active' );
            $item_active.each( function ( $i ) {
                var $item = jQuery(this);
                var $style = $item.attr("style");
                $style    = ( $style == undefined ) ? '' : $style;
                var delay = $i * 300;
                $item.attr("style", $style +
                          ";-webkit-animation-delay:" + delay + "ms;"
                        + "-moz-animation-delay:" + delay + "ms;"
                        + "-o-animation-delay:" + delay + "ms;"
                        + "animation-delay:" + delay + "ms;"
                ).addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $item.removeClass('slideInTop animated');
                    if ( $style )
                        $item.attr("style", $style);
                }); 
            });
        }
        if( typeof( $selector ) == 'undefined' ){
            $this.owlCarousel(config);
        }else{
            $selector.owlCarousel(config);
        }
        
    }
    function hasOnlyCountdown(){
        jQuery( '.only_countdown' ).each(function(){
            var max_time = $(this).find('.max-time-sale');
            if( max_time.length > 0 ){
                var y = max_time.data('y');
                var m = max_time.data('m');
                var d = max_time.data('d');
                var austDay = new Date( y, m - 1, d, 0, 0, 0 );
                $(this).find('.countdown-only').countdown({
                    until: austDay,
                    labels: labels, 
                    layout: layout
                });
            }
        });
    }
    function kt_lazy( $lazy ){
        $lazy.each( function($index, $element){
            $element   = jQuery( $element);
            var $item  = $element.closest( 'li' );
            var $style = $item.attr("style");
            $style     = ( $style == undefined ) ? '' : $style;
            
            var delay  = $index * 300;
            $item.attr("style", $style +
                      ";-webkit-animation-delay:" + delay + "ms;"
                    + "-moz-animation-delay:" + delay + "ms;"
                    + "-o-animation-delay:" + delay + "ms;"
                    + "animation-delay:" + delay + "ms;"
            ).addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $item.removeClass('slideInTop animated');
                $item.attr("style", $style);
            }); 
            
            if( $element.is( 'img' ) ){
                var $url = $element.data('src');
                if( $url !="undefined" ){
                  $element.attr( 'src', $url );
                }
                
            }else{
                var $url = $element.data('src');
                if( $url != "undefined" ){
                  $element.addClass( 'kt-lazy-background' );
                  $element.css( 'background', 'url("'+ $url+'")' );
                }
            }
        } );
    }
    
    /* ---------------------------------------------
     Woocommercer Quantily
     --------------------------------------------- */
     function woo_quantily(){
        $('body').on('click','.quantity .quantity-plus',function(){
            var obj_qty = $(this).closest('.quantity').find('input.qty'),
                val_qty = parseInt(obj_qty.val()),
                min_qty = parseInt(obj_qty.attr('min')),
                max_qty = parseInt(obj_qty.attr('max')),
                step_qty = parseInt(obj_qty.attr('step'));
            val_qty = val_qty + step_qty;
            if(max_qty && val_qty > max_qty){ val_qty = max_qty; }
            obj_qty.val(val_qty);
            obj_qty.trigger("change");
        });
        $('body').on('click','.quantity .quantity-minus',function(){
            var obj_qty = $(this).closest('.quantity').find('input.qty'), 
                val_qty = parseInt(obj_qty.val()),
                min_qty = parseInt(obj_qty.attr('min')),
                max_qty = parseInt(obj_qty.attr('max')),
                step_qty = parseInt(obj_qty.attr('step'));
            val_qty = val_qty - step_qty;
            if(min_qty && val_qty < min_qty){ val_qty = min_qty; }
            if(!min_qty && val_qty < 0){ val_qty = 0; }
            obj_qty.val(val_qty);

            obj_qty.trigger("change");
        });
    }
    // Auto height product list
    function auto_height_product_list(){
        // var max = 0;
        // $('.product-list.grid li.product').each(function(){
        //     var item_height = $(this).height();
        //     if( item_height > max ){
        //         max = item_height;
        //     }
        //     $(this).addClass('product-autoheight');
        // }) 
        // $('.product-autoheight .product-container').css('min-height',max+"px");
    }

    function autoHeight_product_grid(){
        // $('.autoHeight').each(function(){
        //     var max = 0;
        //     $(this).find('.autoHeight-item').each(function(){
        //         var item_height = $(this).innerHeight();
        //         if(item_height > max ){
        //             max = item_height;
                    
        //         }
        //         $(this).addClass('item-set-height');
        //     })
        //     $(this).find('.item-set-height').css('height',max+"px");
        // })
    }
    /* ---------------------------------------------
     MENU REPONSIIVE
     --------------------------------------------- */
     function init_menu_reposive(){
          var kt_is_mobile = (Modernizr.touch) ? true : false;
          if(kt_is_mobile === true){
            $(document).on('click', '.navigation .menu-item-has-children > a', function(e){
              var licurrent = $(this).closest('li');
              var liItem = $('.navigation .menu-item-has-children');
              if ( !licurrent.hasClass('show-submenu') ) {
                liItem.removeClass('show-submenu');
                licurrent.parents().each(function (){
                    if($(this).hasClass('menu-item-has-children')){
                     $(this).addClass('show-submenu');   
                    }
                      if($(this).hasClass('.navigation')){
                          return false;
                      }
                })
                licurrent.addClass('show-submenu');
                // Close all child submenu if parent submenu is closed
                if ( !licurrent.hasClass('show-submenu') ) {
                  licurrent.find('li').removeClass('show-submenu');
                  }
                  return false;
                  e.preventDefault();
              }else{
                var href = $(this).attr('href');
                  if ( $.trim( href ) == '' || $.trim( href ) == '#' ) {
                      licurrent.toggleClass('show-submenu');
                  }
                  else{
                      window.location = href;
                  } 
              }
              // Close all child submenu if parent submenu is closed
                  if ( !licurrent.hasClass('show-submenu') ) {
                      //licurrent.find('li').removeClass('show-submenu');
                  }
                  e.stopPropagation();
          });
        $(document).on('click', function(e){
              var target = $( e.target );
              if ( !target.closest('.show-submenu').length || !target.closest('.navigation').length ) {
                  $('.show-submenu').removeClass('show-submenu');
              }
          }); 
          // On Desktop
          }else{
              $('.navigation .menu-item-has-children').hover(function(){
                $(this).addClass('show-submenu');
              }, function(){
                $(this).removeClass('show-submenu'); 
              });
          }
     }
    /* ---------------------------------------------
     Scripts initialization
     --------------------------------------------- */
    $(window).load(function() {
        // auto width megamenu
        auto_width_megamenu();
        resizeTopmenu();
        autoHeight_product_grid();
        auto_height_product_list();
    });
    /* ---------------------------------------------
     Scripts ready
     --------------------------------------------- */
    $(document).ready(function() {
        init_menu_reposive();
        woo_quantily();
        show_other_item_vertical_menu();
        /* Only Count down */
        hasOnlyCountdown();
        /* Resize top menu*/
        resizeTopmenu();
        auto_height_product_list();
        autoHeight_product_grid();
        /* Zoom image */
        if($('#product-zoom').length >0){
            $('#product-zoom').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750,
                gallery:'gallery_01'
            }); 
        }
        /* Popup sizechart */
        if($('#size_chart').length >0){
            $('#size_chart').fancybox();
        }
        /** OWL CAROUSEL**/
        $( ".owl-carousel").each(function(index, el) {
            var $this = $(this);
            settingCarousel($this);
        });
        jQuery( '.tab-container.enable-carousel' ).each(function(index, el) {
            var $this = $(this);
            var $tab_panel = $this.find( '.tab-panel.active .product-list.on-carousel' );
            settingCarousel($this, $tab_panel);
        });
        
        $(".owl-carousel-vertical").each(function(index, el) {
          var config = $(this).data();
          config.navText = ['<span class="icon-up"></spam>','<span class="icon-down"></span>'];
          
          config.smartSpeed="900";
          
          config.animateOut="";
          
          config.animateIn="fadeInUp";
          
          config.rtl = rtl;
          
          $(this).owlCarousel(config);
        });
        
        /** COUNT DOWN **/
        $('.count-down-time[data-countdown]').each(function() { 
           var $this = $(this), finalDate = $(this).data('countdown');
           if( ! $this.hasClass( 'countdown-lastest' ) ){
               $this.countdown(finalDate, function(event) {
                 var fomat ='<span>%H</span><b></b><span>%M</span><b></b><span>%S</span>';
                 $this.html(event.strftime(fomat));
               });
            }else{
                $this.countdown(finalDate, function(event) {
                 //var fomat = '<span class="box-count"><span class="number">%D</span> <span class="text">Days</span></span><span class="dot">:</span><span class="box-count"><span class="number">%H</span> <span class="text">Hrs</span></span><span class="dot">:</span><span class="box-count"><span class="number">%M</span> <span class="text">Mins</span></span><span class="dot">:</span><span class="box-count"><span class="number">%S</span> <span class="text">Secs</span></span>';
                 $this.html(event.strftime(layout));
               });
                            
            }
        });
        
        $('.stick-countdown').each(function() {
          
           var parent = $(this).closest('.container-data-time');
           var time_max = parent.find('.max-time');

           var y = time_max.data('y');
           var m = time_max.data('m');
           var d = time_max.data('d');

           //var labels = ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Mins', 'Secs'];
           //var layout = '<span class="box-count day"><span class="number">{dnn}</span> <span class="text">Days</span></span><span class="dot">:</span><span class="box-count hrs"><span class="number">{hnn}</span> <span class="text">Hrs</span></span><span class="dot">:</span><span class="box-count min"><span class="number">{mnn}</span> <span class="text">Mins</span></span><span class="dot">:</span><span class="box-count secs"><span class="number">{snn}</span> <span class="text">Secs</span></span>';
           var austDay = new Date( y , m - 1 , d ,'00','00','00');
            $(this).countdown({
                until: austDay,
                labels: labels, 
                layout: layout
            });
        });
        
        /* Close top banner*/
        $(document).on('click','.btn-close',function(){
            $(this).closest('.top-banner').animate({ height: 0, opacity: 0 },1000);
            return false;
        })
        /** SELECT CATEGORY **/
        //$('.select-category').select2();
        if( rtl ){
            $( ".select-category" ).selectmenu({
                position: { my : "left-53 top"}
            });
        }else{
             $( ".select-category" ).selectmenu();
        }
        
        /* Toggle nav menu*/
        $(document).on('click','.toggle-menu',function(){
            $(this).closest('.nav-menu').find('.navbar-collapse').toggle();
            return false;
        });
        
        /* elevator click*/ 
        $(document).on('click','a.btn-elevator',function(e){
           
            var top_menu_height = 50;
            if($('body').hasClass('logged-in')){
                var wpadminbar_height = $('#wpadminbar').height();
                top_menu_height = top_menu_height + wpadminbar_height;
            }
            e.preventDefault();
            var target='';
            if($(this).hasClass('up')){
             //target = $(this).closest('.box-tab-category').css('background-color','#000');
              target = $(this).closest('.box-tab-category').prev('.box-tab-category');
            }else{
                //alert($(this).offset());
              target = $(this).closest('.box-tab-category').next('.box-tab-category');
              
            }
            
            var $target = $(target);
            if(typeof($target.offset()) != 'undefined'){
                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top-top_menu_height
                }, 500);
                return false;
            }
        })
        /* scroll top */ 
        $(document).on('click','.scroll_top',function(){
            $('body,html').animate({scrollTop:0},400);
            return false;
        })
        /** #brand-showcase */
        $(document).on('click','.brand-showcase-logo li',function(){
            var id = $(this).data('tab');
            $(this).closest('.brand-showcase-logo').find('li').each(function(){
                $(this).removeClass('active');
            });
            $(this).closest('li').addClass('active');
            $('.brand-showcase-content').find('.brand-showcase-content-tab').each(function(){
                $(this).removeClass('active');
            });
            var tab_active = $('#'+id);
            tab_active.addClass('active');
            //tab_active.find('img.lazy').trigger('load_lazy');
            return false;
        })
        /** ALL CAT **/
        $(document).on('click','.open-cate',function(){
            $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function(){
                $(this).slideDown();
            });
            var close_text = $(this).data('close_text');
            $(this).addClass('colse-cate').removeClass('open-cate').html( close_text );
        });

        /* Close category */
        $(document).on('click','.colse-cate',function(){
            $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function(){
                $(this).slideUp();
            });
            var open_text = $(this).data('open_text');
            $(this).addClass('open-cate').removeClass('colse-cate').html(open_text);
            return false;
        });
        // bar ontop click
        $(document).on('click','.vertical-megamenus-ontop-bar',function(){
            $('#vertical-megamenus-ontop').find('.box-vertical-megamenus').slideToggle();
            $('#vertical-megamenus-ontop').toggleClass('active');
            return false;
        })
        // View grid list product 
        $(document).on('click','.display-product-option .view-as-grid',function(){
            $(this).closest('.display-product-option').find('li').removeClass('selected');
            $(this).addClass('selected');
            $(this).closest('.view-product-list').find('.product-list').removeClass('list').addClass('grid');
            var data = {
                action: 'fronted_set_products_view_style',
                security : screenReaderText.security,
                style: 'grid'
            };
            $.post(screenReaderText.ajaxurl, data, function(response){
               // console.log(response);
               auto_height_product_list();
            })
            return false;
        });
        // View list list product 
        $(document).on('click','.display-product-option .view-as-list',function(){
            $(this).closest('.display-product-option').find('li').removeClass('selected');
            $(this).addClass('selected');
            $(this).closest('.view-product-list').find('.product-list').removeClass('grid').addClass('list');
            var data = {
                action: 'fronted_set_products_view_style',
                security : screenReaderText.security,
                style: 'list'
            };
            $.post(screenReaderText.ajaxurl, data, function(response){
                //console.log(response);
            })
            return false;
        });
        /// tre menu category
        $(document).on('click','.tree-menu li span',function(){
            $(this).closest('li').children('ul').slideToggle();
            if($(this).closest('li').haschildren('ul')){
                $(this).toggleClass('open');
            }
            return false;
        });
        /* Open menu on mobile */
        $(document).on('click','.btn-open-mobile,.box-vertical-megamenus .title',function(){
            var width = $(window).width();
            if(width > 1200){
                if($('body').hasClass('home') && !$('.box-vertical-megamenus').is('.hiden_content')){
                    if($('#nav-top-menu').hasClass('nav-ontop') || $('#header').hasClass('option6') || $('#header').hasClass('option5') || $('#header').hasClass('ontop')){
                        
                    }else{
                        return false;
                    }
                }
            }
            $(this).closest('.box-vertical-megamenus').find('.vertical-menu-content').slideToggle();
            $(this).closest('.title').toggleClass('active');
            if( width < 768 ){
              $('.main-menu .navigation-main-menu').hide();
            }
            return false;
        });
        /* Product qty */
        $(document).on('click','.btn-plus-down',function(){
            var value = parseInt($('#option-product-qty').val());
            value = value -1;
            if(value <=0) return false;
            $('#option-product-qty').val(value);
            return false;
        });
        $(document).on('click','.btn-plus-up',function(){
            var value = parseInt($('#option-product-qty').val());
            value = value +1;
            if(value <=0) return false;
            $('#option-product-qty').val(value);
            return false;
        });
        //Close vertical 
        $(document).on('click','*',function(e){
            var container = $("#box-vertical-megamenus");
            if (!container.is(e.target) && container.has(e.target).length === 0){
                if($('body').hasClass('home')){
                    if($('#nav-top-menu').hasClass('nav-ontop')){
                    }else{
                        return;
                    }
                }
                container.find('.vertical-menu-content').hide();
                container.find('.title').removeClass('active');
            }
        });
        
        // OWL Product thumb
        // $('.product .thumbnails').owlCarousel(
        //     {
        //         dots:false,
        //         nav:true,
        //         navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        //         margin:20,
        //         responsive : {
        //           // breakpoint from 0 up
        //           0 : {
        //               items : 1,
        //           },
        //           320 : {
        //               items : 2,
        //           },
        //           // breakpoint from 480 up
        //           480 : {
        //               items : 2,
        //           },
        //           // breakpoint from 768 up
        //           768 : {
        //               items : 2,
        //           },
        //           1000 : {
        //               items : 3,
        //           }
        //       },
        //       rtl: rtl
        //     }
        // );

        // OWl related product
         $('.related.products .product-list,.upsells.products .product-list').each(function(){
            var t = $(this).closest('.products');
            var desktop_item = 3;
            var ipad_item = 2;
            if(t.hasClass('full-layout')){
              desktop_item = 4;
              ipad_item = 3;
            }
            var rtl = false;
            if( $('body').hasClass('rtl')){
              rtl = true;
            }
            $(this).owlCarousel(
                {
                    dots:false,
                    nav:true,
                    navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    responsive : {
                      // breakpoint from 0 up
                      0 : {
                          items : 1,
                      },
                      // breakpoint from 480 up
                      480 : {
                          items : ipad_item,
                      },
                      // breakpoint from 768 up
                      768 : {
                          items : ipad_item,
                      },
                      1000 : {
                          items : desktop_item,
                      },
                      1025 : {
                          items : desktop_item,
                      }
                  },
                  rtl: rtl
                }
            );
         });

      // Category product
      $(document).on('click','.widget_product_categories a',function(){
        var paerent = $(this).closest('li');
        var t = $(this);
        //paerent.find('a').removeClass('open');
        //paerent.find('ul').removeClass('open');
        paerent.find('ul').addClass('open');
        if(paerent.children('ul').length > 0){
            //$(this).toggleClass('open');
            $(this).closest('li').children('ul').slideToggle();
            return false;
        }
      });
      // count downt
      if($('.countdown-lastest, .count-down-time').length >0){
          //var labels = ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Mins', 'Secs'];
          //var layout = '<span class="box-count day"><span class="number">{dnn}</span> <span class="text">Days</span></span><span class="dot">:</span><span class="box-count hrs"><span class="number">{hnn}</span> <span class="text">Hrs</span></span><span class="dot">:</span><span class="box-count min"><span class="number">{mnn}</span> <span class="text">Mins</span></span><span class="dot">:</span><span class="box-count secs"><span class="number">{snn}</span> <span class="text">Secs</span></span>';
          $('.countdown-lastest, .count-down-time').each(function() {
              var austDay = new Date($(this).data('y'),$(this).data('m') - 1,$(this).data('d'),$(this).data('h'),$(this).data('i'),$(this).data('s'));
              $(this).countdown({
                  until: austDay,
                  labels: labels, 
                  layout: layout
              });
          });
      }
        
    /**************CHANGE COLOR *******************/
    /**************TAB CATEGORY ******************/
        
    jQuery('div[data-target="change-color"]').each(function(){
        var $this  = jQuery(this);
        var $color = $this.data("color");
        var $rgb   = $this.data('rgb');
        var $id = $this.attr("id");
        if( $this.hasClass('option1') ){
            $style.append('#'+$id+'.option1 .nav-menu-red li a:hover,#'+$id+' .nav-menu-red li.active a,#'+$id+' .nav-menu-red li.selected a,#'+$id+' .nav-menu-red,#'+$id+'.option2 .product-list li .add-to-cart:hover,#'+$id+'.option1 .product-list li .add-to-cart:hover, #'+$id+'.option1 .product-list li .quick-view a:hover,#'+$id+'.option1 .owl-controls .owl-prev:hover,#'+$id+'.option1 .owl-controls .owl-next:hover {background: '+$color+';}');
            $style.append( '#'+$id+'.option1 .product-list li .add-to-cart{background-color:rgba( '+$rgb+', 0.5 )}' );
            $style.append( '#'+$id+'{color: '+$color+'}')
        }else if( $this.hasClass('option2') ){
            if( $this.hasClass( 'tab-2' ) ){
                $style.append( '#'+$id+'.option2 .show-brand .navbar-brand,#'+$id+'.option2 .category-featured .nav-menu .nav>li>a:before,#'+$id+'.option2 .product-list li .add-to-cart:hover, #'+$id+'.option2 .product-list li .quick-view a:hover, #'+$id+'.option2 .product-list li .quick-view a:hover {background-color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .nav>li.active a,#'+$id+'.option2 .category-featured .nav-menu .nav>li:hover a,#'+$id+'.option2 .category-featured .sub-category-list a:hover, #'+$id+'.option2 .nav-menu .nav>li:hover a:after, #'+$id+'.option2 .nav-menu .nav>li.active a:after {color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .navbar-collapse{border-bottom-color:'+$color+'}' );
                $style.append( '#'+$id+'.option2 .product-list li .add-to-cart{background-color:rgba( '+$rgb+', 0.7 )}' );
            }else if( $this.hasClass( 'tab-3' ) ){
                $style.append( '#'+$id+'.option2 .category-featured .navbar-brand, #'+$id+'.option2 .category-featured .nav-menu .nav>li>a:before, #'+$id+'.option2 .category-featured .product-list li .add-to-cart:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.search:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.compare:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.heart:hover, #'+$id+'.option2 .product-list li .quick-view a:hover{background-color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .nav>li:hover a, #'+$id+'.option2 .category-featured .nav-menu .nav>li.active a, #'+$id+'.option2 .category-featured .nav-menu .nav>li:hover a:after, #'+$id+'.option2 .category-featured .nav-menu .nav>li.active a:after, #'+$id+'.option2 .category-featured .sub-category-list a:hover {color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .navbar-collapse{border-bottom-color:'+$color+'}' );
                $style.append( '#'+$id+'.option2 .category-featured .product-list li .add-to-cart{background-color:rgba( '+$rgb+', 0.7 )}' );
            }else if( $this.hasClass( 'tab-4' ) ){
                $style.append( '#'+$id+'.option2 .category-featured .navbar-brand, #'+$id+'.option2 .category-featured .nav-menu .nav>li>a:before,#'+$id+'.option2 .category-featured .product-list li .add-to-cart:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.search:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.compare:hover, #'+$id+'.option2 .category-featured .product-list li .quick-view a.heart:hover, #'+$id+'.option2 .product-list li .quick-view a:hover{background-color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .nav>li:hover a, #'+$id+'.option2 .category-featured .nav-menu .nav>li.active a, #'+$id+'.option2 .category-featured .nav-menu .nav>li:hover a:after, #'+$id+'.option2 .category-featured .nav-menu .nav>li.active a:after, #'+$id+'.option2 .category-featured .sub-category-list a:hover{color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured .nav-menu .navbar-collapse{border-bottom-color:'+$color+'}' );
                $style.append( '#'+$id+'.option2 .category-featured .add-to-cart{background-color:rgba( '+$rgb+', 0.7 )}' );
            }else if( $this.hasClass( 'tab-5' ) ){
                $style.append( '#'+$id+'.option2 .category-featured.jewelry .navbar-brand, #'+$id+'.option2 .category-featured.jewelry .nav-menu .nav>li>a:before,#'+$id+'.option2 .category-featured.jewelry .product-list li .add-to-cart:hover, #'+$id+'.option2 .category-featured.jewelry .product-list li .quick-view a.search:hover, #'+$id+'.option2 .category-featured.jewelry .product-list li .quick-view a.compare:hover, #'+$id+'.option2 .category-featured.jewelry .product-list li .quick-view a.heart:hover, #'+$id+'.option2 .category-featured.jewelry .product-list li .quick-view a:hover{background-color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .category-featured.jewelry .nav-menu .nav>li:hover a, #'+$id+'.option2 .category-featured.jewelry .nav-menu .nav>li.active a,#'+$id+'.option2 .category-featured.jewelry .nav-menu .nav>li:hover a:after, #'+$id+'.option2 .category-featured.jewelry .nav-menu .nav>li.active a:after{color: '+$color+';}' );
                $style.append( '#'+$id+'.option2 .nav-menu .navbar-collapse{border-bottom-color:'+$color+'}' );
                $style.append( '#'+$id+'.option2 .category-featured.jewelry .add-to-cart{background-color:rgba( '+$rgb+', 0.7 )}' );
            }
        }else if( $this.hasClass('option7') ){
            $style.append( '#'+$id+' .products .group-tool-button a,#'+$id+' .products .group-tool-button a,#'+$id+' .products .group-tool-button a.compare, #'+$id+'.option7.box-products .box-product-head .box-title,  #'+$id+'.option7.box-products .box-tabs li>a:before, #'+$id+'.option7 .owl-controls .owl-prev:hover, #'+$id+'.option7 .owl-controls .owl-next:hover{background-color: '+$color+';}' );
            $style.append( '#'+$id+'.option7.box-products .box-tabs li.active>a, #'+$id+'.option7.box-products .box-tabs li>a:after, #'+$id+'.option7.box-products .box-tabs li.active>a, #'+$id+'.option7.box-products .box-tabs li>a:hover, #'+$id+'.option7.box-products a:hover{color: '+$color+';}' );
            $style.append( '#'+$id+'.option7 .products .search{background-color:rgba( '+$rgb+', 0.7 )}' );
            $style.append( '#'+$id+'.option7 .products .group-tool-button a, #'+$id+'.option7.box-products .box-product-head{border-color:'+$color+'}' );
        }else if( $this.hasClass('option12') ){
            $style.append( '#'+$id+'.option12.tab-7.block-tab-category .head .title .bar.active, #'+$id+'.option12.tab-7.block-tab-category .product-style3 .group-button-control .yith-wcwl-add-to-wishlist:hover a,#'+$id+'.option12.tab-7.block-tab-category .product-style3 .compare-button a:hover, #'+$id+'.option12.tab-7.block-tab-category .product-style3 .group-button-control .compare-button:hover, #'+$id+'.option12.tab-7.block-tab-category .product-style3 .group-button-control .yith-wcqv-button:hover, #'+$id+'.option12.tab-7.block-tab-category .product-style3 .add-to-cart:hover{background-color: '+$color+';}' );
            $style.append( '#'+$id+'.option12.tab-7.block-tab-category .box-tabs li a:hover, #'+$id+'.option12.tab-7.block-tab-category .box-tabs li.active a{color: '+$color+';}' );
            $style.append( '#'+$id+'.option12.tab-7.block-tab-category .tab-cat{background-color:rgba( '+$rgb+', 0.8 )}' );
            $style.append( '#'+$id+'.option12.tab-7.block-tab-category .head{border-color:'+$color+'}' );
        }else if( $this.hasClass('box-products') ){
            $style.append( '#'+$id+'.box-products .box-tabs li>a:before, #'+$id+'.box-products .product-list li .add-to-cart:hover, #'+$id+'.box-products .product-list li .quick-view a:hover, #'+$id+'.box-products .owl-controls .owl-prev:hover, #'+$id+'.box-products .owl-controls .owl-next:hover{background-color: '+$color+';}' );
            $style.append( '#'+$id+'.box-products .box-tabs li>a:after{color: '+$color+';}' );
            $style.append( '#'+$id+'.box-products .box-product-head .box-title{border-bottom-color:'+$color+'}' );
            $style.append( '#'+$id+'.box-products .product-list li .add-to-cart{background-color:rgba( '+$rgb+', 0.7 )}' );
        }
    });
    jQuery( '.block-hotdeal-week.option12' ).each(function(){
        var $this  = jQuery(this);
        var $color = $this.data( 'color' );
        if( $color == '' ){
            $color = '#ff3366';
        }
        $style.append( '.option12.block-hotdeal-week .countdown-lastest .box-count .number{background-color: '+$color+';}' )
    });
    /**==============================
    ***  Effect tab category
    ===============================**/
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var $this      = jQuery(this);
            var $container = $this.closest('.container-tab');
            var tab_container = $container.find( '.tab-container' );
            var $tab_nav   = $this.closest( 'li.tab-nav' );
            var data       = $tab_nav.data();
            if( $tab_nav.hasClass( 'enable_ajax' ) ){
                var loading = tab_container.find('.cover-loading');
                loading.show();
                jQuery.post( 
                    ajaxurl, 
                    {
                        'action': 'kt_load_tab_section',
                        'data'  :  data
                    }, function(response){
                        response = jQuery( response );
                        tab_container.find('.tab-panel.active').removeClass('active');
                        tab_container.append( response );
                        loading.hide();
                        var product_list = tab_container.find('.tab-panel.active .product-list');   
                        if( product_list.hasClass( 'on-carousel' ) ) {
                            settingCarousel( tab_container, product_list );
                        }else{
                            var $lazy = response.find( '.kt-template-loop .owl-lazy' );
                            kt_lazy( $lazy );
                        }
                        $tab_nav.removeClass( 'enable_ajax' );
                    }
                );
            }
            
            var $href            = $this.attr('href');
            var $tab_active      = $container.find($href);
            if( $container.hasClass( 'block-tab-category14' ) ){
                $tab_active.find( '.product-style4' ).each(function( $index, $item){
                    var $item = jQuery( $item );
                    var $style = $item.attr("style");
                    $style     = ( $style == undefined ) ? '' : $style;
                    var delay  = $index * 300;
                    $item.attr("style", $style +
                              ";-webkit-animation-delay:" + delay + "ms;"
                            + "-moz-animation-delay:" + delay + "ms;"
                            + "-o-animation-delay:" + delay + "ms;"
                            + "animation-delay:" + delay + "ms;"
                    ).addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $item.removeClass('slideInTop animated');
                        $item.attr("style", $style);
                    }); 
                });
            }else{
                var $carousel_active = $tab_active.find('.product-list');
                
                var $item_active     = $carousel_active.find( '.owl-item.active' );
                
                if( $carousel_active.length > 0 ){
                    if( ! $carousel_active.hasClass( 'owl-loaded' ) && $carousel_active.hasClass( 'on-carousel' ) ){
                      settingCarousel( tab_container, $carousel_active );
                    }else{
                        $item_active.each( function ( $i ) {
                            var $item  = jQuery(this);
                            var $style = $item.attr("style");
                            $style     = ( $style == undefined ) ? '' : $style;
                            var delay  = $i * 300;
                            $item.attr("style", $style +
                                      ";-webkit-animation-delay:" + delay + "ms;"
                                    + "-moz-animation-delay:" + delay + "ms;"
                                    + "-o-animation-delay:" + delay + "ms;"
                                    + "animation-delay:" + delay + "ms;"
                            ).addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                                $item.removeClass('slideInTop animated');
                                if ( $style )
                                    $item.attr("style", $style);
                            }); 
                        });
                    }
                }
                
                var $lazy = $tab_active.find( '.kt-template-loop .owl-lazy' );
                kt_lazy( $lazy );
            }
        });
        
        kt_lazy( first_lazy );

    $(document).on('click','.mobile-navigation',function(){
      $(this).closest('.main-menu-wapper').find('.navigation-main-menu').toggle();
      $('#box-vertical-megamenus .vertical-menu-content').hide();
      return false;
    });

    //
    //
    $(document).on('click','.header.style8 .form-search .icon,.header.style14 .form-search .icon',function(){
        $(this).closest('.form-search').find('form').fadeIn(600);
    });
        
    $(document).on('click','.header.style8 .form-search .close-form,.header.style14 .form-search .close-form',function(){
        $(this).closest('form').fadeOut(600);
    });
    
    if( $('.fancybox').length >0 ){
      $(".fancybox").fancybox({
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic',
        'speedIn'   : 600, 
        'speedOut'    : 200, 
        'overlayShow' : false
      });
    }

    //
    //testimonial-carousel
    if( $('.testimonial-carousel').length >0) {
        var owl = $('.testimonial-carousel');
        owl.owlCarousel(
            {
                margin:30,
                autoplay:true,
                dots:false,
                loop:true,
                items:3,
                nav:true,
                smartSpeed:1000,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            }
        );
        owl.trigger('next.owl.carousel');
        owl.on('changed.owl.carousel', function(event) {
            owl.find('.owl-item.active').removeClass('item-center');
            
            setTimeout(function(){
                owl.find('.owl-item.active').first().next().addClass('item-center');
                owl.find('.owl-item.active').first().next().addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                     $(this).removeClass('zoomIn animated');
                });
                var caption = owl.find('.owl-item.active').first().next().find('.info').html();
                owl.closest('.block-testimonials').find('.testimonial-caption').html(caption).addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                         $(this).removeClass('zoomIn animated');
                });;
            }, 100);
        })
    }
        //testimonial-carousel
    if($('.testimonial-carousel-rtl').length >0){
        var owl = $('.testimonial-carousel-rtl');
        owl.owlCarousel(
            {
                margin:30,
                autoplay:true,
                dots:false,
                loop:true,
                items:3,
                rtl:true,
                nav:true,
                smartSpeed:1000,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            }
        );
        owl.trigger('next.owl.carousel');
        owl.on('changed.owl.carousel', function(event) {
            owl.find('.owl-item.active').removeClass('item-center');
            var caption=owl.find('.owl-item.active').first().next().find('.info').html();
            owl.closest('.block-testimonials').find('.testimonial-caption').html(caption).addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                     $(this).removeClass('zoomIn animated');
            });;
            setTimeout(function(){
                owl.find('.owl-item.active').first().next().addClass('item-center');
                owl.find('.owl-item.active').first().next().addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                     $(this).removeClass('zoomIn animated');
                });
            }, 100);
        })
    }
    
    if($('.testimonial-carousel2').length >0){
        var owl = $('.testimonial-carousel2');
        var rtl = false;
        if( $('body').hasClass('rtl')){
          rtl = true;
        }
        owl.owlCarousel(
            {
                margin:0,
                autoplay:true,
                dots:false,
                loop:true,
                items:3,
                nav:false,
                smartSpeed:1000,
                rtl:rtl,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            }
        );
        owl.trigger('next.owl.carousel');
        owl.on('changed.owl.carousel', function(event) {
            owl.find('.owl-item.active').removeClass('item-center');
            var caption=owl.find('.owl-item.active').first().next().find('.info').html();
            owl.closest('.block-testimonials,.block-testimonials2').find('.testimonial-caption').html(caption).addClass('fadeIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                     $(this).removeClass('fadeIn animated');
            });;
            setTimeout(function(){
                owl.find('.owl-item.active').first().next().addClass('item-center');
                owl.find('.owl-item.active').first().next().addClass('fadeIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                     $(this).removeClass('fadeIn animated');
                });
            }, 100);
        })
    }

        // Single colection
    $(document).on('click','.colection-thumb .thumb-item',function(){
      var src = $(this).attr('href');
      $(this).closest('.colection-thumb').find('.thumb-item').each(function(){
        $(this).removeClass('selected');
      })
      $(this).addClass('selected');
      $('.colection-images .main-image').find('img').attr('src',src);
      return false;
    });
    
    $(document).on('click','.block-tab-category .bar',function(){
        $(this).toggleClass('active');
        $(this).closest('.block-tab-category').find('.tab-cat').toggleClass('show');
    });
    // Open form search in header 9
    $(document).on('click','.form-search-9 .icon',function(){
        $(this).closest('.form-search-9').find('.form-search-inner').fadeIn(600);
        $(this).closest('.form-search-9').find('.form-search-inner .input-serach input').focus();
    })
    /* Close form search in header 9*/
    $(document).on('click','*',function(e){
        var container = $(".form-search-9");
        var icon = $(".form-search-9 .icon");
        if (!container.is(e.target) && container.has(e.target).length === 0 && !icon.is(e.target) && icon.has(e.target).length === 0){
            container.find('.form-search-inner').fadeOut(600);
        }
    });
    if( jQuery.isFunction( 'bxSlider' ) ){
        jQuery('.list-brand').bxSlider({
          mode: 'vertical',
            minSlides: 4,
            maxSlides: 4,
            pager:false,
            useCSS:false
        });
    }
    
    $(document).on('click','.block-top-brands2 .list-brands a',function(){
        var tab = $(this).attr('href');
        $(this).closest('.list-brands').find('a.tab-nav').each(function(){
            $(this).removeClass('active');
        })
        $(this).addClass('active');
        $(this).closest('.block-top-brands2').find('.brand-products .tab-panel').each(function(){
            $(this).removeClass('active');
        });
        var $tab_activate = $(tab);
        
        $tab_activate.addClass('active');
        var $lazy = $tab_activate.find( '.active .primary_image img' );
        kt_lazy( $lazy );
       
        return false;
    })
});
/* ---------------------------------------------
 Scripts resize
 --------------------------------------------- */
$(window).resize(function(){
    // auto width megamenu
    auto_width_megamenu();
    // Remove menu ontop
    remove_menu_ontop();
    // resize top menu
    resizeTopmenu();
    auto_height_product_list();
});
/* ---------------------------------------------
 Scripts scroll
 --------------------------------------------- */
$(window).scroll(function(){
    /* Show hide scrolltop button */
    if( $(window).scrollTop() == 0 ) {
        $('.scroll_top').stop(false,true).fadeOut(600);
    }else{
        $('.scroll_top').stop(false,true).fadeIn(600);
    }
    /* Main menu on top */
    var h = $(window).scrollTop();
    var max_h = $('#header').height() + $('#top-banner').height();
    var width = $(window).width();
    var vertical_menu_height = 0;
    if( $('#box-vertical-megamenus' ).length > 0 ){
      vertical_menu_height = $('#box-vertical-megamenus .vertical-menu-content').innerHeight();
    }
    if(width > 991){
        if( h > (max_h + vertical_menu_height)-50){
            // fix top menu
            $('#nav-top-menu').addClass('nav-ontop');
            $('#nav-top-menu').find('.vertical-menu-content').hide();
            $('#header').addClass('ontop');
            //$('#nav-top-menu').find('.vertical-menu-content').hide();
            //$('#nav-top-menu').find('.title').removeClass('active');
            // add cart box on top menu
            $('#cart-block .cart-block').appendTo('#shopping-cart-box-ontop .shopping-cart-box-ontop-content');
            $('#shopping-cart-box-ontop').fadeIn();
            $('#user-info-top').appendTo('#user-info-opntop');
            $('#header .header-search-box form').appendTo('#form-search-opntop');
        }else{
            $('#nav-top-menu').removeClass('nav-ontop');
            if($('body').hasClass('home')){
                $('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
                if(width > 1024){
                  if($('#nav-top-menu').find('.box-vertical-megamenus').hasClass('hiden_content')){
                    
                  }else{
                    $('#nav-top-menu').find('.vertical-menu-content').show();
                  }
                }else{
                    $('#nav-top-menu').find('.vertical-menu-content').hide();
                }
                
                //$('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
            }
            ///
            $('#shopping-cart-box-ontop .cart-block').appendTo('#cart-block');
            $('#shopping-cart-box-ontop').fadeOut();
            $('#user-info-opntop #user-info-top').appendTo('.top-header .container');
            $('#form-search-opntop form').appendTo('#header .header-search-box');

            $('#header').removeClass('ontop');
        }
    }

    // Menu ontop header 8
    /* Main menu on top */
    var h = $(window).scrollTop();
    var width = $(window).width();
    if(width > 991){
        if(h > 100){
            $('.header.style8,.header.style11,.header.style9,.header.style14').addClass('ontop');
        }else{
            $('.header.style8,.header.style11,.header.style9,.header.style14').removeClass('ontop');
        }
    }
});
var vertical_menu_height = $('#box-vertical-megamenus .box-vertical-megamenus').innerHeight();
/**==============================
***  Auto width megamenu
===============================**/
function auto_width_megamenu(){
    var full_width = parseInt($('.container').innerWidth());
    //full_width = $( document ).width();
    var menu_width = parseInt($('.vertical-menu-content').actual('width'));
    $('.vertical-menu-content').find('.megamenu').each(function(){
        $(this).width((full_width - menu_width)-32);
    });
    
    if($(window).width()+scrollCompensate() < 1025){
        $("#box-vertical-megamenus li.dropdown:not(.active) >a").attr('data-toggle','dropdown');
    }else{
        $("#box-vertical-megamenus li.dropdown >a").removeAttr('data-toggle');
    }
}
/**==============================
***  Remove menu on top
===============================**/
function remove_menu_ontop(){
    var width = parseInt($(window).width());
    if(width < 768){
        $('#nav-top-menu').removeClass('nav-ontop');
        if($('body').hasClass('home')){
            if(width > 1024)
                $('#nav-top-menu').find('.vertical-menu-content').show();
            else{
                $('#nav-top-menu').find('.vertical-menu-content').hide();
            }
        }
        ///
        $('#shopping-cart-box-ontop .cart-block').appendTo('#cart-block');
        $('#shopping-cart-box-ontop').fadeOut();
        $('#user-info-opntop #user-info-top').appendTo('.top-header .container');
        $('#form-search-opntop form').appendTo('#header .header-search-box');
    }
}
/* Top menu*/
function scrollCompensate(){
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";
    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);
    document.body.appendChild(outer);
    var w1 = parseInt(inner.offsetWidth);
    outer.style.overflow = 'scroll';
    var w2 = parseInt(inner.offsetWidth);
    if (w1 == w2) w2 = outer.clientWidth;
    document.body.removeChild(outer);
    return (w1 - w2);
}

function resizeTopmenu(){
    if($(window).width() + scrollCompensate() >= 768){
        var main_menu_w = $('#main-menu .navbar').innerWidth();
        $("#main-menu .megamenu").each(function(){
            var menu_width = $(this).innerWidth();
            var offset_left = $(this).position().left;

            if(menu_width > main_menu_w){
                $(this).css('width',main_menu_w+'px');
                $(this).css('left','0');
            }else{
                if((menu_width + offset_left) > main_menu_w){
                    var t = main_menu_w-menu_width;
                    var left = parseInt((t/2));
                    $(this).css('left',left);
                }
            }
        });
    }

    if($(window).width()+scrollCompensate() < 1025){
        $("#main-menu li.dropdown:not(.active) >a").attr('data-toggle','dropdown');
    }else{
        $("#main-menu li.dropdown >a").removeAttr('data-toggle');
    }
}
function show_other_item_vertical_menu(){
  if( $( '.box-vertical-megamenus' ).length > 0 ){
      var all_item = 0;
      var limit_item = $('.box-vertical-megamenus').data('items')-1;

      if($('.box-vertical-megamenus').hasClass('style2')){
        if( $(window).width() <= 1024){
          limit_item = 8;
        }
        
      }
      var all_item = $('.box-vertical-megamenus .vertical-menu-list>li').length;
      if( all_item > (limit_item + 1) ){
         $('.box-vertical-megamenus').addClass('show-button-all');
      }

      $('.box-vertical-megamenus').find('.vertical-menu-list>li').each(function(i){
          all_item = all_item + 1;
          if(i > limit_item){
            $(this).addClass('cat-link-orther');
          }
      })
  }
}
    
    /*$("img.lazy").lazyload({
        effect: "fadeIn",
        skip_invisible: false,
        failure_limit : 200,
        event: 'scroll load_lazy'
    });*/
})(jQuery); // End of use strict
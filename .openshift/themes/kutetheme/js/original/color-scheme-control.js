/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'kutetheme-color-scheme' ),
		colorSchemeKeys = [
			'background_color',
			'main_color',
			'box_background_color',
			'textcolor',
            'price_color',
			'rate_color',
			'button_color',
            'menu_link_footer',
            'button_color_rgb',
            'color_main_rgb'
		],
		colorSettings = [
			'background_color',
			'main_color',
			'box_background_color',
            'textcolor',
            'price_color'
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					// Update Background Color.
                    console.log(colorScheme[value]);
					api( 'background_color' ).set( colorScheme[value].colors[0] );
					api.control( 'background_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[0] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[0] );

					// Update Main Color.
					api( 'main_color' ).set( colorScheme[value].colors[1] );
					api.control( 'main_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[1] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[1] );

					// Update Box and Sidebar Color.
					api( 'box_background_color' ).set( colorScheme[value].colors[2] );
					api.control( 'box_background_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[2] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[2] );
                        
                    // Update Text Color.
					api( 'textcolor' ).set( colorScheme[value].colors[3] );
					api.control( 'textcolor' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );
                        
                    // Update Text Color.
					api( 'price_color' ).set( colorScheme[value].colors[8] );
					api.control( 'price_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[8] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[8] );
                            
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});

		// Add additional colors.
		colors.button_color_rgb = Color( colors.button_color_rgb ).toCSS( 'rgba', 0.7 );
        colors.color_main_rgb   = Color( colors.color_main_rgb ).toCSS( 'rgba', 0.5 );
        
		css = cssTemplate( colors );

		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );

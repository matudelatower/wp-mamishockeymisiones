<?php
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since mamihockyemisiones 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function mamihockyemisiones_customize_register( $wp_customize ) {
	$color_scheme = mamihockyemisiones_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname',
			array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'mamihockyemisiones_customize_partial_blogname',
			) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription',
			array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'mamihockyemisiones_customize_partial_blogdescription',
			) );
	}

	$wp_customize->add_setting( 'primary_color',
		array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label'   => 'Color Primario',
		'section' => 'colors',
	) ) );

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'mamihockyemisiones_sanitize_color_scheme',
			'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( 'color_scheme',
		array(
			'label'    => __( 'Base Color Scheme', 'mamihockyemisiones' ),
			'section'  => 'colors',
			'type'     => 'select',
			'choices'  => mamihockyemisiones_get_color_scheme_choices(),
			'priority' => 1,
		) );

	// Add custom header and sidebar text color setting and control.
	$wp_customize->add_setting( 'sidebar_textcolor',
		array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_textcolor', array(
		'label'       => __( 'Header and Sidebar Text Color', 'mamihockyemisiones' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.',
			'mamihockyemisiones' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add custom header and sidebar background color setting and control.
	$wp_customize->add_setting( 'header_background_color',
		array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header and Sidebar Background Color', 'mamihockyemisiones' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.',
			'mamihockyemisiones' ),
		'section'     => 'colors',
	) ) );

	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.',
		'mamihockyemisiones' );
}

add_action( 'customize_register', 'mamihockyemisiones_customize_register', 10 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since mamihockyemisiones 1.0
 * @see mamihockyemisiones_customize_register()
 *
 * @return void
 */
function mamihockyemisiones_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since mamihockyemisiones 1.0
 * @see mamihockyemisiones_customize_register()
 *
 * @return void
 */
function mamihockyemisiones_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Register color schemes for mamihockyemisiones.
 *
 * Can be filtered with {@see 'mamihockyemisiones_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since mamihockyemisiones 1.0
 *
 * @return array An associative array of color scheme options.
 */
function mamihockyemisiones_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with mamihockyemisiones.
	 *
	 * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
	 *
	 * @since mamihockyemisiones 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 * @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 * @type string $label Color scheme label.
	 * @type array $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters( 'mamihockyemisiones_color_schemes',
		array(
			'default' => array(
				'label'  => __( 'Default', 'mamihockyemisiones' ),
				'colors' => array(
					'#f1f1f1',
					'#ffffff',
					'#ffffff',
					'#333333',
					'#333333',
					'#f7f7f7',
				),
			),
			'dark'    => array(
				'label'  => __( 'Dark', 'mamihockyemisiones' ),
				'colors' => array(
					'#111111',
					'#202020',
					'#202020',
					'#bebebe',
					'#bebebe',
					'#1b1b1b',
				),
			),
			'yellow'  => array(
				'label'  => __( 'Yellow', 'mamihockyemisiones' ),
				'colors' => array(
					'#f4ca16',
					'#ffdf00',
					'#ffffff',
					'#111111',
					'#111111',
					'#f1f1f1',
				),
			),
			'pink'    => array(
				'label'  => __( 'Pink', 'mamihockyemisiones' ),
				'colors' => array(
					'#ffe5d1',
					'#e53b51',
					'#ffffff',
					'#352712',
					'#ffffff',
					'#f1f1f1',
				),
			),
			'purple'  => array(
				'label'  => __( 'Purple', 'mamihockyemisiones' ),
				'colors' => array(
					'#674970',
					'#2e2256',
					'#ffffff',
					'#2e2256',
					'#ffffff',
					'#f1f1f1',
				),
			),
			'blue'    => array(
				'label'  => __( 'Blue', 'mamihockyemisiones' ),
				'colors' => array(
					'#e9f2f9',
					'#55c3dc',
					'#ffffff',
					'#22313f',
					'#ffffff',
					'#f1f1f1',
				),
			),
		) );
}

if ( ! function_exists( 'mamihockyemisiones_get_color_scheme' ) ) :
	/**
	 * Get the current mamihockyemisiones color scheme.
	 *
	 * @since mamihockyemisiones 1.0
	 *
	 * @return array An associative array of either the current or default color scheme hex values.
	 */
	function mamihockyemisiones_get_color_scheme() {
		$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
		$color_schemes       = mamihockyemisiones_get_color_schemes();

		if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
			return $color_schemes[ $color_scheme_option ]['colors'];
		}

		return $color_schemes['default']['colors'];
	}
endif; // mamihockyemisiones_get_color_scheme

if ( ! function_exists( 'mamihockyemisiones_get_color_scheme_choices' ) ) :
	/**
	 * Returns an array of color scheme choices registered for mamihockyemisiones.
	 *
	 * @since mamihockyemisiones 1.0
	 *
	 * @return array Array of color schemes.
	 */
	function mamihockyemisiones_get_color_scheme_choices() {
		$color_schemes                = mamihockyemisiones_get_color_schemes();
		$color_scheme_control_options = array();

		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}

		return $color_scheme_control_options;
	}
endif; // mamihockyemisiones_get_color_scheme_choices

if ( ! function_exists( 'mamihockyemisiones_sanitize_color_scheme' ) ) :
	/**
	 * Sanitization callback for color schemes.
	 *
	 * @since mamihockyemisiones 1.0
	 *
	 * @param string $value Color scheme name value.
	 *
	 * @return string Color scheme name.
	 */
	function mamihockyemisiones_sanitize_color_scheme( $value ) {
		$color_schemes = mamihockyemisiones_get_color_scheme_choices();

		if ( ! array_key_exists( $value, $color_schemes ) ) {
			$value = 'default';
		}

		return $value;
	}
endif; // mamihockyemisiones_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since mamihockyemisiones 1.0
 *
 * @see wp_add_inline_style()
 */
function mamihockyemisiones_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = mamihockyemisiones_get_color_scheme();

	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = mamihockyemisiones_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = mamihockyemisiones_hex2rgb( $color_scheme[4] );
	$colors                      = array(
		'background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1],
		'box_background_color'        => $color_scheme[2],
		'textcolor'                   => $color_scheme[3],
		'secondary_textcolor'         => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_textcolor_rgb ),
		'border_color'                => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_textcolor_rgb ),
		'border_focus_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_textcolor_rgb ),
		'sidebar_textcolor'           => $color_scheme[4],
		'sidebar_border_color'        => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_sidebar_textcolor_rgb ),
		'sidebar_border_focus_color'  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_sidebar_textcolor_rgb ),
		'secondary_sidebar_textcolor' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_textcolor_rgb ),
		'meta_box_background_color'   => $color_scheme[5],
	);

	$color_scheme_css = mamihockyemisiones_get_color_scheme_css( $colors );

	wp_add_inline_style( 'mamihockyemisiones-style', $color_scheme_css );
}

add_action( 'wp_enqueue_scripts', 'mamihockyemisiones_color_scheme_css' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since mamihockyemisiones 1.0
 */
function mamihockyemisiones_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control',
		get_template_directory_uri() . '/js/color-scheme-control.js',
		array( 'customize-controls', 'iris', 'underscore', 'wp-util' ),
		'20141216',
		true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', mamihockyemisiones_get_color_schemes() );
}

add_action( 'customize_controls_enqueue_scripts', 'mamihockyemisiones_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since mamihockyemisiones 1.0
 */
function mamihockyemisiones_customize_preview_js() {
	wp_enqueue_script( 'mamihockyemisiones-customize-preview',
		get_template_directory_uri() . '/js/customize-preview.js',
		array( 'customize-preview' ),
		'20141216',
		true );
}

add_action( 'customize_preview_init', 'mamihockyemisiones_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since mamihockyemisiones 1.0
 *
 * @param array $colors Color scheme colors.
 *
 * @return string Color scheme CSS.
 */
function mamihockyemisiones_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors,
		array(
			'background_color'            => '',
			'header_background_color'     => '',
			'box_background_color'        => '',
			'textcolor'                   => '',
			'secondary_textcolor'         => '',
			'border_color'                => '',
			'border_focus_color'          => '',
			'sidebar_textcolor'           => '',
			'sidebar_border_color'        => '',
			'sidebar_border_focus_color'  => '',
			'secondary_sidebar_textcolor' => '',
			'meta_box_background_color'   => '',
		) );

	$css = <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Sidebar Background Color */
	body:before,
	.site-header {
		background-color: {$colors['header_background_color']};
	}

	/* Box Background Color */
	.post-navigation,
	.pagination,
	.secondary,
	.site-footer,
	.hentry,
	.page-header,
	.page-content,
	.comments-area,
	.widecolumn {
		background-color: {$colors['box_background_color']};
	}

	/* Box Background Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.sticky-post {
		color: {$colors['box_background_color']};
	}

	/* Main Text Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.page-links a,
	.sticky-post {
		background-color: {$colors['textcolor']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	a,
	.dropdown-toggle:after,
	.image-navigation a:hover,
	.image-navigation a:focus,
	.comment-navigation a:hover,
	.comment-navigation a:focus,
	.widget-title,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.comment-list .reply a:hover,
	.comment-list .reply a:focus,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['textcolor']};
	}

	/* Main Text Color */
	.entry-content a,
	.entry-summary a,
	.page-content a,
	.comment-content a,
	.pingback .comment-body > a,
	.author-description a,
	.taxonomy-description a,
	.textwidget a,
	.entry-footer a:hover,
	.comment-metadata a:hover,
	.pingback .edit-link a:hover,
	.comment-list .reply a:hover,
	.site-info a:hover {
		border-color: {$colors['textcolor']};
	}

	/* Secondary Text Color */
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	a:hover,
	a:focus,
	.main-navigation .menu-item-description,
	.post-navigation .meta-nav,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.image-navigation,
	.image-navigation a,
	.comment-navigation,
	.comment-navigation a,
	.widget,
	.author-heading,
	.entry-footer,
	.entry-footer a,
	.taxonomy-description,
	.page-links > .page-links-title,
	.entry-caption,
	.comment-author,
	.comment-metadata,
	.comment-metadata a,
	.pingback .edit-link,
	.pingback .edit-link a,
	.post-password-form label,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.no-comments,
	.site-info,
	.site-info a,
	.wp-caption-text,
	.gallery-caption,
	.comment-list .reply a,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		color: {$colors['secondary_textcolor']};
	}

	/* Secondary Text Color */
	blockquote,
	.logged-in-as a:hover,
	.comment-author a:hover {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['secondary_textcolor']};
	}

	/* Border Color */
	hr,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	/* Border Color */
	pre,
	abbr[title],
	table,
	th,
	td,
	input,
	textarea,
	.main-navigation ul,
	.main-navigation li,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.comment-navigation,
	.widget li,
	.widget_categories .children,
	.widget_nav_menu .sub-menu,
	.widget_pages .children,
	.site-header,
	.site-footer,
	.hentry + .hentry,
	.author-info,
	.entry-content .page-links a,
	.page-links > span,
	.page-header,
	.comments-area,
	.comment-list + .comment-respond,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-list .reply a,
	.no-comments {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	/* Border Focus Color */
	a:focus,
	button:focus,
	input:focus {
		outline-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['border_focus_color']};
	}

	input:focus,
	textarea:focus {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_focus_color']};
	}

	/* Sidebar Link Color */
	.secondary-toggle:before {
		color: {$colors['sidebar_textcolor']};
	}

	.site-title a,
	.site-description {
		color: {$colors['sidebar_textcolor']};
	}

	/* Sidebar Text Color */
	.site-title a:hover,
	.site-title a:focus {
		color: {$colors['secondary_sidebar_textcolor']};
	}

	/* Sidebar Border Color */
	.secondary-toggle {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_color']};
	}

	/* Sidebar Border Focus Color */
	.secondary-toggle:hover,
	.secondary-toggle:focus {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_focus_color']};
	}

	.site-title a {
		outline-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['sidebar_border_focus_color']};
	}

	/* Meta Background Color */
	.entry-footer {
		background-color: {$colors['meta_box_background_color']};
	}

	@media screen and (min-width: 38.75em) {
		/* Main Text Color */
		.page-header {
			border-color: {$colors['textcolor']};
		}
	}

	@media screen and (min-width: 59.6875em) {
		/* Make sure its transparent on desktop */
		.site-header,
		.secondary {
			background-color: transparent;
		}

		/* Sidebar Background Color */
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			color: {$colors['header_background_color']};
		}

		/* Sidebar Link Color */
		.secondary a,
		.dropdown-toggle:after,
		.widget-title,
		.widget blockquote cite,
		.widget blockquote small {
			color: {$colors['sidebar_textcolor']};
		}

		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a {
			background-color: {$colors['sidebar_textcolor']};
		}

		.textwidget a {
			border-color: {$colors['sidebar_textcolor']};
		}

		/* Sidebar Text Color */
		.secondary a:hover,
		.secondary a:focus,
		.main-navigation .menu-item-description,
		.widget,
		.widget blockquote,
		.widget .wp-caption-text,
		.widget .gallery-caption {
			color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget button:hover,
		.widget button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: {$colors['secondary_sidebar_textcolor']};
		}

		.widget blockquote {
			border-color: {$colors['secondary_sidebar_textcolor']};
		}

		/* Sidebar Border Color */
		.main-navigation ul,
		.main-navigation li,
		.widget input,
		.widget textarea,
		.widget table,
		.widget th,
		.widget td,
		.widget pre,
		.widget li,
		.widget_categories .children,
		.widget_nav_menu .sub-menu,
		.widget_pages .children,
		.widget abbr[title] {
			border-color: {$colors['sidebar_border_color']};
		}

		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.widget hr {
			background-color: {$colors['sidebar_border_color']};
		}

		.widget input:focus,
		.widget textarea:focus {
			border-color: {$colors['sidebar_border_focus_color']};
		}

		.sidebar a:focus,
		.dropdown-toggle:focus {
			outline-color: {$colors['sidebar_border_focus_color']};
		}
	}
CSS;

	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since mamihockyemisiones 1.0
 */
function mamihockyemisiones_color_scheme_css_template() {
	$colors = array(
		'background_color'            => '{{ data.background_color }}',
		'header_background_color'     => '{{ data.header_background_color }}',
		'box_background_color'        => '{{ data.box_background_color }}',
		'textcolor'                   => '{{ data.textcolor }}',
		'secondary_textcolor'         => '{{ data.secondary_textcolor }}',
		'border_color'                => '{{ data.border_color }}',
		'border_focus_color'          => '{{ data.border_focus_color }}',
		'sidebar_textcolor'           => '{{ data.sidebar_textcolor }}',
		'sidebar_border_color'        => '{{ data.sidebar_border_color }}',
		'sidebar_border_focus_color'  => '{{ data.sidebar_border_focus_color }}',
		'secondary_sidebar_textcolor' => '{{ data.secondary_sidebar_textcolor }}',
		'meta_box_background_color'   => '{{ data.meta_box_background_color }}',
	);
	?>
    <script type="text/html" id="tmpl-mamihockyemisiones-color-scheme">
		<?php echo mamihockyemisiones_get_color_scheme_css( $colors ); ?>
    </script>
	<?php
}

add_action( 'customize_controls_print_footer_scripts', 'mamihockyemisiones_color_scheme_css_template' );


function mamihockyemisiones_extra_customize_register( $wp_customize ) {

//	Secciones
	$wp_customize->add_panel( 'mamihockyemisiones_secciones_panel',
		array(
			'priority'   => 600,
			'capability' => 'edit_theme_options',
			'title'      => __( 'Secciones', 'mamihockyemisiones' )
		) );

	//	seccion header
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_header',
		array(
			'title'         => __( 'Header', 'mamihockyemisiones' ),
			'priority'      => 610,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting(
		'seccion_header_titulo',
		array(
			'default'           => 'Lorem ipsum dolor sit amet',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'seccion_header_titulo',
		array(
			'label'   => __( 'Título', 'mamihockyemisiones' ),
			'section' => 'mamihockyemisiones_seccion_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'seccion_header_descripcion',
		array(
			'default'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis exercitationem reprehenderit dolor vel ducimus voluptate eaque quo suscipit, iste placeat quos facere. Consequuntur praesentium aliquam rerum! Totam aut dolorem velit!',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_header_descripcion',
		array(
			'label'   => __( 'Descripción', 'mamihockyemisiones' ),
			'section' => 'mamihockyemisiones_seccion_header',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting( 'seccion_header_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_header_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_header',
			'settings' => 'seccion_header_imagen_fondo',
		) ) );

	$wp_customize->add_setting( 'seccion_header_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_header_logo',
		array(
			'label'    => 'Logo',
			'section'  => 'mamihockyemisiones_seccion_header',
			'settings' => 'seccion_header_logo',
		) ) );

//    seccion torneos

	$wp_customize->add_section(
		'mamihockyemisiones_seccion_torneos',
		array(
			'title'         => __( 'Torneos', 'mamihockyemisiones' ),
			'priority'      => 620,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_torneos_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_torneos_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_torneos',
			'settings' => 'seccion_torneos_imagen_fondo',
		) ) );

	$torneosPartes = [
		'fixture'          => 'Fixture',
		'tabla_posiciones_a' => 'Tabla de Posiciones - Zona A',
		'tabla_posiciones_b' => 'Tabla de Posiciones - Zona B',
		'tabla_posiciones_c' => 'Tabla de Posiciones - Zona C',
		'goleadoras'       => 'Goleadoras',
		'tarjetas'         => 'Tarjetas',
		'archivos'         => 'Archivos',

	];

	foreach ( $torneosPartes as $key => $torneoParte ) {

		$wp_customize->add_setting(
			'seccion_torneos_' . $key,
			array(
				'default'           => '',
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'seccion_torneos_' . $key,
			array(
				'label'   => __( $torneoParte . ' - shortcode', 'mamihockyemisiones' ),
				'section' => 'mamihockyemisiones_seccion_torneos',
				'type'    => 'text',
			)
		);

	}

//	seccion instucion
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_institucion',
		array(
			'title'         => __( 'Institución', 'mamihockyemisiones' ),
			'priority'      => 630,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_institucion_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_institucion_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_institucion',
			'settings' => 'seccion_institucion_imagen_fondo',
		) ) );

//	$wp_customize->add_setting( 'seccion_institucion_wdi' );
//
//	$wp_customize->add_control( new WP_Widget_Area_Customize_Control( $wp_customize, 'seccion_institucion_wdi',
//		array(
//			'label'    => 'Sobre',
//			'section'  => 'mamihockyemisiones_seccion_institucion',
//			'settings' => 'seccion_institucion_wdi',
//			'sidebar_id' => 'sobre',
//		) ) );

	//	seccion normativas
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_normativas',
		array(
			'title'         => __( 'Normativas', 'mamihockyemisiones' ),
			'priority'      => 640,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_normativas_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_normativas_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_normativas',
			'settings' => 'seccion_normativas_imagen_fondo',
		) ) );

	//	seccion equipos
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_equipos',
		array(
			'title'         => __( 'Equipos', 'mamihockyemisiones' ),
			'priority'      => 650,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_equipos_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_equipos_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_equipos',
			'settings' => 'seccion_equipos_imagen_fondo',
		) ) );


//    seccion socias
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_socias',
		array(
			'title'         => __( 'Socias', 'mamihockyemisiones' ),
			'priority'      => 660,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_socias_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_socias_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_socias',
			'settings' => 'seccion_socias_imagen_fondo',
		) ) );

	$wp_customize->add_setting(
		'seccion_socias_descripcion',
		array(
			'default'           => '',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_socias_descripcion',
		array(
			'label'   => __( 'shortcode', 'mamihockyemisiones' ),
			'section' => 'mamihockyemisiones_seccion_socias',
			'type'    => 'text',
		)
	);

	//	seccion galeria
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_galeria',
		array(
			'title'         => __( 'Galería', 'mamihockyemisiones' ),
			'priority'      => 670,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_galeria_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_galeria_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_galeria',
			'settings' => 'seccion_galeria_imagen_fondo',
		) ) );

	//	seccion formularios
	$wp_customize->add_section(
		'mamihockyemisiones_seccion_formularios',
		array(
			'title'         => __( 'Formularios', 'mamihockyemisiones' ),
			'priority'      => 680,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_formularios_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_formularios_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_formularios',
			'settings' => 'seccion_formularios_imagen_fondo',
		) ) );

//	seccion contacto

	$wp_customize->add_section(
		'mamihockyemisiones_seccion_contacto',
		array(
			'title'         => __( 'Contacto', 'mamihockyemisiones' ),
			'priority'      => 680,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockyemisiones_secciones_panel'
		)
	);

	$wp_customize->add_setting( 'seccion_contacto_imagen_fondo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seccion_contacto_imagen_fondo',
		array(
			'label'    => 'Imagen de Fondo',
			'section'  => 'mamihockyemisiones_seccion_contacto',
			'settings' => 'seccion_contacto_imagen_fondo',
		) ) );

	$wp_customize->add_setting(
		'seccion_contacto_formulario',
		array(
			'default'           => '',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		'seccion_contacto_formulario',
		array(
			'label'   => __( 'Formulario - shortcode', 'mamihockyemisiones' ),
			'section' => 'mamihockyemisiones_seccion_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_panel( 'mamihockeymisiones_contact_panel',
		array(
			'priority'   => 690,
			'capability' => 'edit_theme_options',
			'title'      => __( 'Contacto / Redes Sociales', 'mamihockyemisiones' )
		) );

	$wp_customize->add_section(
		'mamihockyemisiones_seccion_contacto',
		array(
			'title'         => __( 'Contacto', 'mamihockyemisiones' ),
			'priority'      => 681,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockeymisiones_contact_panel'
		)
	);

	$wp_customize->add_setting(
		'mamihockyemisiones_telefono',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'mamihockyemisiones_telefono',
		array(
			'label'   => __( 'Teléfono', 'poncho' ),
			'section' => 'mamihockyemisiones_seccion_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'mamihockyemisiones_celular',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'mamihockyemisiones_celular',
		array(
			'label'   => __( 'Celular', 'poncho' ),
			'section' => 'mamihockyemisiones_seccion_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'mamihockyemisiones_mail',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'mamihockyemisiones_mail',
		array(
			'label'   => __( 'Mail', 'poncho' ),
			'section' => 'mamihockyemisiones_seccion_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'mamihockyemisiones_direccion',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'mamihockyemisiones_direccion',
		array(
			'label'   => __( 'Direccion', 'poncho' ),
			'section' => 'mamihockyemisiones_seccion_contacto',
			'type'    => 'text',
		)
	);

	$wp_customize->add_section(
		'mamihockeymisiones_social_icon',
		array(
			'title'         => __( 'Redes Sociales', 'mamihockyemisiones' ),
			'priority'      => 682,
			'capability'    => 'edit_theme_options',
			'theme_support' => '',
			'panel'         => 'mamihockeymisiones_contact_panel'
		)
	);

	$social_links = array(
		'Facebook'   => 'mamihockyemisiones_facebook_text',
		'Twitter'    => 'mamihockyemisiones_twitter_text',
		'GooglePlus' => 'mamihockyemisiones_googleplus_text',
		'Pinterest'  => 'mamihockyemisiones_pinterest_text',
		'YouTube'    => 'mamihockyemisiones_youtube_text',
		'Vimeo'      => 'mamihockyemisiones_vimeo_text',
		'Linked'     => 'mamihockyemisiones_linkedin_text',
		'Flickr'     => 'mamihockyemisiones_flickr_text',
		'Tumblr'     => 'mamihockyemisiones_tumblr_text',
		'RSS'        => 'mamihockyemisiones_rss_text'
	);
	foreach ( $social_links as $key => $value ) {
		$wp_customize->add_setting(
			$value,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$value,
			array(
				'label'   => __( $key, 'mamihockyemisiones' ),
				'section' => 'mamihockeymisiones_social_icon',
				'type'    => 'text',
			)
		);
	}
}

add_action( 'customize_register', 'mamihockyemisiones_extra_customize_register' );

<?php

$frank_customizer = FrankThemeCustomizer::instance();


class FrankThemeCustomizer {

	private $options = array();

	private $fonts_google = array(
			'Noto+Sans:400,700,400italic,700italic|sans-serif',
			'Playfair+Display:400,700,400italic,700italic|serif',
			'PT+Sans:400,700,400italic,700italic|sans-serif',
			'PT+Sans+Caption:400,700|sans-serif',
			'PT+Mono|monospace',
			'Noto+Serif:400,700,400italic,700italic|serif',
			'Roboto+Slab:400,700|sans-serif',
			'Abril+Fatface|serif',
			'Open+Sans:400italic,700italic,400,700|sans-serif',
			'Roboto:400,400italic,700,700italic|sans-serif',
			'Roboto+Condensed:400italic,700italic,400,700|sans-serif',
			'Source+Sans+Pro:400,700,400italic,700italic|sans-serif',
			'Oxygen:400,700|sans-serif',
			'Titillium+Web:400,400italic,700,700italic|sans-serif',
			'Bree+Serif|sans-serif',
			'Domine:400,700|serif',
			'Arimo:400,700,400italic,700italic|sans-serif',
			'Libre+Baskerville:400,700,400italic|serif',
			'Coustard|serif',
			'Merriweather:400,400italic,700,700italic|serif',
			'Merriweather+Sans:400,700,700italic,400italic|sans-serif',
			'Montserrat:400,700|sans-serif'
		);

	private $fonts_websafe = array(
			'Georgia|serif',
			'Times+New+Roman|serif',
			'Helvetica|Arial,sans-serif',
			'Impact|Charcoal,sans-serif',
			'Tahoma|Geneva,sans-serif',
			'Trebuchet+MS|Helvetica,Arial,sans-serif',
			'Verdana|Geneva,sans-serif',
			'Courier+New|Courier,monospace'
		);


	public static function instance() {

		static $instance;

		if ( ! $instance )
			$instance = new self();

		return $instance;

	}


	protected function __construct() {

		$this->setup();

		add_action( 'customize_register', array( $this, 'register' ) );

		// We hook into wp_head just like wp-head-callback does
		add_action( 'wp_enqueue_scripts', array( $this, 'do_styles' ) );

		add_action( 'wp_footer', array( $this, 'do_fonts' ) );

		add_action( 'wp', array( $this, 'do_hooks' ) );

	}


	function register( $wp_customize ) {

		/**
		 * Theme color options
		 */

		foreach ( $this->options['colors'] as $color_name => $color_options ) {

			$wp_customize->add_setting( 
				$color_name, 
				array_merge(
					array(
						'sanitize_js_callback' => 'maybe_hash_hex_color',
						'sanitize_callback' => 'sanitize_hex_color_no_hash',
					),
					$color_options 
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color_name,
					array(
						'label' => $color_options['label'],
						'section' => 'colors',
						'settings' => $color_name
					)
				)
			);

		}


		/**
		 * frank fonts
		 */

		$wp_customize->add_section(
			'frank-fonts',
			array(
				'title' => __( 'Fonts', 'frank' ),
				'description' => __( 'Choose fonts for headings and body text.', 'frank' ),
				'priority' => 50
			)
		);

		foreach ( $this->options['fonts'] as $font_setting => $font_options ) {

			$wp_customize->add_setting( 
				$font_setting, 
				array(
					'default' => $font_options['default'] 
				) 
			);

			$wp_customize->add_control(
				$font_setting,
				array(
					'type' => 'select',
					'section' => 'frank-fonts',
					'label' => $font_options['label'],
					'choices' => $font_options['choices']
				)
			);

		}


		/**
		 * frank Layout
		 */

		$wp_customize->add_section(
			'frank-layout',
			array(
				'title' => __( 'Layout', 'frank' ),
				'priority' => 30
			)
		);

		$wp_customize->add_setting( 'frank-layout-type', array( 'default' => '' ) );

		$wp_customize->add_control(
			'frank-layout-type',
			array(
				'type' => 'radio',
				'section' => 'frank-layout',
				'label' => __( 'Page Layout', 'frank' ),
				'choices' => array(
					'' => __( 'Left-aligned', 'frank' ),
					'centered' => __( 'Centered', 'frank' )
				)
			)
		);


		/**
		 * Turn regular WordPress actions into theme options
		 */
		
		foreach ( $this->options['filters'] as $filter => $options ) {

			$wp_customize->add_setting( $filter, array( 'default' => $options['default'] ) );

			$wp_customize->add_control(
				$filter,
				array(
					'label' => $options['label'],
					'section' => 'frank-layout',
					'type' => 'checkbox'
				)
			);

		}

	}


	function setup() {

		$this->options['colors'] = array(
			'background_color' => array(
				'label' => __( 'Header Background', 'frank' ),
				'default' => 'dddddd',
				'css' => array( 
					'.wrap-header' => 'background-color',
					'#nav-main .sub-menu a' => 'color'
				),
				'extra' => array(
					array(
						'amount' => -15,
						'css' => array(
							'.wrap-header .wrap-section-in:after, .nav-blog .current-post-ancestor a' => 'background-color',
							'.index-header, .nav-blog-header' => 'border-color'
						)
					)
				)
			),
			'header_textcolor' => array( 
				'label' => __( 'Header Text', 'frank' ),
				'default' => '222222',
				'css' => array( 
					'.wrap-header, .index-heading, #logo a' => 'color',
					'#nav-main .sub-menu' => 'background-color'
				)
			),
			'header-link-color' => array( 
				'label' => __( 'Header Links', 'frank' ),
				'default' => '1e73be',
				'css' => array( 
					'.wrap-header a, #nav-main a, #nav-main .sub-menu .current-menu-item > a' => 'color'
				)
			),
			'link-color' => array( 
				'label' => __( 'Links', 'frank' ),
				'default' => '1e73be',
				'css' => array( 
					'a, .post-meta a:hover, .entry-title a:hover' => 'color'
				)
			),
			'text-color' => array( 
				'label' => __( 'Body Text', 'frank' ),
				'default' => '333333',
				'css' => array( 
					'body' => 'color' 
				)
			),
			'headline-color' => array( 
				'label' => __( 'Headlines', 'frank' ),
				'default' => '222222',
				'css' => array( 
					'.post .entry-title a, h1, h2, h3, h4, h5, h6' => 'color'
				)
			)
		);

		$this->options['filters'] = array(
				'frank_breadcrumb' => array( 
					'hook' => 'content_before', 
					'label' => __( 'Enable breadcrumb', 'frank' ),
					'default' => false
				),
				'frank_featured_image_header_single' => array(
					'hook' => null,
					'label' => __( 'Place featured image after title', 'frank' ),
					'default' => true
				),
				'frank_index_excerpts' => array(
					'hook' => null,
					'label' => __( 'Show post excerpts', 'frank' ),
					'default' => false
				)
			);

		sort( $this->fonts_google );

		$font_frank = array_merge( 
				$this->fonts_websafe,
				$this->fonts_google
			);

		$frank_font_choices = array();

		foreach ( $font_frank as $font_uri ) {
			$font_uri_parts = preg_split( '/[|:]/i', $font_uri );
			$frank_font_choices[ $font_uri ] = str_replace( '+', ' ', $font_uri_parts[0] );
		}

		$this->options['fonts'] = array(
				'heading-font' => array( 
					'label' => __( 'Headings', 'frank' ),
					'choices' => $frank_font_choices,
					'default' => 'Tahoma|Geneva,sans-serif',
					'css' => array( 
						'#header, .footer-menu-wrap, h1, h2, h3, h4, h5, h6, .commentfrank .comment-author, .breadcrumb, #nav-blog' => 'font-family'
					)
				),
				'body-font' => array( 
					'label' => __( 'Body text', 'frank' ),
					'choices' => $frank_font_choices,
					'default' => 'Georgia|serif',
					'css' => array( 
						'body' => 'font-family'
					)
				)
			);

	}


	function do_hooks() {

		foreach ( $this->options['filters'] as $filter => $options )
			if ( ! empty( $options['hook'] ) && ! get_theme_mod( $filter, $options['default'] ) )
				remove_action( $options['hook'], $filter );

	}


	function do_styles() {

		$styles = array();

		// Custom colors
		foreach ( $this->options['colors'] as $color => $settings ) {

			$mod_value = get_theme_mod( $color, $settings['default'] );

			// Ensure that we don't have the hash in front
			$mod_value = ltrim( $mod_value, '#' );

			if ( strcasecmp( $mod_value, $settings['default'] ) )
				foreach ( $settings['css'] as $selector => $property )
					$styles[] = sprintf( 
						'%s { %s: #%s; }', 
						$selector, 
						$property, 
						$mod_value 
					);

			if ( isset( $settings['extra'] ) )
				foreach ( $settings['extra'] as $extra_colors )
					foreach ( $extra_colors['css'] as $selector => $property )
						$styles[] = sprintf( 
							'%s { %s: #%s; }', 
							$selector, 
							$property, 
							$this->frank_hex_color_mod( $mod_value, $extra_colors['amount'] ) 
						);

		}

		// Custom fonts
		foreach ( $this->options['fonts'] as $font => $font_settings ) {

			$mod_value = get_theme_mod( $font, false );

			if ( empty( $mod_value ) )
				continue;

			$mod_value_parts = preg_split( '/[|:]/i', $mod_value );
			$fallback_font = end( $mod_value_parts );

			if ( empty( $fallback_font ) )
				$fallback_font = 'sans-serif';

			foreach ( $font_settings['css'] as $selector => $property ) {
				$styles[] = sprintf( 
						'%s { %s: "%s", %s; }', 
						$selector, 
						$property, 
						esc_attr( str_replace( '+', ' ', $mod_value_parts[0] ) ),
						esc_attr( $fallback_font )
					);
			}

		}

		wp_add_inline_style( 'frank-css', implode( ' ', $styles ) );

	}


	function do_fonts() {

		$queue = array();

		// CSS styles for google fonts
		foreach ( $this->options['fonts'] as $font => $font_settings ) {

			$mod_value = get_theme_mod( $font, false );

			if ( empty( $mod_value ) || ! in_array( $mod_value, $this->fonts_google ) )
				continue;
			
			$font_parts = explode( '|', $mod_value );
			$queue[] = sprintf( '"%s"', esc_attr( $font_parts[0] ) );

		}

		if ( ! empty( $queue ) )
			printf( 
				'<script type="text/javascript">
					WebFontConfig = { google: { families: [ %s ] } };
					(function() {
						var wf = document.createElement("script");
						wf.src = ("https:" == document.location.protocol ? "https" : "http") +
						"://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
						wf.type = "text/javascript";
						wf.async = "true";
						var s = document.getElementsByTagName("script")[0];
						s.parentNode.insertBefore(wf, s);
					})();
				</script>', 
				implode( ', ', array_unique( $queue ) )
			);

	}


	function frank_hex_color_mod( $hex, $diff ) {

		$rgb = str_split( trim( $hex, '# ' ), 2 );
	 
		foreach ($rgb as &$hex) {
			$dec = hexdec($hex) + $diff;
			$dec = max( 0, min( 255, $dec ) );
			$hex = str_pad( dechex( $dec ), 2, '0', STR_PAD_LEFT );
		}
	 
		return implode( $rgb );

	}

}


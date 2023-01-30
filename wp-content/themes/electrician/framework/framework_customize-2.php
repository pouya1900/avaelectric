<?php
function electrician_customizer_live_preview() {
	wp_enqueue_script(
		'ils-themecustomizer',            // Give the script an ID
		ELECTRICITY_JS_URL . '/theme-customizer.js', // Point to file
		array( 'jquery', 'customize-preview' ),    // Define dependencies
		'',                       // Define a version (optional)
		true                      // Put script in footer?
	);
}
// add_action( 'customize_preview_init', 'electrician_customizer_live_preview' );

/*Customizer Code HERE*/



function electrician_theme_customizer( $wp_customize ) {

	// Customizer Title Control
	class WP_Customize_Title_Control extends WP_Customize_Control {
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}
		public function render_content() {
			?><h3><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}

	$wp_customize->add_panel(
		'all_styling_panel',
		array(
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'title'       => esc_html__( 'Styling Settings', 'electrician' ),
			'description' => esc_html__( 'All Styling Settings', 'electrician' ),
		)
	);

	// common color

	 // All Color Settings
	$wp_customize->add_section(
		'electrician_common_color_section',
		array(
			'title'    => esc_html__( 'Common Color', 'electrician' ),
			'priority' => 1,
			'panel'    => 'all_styling_panel',
		)
	);

	// body_color

	$wp_customize->add_setting(
		'electrician_colors[preloader_border_color]',
		array(
			'default'           => '#f47629',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'electrician_colors[preloader_border_color]',
			array(
				'label'    => esc_html__( 'Preloader Color', 'electrician' ),
				'section'  => 'electrician_common_color_section',
				'priority' => 18,
			)
		)
	);

	$wp_customize->add_setting(
		'electrician_colors[heading_span_color]',
		array(
			'default'           => '#f47629',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'electrician_colors[heading_span_color]',
			array(
				'label'    => esc_html__( 'Theme Active Color', 'electrician' ),
				'section'  => 'electrician_common_color_section',
				'priority' => 18,
			)
		)
	);

	$wp_customize->add_setting(
		'electrician_colors[bg_color]',
		array(
			'default'           => '#303442',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'electrician_colors[bg_color]',
			array(
				'label'    => esc_html__( 'Background colors', 'electrician' ),
				'section'  => 'electrician_common_color_section',
				'priority' => 18,
			)
		)
	);

	 // Header_color

	// Button
	$wp_customize->add_section(
		'electrician_Button_section',
		array(
			'title'    => esc_html__( 'Button Color', 'electrician' ),
			'priority' => 4,
			'panel'    => 'all_styling_panel',
		)
	);

	$wp_customize->add_setting(
		'electrician_colors[button_bg_color]',
		array(
			'default'           => '#f47629',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'electrician_colors[button_bg_color]',
			array(
				'label'    => esc_html__( 'Button Color', 'electrician' ),
				'section'  => 'electrician_Button_section',
				'priority' => 19,
			)
		)
	);
	// Footer color
}
add_action( 'customize_register', 'electrician_theme_customizer' );

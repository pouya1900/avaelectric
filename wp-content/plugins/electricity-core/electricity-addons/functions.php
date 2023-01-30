<?php
// Silence is golden.
add_action(
	'elementor/init',
	function () {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'electrician',
			array(
				'title' => __( 'Electrician', 'electrician-core' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
	}
);


function electrician_post_thumbnail_image( $size = 'full' ) {
	$electrician_featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'electrician_galleries_home' );
	?>
<picture>
  <source type="image/jpeg" srcset="<?php echo esc_url( $electrician_featured_image_url ); ?>">
  <img src="<?php echo esc_url( $electrician_featured_image_url ); ?>" alt="<?php esc_attr_e( 'Img', 'electrician' ); ?>">
</picture>
	<?php
}

if ( ! function_exists( 'electrician_custom_icon' ) ) {

	function electrician_custom_icon( $array ) {

		$plugin_url = plugins_url();
		global $electrician_option;
		$theme = $electrician_option['electrician_demo_select'];

		if ( $theme == '2' ) {
			return array(
				'custom-icon' => array(
					'name'          => 'custom-icon',
					'label'         => 'Electrician Icon',
					'url'           => '',
					'enqueue'       => array(
						$plugin_url . '/electricity-core/electricity-addons/icon-2/style-2.css',
					),
					'prefix'        => '',
					'displayPrefix' => '',
					'labelIcon'     => 'fab fa-font-awesome-alt',
					'ver'           => '5.9.0',
					'fetchJson'     => $plugin_url . '/electricity-core/electricity-addons/assets/js/regular-2.js',
					'native'        => 1,
				),
			);
		} else {
			return array(
				'custom-icon' => array(
					'name'          => 'custom-icon',
					'label'         => 'Electrician Icon',
					'url'           => '',
					'enqueue'       => array(
						$plugin_url . '/electricity-core/electricity-addons/icon/style.css',
					),
					'prefix'        => '',
					'displayPrefix' => '',
					'labelIcon'     => 'fab fa-font-awesome-alt',
					'ver'           => '5.9.0',
					'fetchJson'     => $plugin_url . '/electricity-core/electricity-addons/assets/js/regular.js',
					'native'        => 1,
				),
			);
		}

	}
}
add_filter( 'elementor/icons_manager/additional_tabs', 'electrician_custom_icon' );

function electrician_get_allowed_html_tags( $level = 'basic' ) {
	$allowed_html = array(
		'b'      => array(),
		'i'      => array(),
		'u'      => array(),
		'em'     => array(),
		'br'     => array(),
		'abbr'   => array(
			'title' => array(),
		),
		'span'   => array(
			'class' => array(),
		),
		'strong' => array(),
	);

	if ( $level === 'intermediate' ) {
		$allowed_html['a'] = array(
			'href'  => array(),
			'title' => array(),
			'class' => array(),
			'id'    => array(),
		);
	}

	return $allowed_html;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function electrician_kses_intermediate( $string = '' ) {
	return wp_kses( $string, electrician_get_allowed_html_tags( 'intermediate' ) );
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function electrician_kses_basic( $string = '' ) {
	return wp_kses( $string, electrician_get_allowed_html_tags( 'basic' ) );
}

function electrician_get_allowed_html_desc( $level = 'basic' ) {
	if ( ! in_array( $level, array( 'basic', 'intermediate' ) ) ) {
		$level = 'basic';
	}

	$tags_str = '<' . implode( '>,<', array_keys( electrician_get_allowed_html_tags( $level ) ) ) . '>';
	return sprintf( __( 'This input field has support for the following HTML tags: %1$s', 'happy-elementor-addons' ), '<code>' . esc_html( $tags_str ) . '</code>' );
}

function get_elementor_library() {
	$pageslist = get_posts(
		array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		)
	);
	$pagearray = array();
	if ( ! empty( $pageslist ) ) {
		foreach ( $pageslist as $page ) {
			$pagearray[ $page->ID ] = $page->post_title;
		}
	}
	return $pagearray;
}

if ( ! function_exists( 'electrician_comments_count' ) ) :

	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function electrician_comments_count() {

		if ( get_comments_number( get_the_ID() ) > 1 ) {
			$comments_count = sprintf(
			/* translators: %s: post date. */
				esc_html( '%s' ),
				get_comments_number( get_the_ID() ) . ' comments'
			);
		} else {
			$comments_count = sprintf(
			/* translators: %s: post date. */
				esc_html( '%s' ),
				get_comments_number( get_the_ID() ) . ' comment'
			);
		}
		echo ' ' . $comments_count;
	}

endif;

if ( ! function_exists( 'electrician_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function electrician_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = sprintf(
		/* translators: %s: post date. */
			esc_html( '%s' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo $posted_on; // WPCS: XSS OK.
	}

endif;

if ( ! function_exists( 'electrician_slider_controls' ) ) {

	function electrician_slider_controls( $obj, $slidesToShow = 3, $slidesToScroll = 1, $infinite = 'yes', $autoplay = 'yes', $autoplaySpeed = 6000, $arrows = 'no', $dots = 'yes' ) {

		$obj->start_controls_section(
			'slider_options',
			array(
				'label' => __( 'Slider Settings', 'electricity-core' ),
			)
		);

		$obj->add_control(
			'slidesToShow',
			array(
				'label'   => __( 'Slides To Show', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => $slidesToShow,
			)
		);

		$obj->add_control(
			'slidesToScroll',
			array(
				'label'   => __( 'Slides To Show', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => $slidesToScroll,
			)
		);

		$obj->add_control(
			'infinite',
			array(
				'label'   => __( 'Infinite', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => $infinite,
			)
		);

		$obj->add_control(
			'autoplay',
			array(
				'label'   => __( 'Autoplay', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => $autoplay,
			)
		);

		$obj->add_control(
			'autoplaySpeed',
			array(
				'label'   => __( 'Autoplay Speed', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => $autoplaySpeed,
			)
		);

		$obj->add_control(
			'arrows',
			array(
				'label'   => __( 'Array', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => $arrows,
			)
		);

		$obj->add_control(
			'dots',
			array(
				'label'   => __( 'Dots', 'electricity-core' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => $dots,
			)
		);

		$obj->end_controls_section();
	}
}

if ( ! function_exists( 'electrician_slider_controls_settings' ) ) {

	function electrician_slider_controls_settings( $settings ) {

		$slides_to_show   = $settings['slidesToShow'];
		$slides_to_scroll = $settings['slidesToScroll'];

		if ( $settings['infinite'] == 'yes' ) {
			$infinite = 'true';
		} else {
			$infinite = 'false';
		}

		if ( $settings['autoplay'] == 'yes' ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}

		$autoplay_speed = $settings['autoplaySpeed'];

		if ( $settings['arrows'] == 'yes' ) {
			$arrows = 'true';
		} else {
			$arrows = 'false';
		}

		if ( $settings['dots'] == 'yes' ) {
			$dots = 'true';
		} else {
			$dots = 'false';
		}

		return array(
			'mobile_first'     => 'false',
			'slides_to_show'   => $slides_to_show,
			'slides_to_scroll' => $slides_to_scroll,
			'infinite'         => $infinite,
			'autoplay'         => $autoplay,
			'autoplay_speed'   => $autoplay_speed,
			'arrows'           => $arrows,
			'dots'             => $dots,
		);
	}
}

if ( ! function_exists( 'electrician_slider_controls_settings_work_category' ) ) {

	function electrician_slider_controls_settings_work_category( $settings ) {

		$slides_to_show   = $settings['slidesToShow'];
		$slides_to_scroll = $settings['slidesToScroll'];

		if ( $settings['infinite'] == 'yes' ) {
			$infinite = 'true';
		} else {
			$infinite = 'false';
		}

		if ( $settings['autoplay'] == 'yes' ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}

		$autoplay_speed = $settings['autoplaySpeed'];

		if ( $settings['arrows'] == 'yes' ) {
			$arrows = 'true';
		} else {
			$arrows = 'false';
		}

		if ( $settings['dots'] == 'yes' ) {
			$dots = 'true';
		} else {
			$dots = 'false';
		}

		return array(
			'mobile_first'     => 'true',
			'slides_to_show'   => $slides_to_show,
			'slides_to_scroll' => $slides_to_scroll,
			'infinite'         => $autoplay,
			'autoplay'         => $autoplay,
			'autoplay_speed'   => $autoplay_speed,
			'arrows'           => $arrows,
			'dots'             => $dots,
		);
	}
}

if ( ! function_exists( 'get_contact_form_7_posts' ) ) :

	function get_contact_form_7_posts() {

		$args = array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1,
		);

		$catlist = array();

		if ( $categories = get_posts( $args ) ) {
			foreach ( $categories as $category ) {
				(int) $catlist[ $category->ID ] = $category->post_title;
			}
		} else {
			(int) $catlist['0'] = esc_html__( 'No contect From 7 form found', 'void' );
		}
		return $catlist;
	}

endif;

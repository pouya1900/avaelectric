<?php

class FooterGoogleMap extends WP_Widget {

	public $defaults;

	public function __construct() {
		$this->defaults = array(
			'title'             => '',
			'google_map_image ' => "off",
			'map_url'           => '',
		);
		parent::__construct(
			'footer_map', // Base ID
			esc_html__( 'Electrician Footer Map', 'electricity-core' ), // Name
			array(
				'description' => esc_html__( 'Footer Google Map.', 'electricity-core' ),
			)
		);
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<strong><?php esc_html_e( 'Title', 'electricity-core' ); ?>:</strong><br /><input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</label>
		</p> 
		<p>
	<input class="checkbox" type="checkbox" <?php checked( $instance['google_map_image'], 'on' ); ?> id="<?php echo $this->get_field_id( 'google_map_image' ); ?>" name="<?php echo $this->get_field_name( 'google_map_image' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'google_map_image' ); ?>"><?php esc_html_e( 'Show Google map as image', 'car-repair-services-core' ); ?></label>
	</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'map_url' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'map_url' ) ); ?>">
				<strong><?php esc_html_e( 'Map Image Url', 'electricity-core' ); ?>:</strong><br /><input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'map_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'map_url' ) ); ?>" value="<?php echo esc_attr( $instance['map_url'] ); ?>" />
			</label>
		</p> 

		<?php
	}

	function widget( $args, $instance ) {

		extract( $args );
		echo wp_kses_post( $before_widget );
		$google_map_image = isset( $instance['google_map_image'] ) ? 'true' : 'false';

		if ( ! empty( $instance['title'] ) ) {
			$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
			echo wp_kses_post( $before_title . $title . $after_title );
		};

		if ( isset( $google_map_image ) && ( $google_map_image == 'true' ) ) {

			echo '<div id="map-img"><img src="' . $instance['map_url'] . '"></div>';
		} else {

			if ( function_exists( 'electrician_options' ) ) {
				$electrician_option = electrician_options();
				if ( isset( $electrician_option['electrician-display-gmap'] ) && $electrician_option['electrician-display-gmap'] && ! empty( $electrician_option['electrician-gmap-api-key'] )
				) {

					wp_enqueue_script( 'contact-googlemap' );
					$theme = $electrician_option['electrician_demo_select'];
					if ( $theme == '2' ) {
						echo ' <div id="map"></div>';
					} else {
						echo ' <div id="footer-map"></div>';
					}
				}
			}
		}

		?>
	   
		<?php
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		$instance                     = $old_instance;
		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['google_map_image'] = $new_instance['google_map_image'];
		$instance['map_url']          = $new_instance['map_url'];

		// ...
		return $instance;
	}

}

function electrician_FooterGoogleMap() {
	register_widget( 'FooterGoogleMap' );
}

add_action( 'widgets_init', 'electrician_FooterGoogleMap' );

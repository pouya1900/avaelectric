<?php
class SmartContactBox extends WP_Widget {

	public $defaults;

	public function __construct() {
		$this->defaults = array(
			'title'         => esc_html__( 'Contacts', 'electricity-core' ),
			'phone'         => '1 (800) 765-43-21',
			'address'       => '8494 Signal Hill Road Manassas, VA, 20110',
			'hours'         => 'Mon-Fri: 7:00am-7:00pm
                    <br>Sat-Sun: 10:00am-5:00pm',
			'address_title' => 'Our address:',
			'phone_title'   => 'Call us:',
			'hours_title'   => 'Work Time:',
			'btn'			=> 'Make an Appointment',
		);

		$widget_ops = array(
			'classname'                   => 'tt-block-aside__shadow',
			'description'                 => esc_html__( 'Side Bar Contact Box.', 'electricity-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'smart_contact_box', esc_html__( 'Service Contact Box', 'electricity-core' ), $widget_ops );

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
			<label for="<?php echo esc_attr( $this->get_field_id( 'address_title' ) ); ?>">
				<strong><?php esc_html_e( 'Address Title', 'electricity-core' ); ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'address_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address_title' ) ); ?>" value="<?php echo esc_attr( $instance['address_title'] ); ?>" />
			</label>
		</p> 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address', 'electricity-core' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo wp_kses_post( $instance['address'] ); ?></textarea>
		</p>
		 <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_title' ) ); ?>">
				<strong><?php esc_html_e( 'Phone Title', 'electricity-core' ); ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'phone_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_title' ) ); ?>" value="<?php echo esc_attr( $instance['phone_title'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone', 'electricity-core' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"><?php echo wp_kses_post( $instance['phone'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hours_title' ) ); ?>">
				<strong><?php esc_html_e( 'Work Time Title', 'electricity-core' ); ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'hours_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours_title' ) ); ?>" value="<?php echo esc_attr( $instance['hours_title'] ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>"><?php esc_html_e( 'Work Time', 'electricity-core' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours' ) ); ?>"><?php echo wp_kses_post( $instance['hours'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn' ) ); ?>">
				<strong><?php esc_html_e( 'Button Title', 'electricity-core' ); ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'btn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn' ) ); ?>" value="<?php echo esc_attr( $instance['btn'] ); ?>" />
			</label>
		</p>
		<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		echo wp_kses_post( $before_widget );
		if ( ! empty( $instance['title'] ) ) {
			$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
			echo wp_kses_post( $before_title . $title . $after_title );
		};
		if ( isset( $instance['address_title'] ) ) {
			$address_title = $instance['address_title'];
		} else {
			 $address_title = $this->defaults['address_title'];
		}
		if ( isset( $instance['phone_title'] ) ) {
			$phone_title = $instance['phone_title'];
		} else {
			 $phone_title = $this->defaults['phone_title'];
		}
		if ( isset( $instance['hours_title'] ) ) {
			$hours_title = $instance['hours_title'];
		} else {
			 $hours_title = $this->defaults['hours_title'];
		}
		if ( isset( $instance['btn'] ) ) {
			$btn = $instance['btn'];
		} else {
			 $btn = $this->defaults['btn'];
		}
		$electrician_option = electrician_options();
		$theme              = $electrician_option['electrician_demo_select'];
		if ( $theme == '2' ) {
			?>
				<div class="tt-aside-content">
					<ul class="box-aside-info">
					<?php if ( ! empty( $instance['address'] ) ) : ?>
						<li>
							<i class="icon-map-marker"></i>
							<?php echo wp_kses_post( $instance['address'] ); ?>
						</li>
						<?php endif; ?>
						<?php if ( ! empty( $instance['hours'] ) ) : ?>
						<li>
							<i class="icon-clock-circular-outline-1"></i>
							<?php echo wp_kses_post( $instance['hours'] ); ?>
						</li>
						<?php endif; ?>
						<?php if ( ! empty( $instance['phone'] ) ) : ?>
						<li>
							<a href="tel:<?php echo esc_attr( $instance['phone'] ); ?>">
								<i class="icon-telephone"></i>
								<?php echo wp_kses_post( $instance['phone'] ); ?>
							</a>
						</li>
						<?php endif; ?>
					</ul>
					<?php if(!empty($btn)){ ?>
					<a href="#" data-toggle="modal" data-target="#modalMakeAppointment" class="tt-btn btn__color01"><?php $electrician_options = electrician_options();
								if(!empty($electrician_options['electrician-site-wide-icon'])){ ?>
								<span class="icon-sitewide"><?php echo $electrician_options['electrician-site-wide-icon']; ?></span>
								<?php } else { ?>
								<span class="icon-lightning"></span>
								 <?php } ?><?php echo wp_kses_post( $btn ); ?></a>
						<?php } ?>
				</div>
			<?php
		} else {
			?>
		<div class="contact-box">
			<?php if ( ! empty( $instance['address'] ) ) : ?>
			<div class="contact-box-row">
				<i class="icon-map-marker"></i>
				<div class="contact-box-row-title"><?php echo wp_kses_post( $address_title ); ?> </div>
				<div>
					<div><?php echo wp_kses_post( $instance['address'] ); ?> </div>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( ! empty( $instance['phone'] ) ) : ?>
			<div class="contact-box-row">
				<i class="icon-telephone"></i>
				<div class="contact-box-row-title"><?php echo wp_kses_post( $phone_title ); ?></div>
				<div> 
					<div><?php echo wp_kses_post( $instance['phone'] ); ?></div> 
				</div>
			</div>
			<?php endif; ?>
			<?php if ( ! empty( $instance['hours'] ) ) : ?>
			<div class="contact-box-row">
				<i class="icon-clock"></i>
				<div class="contact-box-row-title"><?php echo wp_kses_post( $hours_title ); ?></div>
				<div>
					<div>
						<div><?php echo wp_kses_post( $instance['hours'] ); ?></div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
			<?php
		}
		echo wp_kses_post( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['phone']   = $new_instance['phone'];
		$instance['address'] = $new_instance['address'];
		$instance['hours']   = $new_instance['hours'];

		$instance['btn']   = $new_instance['btn'];

		$instance['address_title'] = $new_instance['address_title'];
		$instance['phone_title']   = $new_instance['phone_title'];
		$instance['hours_title']   = $new_instance['hours_title'];
		return $instance;
	}

}
function electrician_contact_address_widget() {
	register_widget( 'SmartContactBox' );
}
add_action( 'widgets_init', 'electrician_contact_address_widget' );

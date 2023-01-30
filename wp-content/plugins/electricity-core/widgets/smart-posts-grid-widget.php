<?php
if ( version_compare( THEME_VERSION_CORE, '2.3', '>' ) ) {
	class SmartPostsGrid extends WP_Widget {




		public $defaults;
		public function __construct() {
			$this->defaults = array(
				'title'   => esc_html__( 'Popular Posts', 'electricity-core' ),
				'limit'   => '2',
				'orderby' => 'date',
				'order'   => 'DESC',
			);
			parent::__construct(
				'smart_posts_grid', // Base ID
				esc_html__( 'Electrician Posts Grid', 'electricity-core' ), // Name
				array(
					'description' => esc_html__( 'This widget will display posts grid on sidebars.', 'electricity-core' ),
				)
			);
		}

		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, $this->defaults );
			extract( $instance );
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title', 'electricity-core' ); ?>:</strong><br /><input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</label>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By:', 'electricity-core' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<option value="ID" <?php selected( $orderby, 'ID' ); ?>><?php esc_html_e( 'ID', 'electricity-core' ); ?></option>
				<option value="date" <?php selected( $orderby, 'date' ); ?>><?php esc_html_e( 'Date', 'electricity-core' ); ?></option>
				<option value="comment_count" <?php selected( $orderby, 'comment_count' ); ?>><?php esc_html_e( 'Comments', 'electricity-core' ); ?></option>
				<option value="rand" <?php selected( $orderby, 'rand' ); ?>><?php esc_html_e( 'Random', 'electricity-core' ); ?></option>
			</select>
			</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order:', 'electricity-core' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'electricity-core' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'electricity-core' ); ?></option>
			</select>
		</p>
		<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>">
					<strong><?php esc_html_e( 'Posts Limit', 'electricity-core' ); ?>:</strong><br /><input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
				</label>
			</p>


			<?php
		}

		function widget( $args, $instance ) {
			global $post;

			extract( $args );

			echo wp_kses_post( $before_widget );

			if ( ! empty( $instance['title'] ) ) {
				$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
				echo wp_kses_post( $before_title . $title . $after_title );
			};
			$query_args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'orderby'        => $instance['orderby'],
				'order'          => $instance['order'],
				'posts_per_page' => (int) $instance['limit'],
			);

			$results = get_posts( $query_args );
			if ( ! empty( $results ) && ! is_wp_error( $results ) ) :

				$electrician_option = electrician_options();
				$theme              = $electrician_option['electrician_demo_select'];
				if ( $theme == '2' ) {
					?>
			<div class="tt-recent-list slick-type01 slick-dotted" data-slick='{
									"dots": true,
									"arrows": false,
									"infinite": true,
									"speed": 300,
									"slidesToShow": 1,
									"slidesToScroll": 1,
									"adaptiveHeight": true
								}'>
					<?php
					foreach ( $results as $post ) :
						setup_postdata( $post );
						?>
			
			<div class="tt-item">
				<div class="tt-recent-obj">
					<div class="recent-obj__img">
						<?php the_post_thumbnail( 'electrician-sidebar-post' ); ?>
					</div>
					<div class="recent-obj__wrapper">
						<div class="recent-obj__data">
							<div class="tt-col">
								<div class="data__time"><?php echo get_the_date( 'd M, Y' ); ?></div>
							</div>
						</div>
						<h3 class="recent-obj__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p>
						<?php
						$content = substr( get_the_excerpt(), 0, 70 );
						echo $content;
						?>
						</p>
						<div class="recent-obj__row-btn">
							<a href="<?php the_permalink(); ?>" class="tt-link"><?php esc_html_e( 'Read more', 'electricity-core' ); ?><span class="icon-arrowhead-pointing-to-the-right-1"></span></a>
						</div>
					</div>
				</div>
			</div>
						<?php
					endforeach;
					?>
			</div>
					<?php
				} else {

					foreach ( $results as $post ) :
						setup_postdata( $post );
						?>
				
				<div class="blog-post post-preview">
					<div class="wrapper">
						<div class="post-image">
						<?php get_template_part( 'content', get_post_format() ); ?>
						</div>
						<div class="post-content">
							<div class="post-date"><span class="day"><?php echo get_the_date( 'd' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span></div>
							<div class="post-author"><?php printf( esc_html__( 'by %s', 'electricity-core' ), get_the_author() ); ?></div>
							<div class="post-meta"><i class="icon icon-speech"></i><span><?php comments_number( '0', '1', '%' ); ?></span></div>
							<h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<div class="post-teaser">
						<?php
						$content = $post->post_content;
						$content = apply_filters( 'the_content', $content );
						echo wp_trim_words( $content, 15, '...' );
						?>
							</div>
						</div>
					</div>
				</div>
						<?php
					endforeach;

				}
			endif;
			wp_reset_postdata();
			echo wp_kses_post( $after_widget );
		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['orderby'] = strip_tags( $new_instance['orderby'] );
			$instance['order']   = strip_tags( $new_instance['order'] );
			$instance['limit']   = strip_tags( $new_instance['limit'] );

			return $instance;
		}

	}

	if ( ! function_exists( 'electrician_popular_post_widget' ) ) {
		function electrician_popular_post_widget() {
			register_widget( 'SmartPostsGrid' );
		}
		add_action( 'widgets_init', 'electrician_popular_post_widget' );

	}
}

<?php
	vc_map( array(
		'name' => esc_html__( 'YouTube Video', 'textdomain' ),
		'description' => esc_html__( 'YouTube Embed ', '' ),
        'base' => 'electricial_youtbube',
        "icon" => ELECTRICITY_THEME_URI . '/images/electricity.png',
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Electrician', 'textdomain'),
		'params' => array(
			array(
				'type' => 'textfield',
				'class' => '',
				'admin_label' => True,
				'heading' => esc_html__( 'Video ID', 'textdomain' ),
                'param_name' => 'video_id',
                'description' => esc_html__( '  URL of the video is: https://www.youtube.com/watch?v=rvJxZ18TRvg. Therefore, the ID of the video is rvJxZ18TRvg.', 'textdomain' )
			),
		)
	) );

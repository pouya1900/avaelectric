<?php

class electricial_youtbube {

    public function __construct() {
        add_shortcode( 'electricial_youtbube',  array($this,'electricial_youtbube_shortcode') );
    }

    // Create Shortcode electricial_youtbube
    // Use the shortcode: [electricial_youtbube video_id="" video_image=""]
    function electricial_youtbube_shortcode($atts) {
        // Attributes
        $atts = shortcode_atts(
            array(
                'video_id' => '',
                'video_image' => '',
            ),
            $atts,
            'electricial_youtbube'
        );
        // Attributes in var
        $video_id = $atts['video_id'];
        $video_image = $atts['video_image'];


        // Output Code
        $output = '<div class="youtube-player" data-id="'. $video_id.'" data-poster="'.$video_image.'"></div>';

        return $output;
    }
}

new electricial_youtbube();
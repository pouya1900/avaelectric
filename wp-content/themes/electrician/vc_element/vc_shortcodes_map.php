<?php
function electricity_custom_shortcodes(){

        vc_map(array(
            "name" => esc_html("Electrician Team Carousel" , 'electrician'),
            "base" => "electricity_team_carousel",
            "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
            "category" => esc_html('Electrician', 'electrician'),
            "as_parent" => array('only' => 'electricity_team'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "is_container" => true,
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Slider", 'electrician'),
                    "param_name" => "slider_swich",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "admin_label" => true,
                    "heading" => esc_html("Column no", 'electrician'),
                    "param_name" => "team_col",
                    "std" => "3",
                    "value" => array(      
                        "2 Column" => "2",
                        "3 Column" => "3",
                        "4 Column" => "4",
                    ),
                    "description"=> esc_html('No of column of the team.', 'electrician'),
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html( "Mask Image", "electrician" ),
                    "param_name" =>  "mask_image",
                    "value" => "",
                ),
                //Slider options
                
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Mobile First", 'electrician'),
                    "param_name" => "mobile_first",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html("How many slides to show", 'electrician'),
                    "param_name" => "slides_to_show",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'slides_to_show' => '3',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html("How many slides to scroll", 'electrician'),
                    "param_name" => "slides_to_scroll",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'slides_to_scroll' => '1',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Infinite Scroll", 'electrician'),
                    "param_name" => "infinite",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Autoplay", 'electrician'),
                    "param_name" => "autoplay",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html("Autoplay Speed", 'electrician'),
                    "param_name" => "autoplay_speed",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'autoplay_speed' => '6000',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Arrows", 'electrician'),
                    "param_name" => "arrows",
                    'value' => array(     
                        'No' => 'false',
                        'Yes' => 'true'
                    ),
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Dots", 'electrician'),
                    "param_name" => "dots",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                )

            ),
            "js_view" => 'VcColumnView',
        ));

        vc_map(array(
            "name" => esc_html("Electrician Team" , 'electrician'),
            "base" => "electricity_team",
            "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
            "category" => esc_html('Electrician', 'electrician'),
            "as_child" => array('only' => 'electricity_team_carousel'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "type" => "textarea_html",
                    "admin_label" => true,
                    "heading" => esc_html( "Name of Team Member", "electrician" ),
                    "param_name" => "name",
                    "value" => "",

                ),

                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "heading" => esc_html( "Designation of Team Member", "electrician" ),
                    "param_name" =>  "designation",
                    "value" => "",

                ),

                array(
                    "type" => "attach_image",
                    "heading" => esc_html( "Picture of Team Member", "electrician" ),
                    "param_name" =>  "image",
                    "value" => "",

                ),
                array(
                "type" => "vc_link",
                "holder" => "div",
                "heading" => "Action Button",
                "param_name" => "call_action",
             ),
            )
        ));

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Electricity_Team_Carousel extends WPBakeryShortCodesContainer {
            }

        }
        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Electricity_Team extends WPBakeryShortCode {
            }
        }

        vc_map(array(
            "name" => esc_html("Electrician Brands Slider" , 'electrician'),
            "base" => "electricity_brand_carousel",
            "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
            "class" => "",
            "category" => esc_html('Electrician', 'electrician'),
            "as_parent" => array('only' => 'electricity_brand_carousel_items'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "js_view" => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Mobile First", 'electrician'),
                    "param_name" => "mobile_first",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html("How many slides to show", 'electrician'),
                    "param_name" => "slides_to_show",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'slides_to_show' => '7',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html("How many slides to scroll", 'electrician'),
                    "param_name" => "slides_to_scroll",
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'slides_to_scroll' => '1',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html("Enable Infinite Scroll", 'electrician'),
                    "param_name" => "infinite",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Autoplay", 'electrician'),
                    "param_name" => "autoplay",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Autoplay Speed", 'electrician'),
                    "param_name" => "autoplay_speed",
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                    'value' => array(
                        'autoplay_speed' => '2000',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Arrows", 'electrician'),
                    "param_name" => "arrows",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Dots", 'electrician'),
                    "param_name" => "dots",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                )

            )
        ));

        vc_map(array(
            "name" => esc_html("Electrician Brand Item", 'electrician'),
        	"description" => esc_html("Set Brand Here", 'electrician'),
            "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
            "base" => "electricity_brand_carousel_items",
            "as_child" => array('only' => 'electricity_brand_carousel'),
            "class" => "",
            "weight" => 1000,
            "controls" => "full",
            "category" => esc_html('Electrician', 'electrician'),
            "params" => array(
                array(
                    "type" => "attach_image",
                    "heading" => esc_html('Image', 'electrician'),
                    "param_name" => "image",
                    "value" => "",
                    'description' => esc_html('Upload Brand Image.', 'electrician'),
                ),


                array(
                    "type" => "textfield",
                    "heading" => esc_html("URL of Brand", 'electrician'),
                    "param_name" => "url",
                    "std" => esc_url("#"),
                    "description" => esc_html('Set Link.', 'electrician'),
                    "admin_label" => true,
                ),
            )
        ));

    	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    	    class WPBakeryShortCode_Electricity_Brand_Carousel extends WPBakeryShortCodesContainer {
    	    }
    	}
    	if ( class_exists( 'WPBakeryShortCode' ) ) {
    	    class WPBakeryShortCode_Electricity_Brand_Carousel_Items extends WPBakeryShortCode {
    	    }
    	}
        
        
    vc_map(array(
        "name" => esc_html("Electrician Nivo Slider" , 'electrician'),
        "base" => "electricity_nivo_slider",
        "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
        "category" => esc_html('Electrician', 'electrician'),
        "as_parent" => array('only' => 'electricity_nivo_slider_items'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        "params" => array(
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html("Heading" , 'electrician'),
                "param_name" => "title_1",
                "std" => "",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Slide transition speed", 'electrician'),
                "param_name" => "anim_speed",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("How long each slide will show", 'electrician'),
                "param_name" => "pause_time",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Autoplay", 'electrician'),
                "param_name" => "autoplay",
                'value' => array(
                    'No' => 'true',
                    'Yes' => 'false',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Stop animation while hovering", 'electrician'),
                "param_name" => "pause_on_hover",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Specify Animation Effect", 'electrician'),
                "param_name" => "effect",
                'value' => array(
                    'sliceDown' => 'sliceDown',
                    'sliceDownLeft' => 'sliceDownLeft',
                    'sliceUp' => 'sliceUp',
                    'sliceUpLeft' => 'sliceUpLeft',
                    'sliceUpDown' => 'sliceUpDown',
                    'sliceUpDownLeft' => 'sliceUpDownLeft',
                    'fold' => 'fold',
                    'fade' => 'fade',
                    'random' => 'random',
                    'slideInRight' => 'slideInRight',
                    'slideInLeft' => 'slideInLeft',
                    'boxRandom' => 'boxRandom',
                    'boxRain' => 'boxRain',
                    'boxRainReverse' => 'boxRainReverse',
                    'boxRainGrow' => 'boxRainGrow',
                    'boxRainGrowReverse' => 'boxRainGrowReverse',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable DirectionNav", 'electrician'),
                "param_name" => "direction_nav",
                'value' => array(             
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Prev directionNav text", 'electrician'),
                "param_name" => "prev_text",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Next directionNav text", 'electrician'),
                "param_name" => "next_text",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("1,2,3... navigation", 'electrician'),
                "param_name" => "control_nav",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false'
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true
            )
        )
    ));

    vc_map(array(
        "name" => esc_html("Electrician Nivo Slider Setting" , 'electrician'),
        "base" => "electricity_nivo_slider_items",
        "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
        "category" => esc_html('Electrician', 'electrician'),
        "as_child" => array('only' => 'electricity_nivo_slider'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Slider Image", "electrician" ),
                "param_name" => "image",
            ),
            array(
                "type" => "textarea_html",
                "admin_label" => true,
                "heading" => esc_html("Slider Title" , 'electrician'),
                "param_name" => "heading",
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html("Sub Heading" , 'electrician'),
                "param_name" => "sub_heading",
            ),
            
            array(
                "type" => "textfield",
                "heading" => esc_html("Button URL", 'electrician'),
                "param_name" => "button_url",
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html("Button Text", 'electrician'),
                "param_name" => "button_text",
                "admin_label" => true,
            ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Electricity_Nivo_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Electricity_Nivo_Slider_Items extends WPBakeryShortCode {
        }
    }
    
    vc_map( array(
        "name" => esc_html( "Electrician Work Category", "electrician" ),
        "base" => "electricity_work_category",
        "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
        "class" => " ",
        "category" => esc_html('Electrician', 'electrician'),
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image1",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 1', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title1",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 1', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action URL", "electrician" ),
                "param_name" => "call_to_action1",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 1', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text1",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 1', 'electrician')
            ),
            // slide 2
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image2",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 2', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title2",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 2', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action Url", "electrician" ),
                "param_name" => "call_to_action2",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 2', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text2",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 2', 'electrician')
            ),
            // slide 3
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image3",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 3', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title3",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 3', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action Url", "electrician" ),
                "param_name" => "call_to_action3",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 3', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text3",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 3', 'electrician')
            ),
			// slide 4
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image4",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 4', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title4",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 4', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action Url", "electrician" ),
                "param_name" => "call_to_action4",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 4', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text4",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 4', 'electrician')
            ),
			// slide 5
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image5",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 5', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title5",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 5', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action Url", "electrician" ),
                "param_name" => "call_to_action5",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 5', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text5",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 5', 'electrician')
            ),
			// slide 6
            array(
                "type" => "attach_image",
                "heading" => esc_html( "Category Image", "electrician" ),
                "param_name" => "image6",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 6', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Title", "electrician" ),
                "param_name" => "title6",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 6', 'electrician')
            ),

            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Action Url", "electrician" ),
                "param_name" => "call_to_action6",
                "value" => "",
                "description" => esc_html( "Enter foo.", "electrician" ),
                'group' => esc_html('Slide 6', 'electrician')
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Button Text", "electrician" ),
                "param_name" => "button_text6",
                "value" => "",
                "description" => esc_html( "Button Text.", "electrician" ),
                'group' => esc_html('Slide 6', 'electrician')
            ),
            //Slider options
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Mobile First", 'electrician'),
                "param_name" => "mobile_first",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("How many slides to show", 'electrician'),
                "param_name" => "slides_to_show",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("How many slides to scroll", 'electrician'),
                "param_name" => "slides_to_scroll",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Infinite Scroll", 'electrician'),
                "param_name" => "infinite",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Autoplay", 'electrician'),
                "param_name" => "autoplay",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Autoplay Speed", 'electrician'),
                "param_name" => "autoplay_speed",
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Arrows", 'electrician'),
                "param_name" => "arrows",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false'
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Enable Dots", 'electrician'),
                "param_name" => "dots",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false'
                ),
                'group' => esc_html__( 'Slider Settings', 'electrician'),
                "admin_label" => true
            )
        )
    ));
 
 
   /*
     * Gallary
     */
    vc_map(array(
        "name" => esc_html("Electrician Gallary", 'electrician'),
        "base" => "gallaries",
        "class" => "",
        "icon" => ELECTRICITY_THEME_URI . '/images/electricity.png',
        "category" => esc_html('Electrician', 'electrician'),
        "params" => array(
 
            array(
                "type" => "textfield",
                "heading" => esc_html("Number of Gallary", 'electrician'),
                "param_name" => "showposts",
                "value" => "10",
                "description" => esc_html('Set how many gallary image will display.', 'electrician'),
                "admin_label"=> true,
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html('Order By', 'electrician'),
                'param_name' => 'orderby',
                'value' => array(
                    'Date' => 'date',
                    'ID' => 'ID',
                    'Title' => 'title',
                    'Name' => 'name',
                    'Modified' => 'modified',
                    'Rand' => 'rand',
                ),
                'description' => esc_html('Select order type.', 'electrician'),
                "admin_label"=> true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html('Sort Order', 'electrician'),
                'param_name' => 'order',
                'value' => array('Descending' => 'DESC', 'Ascending' => 'ASC'),
                'description' => esc_html('Select sorting order.', 'electrician'),
                "admin_label"=> true,
            ),
         
        )
    ));


//icon carousel list

    vc_map(array(
        "name" => esc_html("Electrician Icon carousel", 'electrician'),
        "base" => "electricity_icon_carousel",
        "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
        "category" => esc_html('Electrician', 'electrician'),
        "as_parent" => array('only' => 'electricity_icon_carousel_items'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        "params" => array(

            array(
                "type" => "dropdown",
                "admin_label" => true,
                "heading" => esc_html("Column no", 'electrician'),
                "param_name" => "column_no",
                "value" => array(
                    "2 Column" => "2",
                    "3 Column" => "3",
                    "4 Column" => "4",
                    "6 Column" => "6",
                    "12 Column" => "12",
   
                ),
                "std" => "4",
                 "description"=> esc_html('No of column of the icon.', 'electrician'),
            ),




            array(
                "type" => "dropdown",
                "heading" => esc_html__("Are You want to Disable Mobile Slide", 'electrician'),
                "param_name" => "mobileslide",
                'value' => array(
                    'Yes' => 'true',
                    'No' => 'false',
                ),
                "admin_label" => true,
            ),





            array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Mobile First", 'electrician'),
                    "param_name" => "mobile_first",
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("How many slides to show", 'electrician'),
                    "param_name" => "slides_to_show",
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("How many slides to scroll", 'electrician'),
                    "param_name" => "slides_to_scroll",
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Infinite Scroll", 'electrician'),
                    "param_name" => "infinite",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Autoplay", 'electrician'),
                    "param_name" => "autoplay",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false',
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Autoplay Speed", 'electrician'),
                    "param_name" => "autoplay_speed",
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true,
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Arrows", 'electrician'),
                    "param_name" => "arrows",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Enable Dots", 'electrician'),
                    "param_name" => "dots",
                    'value' => array(
                        'Yes' => 'true',
                        'No' => 'false'
                    ),
                    'group' => esc_html__( 'Slider Settings', 'electrician'),
                    "admin_label" => true
                )

             
        )
    ));

    vc_map(array(
        "name" => esc_html("Electrician Icon Carousel Item", 'electrician'),
        "base" => "electricity_icon_carousel_items",
        "icon" =>  ELECTRICITY_THEME_URI . '/images/electricity.png',
        "category" => esc_html('Electrician', 'electrician'),
        "as_child" => array('only' => 'electricity_icon_carousel'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(
            array(
                     'type' => 'dropdown',
                     'heading' => esc_html('Select Icon / Image', 'electrician'),
                     'param_name' => 'option_icon',
                     'value' => array(
                        'Icon' => 'icon',
                        'Image' => 'image',
                        ),
                     'std'         => 'icon', 

                ),
            array(
                  "type" => "attach_image",
                  "class" => "",
                  "heading" => esc_html( "Thumbnail", "electrician" ),
                  "param_name" =>  "thumbnail",
                        "holder" => "div",
                        "admin_label" => false,
                    'dependency' => array(
                    'element' => 'option_icon',
                    'value' => 'image',
                      ),
               ),
            array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'electrician' ),
            'value' => array(
                esc_html__( 'Electrician', 'electrician' ) => 'electrician',
                esc_html__( 'Font Awesome', 'electrician' ) => 'fontawesome',
                esc_html__( 'Open Iconic', 'electrician' ) => 'openiconic',
                esc_html__( 'Typicons', 'electrician' ) => 'typicons',
                esc_html__( 'Entypo', 'electrician' ) => 'entypo',
                esc_html__( 'Linecons', 'electrician' ) => 'linecons',
                esc_html__( 'Mono Social', 'electrician' ) => 'monosocial',
            ),
            'dependency' => array(
                                'element' => 'option_icon',
                                'value' => 'icon',
                            ),
            'param_name' => 'icon_type',
            'description' => esc_html__( 'Select icon library.', 'electrician' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_openiconic',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'openiconic',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_typicons',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'typicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_entypo',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_linecons',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon_monosocial',
            'value' => 'vc-mono vc-mono-fivehundredpx',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'monosocial',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'monosocial',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),
         array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'electrician' ),
            'param_name' => 'icon',
            'value' => 'icon-lightning',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'electrician',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'electrician',
            ),
            'description' => esc_html__( 'Select icon from library.', 'electrician' ),
        ),


            
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" =>  esc_html( "Heading", 'electrician' ),
                "param_name" => "heading",
                "description"=> esc_html('Heading of the icon.', 'electrician'),
            ),
            array(
                "type" => "textfield",
                "admin_label" => true,
                "heading" => esc_html( "Description", 'electrician' ),
                "param_name" => "description",
                "description"=> esc_html('Description of your icon.', 'electrician'),
            ),
           array(
                "type" => "vc_link",
                "holder" => "div",
                "heading" => "Action Button",
                "param_name" => "call_action",
             ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Electricity_Icon_Carousel extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Electricity_Icon_Carousel_Items extends WPBakeryShortCode {
        }
    }

    //
} //end of class


add_action('vc_before_init', 'electricity_custom_shortcodes');
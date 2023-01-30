<?php

namespace ElectricianAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

class Ele_ContactForm7 extends \Elementor\Widget_Base {   
    public function get_name() {
        return 'electrician_contact_form7';
    }

    public function get_title() {
        return esc_html__('Contact From 7', 'electricity-core');
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return ['electrician'];
    }
    protected function register_controls() {

        $this->start_controls_section(
                'banner_slider_content', [
            'label' => esc_html__('electrician Contact Form 7', 'electricity-core'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );
        $this->add_control(
                'cf7', [
            'label' => esc_html__('Select Contact Form', 'electricity-core'),
            'description' => esc_html__('Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7', 'electriciancore'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => false,
            'label_block' => 1,
            'options' => get_contact_form_7_posts(),
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {    //to show on the fontend 

        $settings = $this->get_settings();
        if (!empty($settings['cf7'])) {
            echo'<div class="elementor-shortcode electriciancore-cf7">';
            echo do_shortcode('[contact-form-7 id="' . $settings['cf7'] . '"]');
            echo '</div>';
        }
    }

}

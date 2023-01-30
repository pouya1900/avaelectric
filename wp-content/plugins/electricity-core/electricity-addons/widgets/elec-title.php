<?php

namespace ElectricianAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;

class Elec_Title extends Widget_Base {

    public function get_name() {
        return 'ele_title';
    }

    public function get_title() {
        return __('Elec Text Block', 'electricity-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['electrician'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section', [
                'label' => __('Content', 'electricity-core'),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Text', 'leganic-core'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Home Electrical Repair', 'electricity-core'),
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => esc_html__('HTML Tag', 'electricity-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ),
                'default' => 'h4',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading = $settings["heading"];
        $this->add_inline_editing_attributes('heading', 'basic');
        echo sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string('heading'), $heading);
        ?>
<?php
}

}
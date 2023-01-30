<?php

namespace ElectricianAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Elec_Latest_News extends Widget_Base {

    public function get_name() {
        return 'ele_latest_news';
    }

    public function get_title() {
        return __('Latest News', 'electricity-core');
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
            'title_1', [
                'label' => __('Title', 'electricity-core'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('What’s <b>New</b>', 'electricity-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image', [
                'label' => __('Image', 'electricity-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'pub_date', [
                'label' => __('Date', 'electricity-core'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __('Title 2', 'electricity-core'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => __('Content', 'electricity-core'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'button_text', [
                'label' => __('Button Text', 'electricity-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read more', 'electricity-core'),
            ]
        );

        $repeater->add_control(
            'action_link', [
                'label' => __('Action Button', 'electricity-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
            ]
        );

        $this->add_control(
            'slider_list', [
                'label' => __('News List', 'electricity-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'pub_date' => __('May 1, 2017', 'electricity-core'),
                        'title' => __('Solar Cells With Nanostripes', 'electricity-core'),
                        'content' => __('May 2, 2017 — Solar cells based on perovskites reach high efficiencies: they convert more than 20 percent of the incident light directly into usable power.', 'electricity-core'),
                    ],
                    [
                        'pub_date' => __('May 1, 2017', 'electricity-core'),
                        'title' => __('A Glow Stick That Detects Cancer?', 'electricity-core'),
                        'content' => __('A new mechanism produces a water- resistant chemiluminescent probe that is 3,000-times-brighter than those currently...', 'electricity-core'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        electrician_slider_controls($this, 2);
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $changed_atts = electrician_slider_controls_settings($settings);
        //wp_localize_script('electrician-custom', 'ajax_latestNews', $changed_atts);
        ?>
<div class="block bottom-sm">
  <div class="container">
    <h2 class="text-center"><?php echo wp_kses_post($settings['title_1']); ?></h2>
    <div class="divider divider-md"></div>
    <div class="row news-preview-carousel" data-slick='<?php echo wp_json_encode($changed_atts); ?>'>
      <?php
if (!empty($settings['slider_list'])) {
            foreach ($settings['slider_list'] as $item) {
                $url = '#';
                $target = '';
                if (!empty($item['action_link'])) {
                    $link = $item['action_link'];
                    $url = $link['url'];
                    $target = $link['is_external'] ? 'target="_blank"' : '';
                }
                $image_alt = get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true);
                ?>
      <div class="col-md-6">
        <div class="news-preview">
          <div class="news-preview-image">
            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($image_alt); ?>">
          </div>
          <div class="news-preview-text">
            <div class="news-preview-date"><?php echo wp_kses_post($item['pub_date']); ?></div>
            <h4 class="news-preview-title"><?php echo wp_kses_post($item['title']); ?></h4>
          </div>
          <div class="news-preview-teaser">
            <div>
              <?php echo wp_kses_post($item['content']); ?>
            </div>
            <a href="<?php echo esc_url($url); ?>" <?php echo $target; ?> class="news-preview-link">
              <?php echo esc_html($item['button_text']); ?>
            </a>
          </div>
        </div>
      </div>
      <?php
}
        }
        ?>
    </div>
  </div>
</div>
<?php
}

}
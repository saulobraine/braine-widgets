<?php

namespace Braine\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Scroll_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style('braine-scroll', plugins_url('/assets/css/scroll.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-scroll'];
    }

    public function get_name() {
        return 'braine-scroll';
    }

    public function get_title() {
        return 'Scroll • Braine';
    }

    public function get_icon() {
        return 'eicon-scroll';
    }

    public function get_categories() {
        return ['braine'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Configuração', 'scroll-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Set text of the scroll
        $this->add_control(
            'scroll_text',
            [
                'label' => __('Texto', 'scroll-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Texto do Scroll', 'scroll-braine'),
                'default' => 'Scroll'
            ]
        );

        $this->end_controls_section();

        // Styles

        // style for the scroll text
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Estilo', 'scroll-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Cor do texto', 'scroll-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .scroll-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<div class="scroll-braine-container">
  <div class="scroll-braine-wrapper">
    <div class="scroll-braine scroll-text">
      <?= $settings['scroll_text'] ?>
    </div>
  </div>
</div>
<?php
    }
}

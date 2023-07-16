<?php

namespace Braine\Widgets;

if(!defined('ABSPATH')) {
    exit;
}

class Slider_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('braine-slider', plugins_url('/assets/js/slider.js', __FILE__), ['elementor-frontend', 'jquery', 'swiper'], '1.0.0', true);

        wp_register_style('braine-slider', plugins_url('/assets/css/slider.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-slider'];
    }

    public function get_script_depends() {
        return ['braine-slider'];
    }

    public function get_name() {
        return 'braine-slider';
    }

    public function get_title() {
        return 'Slider • Braine';
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['braine'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slides', 'slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title',
            [
                'label' => __('Título', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Nossa energia é limpa, nosso futuro é hoje.', 'slider-braine'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_subtitle',
            [
                'label' => __('Subtítulo', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Bem-vindos à nova Atiaia Renováveis.', 'slider-braine'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'divisor_link_subtitle_image',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_responsive_control(
            'list_image',
            [
                'label' => __('Imagem do slide', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-background' => 'background-image: url("{{URL}}")'
                ],
            ]
        );

        $repeater->add_control(
            'list_image_background_size',
            [
                'label' => __('Tamanho do background', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => __('Cover', 'slider-braine'),
                    'contain' => __('Contain', 'slider-braine'),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slider-background' => 'background-size: {{VALUE}}'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'list_button_text',
            [
                'label' => __('Texto do botão', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Saiba +', 'slider-braine'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_button_link',
            [
                'label' => __('Link', 'elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'slider-braine'),
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => __('Lista de Slides', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Nossa energia é limpa, nosso futuro é hoje.', 'slider-braine'),
                        'list_subtitle' => __('Bem-vindos à nova Atiaia Renováveis.', 'slider-braine')
                    ],
                ],
                'title_field' => '{{{ list_title }}} <b>{{{ list_subtitle }}}</b>',
            ]
        );

        $this->end_controls_section();

        // Styles

        $this->start_controls_section(
            'slider_item_style_section',
            [
                'label' => __('Item do Slide', 'slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_padding_item',
            [
                'label' => __('Espaçamento do slider', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_padding_item_content',
            [
                'label' => __('Espaçamento interno', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-background' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_item_content_align',
            [
                'label' => __('Posição do conteúdo', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Início', 'slider-braine'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'center' => [
                        'title' => __('Centro', 'slider-braine'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Fundo', 'slider-braine'),
                        'icon' => 'fa fa-align-left',
                    ],
                ],
                'default' => 'flex-end',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-background' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_item_content_gap',
            [
                'label' => __('Lacuna itens', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-braine-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_item_content_width',
            [
                'label' => __('Tamanho do conteúdo', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-braine-content' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'typography_style_section',
            [
                'label' => __('Tipografia', 'slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_title_color',
            [
                'label' => __('Cor do título', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'slider_subtitle_color',
            [
                'label' => __('Cor do sub-título', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divisor_link_color_typography',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slider_title_typography',
                'label' => __('Título', 'slider-braine'),
                'selector' => '{{WRAPPER}} .slider-braine .slider-braine-item .title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slider_subtitle_typography',
                'label' => __('Subtítulo', 'slider-braine'),
                'selector' => '{{WRAPPER}} .slider-braine .slider-braine-item .subtitle',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slider_button_typography',
                'label' => __('Botão', 'slider-braine'),
                'selector' => '{{WRAPPER}} .slider-braine .slider-braine-item .slider-braine-button'
            ]
        );

        $this->add_control(
            'divisor_link_typography_image',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('Imagem', 'slider-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_image_height',
            [
                'label' => __('Altura da Imagem', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-background' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_image_border_radius',
            [
                'label' => __('Border Radius', 'slider-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-braine .slider-braine-item .slider-background' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_element = $this->get_id();

        if ($settings['slider_list']):
            echo "<div class='slider-braine swiper-container'>";
            echo "<div class='swiper-wrapper'>";
            foreach ($settings['slider_list'] as $item):
                $this->add_link_attributes('list_button_link_attr', $item['list_button_link']);
                ?>
<div class="slider-braine-item swiper-slide elementor-repeater-item-<?= $item['_id'] ?>">
  <div class="slider-background">
    <div class="slider-braine-content">
      <h3 class="title"><?= $item['list_title'] ?></h3>
      <p class="subtitle"><?= $item['list_subtitle'] ?></p>
      <?php if($item['list_button_link']['url']): ?>
      <a class="slider-braine-button" <?= $this->get_render_attribute_string('list_button_link_attr'); ?>>
        <?= $item['list_button_text'] ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
                $this->remove_render_attribute('list_button_link_attr');
            endforeach;
            echo "</div>";
            echo "</div>";
        endif;
    }
}

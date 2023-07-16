<?php

namespace Braine\Widgets;

if(!defined('ABSPATH')) {
    exit;
}

class MiniCaroussel_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('braine-mini-caroussel', plugins_url('/assets/js/mini-caroussel.js', __FILE__), ['elementor-frontend', 'jquery', 'swiper'], '1.0.0', true);

        wp_register_style('braine-mini-caroussel', plugins_url('/assets/css/mini-caroussel.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-mini-caroussel'];
    }

    public function get_script_depends() {
        return ['braine-mini-caroussel'];
    }

    public function get_name() {
        return 'braine-mini-caroussel';
    }

    public function get_title() {
        return 'MiniCaroussel • Braine';
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
                'label' => __('Slides', 'mini-caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_responsive_control(
            'list_image',
            [
                'label' => __('Imagem do slide', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mini-caroussel-background' => 'background-image: url("{{URL}}")'
                ],
            ]
        );

        $repeater->add_control(
            'list_title',
            [
                'label' => __('Título', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Somos agentes de transformação! Criar pontes entre as necessidades atuais e futuras de nossos clientes faz parte do nosso DNA.', 'mini-caroussel-braine'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'mini_caroussel_list',
            [
                'label' => __('Lista de Slides', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Somos agentes de transformação! Criar pontes entre as necessidades atuais e futuras de nossos clientes faz parte do nosso DNA.', 'mini-caroussel-braine'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Styles

        $this->start_controls_section(
            'mini_caroussel_item_style_section',
            [
                'label' => __('Item do Slide', 'mini-caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mini_caroussel_padding_item',
            [
                'label' => __('Espaçamento do mini-caroussel', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mini_caroussel_padding_item_content',
            [
                'label' => __('Espaçamento interno', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .mini-caroussel-background' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mini_caroussel_item_content_gap',
            [
                'label' => __('Lacuna itens', 'mini-caroussel-braine'),
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
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .mini-caroussel-braine-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'typography_style_section',
            [
                'label' => __('Tipografia', 'mini-caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mini_caroussel_title_color',
            [
                'label' => __('Cor do texto', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .title' => 'color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'mini_caroussel_border_color',
            [
                'label' => __('Cor da borda', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0095DA',
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-content' => 'border-color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mini_caroussel_title_typography',
                'label' => __('Texto', 'mini-caroussel-braine'),
                'selector' => '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .title',
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('Imagem', 'mini-caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mini_caroussel_image_height',
            [
                'label' => __('Altura da Imagem', 'mini-caroussel-braine'),
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
                    'unit' => 'px',
                    'size' => 325,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .mini-caroussel-background' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mini_caroussel_image_border_radius',
            [
                'label' => __('Arredondamento', 'mini-caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mini-caroussel-braine .mini-caroussel-braine-item .mini-caroussel-background' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_element = $this->get_id();

        if ($settings['mini_caroussel_list']):
            echo "<div class='mini-caroussel-braine swiper-container'>";
            echo "<div class='swiper-wrapper'>";
            foreach ($settings['mini_caroussel_list'] as $item):
                ?>
<div class="mini-caroussel-braine-item swiper-slide elementor-repeater-item-<?= $item['_id'] ?>">
  <div class="mini-caroussel-background"></div>
  <div class="mini-caroussel-braine-content">
    <div class="title"><?= $item['list_title'] ?></div>
  </div>
</div>
<?php
            endforeach;
            echo "</div>";
            echo "</div>";
        endif;
    }
}

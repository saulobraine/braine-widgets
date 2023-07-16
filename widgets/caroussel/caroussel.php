<?php

namespace Braine\Widgets;

if(!defined('ABSPATH')) {
    exit;
}

class Caroussel_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script('braine-caroussel', plugins_url('/assets/js/caroussel.js', __FILE__), ['elementor-frontend', 'jquery', 'swiper'], '1.0.0', true);

        wp_register_style('braine-caroussel', plugins_url('/assets/css/caroussel.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-caroussel'];
    }

    public function get_script_depends() {
        return ['braine-caroussel'];
    }

    public function get_name() {
        return 'braine-caroussel';
    }

    public function get_title() {
        return 'Caroussel • Braine';
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
                'label' => __('Slides', 'caroussel-braine'),
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .caroussel-background' => 'background-image: url("{{URL}}")'
                ],
            ]
        );

        $repeater->add_control(
            'list_title',
            [
                'label' => __('Título', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Além de fornecimento de energia…', 'caroussel-braine'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'list_subtitle',
            [
                'label' => __('Subtítulo', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Podemos proporcionar ao cliente uma opção de compra de participação na usina, permitindo que se torne autoprodutor e reduza ainda mais seu custo final de eletricidade.', 'caroussel-braine'),
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'list_button_text',
            [
                'label' => __('Texto do botão', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Quer saber mais? Clique aqui!', 'caroussel-braine'),
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
                'placeholder' => __('https://your-link.com', 'caroussel-braine'),
            ]
        );

        $this->add_control(
            'caroussel_list',
            [
                'label' => __('Lista de Slides', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Além de fornecimento de energia…', 'caroussel-braine'),
                        'list_subtitle' => __('Podemos proporcionar ao cliente uma opção de compra de participação na usina, permitindo que se torne autoprodutor e reduza ainda mais seu custo final de eletricidade.', 'caroussel-braine'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Control Section for Icons
        $this->start_controls_section(
            'caroussel_icons',
            [
                'label' => __('Ícones', 'caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'caroussel_icon_left',
            [
                'label' => __('Ícone Anterior', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-arrow-left',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'caroussel_icon_right',
            [
                'label' => __('Ícone Próximo', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'caroussel_item_style_section',
            [
                'label' => __('Item do Slide', 'caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'caroussel_padding_item',
            [
                'label' => __('Espaçamento do caroussel', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'caroussel_padding_item_content',
            [
                'label' => __('Espaçamento interno', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-background' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'caroussel_item_content_gap',
            [
                'label' => __('Lacuna itens', 'caroussel-braine'),
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
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-braine-content' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'typography_style_section',
            [
                'label' => __('Tipografia', 'caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'caroussel_title_color',
            [
                'label' => __('Texto', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caroussel_subtitle_color',
            [
                'label' => __('Sub Título', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'caroussel_button_color',
            [
                'label' => __('Texto do botão', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-braine-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'caroussel_button_border_color',
            [
                'label' => __('Borda do botão', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-braine-button' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caroussel_title_typography',
                'label' => __('Título', 'caroussel-braine'),
                'selector' => '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caroussel_subtitle_typography',
                'label' => __('Sub Título', 'caroussel-braine'),
                'selector' => '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .subtitle',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caroussel_button_typography',
                'label' => __('Botão', 'caroussel-braine'),

                'selector' => '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-braine-button'
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('Imagem', 'caroussel-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'caroussel_image_height',
            [
                'label' => __('Altura da Imagem', 'caroussel-braine'),
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
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-background' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'caroussel_image_border_radius',
            [
                'label' => __('Arredondamento', 'caroussel-braine'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-background' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'caroussel_image_border',
                'label' => __('Borda', 'caroussel-braine'),
                'selector' => '{{WRAPPER}} .caroussel-braine .caroussel-braine-item .caroussel-background',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_element = $this->get_id();

        if ($settings['caroussel_list']):
            echo "<div class='caroussel-braine swiper-container'>";
            echo "<div class='swiper-wrapper'>";
            foreach ($settings['caroussel_list'] as $item):
                $this->add_link_attributes('list_button_link_attr', $item['list_button_link']);
                ?>
<div class="caroussel-braine-item swiper-slide elementor-repeater-item-<?= $item['_id'] ?>">
  <div class="caroussel-background"></div>
  <div class="caroussel-braine-content">
    <h3 class="title"><?= $item['list_title'] ?></h3>
    <p class="subtitle"><?= $item['list_subtitle'] ?></p>
    <?php if($item['list_button_link']['url']): ?>
    <a class="caroussel-braine-button" <?= $this->get_render_attribute_string('list_button_link_attr'); ?>>
      <?= $item['list_button_text'] ?>
    </a>
    <?php endif; ?>
  </div>
</div>
<?php
                $this->remove_render_attribute('list_button_link_attr');
            endforeach;
            echo "</div>";
            echo "</div>";
            echo "<div class='caroussel-buttons-container'>";
            echo "<div class='caroussel-buttons-divisor'></div>";
            \Elementor\Icons_Manager::render_icon($settings['caroussel_icon_left'], ['aria-hidden' => 'true', 'class' => 'caroussel-braine-button-prev']);
            \Elementor\Icons_Manager::render_icon($settings['caroussel_icon_right'], ['aria-hidden' => 'true', 'class' => 'caroussel-braine-button-next']);
            echo "</div>";
        endif;
    }
}

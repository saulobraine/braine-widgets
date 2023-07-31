<?php

namespace Braine\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Accordion_Braine extends \Elementor\Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_script('braine-accordion', plugins_url('/assets/js/accordion.js', __FILE__), ['elementor-frontend', 'jquery'], '1.0.0', true);

        wp_register_style('braine-accordion', plugins_url('/assets/css/accordion.css', __FILE__), ['elementor-frontend']);
    }

    public function get_style_depends() {
        return ['braine-accordion'];
    }

    public function get_script_depends() {
        return ['braine-accordion'];
    }

    public function get_name() {
        return 'braine-accordion';
    }

    public function get_title() {
        return 'Acordeão • Braine';
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['braine'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Configuração', 'accordion-braine'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'important_note',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => "<p style='line-height: 1.3em'>As informações devem ser gerenciadas via <b>painel administrativo.</b></p>",
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        echo "<div class='accordion-braine'>";
        while(have_rows('itens_do_acordeao', 'option')): the_row(); ?>

<div class='item-accordion-braine flex'
  style="--theme-color: <?= the_sub_field('cor_de_fundo') ?>; --text-hover-color: <?= the_sub_field('cor_do_texto_ao_passar_o_mouse') ?>">
  <div class="col flex align-center">
    <img class="icon" src="<?= the_sub_field('icone') ?>" alt="Ícone" />
    <div class="title"><?= the_sub_field('titulo') ?></div>
  </div>
  <div class="col flex">
    <div class="control">
      <svg viewBox="0 0 86 31" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path id="Vector"
          d="M0 17.2802H79.0567L67.6424 28.4828L70.2072 31L86 15.5L70.2072 0L67.6424 2.51717L79.0567 13.7198H0V17.2802Z"
          fill="currentColor" />
      </svg>
    </div>
  </div>
  <div class="marquee"><span><?= the_sub_field('texto_circulante') ?></span></div>
</div>
<div class="item-accordion-content-braine flex flex-col"
  style="--theme-color: <?= the_sub_field('cor_de_fundo') ?>; --text-hover-color: <?= the_sub_field('cor_do_texto_ao_passar_o_mouse') ?>">
  <div class="aprender col flex justify-around only-mb-flex-col">
    <div class="col flex-col">O que você aprender:

      <div class="itens flex flex-col gap md-gap">
        <?php while(have_rows('conteudo')): the_row(); ?>
        <div class="col align-center mb-align-start gap-inline-item">
          <svg viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M16.4985 0C13.2352 0.000296101 10.0452 0.968256 7.33201 2.78148C4.61879 4.5947 2.50418 7.17175 1.25557 10.1868C0.0069493 13.2018 -0.319592 16.5193 0.317233 19.7199C0.954058 22.9205 2.52565 25.8604 4.83327 28.1678C7.1409 30.4752 10.0809 32.0465 13.2816 32.6831C16.4822 33.3196 19.7997 32.9928 22.8146 31.7439C25.8295 30.495 28.4064 28.3801 30.2194 25.6667C32.0323 22.9534 33 19.7633 33 16.5C32.9984 12.1242 31.2593 7.92801 28.165 4.83396C25.0707 1.73991 20.8744 0.00119042 16.4985 0ZM13.2048 24.7507L4.94806 16.5L7.27462 14.1734L13.1988 20.0812L25.7224 7.55757L28.049 9.9006L13.2048 24.7507Z"
              fill="currentColor" />
          </svg>
          <div class="title"><?= the_sub_field('texto') ?></div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
    <div class="quem col flex-col only-mb-flex-col">Com quem você vai aprender:

      <div class="itens flex flex-col gap md-gap">
        <?php while(have_rows('conteudo')):
            the_row(); ?>
        <div class="col align-center mb-align-start gap-inline-item">
          <svg viewBox="0 0 32 37" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M15.9997 17.6017C20.8603 17.6017 24.8006 13.6614 24.8006 8.80086C24.8006 3.94029 20.8603 0 15.9997 0C11.1391 0 7.19885 3.94029 7.19885 8.80086C7.19885 13.6614 11.1391 17.6017 15.9997 17.6017Z"
              fill="currentColor" />
            <path
              d="M16 22.002C7.1815 22.002 0 27.9161 0 35.2032C0 35.6961 0.387238 36.0833 0.880086 36.0833H31.1199C31.6128 36.0833 32 35.6961 32 35.2032C32 27.9161 24.8185 22.002 16 22.002Z"
              fill="currentColor" />
          </svg>
          <div class="title"><?= get_sub_field('post')[0]->post_title; ?></div>
        </div>
        <?php
        endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php
        endwhile;
        echo "</div>";
    }
}

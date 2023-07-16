<?php

namespace Braine;

class Braine_Widgets_Loader {
    private static $_instance = null;

    public static function instance() {
        if(is_null(self::$_instance)):
            self::$_instance = new self();
        endif;

        return self::$_instance;
    }

    public function include_widgets_files() {
        require_once __DIR__ . '/slider/slider.php';
        require_once __DIR__ . '/mini-caroussel/mini-caroussel.php';
        require_once __DIR__ . '/caroussel/caroussel.php';
        require_once __DIR__ . '/scroll/scroll.php';
    }

    public function register_widgets() {
        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register(new Widgets\Slider_Braine());
        \Elementor\Plugin::instance()->widgets_manager->register(new Widgets\MiniCaroussel_Braine());
        \Elementor\Plugin::instance()->widgets_manager->register(new Widgets\Caroussel_Braine());
        \Elementor\Plugin::instance()->widgets_manager->register(new Widgets\Scroll_Braine());
    }

    public function register_category($elements_manager) {
        $elements_manager->add_category(
            'braine',
            [
                'title' => "Braine",
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function init() {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
        add_action('elementor/elements/categories_registered', [$this, 'register_category']);
    }

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }
}

Braine_Widgets_Loader::instance();

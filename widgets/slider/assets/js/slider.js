class SliderBraine extends elementorModules.frontend.handlers.Base {

  getDefaultSettings() {
    return {
      selectors: {
        slider: '.slider-braine',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $slider: this.$element.find(selectors.slider),
    }
  }

  bindEvents() {
  }

  // Init

  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    // initialize slider
    new Swiper(this.elements.$slider, {
      speed: 3000,
      loop: true,
      slidesPerView: 1,
      autoplay: {
        delay: 5000,
        pauseOnMouseEnter: true,
        disableOnInteraction: false,
      }
    });
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(SliderBraine, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/braine-slider.default', addHandler);
});
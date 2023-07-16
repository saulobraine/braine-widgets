class MiniCaroussel extends elementorModules.frontend.handlers.Base {

  getDefaultSettings() {
    return {
      selectors: {
        slider: '.mini-caroussel-braine',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $slider: this.$element.find(selectors.slider),
    }
  }

  // Init

  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    // initialize slider

    new Swiper(this.elements.$slider, {
      grabCursor: true,
      speed: 2000,
      loop: true,
      autoplay: {
        delay: 2000
      }
    });

  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(MiniCaroussel, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/braine-mini-caroussel.default', addHandler);
});
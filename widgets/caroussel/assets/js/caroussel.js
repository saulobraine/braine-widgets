class CarouselBraine extends elementorModules.frontend.handlers.Base {

  getDefaultSettings() {
    return {
      selectors: {
        slider: '.caroussel-braine',
        prev: '.caroussel-buttons-container .caroussel-braine-button-prev',
        next: '.caroussel-buttons-container .caroussel-braine-button-next',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $slider: this.$element.find(selectors.slider),
      $prev: this.$element.find(selectors.prev),
      $next: this.$element.find(selectors.next),
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
      navigation: {
        nextEl: this.elements.$next,
        prevEl: this.elements.$prev,
      }
    });

  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(CarouselBraine, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/braine-caroussel.default', addHandler);
});
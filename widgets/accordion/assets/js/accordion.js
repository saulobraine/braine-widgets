class Accordion extends elementorModules.frontend.handlers.Base {

  getDefaultSettings() {
    return {
      selectors: {
        Accordion: '.braine-accordion',
        Item: '.item-accordion-braine',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $Accordion: this.$element.find(selectors.Accordion),
      $Item: this.$element.find(selectors.Item),
    }
  }

  bindEvents() {
    parent = this;

    this.elements.$Item.on('click', function () {
      parent.elements.$Item.removeClass('active');

      jQuery(this).addClass('active');
    });
  }


  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(Accordion, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/braine-accordion.default', addHandler);
});
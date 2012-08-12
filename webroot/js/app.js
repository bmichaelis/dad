(function ($) {

  $(function(){
    $(document).foundationAlerts();
    $(document).foundationButtons();
    $(document).foundationNavigation();
    $(document).foundationCustomForms();
    $(document).foundationTabs({callback:$.foundation.customForms.appendCustomMarkup});

    $(document).tooltips();
  });

})(jQuery);
;(function ($, window, undefined) {
  'use strict';

  var $doc = $(document),
      Modernizr = window.Modernizr;

  $.fn.foundationAlerts           ? $doc.foundationAlerts() : null;
  $.fn.foundationButtons          ? $doc.foundationButtons() : null;
  $.fn.foundationNavigation       ? $doc.foundationNavigation() : null;
  $.fn.foundationTopBar           ? $doc.foundationTopBar() : null;
  $.fn.foundationCustomForms      ? $doc.foundationCustomForms() : null;
  $.fn.foundationTooltips         ? $doc.foundationTooltips() : null;

  $.embedly.defaults['key'] = '4603f0580d124fa8ae58b4afd47b0835';
  $('[data-embeddable]').embedly();


  $doc.on("click", "[data-behavior~=expandable]", function(){
    $(this).find('.collapsed_content').hide();
    $(this).find('.expanded_content').show();
  });

})(jQuery, this);
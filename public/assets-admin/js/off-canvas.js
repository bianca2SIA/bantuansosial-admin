(function($) {
  'use strict';
  $(function() {
    $('[data-toggle="offcanvas"]').on("click", function() {
      $('.sidebar-offcanvas').toggleClass('active')
    });

    // ==== FIX: cegah hash (#ui-basic) muncul di URL ====
    $('.nav-link').on('click', function(e) {
      const href = $(this).attr('href');
      if (href && href.includes('#')) {
        e.preventDefault();
        // buka halaman tanpa hash
        window.location.href = href.split('#')[0];
      }
    });
    // ==== END FIX ====
  });
})(jQuery);

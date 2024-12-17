;(function($) {
    "use strict";
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/saasp-comparison.default", function (scope, $) {
  
          var saaspExpire = setInterval(function() {
  
            var saaspMainClass = $(scope).find(".saaspricing-ribbon-wrapper");
            var saaspDateOne = saaspMainClass.data('expire-date-one');
            var saaspDateTwo = saaspMainClass.data('expire-date-two');
            var saaspDateThree = saaspMainClass.data('expire-date-three');
            
            if ( "undefined" !== typeof saaspDateOne && "undefined" !== typeof saaspDateTwo && "undefined" !== typeof saaspDateThree) {
            var saaspCountDownDate = [new Date(saaspDateOne.replace(/-/g, "/")), new Date(saaspDateTwo.replace(/-/g, "/")),  new Date(saaspDateThree.replace(/-/g, "/"))];
            var saaspCurrentTime = new Date().getTime();
            var saaspCountdowns = $(scope).find(".saaspricing-show-expire-date");
          
            // Find the distance between now and the count down date
            
            saaspCountdowns.each(function() {
              var saaspCountDownIndex = $(this).data("countdown-index");
              var saaspDistance = saaspCountDownDate[saaspCountDownIndex] - saaspCurrentTime;
          
              var saaspDays = Math.floor(saaspDistance / (1000 * 60 * 60 * 24));
              var saaspHours = Math.floor((saaspDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var saaspMinutes = Math.floor((saaspDistance % (1000 * 60 * 60)) / (1000 * 60));
              var saaspSeconds = Math.floor((saaspDistance % (1000 * 60)) / 1000);
              
              $(this).html(saaspDays + "d: " + saaspHours + "h: " + saaspMinutes + "m: " + saaspSeconds + "s ");
          
              if (saaspDistance < 0) {
                clearInterval(saaspExpire);
                $(this).html("00d: 00h: 00m: 00s");
              }
            });
          }

          }, 1000);
  
          // Tooltip Trigger Function
          
          var saaspTooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
          var saaspTooltipList = saaspTooltipTriggerList.map(function (saaspTooltipTriggerEl) {
            return new bootstrap.Tooltip(saaspTooltipTriggerEl)
          })
             
        });
    })
  })(jQuery);
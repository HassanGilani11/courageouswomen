jQuery(document).ready(function($) {
    // required elements
    var imgPopup = $('.saasprcing-img-lightbox')
    var imgPopupInner = $('.saasprcing-img-lightbox-inner');
    var imgCont  = $('.saasprcing-img-holder');
    var popupImage = $('.saasprcing-img-lightbox img');
    var closeBtn = $('.saasprcing-lightbox-close');
  
    // handle events
    imgCont.on('click', function() {
      var img_src = $(this).children('img').attr('src');
      imgPopupInner.children('img').attr('src', img_src);
      imgPopup.addClass('opened');
    });
  
    $(imgPopup, closeBtn).on('click', function() {
      imgPopup.removeClass('opened');
      imgPopupInner.children('img').attr('src', '');
    });
  
    popupImage.on('click', function(e) {
      e.stopPropagation();
    });
    
  });
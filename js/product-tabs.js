jQuery(document).ready(function($){


  // ===== FUNCTION - Get URL Parameter ===== //
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  };



  // ===== FUNCTION - Initialize Tabs ===== //
  function initTabs(){

    // Activate in carousel
    $('.p-cat-tab .p-cat-tab-link[data-pid="' + initID + '"]').toggleClass('active inactive');

    // Activate in product content
    $('.p-cat-product[data-pid="' + initID + '"]').toggleClass('active inactive');

  }



  // ===== FUNCTION - Scroll to Product (for init) ===== //
  function scrolltoProduct(){

    // Adjust carousel to show product
    pIndex = $('.p-cat-tab .p-cat-tab-link[data-pid="' + initID + '"]').parent('.p-cat-tab').index();

    nextPos = arrowSize - (pIndex * tabSize);

    // check for bounds
    if( nextPos > arrowSize ){ nextPos = arrowSize; }
    initLimit = - ( carSize + arrowSize - carWrapSize );
    if( nextPos < initLimit && carSize > carWrapSize ){ nextPos = initLimit; }

    if( $(window).width() >= 1024 ){
      carousel.css('top', nextPos + 'px');
    } else {
      carousel.css('left', nextPos + 'px');
    }

    // update arrow classes
    updateArrowClass();

  }



  // ===== FUNCTION - Window Resize ===== //
  function tabsResize(){

    // on mobile, adjust carousel width
    if( $(window).width() < 1024 ){

      // Mobile
      tabSize = 160;
      shiftSize = 160;

      var productsWidth = $('.p-cat-tab').length * shiftSize;

      carousel.css({
        'top': '0',
        'width': productsWidth + 'px',
      });

    } else {

      // Desktop
      tabSize = 200;
      shiftSize = 400;

      carousel.css({
        'left': '0',
        'width': '100%',
      });

    }

    updateCarDims();

    updateArrowClass();

  }



  // ===== Update Carousel Dimensions ===== //
  function updateCarDims(){

    if( $(window).width() >= 1024 ){
      carWrapSize = carouselWrap.height();
      carSize = carousel.height();
    } else {
      carWrapSize = carouselWrap.width();
      carSize = carousel.width();
    }

  }


  // ===== FUNCTION - Get Carousel Position ===== //
  function updateCarPos(){

    // Get Direction
    if( $(window).width() >= 1024 ){

      // Desktop
      tabDir = 'top';
      curPos = carousel.position().top;

    } else {

      // Mobile
      tabDir = 'left';
      curPos = carousel.position().left;

    }

  }

  // ===== FUNCTION - Shift Carousel ===== //
  function shiftCarousel(arrow){

    if( arrow.hasClass('inactive') ){ return false; }

    //updateCarDims();

    updateCarPos();

    // Prev / Next
    if( arrow.hasClass('arrow-prev') ){

      // <<< Prev
      nextPos = curPos + shiftSize;
      if( nextPos >= arrowSize ){
        nextPos = arrowSize;
      }

      // move carousel
      carousel.css(tabDir, nextPos + 'px');

    } else {

      // >>> Next
      nextPos = curPos - shiftSize;
      carLimit = - ( carSize + arrowSize - carWrapSize );
      if( nextPos <= carLimit ){
        nextPos = carLimit;
      }

      // move carousel
      carousel.css(tabDir, nextPos + 'px');

    }

    // update arrow classes
    updateArrowClass();

  }



  // ===== FUNCTION - Update Arrow Class ===== //
  function updateArrowClass(){

    updateCarPos();

    // Prev Arrow
    if( nextPos >= arrowSize ){
      $('.arrow-prev').removeClass('active');
      $('.arrow-prev').addClass('inactive');
    } else {
      $('.arrow-prev').removeClass('inactive');
      $('.arrow-prev').addClass('active');
    }

    // Next Arrow
    carLimit = - ( carSize + arrowSize - carWrapSize );

    if( nextPos <= carLimit ){
      $('.arrow-next').removeClass('active');
      $('.arrow-next').addClass('inactive');
    } else {
      $('.arrow-next').removeClass('inactive');
      $('.arrow-next').addClass('active');
    }

  }



  // ===== FUNCTION - Switch Tabs ===== //
  function switchTabs(el){

    // make sure it's not already active
    if( el.hasClass('inactive') ){

      var productID = el.data('pid');

      // disable active tab
      $('.p-cat-tab-link.active').toggleClass('active inactive');

      // disable active product
      $('.p-cat-product.active').toggleClass('active inactive');

      // activate this tab
      el.toggleClass('active inactive');

      // activate this product
      $('.p-cat-product[data-pid="' + productID + '"]').toggleClass('active inactive');

    }

  }



  // ===== Variables ===== //
  var carouselWrap = $('#p-cat-carousel-wrap'),
      carousel = $('#p-cat-carousel'),
      tabSize = 200,
      shiftSize = 200,
      tabDir = 'top',
      arrowSize = 50,
      curPos = arrowSize,
      nextPos = curPos,
      carWrapSize = 0,
      carSize = 0,
      carLimit = 0,
      resizeDelay = 500,
      doResize = false,
      pIndex = 0;

  // Get Init tab
  var initID = getUrlParameter('pid');

  if( typeof initID !== 'undefined' ){

    // Product ID from URL, scroll down
    var scrollPos = $('#p-cat-tabs').offset().top - 100;
    $(window).scrollTop(scrollPos);

  } else {

    // Product ID from first one in carousel
    initID = $('#p-cat-carousel .p-cat-tab:first-child .p-cat-tab-link').data('pid');

  }



  // ===== INIT ===== //

  // init tabs
  initTabs();

  // resize tabs on init
  tabsResize();

  // update carousel dimensions on init
  updateCarDims();

  // scroll to product in carousel
  scrolltoProduct();

  // update arrow classes
  updateArrowClass();



  // ===== TRIGGER - Window Resize ===== //
  var resizerInterval = setInterval(function(){
    if(doResize){
      tabsResize();
      doResize = false;
    }
  }, resizeDelay);

  $(window).resize(function(){ doResize = true; });



  // ===== TRIGGER - Switch Tabs ===== //
  $('.p-cat-tab-link').click(function(){
    switchTabs($(this));
  });



  // ===== TRIGGER - Arrow Click ===== //
  $('.tab-arrow').click(function(){
    shiftCarousel($(this));
  });


});

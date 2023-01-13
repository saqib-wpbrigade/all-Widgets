(function($) {
    $(function(){
        const swiper = new Swiper('.timeline-main-wrapper', {
            slidesPerView: 2,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-controller .swiper-pagination',
                
                clickable: true
            },
          });
    });

    //and rest of code here
})(jQuery);






import owlCarousel from 'owl.carousel';

class BlogSliderUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$slider = $('.highlighted-slider');
        this.slideClass = $('.highlighted-slider .list-item');
        this.owl = false;

    }

    init() {
        
        if(this.$slider.length){
            this.initSlider();
        }

    }

    initSlider() {

        let prevArrow = this.$slider.attr('data-prev');
        let nextArrow = this.$slider.attr('data-next');

        this.owl = this.$slider.owlCarousel({
            // stagePadding: 365,
            items: 1,
            loop: ((this.slideClass.length > 1) ? true : false ),
            autoplay: true,
            autoplayTimeout: 11000,
            dots: true,
            // dotsEach: ((this.slideClass.length > 5) ? 3 : 0 ),
            autoHeight: true,
            nav: true,
            navText : [
                '<img src="'+prevArrow+'" alt="left arrow symbol" />',
                '<img src="'+nextArrow+'" alt="right arrow symbol" />'
            ],
            responsive: {
                0: {
                    stagePadding: 0,
                },
                768: {
                    stagePadding: 120,
                },
                1024: {
                    stagePadding: 120,
                },
                1260: {
                    stagePadding: 80,
                },
                1400: {
                    stagePadding: 150,
                },
                1600: {
                    stagePadding: 250,
                },
                1830: {
                    stagePadding: 365,
                }
            }
        });

        this.$elem.find('.carousel-nav.nav-next').click(() => {
            this.owl.trigger('next.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        })
        this.$elem.find('.carousel-nav.nav-prev').click(() => {
            this.owl.trigger('prev.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        });
    }

}

$(function(){
    if($('.block--custom-layout__highlighted-slider').length){
        let _module = new BlogSliderUX($('.block--custom-layout__highlighted-slider'));
        _module.init();

        $('.block--custom-layout__highlighted-slider .highlighted-slider > div:nth-child(2), .block--custom-layout__highlighted-slider .highlighted-slider > div:nth-child(3)').wrapAll('<div class="nav-wrapper"></div>');
        $('.block--custom-layout__highlighted-slider .highlighted-slider .owl-nav .owl-next').css('left', ($('.block--custom-layout__highlighted-slider .highlighted-slider .owl-dots').width() + 50));
    } 
})
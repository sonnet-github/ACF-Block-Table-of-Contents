import owlCarousel from 'owl.carousel';

class LogoSliderUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$slider = $('.logo-slider');
        this.slideClass = $('.logo-slider .slide-item');
        this.owl = false;
        this.speed = $('.logo-slider-speed').val();

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
            items: 4,
            loop: ((this.slideClass.length >= 4) ? true : false ),
            autoplay: true,
            autoplayTimeout: ((this.speed > 1) ? (this.speed * 1000) : 7000),
            dots: false,
            // autoWidth: true,
            margin: 70,
            // autoHeight: true,
            nav: true,
            navText : [
                '<img src="'+prevArrow+'" alt="left arrow symbol" />',
                '<img src="'+nextArrow+'" alt="right arrow symbol" />'
            ],
            responsive: {
                0: {
                  items: 1,
                //   autoHeight: false,
                  autoWidth: false,
                },
                550: {
                  items: 3,
                  autoWidth: false,
                  autoHeight: false,
                },
                1530: {
                  items: 4,
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
    if($('.block--custom-layout__logo-slider').length){
        let _module = new LogoSliderUX($('.block--custom-layout__logo-slider'));
        _module.init();
    }
})
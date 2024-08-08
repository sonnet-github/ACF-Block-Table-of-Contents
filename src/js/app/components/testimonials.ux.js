import owlCarousel from 'owl.carousel';

class TestimonialUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$slider = $('.testimonial-slider');
        this.slideClass = $('.testimonial-slider .slide-item');
        this.owl = false;
        this.speed = $('.testimonial-speed').val();

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
            items: 1,
            loop: ((this.slideClass.length > 1) ? true : false ),
            autoplay: true,
            autoplayTimeout: ((this.speed > 1) ? (this.speed * 1000) : 10000),
            dots: false,
            autoHeight: true,
            nav: true,
            navText : [
                '<img src="'+prevArrow+'" alt="left arrow symbol" />',
                '<img src="'+nextArrow+'" alt="right arrow symbol" />'
            ]
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
    if($('.block--custom-layout__testimonials').length){
        let _module = new TestimonialUX($('.block--custom-layout__testimonials'));
        _module.init();
    }
})
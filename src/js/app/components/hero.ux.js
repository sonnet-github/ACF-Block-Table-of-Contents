import owlCarousel from 'owl.carousel';

class HeroUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.heroCarouselClass = $('.hero-carousel');
        this.heroSlideClass = $('.hero-carousel-item');
        this.owl = false;

    }

    init() {
        
        if(this.heroCarouselClass.length){
            this.initHeroSlider();
        }

    }

    initHeroSlider() {

        this.owl = this.heroCarouselClass.owlCarousel({
            items: 1,
            loop: ((this.heroSlideClass.length > 1) ? true : false ),
            autoplay: true,
            autoplayTimeout: 10000,
            nav: false,
            dots: false,
            autoHeight: true,
            animateOut: 'fadeOut'
        });

        this.$elem.find('.carousel-nav.nav-next').click(() => {
            this.owl.trigger('next.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        })
        this.$elem.find('.carousel-nav.nav-prev').click(() => {
            this.owl.trigger('prev.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        });

        let ins = this;

        this.$elem.find('.carousel-nav.nav-bullet').click(function(){
            if(!$(this).hasClass('active-bullet')){
                let slide_index = $(this).attr('data-index');
                ins.owl.trigger('to.owl.carousel', slide_index);
                ins.owl.trigger('stop.owl.autoplay');
            }
        });

    }

}

$(function(){
    if($('.panel-hero').length){
        let _module = new HeroUX($('.panel-hero'));
        _module.init();
    }
})
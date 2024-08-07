//modules
import { CommonHelper } from './utils/common.helper';
import './lazyload/contentlazyload.ux';
// import fancybox from '@fancyapps/fancybox';

// components
import './components/header.ux';

class WebApp {

    constructor($window, $document, _data) {

        this.$window = $window;
        this.$document = $document;
        this.data = (_data) ? _data : {};

    }

    init() {

        this.$document.ready( () => { this.afterDocumentreadyHook(); } );
        this.$window.on( 'load', () => { this.afterWindowloadHook(); } );

    }

    clearData() {

        this.data = {};
        return true;

    }

    afterDocumentreadyHook(){

        this.bindScrollToAnchor();
        $('#page-content').css({
            'min-height' : this.$window.height() - $('#page-footer').height()
        });
        // $("html, body").animate({scrollTop: 1});

        let anchor = CommonHelper.getUrlParameter('goto');
        // if(!anchor){
        //     setTimeout(function(){ 
        //         $("html, body").animate({scrollTop: 1});
        //     }, 200);
        // }

        $('.service-item').bind('click', function(){
            $(this).toggleClass('active-item');
        });

    }

    afterWindowloadHook(){

        let anchor = CommonHelper.getUrlParameter('goto');
        if(anchor){
            this.scrollToAnchor(anchor);
        }

        let smoothanchor = CommonHelper.getUrlParameter('gt');
        if(smoothanchor){
            this.scrollToAnchorById('#'+smoothanchor);
        }

    }

    bindScrollToAnchor() {

        let wa = this;
        $('*[data-ux="scroll-to-anchor"]').bind('click', function(){
            let target = $(this).attr('data-target');
            if(target){
                wa.scrollToAnchor(target);
            } else {
                $('html, body').animate({
                    scrollTop: ($(window).height() - ($('#page-header').height()))
                }, 1200);
            }
        });

        
        $('.ux-scroll-to-anchor').bind('click', function(ev){
            ev.preventDefault();
            let target = $(this).attr('href');
            if(target){
                if($(this).hasClass('home-only')){
                    if($('body').hasClass('home')){
                        wa.scrollToAnchorById(target);
                    } else {
                        window.location = $(this).attr('data-home');
                    }
                } else {
                    wa.scrollToAnchorById(target);
                }
            } else {
                $('html, body').animate({
                    scrollTop: ($(window).height() - ($('#page-header').height()))
                }, 1200);
            }
        });

    }

    scrollToAnchor(target) {
        if($('*[data-anchor="'+target+'"]').length){
            $('html, body').animate({
                scrollTop: $('*[data-anchor="'+target+'"]').offset().top - ($(window).height() / 5)
            }, 1200);
        }
    }

    scrollToAnchorById(target){
        if($(target).length){
            $('html, body').animate({
                scrollTop: $(target).offset().top - 30
            }, 1200);
        }
    }

}

const _WebApp = new WebApp( 
    $(window), 
    $(document), 
    { 
        started : Date.now() 
    }
).init();
import { TweenMax, Expo } from 'gsap/TweenMax';

class HeaderUX {
    
    constructor() {

        this.$triggers = {
            mobile_menu_toggle : $('.mobile-menu-trigger'),
            search_toggle :  $('#nav-search > i')
        }

        this.$mobile_menu = $('#mobile-menu');
        this.is_mobile_menu_active = false;

        this.$mobile_menu_items = $('#mobile-menu nav > a, #mobile-menu nav > div');
        this.$search_bar = $('#nav-search > input');
        this.$search_input = $('input[name="search"]');

        this.sticky_class = 'sticky-mode';

    }

    init() {

        this.adjustNav();
        this.bindEventTriggers();
        this.bindSearch();
        this.bindScroll();
        this.bindMobileSubNavToggle();

        $(window).resize(() => {
            this.adjustNav();
        });

    }

    adjustNav() {

        $('#main-navigation .has-sub-menu .sub-nav').each(function(){
            let parent = $(this).parent();
            TweenMax.set($(this), {
                x: 0 - (($(this).width() - parent.width()) / 2)
            });
        });

    }

    bindEventTriggers() {

        this.$triggers.mobile_menu_toggle.unbind('click');
        this.$triggers.mobile_menu_toggle.bind('click', () => {
            this.toggleMobileMenu();
        });

        this.$triggers.search_toggle.unbind('click');
        this.$triggers.search_toggle.bind('click', () => {
            this.toggleSearchBar();
        });

        $('.ux-scroll-to-anchor').bind('click', () => {
            this.closeMobileMenu();
        });

    }

    bindScroll() {
        $(window).scroll(() => {    
            let scroll = $(window).scrollTop();
            let hh = $('#page-header').height() + 200;
            let offset = 0;
            if (scroll >= (hh - offset)) {
                $('#page-header').addClass(this.sticky_class);
            } else {
                $('#page-header').removeClass(this.sticky_class);
            }
        });
    }

    toggleMobileMenu() {

        if(!this.is_mobile_menu_active){
            this.openMobileMenu();
        } else {
            this.closeMobileMenu();
        }

    }

    toggleSearchBar() {
        this.$search_bar.toggleClass('active-search');
    }

    bindSearch() {

        this.$search_input.on('change', function(){

            let s = $(this).val();

            if(s.length){
                s = encodeURI(s);
                let base = $(this).attr('data-sctrl');
                window.location = base + '?qs=' + s;
            }

        });

    }

    bindMobileSubNavToggle(){
        this.$mobile_menu.find('.has-sub-menu > a').bind('click', function(e){
            e.preventDefault();
            $(this).nextAll('.sub-nav').slideToggle();
            $(this).toggleClass('sub-nav-active');
            // $(this).unbind('click');
        });
    }

    openMobileMenu() {

        TweenMax.set(this.$mobile_menu, {
            opacity: 0,
            x: '100vw',
            display: 'block',
            ease: Expo.easeOut
        });

        TweenMax.set(this.$mobile_menu_items, {
            opacity: 0,
            x: '30vw'
        });

        this.$triggers.mobile_menu_toggle.addClass('active-menu');
        $('#page-header').addClass('mobile-menu-active');
        $('body').addClass('mobile-menu-active');

        TweenMax.to(this.$mobile_menu, 0.5, {
            opacity: 1,
            x: 0,
            onComplete: () => {
                this.is_mobile_menu_active = true;
                TweenMax.staggerTo(this.$mobile_menu_items, 0.45,{
                    x: 0,
                    opacity: 1
                }, 0.15);
            }
        });

    }

    closeMobileMenu() {

        this.$triggers.mobile_menu_toggle.removeClass('active-menu');
        $('#page-header').removeClass('mobile-menu-active');
        $('body').removeClass('mobile-menu-active');
        TweenMax.to(this.$mobile_menu, 0.5, {
            opacity: 0,
            x: '100vw',
            ease: Expo.easeIn,
            onComplete: () => {
                this.is_mobile_menu_active = false;
                TweenMax.set(this.$mobile_menu, {
                    display: 'none'
                });
            }
        });

    }

}

$(function(){
    let _module = new HeaderUX();
    _module.init();

    $('#mobile-menu').css('top', ($('#page-header').outerHeight() - 1));
    $(window).resize(function() {
        $('#mobile-menu').css('top', ($('#page-header').outerHeight() - 1));
    });
    $(".block--custom-layout__whitepaper-download .form-container form > .forminator-row-last").appendTo(".block--custom-layout__whitepaper-download .form-container form > div:nth-child(2)");
    $(".block--custom-layout__whitepaper-download .form-container form > .forminator-row-last").addClass('forminator-col');
    $(".block--custom-layout__whitepaper-download .form-container form .form-custom .forminator-field input").each(function() {
        $(this).prependTo($(this).parent());
    });

    $('input[type=text]').not('[name=Email], [name=PhoneNumber_countrycode]').keydown(function (e) {
        var key = e.keyCode;
        if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (key == 9))) {
            e.preventDefault();
        }
    });
    
    $(".block--custom-layout__listing-page .form-container form > .forminator-row-last").appendTo(".block--custom-layout__listing-page .form-container form > div:nth-child(2)");

    $(".block--custom-layout__lets-talk-form .form-container form .label-bottom .forminator-field input").each(function() {
        $(this).prependTo($(this).parent());
    });

    $( '.block--custom-layout__two-col-image-text .content-wrap .content-item .tb-wr p:empty' ).remove();

    $('.block--custom-layout__wysiwyg .container-block > *, .block--custom-layout__three-col-icon-text .tiles-grid .desc p').each(function() {
        if ($(this).css('text-align') == 'center') {
            $(this).addClass('centered');
        }
    });


    $('.design-single-slider .design-slider .slide-item .video-thumb').click(function() {
        $(this).fadeOut();
        $(this).next('.hidden').fadeIn();
    });

    var gridCount = $('.block--custom-layout__select-services .tiles-grid .tile-item').length;
    if (gridCount < 3) {
        $('.block--custom-layout__select-services .tiles-grid').addClass('tiles-center');
    }

    $(".label-bottom .forminator-field input").each(function() {
        $(this).prependTo($(this).parent());
    });

    var sectorsCount = $('.block--custom-layout__sectors-we-serve .tiles-grid .tile-item').length;
    if (sectorsCount < 4) {
        $('.block--custom-layout__sectors-we-serve .tiles-grid').addClass('tiles-center');
    }

    var postID = '.postid-' + $('.hidden-id').text();

    $(postID + ' .heart-icon').click(function(e) {
        e.preventDefault();
        $(this).addClass('active');
        localStorage.setItem("div-class", "active");
        localStorage.setItem("heart-id", postID);
    });

    window.onload = function() {
        var heartID = localStorage.getItem("heart-id");
        if (localStorage.getItem("div-class")) {
            $(heartID + ' .heart-icon').addClass(localStorage.getItem("div-class"));
        }
    };

    $('.details-container').each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            $(this).next('.content').slideToggle();
        });
    });

    $('.tabs-content a:first-child').addClass('active');
    var activeState = $('.tabs-content a:first-child').attr('id');
    //Show active state
    $('.main-content-container .content-wrapper .main-content .post-item').hide();
    $('.main-content-container .publication').hide();
    //Hide inactive state
    $(".main-content-container .content-wrapper .main-content .post-item"+'#'+activeState).show();
    $('.main-content-container .publication'+'#'+activeState).show();

    $('.tabs-content a').each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            //Tabs toggle
            $('.tabs-content a.active').removeClass('active'); 
            $(this).addClass('active'); 

            var $category = $(this).attr('id');

            //Main Content toggle
            $('.main-content-container .content-wrapper .main-content .post-item').each(function() {
                if ($(this).attr('id').indexOf($category) > -1) {
                    $(this).addClass('show');
                    $(this).removeClass('hide');
                    
                    $(".main-content-container .content-wrapper .main-content .post-item.hide").hide();
                    $(".main-content-container .content-wrapper .main-content .post-item.show").show();
                }
                else {
                    $(this).addClass('hide');
                    $(this).removeClass('show');

                    $(".main-content-container .content-wrapper .main-content .post-item.hide").hide();
                    $(".main-content-container .content-wrapper .main-content .post-item.show").show();
                }
            });

            //Publication toggle
            $('.main-content-container .publication').each(function() {
                if ($(this).attr('id').indexOf($category) > -1) {
                    $(this).addClass('show');
                    $(this).removeClass('hide');
                    
                    $('.main-content-container .publication.hide').hide();
                    $('.main-content-container .publication.show').show();
                }
                else {
                    $(this).addClass('hide');
                    $(this).removeClass('show');

                    $('.main-content-container .publication.hide').hide();
                    $('.main-content-container .publication.show').show();
                }
            });
        });
    });

      
})
import { fancybox } from "@fancyapps/fancybox";
import "../../../scss/vendor/fancybox.scss";

class ContactPopupUX {
    
    constructor($elem) {

        this.$elem = $elem;

    }

    init() {
    
    }

}

$(function(){
    if($('.block--custom-layout__lets-talk').length){
        let _module = new ContactPopupUX($('.block--custom-layout__lets-talk'));
        _module.init();

        $("input").attr('maxlength','500');
        $( 'input' ).prop( 'maxlength', '500' );

        $(".label-bottom .forminator-field input").each(function() {
            $(this).prependTo($(this).parent());
        });
    }
})
class BlogListing {
    
    constructor($elem) {

        this.$elem = $elem;

    }

    init() {
    
    }

}

$(function(){
    if($('.block--custom-layout__listing-page').length){
        let _module = new BlogListing($('.block--custom-layout__listing-page'));
        _module.init();

        $(".listing-content .listing-wrapper .item").hide();
        $(".listing-content .listing-wrapper .item").slice(0,15).show();

        $('#dropdown').on('change', function(){
            var $category = $(this).val(); 
            $(".listing-content .listing-wrapper .item").each(function() {
                if ($(this).attr('data-category').indexOf($category) > -1) {
                    $(this).addClass('show');
                    $(this).removeClass('hide');
                    
                    // $(".listing-content .listing-wrapper .item").hide();
                    $(".listing-content .listing-wrapper .item.hide").hide();
                    $(".listing-content .listing-wrapper .item.show").slice(0,15).show();
                }
                else {
                    $(this).addClass('hide');
                    $(this).removeClass('show');

                    $(".listing-content .listing-wrapper .item.hide").hide();
                    $(".listing-content .listing-wrapper .item.show").slice(0,12).show();
                }
            });
        });

        $(".older-posts a").on('click', function (e) {
            e.preventDefault();
            $(".listing-content .listing-wrapper .item:hidden").slice(0,12).slideDown();
            if ($(".listing-content .listing-wrapper .item:hidden").length == 0) {
                $(".listing-content .older-posts").hide();
            }
  
        });

        $(".mailing-form-container .forminator-field input").each(function() {
            $(this).prependTo($(this).parent());
        });
    }
})
class AccordionUX {
    
    constructor($elem) {

        this.$elem = $elem;

    }

    init() {
    
    }

}

$(function(){
    if($('.block--custom-layout__pain-points').length){
        let _module = new AccordionUX($('.block--custom-layout__pain-points'));
        _module.init();

        $('.block--custom-layout__pain-points .columns-container .main-tab').on('click', function(e){
            e.preventDefault(); 
            $(this) 
              .toggleClass('active')
              .next('.sub-tabs') 
              .not(':animated') 
              .slideToggle(); 

            if ($(this).hasClass('active')) {

            }
            else {
                $(this).parent().find('.sub-tabs .column-item .title').removeClass('active');
                // title.removeClass('active');
                $(this).parent().find('.sub-tabs .column-item .description').hide();
            }
        })

        $('.block--custom-layout__pain-points .columns-container .sub-tabs .column-item .title').on('click', function(e){
            e.preventDefault(); 
            $(this) 
              .toggleClass('active')
              .next('.description') //select the next accordion panel
              .not(':animated') 
              //if it is not currently animating
              .slideToggle(); //use slideToggle to show or hide it
        })

    //     $('.block--custom-layout__pain-points .columns-container p.title').click(function(e) {
    //         e.preventDefault();
        
    //       let $this = $(this);
        
    //       if ($this.next().hasClass('show')) {
    //           $this.next().removeClass('show');
    //           $this.next().slideUp(350);
    //       } else {
    //           $this.parent().parent().find('div .description').removeClass('show');
    //           $this.parent().parent().find('div .description').slideUp(350);
    //           $this.next().toggleClass('show');
    //           $this.next().slideToggle(350);
    //       }
    //   });
    }
})
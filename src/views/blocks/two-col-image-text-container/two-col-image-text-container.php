<?php
/**
 * Two Column Image and Text with Container Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $background_image = get_field('background_image') ?: '';

    //Two Column Section
    $tc_show_section = get_field('tc_show_section');

    $tc_heading_color = get_field('tc_heading_color') ?: '#DB6D10';
    $tc_subheading_color = get_field('tc_subheading_color') ?: '#EBB323';
    $tc_heading = get_field('tc_heading');
    $tc_heading_alignment = get_field('tc_heading_alignment');
    $tc_subheading = get_field('tc_subheading');
    $tc_subheading_alignment = get_field('tc_subheading_alignment');
    $tc_description = get_field('tc_description');
    $tc_description_color = get_field('tc_description_color') ?: '#FFFFFF';

    $tc_image = get_field('tc_image');
    $tc_image_placement = get_field('tc_image_placement');

    $tc_add_cta = get_field('tc_add_cta');
    $tc_cta_type = get_field('tc_cta_type');
    $tc_cta_link = get_field('tc_cta_link');
    $tc_cta_text = get_field('tc_cta_text');
    $tc_cta_form = get_field('tc_cta_form');
    $tc_custom_form = get_field('tc_custom_form');
    $tc_cta_bg = get_field('tc_cta_bg');
    $tc_cta_text_color = get_field('tc_cta_text_color');
    $tc_cta_alignment = get_field('tc_cta_alignment');

    $tc_background_color = get_field('tc_background_color') ?: '#FFFFFF';

    //Brand Presence Section
    $bp_show_section = get_field('bp_show_section');

    $bp_heading_color = get_field('bp_heading_color') ?: '#FFFFFF';
    $bp_subheading_color = get_field('bp_subheading_color') ?: '#EBB323';
    $bp_heading = get_field('bp_heading');
    $bp_heading_alignment = get_field('bp_heading_alignment');
    $bp_subheading = get_field('bp_subheading');
    $bp_subheading_alignment = get_field('bp_subheading_alignment');
    $bp_description = get_field('bp_description');
    $bp_description_color = get_field('bp_description_color') ?: '#FFFFFF';

    $bp_image = get_field('bp_image');
    $bp_image_placement = get_field('bp_image_placement');

    $bp_cta_type = get_field('bp_cta_type');
    $bp_cta_link = get_field('bp_cta_link');
    $bp_cta_text = get_field('bp_cta_text');
    $bp_cta_form = get_field('bp_cta_form');
    $bp_custom_form = get_field('bp_custom_form');
    $bp_cta_bg = get_field('bp_cta_bg');
    $bp_cta_text_color = get_field('bp_cta_text_color');
    $bp_cta_alignment = get_field('bp_cta_alignment');

    $bp_show_line = get_field('bp_show_line');
    $separator_color = get_field('separator_color') ?: '#EBB323';
    $separator_alignment = get_field('separator_alignment');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__two-col-img-text-container';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
    ?>

 <div class="block--custom-layout <?= $class_name ?>" style="background-image: url('<?= $background_image['url'] ?>');">
        <div class="container-block">
            <?php if ($tc_show_section) : ?>
                <div class="tb-wr two-col-wrapper <?= $tc_image_placement; ?>" style="background-color: <?= $tc_background_color; ?>;">
                    <div class="tb-c-wr image-cell va-middle">
                        <img src="<?= $tc_image['url']; ?>">
                    </div>
                    <div class="tb-c-wr text-cell va-middle">
                        <?php if ($tc_heading) : ?>
                            <h4 class="<?= $tc_heading_alignment; ?> <?php if ($tc_subheading) : ?>heading<?php endif; ?>" style="color: <?= $tc_heading_color; ?>"><?= $tc_heading; ?></h4>
                        <?php endif; ?>
                        <?php if ($tc_subheading) : ?>
                            <h4 style="color: <?= $tc_subheading_color; ?>" class="subtitle <?= $tc_subheading_alignment; ?>"><?= $tc_subheading; ?></h4>
                        <?php endif; ?>
                        <div class="description" style="color: <?= $tc_description_color; ?>">
                            <?= $tc_description; ?>
                        </div>
                        <?php if ($tc_add_cta) : ?>
                            <?php if ($tc_cta_type === 'link') : 
                                if($tc_cta_link) : 
                            ?>
                                <div class="cta-container">
                                    <div class="cta-wrap <?= $tc_cta_alignment; ?>">
                                        <a href="<?= $tc_cta_link['url'] ?>" target="<?= $tc_cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $tc_cta_bg; ?>; color: <?= $tc_cta_text_color; ?>">
                                            <?= $tc_cta_link['title'] ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else : if($tc_cta_text) :  ?>
                                <div class="container-block cta-container">
                                    <div class="cta-wrap <?= $cta_alignment; ?>">
                                        <a data-fancybox data-src="#tc-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $tc_cta_bg; ?>; color: <?= $tc_cta_text_color; ?>">
                                            <?= $tc_cta_text; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($bp_show_section) : ?>
                <div class="tb-wr bp-wrapper <?= $bp_image_placement; ?>">
                    <div class="tb-c-wr image-cell va-top">
                        <img src="<?= $bp_image['url']; ?>">
                    </div>
                    <div class="tb-c-wr text-cell va-top">
                        <?php if ($bp_subheading) : ?>
                            <h4 style="color: <?= $bp_subheading_color; ?>" class="subtitle <?= $bp_subheading_alignment; ?>"><?= $bp_subheading; ?></h4>
                        <?php endif; ?>
                        <?php if ($bp_heading) : ?>
                            <h2 class="<?= $bp_heading_alignment; ?> <?php if ($bp_subheading) : ?>heading<?php endif; ?>" style="color: <?= $bp_heading_color; ?>"><?= $bp_heading; ?></h2>
                        <?php endif; ?>
                        <?php if ($bp_show_line) : ?>
                            <div class="<?= $separator_alignment; ?>">
                                <hr style="background-color: <?= $separator_color; ?>">
                            </div>
                        <?php endif; ?>
                        <div class="description" style="color: <?= $bp_description_color; ?>">
                            <?= $bp_description; ?>
                        </div>
                        <?php if ($bp_cta_type === 'link') : 
                            if($bp_cta_link) : 
                        ?>
                            <div class="cta-container">
                                <div class="cta-wrap <?= $bp_cta_alignment; ?>">
                                    <a href="<?= $bp_cta_link['url'] ?>" target="<?= $bp_cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $bp_cta_bg; ?>; color: <?= $bp_cta_text_color; ?>">
                                        <?= $bp_cta_link['title'] ?>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php else : if($bp_cta_text) :  ?>
                            <div class="container-block cta-container">
                                <div class="cta-wrap <?= $cta_alignment; ?>">
                                    <a data-fancybox data-src="#bp-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $bp_cta_bg; ?>; color: <?= $bp_cta_text_color; ?>">
                                        <?= $bp_cta_text; ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
     <?php if ($tc_custom_form || $tc_cta_form) : ?>
     <div class="hidden">
         <div id="tc-form" class="popup-form-container">
             <?php if ($tc_custom_form) : ?>
                 <?= $tc_custom_form; ?>
             <?php else : ?>
                 <?php echo @do_shortcode($tc_cta_form); ?>
             <?php endif; ?>
         </div>
     </div>
     <?php endif; ?>

     <?php if ($bp_custom_form || $bp_cta_form) : ?>
     <div class="hidden">
         <div id="bp-form" class="popup-form-container">
             <?php if ($bp_custom_form) : ?>
                 <?= $bp_custom_form; ?>
             <?php else : ?>
                 <?php echo @do_shortcode($bp_cta_form); ?>
             <?php endif; ?>
         </div>
     </div>
     <?php endif; ?>
 </div>

<?php endif; ?>
<?php
/**
 * Floating Two Column Image and Text Template
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
    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__two-col-img-text-container floating';
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

 <div class="block--custom-layout <?= $class_name ?>">
        <div class="container-block">
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

 </div>

<?php endif; ?>
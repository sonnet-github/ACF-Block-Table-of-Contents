<?php
/**
 * Full Width Rich Text Editor with Background Image Template
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
    $heading_color = get_field('heading_color') ?: '#EBB323';
    $subheading_color = get_field('subheading_color') ?: '#DB6D10';
    $heading = get_field('heading');
    $heading_alignment = get_field('heading_alignment');
    $subheading = get_field('subheading');
    $subheading_alignment = get_field('subheading_alignment');
    $description = get_field('description');
    $description_color = get_field('description_color') ?: '#FFFFFF';

    $background_image = get_field('background_image') ?: '';
    $contentBG = get_field('content_bg_color') ?: 'rgba(23, 36, 56, 0.86)';
    $content_width = get_field('content_width');
    $content_alignment = get_field('content_alignment');

    $add_button = get_field('add_button');
    $cta_type = get_field('cta_type');
    $cta_link = get_field('cta_link');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $ctaBG = get_field('cta_background_color');
    $ctaColor = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment');
    $customForm = get_field('custom_form');

    $mobile_image = get_field('mobile_image');
    $mobile_content_bg = get_field('mobile_content_bg');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__full-rte-bg';
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
        <?php if ($mobile_image) : ?>
            <img src="<?= $mobile_image['url'] ?>" class="mobile-only">
        <?php else : ?>
            <img src="<?= $background_image['url'] ?>" class="mobile-only">
        <?php endif; ?>
        <div class="content-wrap <?= $content_width . ' ' . $content_alignment; ?>" style="background-color: <?= $contentBG ?>">
            <div class="content-item">
                <?php if ($mobile_content_bg) : ?>
                    <div class="mobile-bg mobile-only" style="background-color: <?= $mobile_content_bg ?>"></div>
                <?php endif; ?>
                <div class="heading">
                    <?php if ($heading) : ?>
                        <h4 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h4>
                    <?php endif; ?>
                    <?php if ($subheading) : ?>
                        <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
                    <?php endif; ?>
                </div>
                <div class="description" style="color: <?= $description_color; ?>">
                    <?= $description; ?>
                </div>
                <?php if ($add_button) : ?>
                    <?php if ($cta_type === 'link') : 
                        if($cta_link) : 
                    ?>
                        <div class="cta-container">
                            <div class="cta-wrap <?= $cta_alignment; ?>">
                                <a href="<?= $cta_link['url'] ?>" target="<?= $cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                                    <?= $cta_link['title'] ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php else : if($cta_text) :  ?>
                        <div class="container-block cta-container">
                            <div class="cta-wrap <?= $cta_alignment; ?>">
                                <a data-fancybox data-src="#tcit-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                                    <?= $cta_text; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; endif; ?>
                <?php endif; ?>
            </div>
        </div>

     <?php if ($customForm || $cta_form) : ?>
     <div class="hidden">
         <div id="tcit-form" class="popup-form-container">
             <?php if ($customForm) : ?>
                 <?= $customForm; ?>
             <?php else : ?>
                 <?php echo @do_shortcode($cta_form); ?>
             <?php endif; ?>
         </div>
     </div>
     <?php endif; ?>
 </div>

<?php endif; ?>
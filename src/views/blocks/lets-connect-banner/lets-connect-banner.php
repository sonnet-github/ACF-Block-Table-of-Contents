<?php
/**
 * Let's Connect Banner Template
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
    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#EBB323';
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#EBB323';
    $subheading_alignment = get_field('subheading_alignment');

    $description = get_field('description');
    $description_color = get_field('description_color') ?: '#FFFFFF';

    $ctaType = get_field('cta_type');
    $ctaText = get_field('cta');
    $form = get_field('form_shortcode');
    $ctaLink = get_field('cta_link');
    $ctaBG = get_field('cta_background') ?: '#FFFFFF';
    $ctaTextColor = get_field('cta_text_color') ?: '#25AAE1';
    $cta_alignment = get_field('cta_alignment');
    $customForm = get_field('custom_form');

    $backgroundImage = get_field('background_image');
    $background_color = get_field('background_color') ?: '#172438';
    if ($backgroundImage) {
        $background = 'url('.$backgroundImage['url'].')';
    }
    else {
        $background = 'none';
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__lets-connect';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    if (! ($description) ) {
        $class_name .= ' layout-spaced';
    }
    else {
        $class_name .= '';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-image:  <?= $background; ?>; background-color: <?= $background_color; ?>">
        <div class="container-block">
            <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
            <?php if ($subheading) : ?>
                <h5 class="subtitle <?= $subheading_alignment; ?>" style="color: <?= $subheading_color; ?>"><?= $subheading ?></h5>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="description" style="color: <?= $description_color; ?>">
                    <?= $description; ?>
                </div>
            <?php endif; ?>
            <?php if ($ctaType === 'link') : 
                if($ctaLink) : 
            ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a href="<?= $ctaLink['url'] ?>" target="<?= $ctaLink['target'] ?>" class="btn-default secondary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                        <?= $ctaLink['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($ctaText) : ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#open-form" href="javascript:;" class="btn-default secondary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                        <?= $ctaText; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
            </div>
        </div>
        <div class="hidden">
            <div id="open-form" class="popup-form-container">
                <?php if ($customForm) : ?>
                    <?= $customForm; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($form); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>



<?php endif; ?>
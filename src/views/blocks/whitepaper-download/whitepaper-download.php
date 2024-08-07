<?php
/**
 * Whitepaper Download Block Template
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
    $layout = get_field('layout');

    $image = get_field('featured_image');
    $image_placement = get_field('image_placement');

    $heading = get_field('heading');
    $subtitle = get_field('subtitle');
    $subtitleColor = get_field('subtitle_color') ?: '#707070';
    $headingColor = get_field('heading_color') ?: '#003E61';
    $headingAlignment = get_field('heading_alignment');
    $subtitleAlignment = get_field('subtitle_alignment');

    $ctaType = get_field('cta_type');
    $cta = get_field('cta_link');
    $cta_text = get_field('cta_text');
    $ctaBG = get_field('cta_bg_color') ?: '#EBB323';
    $ctaTextColor = get_field('cta_text_color') ?: '#FFFFFF';
    $cta_alignment = get_field('cta_alignment');
    $form = get_field('form_shortcode');
    $customForm = get_field('custom_form');

    $background = get_field('background_color') ?: '#FFFFFF';

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__whitepaper-download';
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

    <div class="block--custom-layout <?= $class_name ?> <?= 'custom-' . $layout ?>" <?= $anchor ?> style="background-color: <?= $background ?>;">
        <div class="container-block <?= $layout . ' ' . $image_placement; ?>">
            <div class="tb-wr">
                <div class="tb-c-wr image-cell va-middle">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                </div>
                <div class="tb-c-wr text-cell va-middle">
                    <div class="text-content">
                        <h4 class="subheading <?= $subtitleAlignment; ?>" style="color: <?= $subtitleColor ?>;"><?= $subtitle ?></h4>
                        <h2 class="heading <?= $headingAlignment; ?>" style="color: <?= $headingColor ?>;"><?= $heading ?></h2>
                        <?php if ($ctaType === 'link') : 
                            if($cta) : 
                        ?>
                            <div class="cta-wrap <?= $cta_alignment; ?>">
                                <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                                    <?= $cta['title'] ?>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php else : if($cta_text) : ?>
                            <div class="cta-wrap <?= $cta_alignment; ?>">
                                <a data-fancybox data-src="#wp-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                                    <?= $cta_text; ?>
                                </a>
                            </div>
                        <?php endif; endif; ?>
                    </div>
                </div>

            </div>            
        </div>
        <?php if ($cta_text || $cta) : ?>
            <div class="hidden">
                <div id="wp-form" class="popup-form-container">
                    <?= $form; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>
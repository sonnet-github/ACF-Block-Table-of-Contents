<?php
/**
 * Virtual Media Training Template
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
    $heading = get_field('heading') ?: get_the_title();
    $heading_color = get_field('heading_color') ?: '#FFFFFF';
    $heading_alignment = get_field('heading_alignment');

    $subtitle = get_field('subtitle') ?: '';
    $subtitle_color = get_field('subtitle_color') ?: '#172438';
    $subtitle_alignment = get_field('subtitle_alignment');

    $ctaType = get_field('cta_type') ?: 'link';
    $cta = get_field('cta') ?: false;
    $cta_text = get_field('cta_text');
    $ctaBG = get_field('cta_background_color') ?: '#EBB323';
    $ctaTextColor = get_field('cta_text_color') ?: '#FFFFFF';
    $cta_alignment = get_field('cta_alignment');
    $form = get_field('form_shortcode');

    $background_image = get_field('background_image') ?: '';
    $background_color = get_field('background_color');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__virtual-media-training';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }
    if (!$subtitle) {
        $class_name .= ' layout-two';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-image: url('<?= $background_image ?>'); background-color: <?= $background_color; ?>">
        <div class="container-block">
            <?php if($subtitle) : ?>
                <h4 class="<?= $subtitle_alignment; ?>" style="color: <?= $subtitle_color; ?>"><?= $subtitle ?></h4>
            <?php endif; ?>
            <h2 class="<?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h2>
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
                    <a data-fancybox data-src="#vmt-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaTextColor; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>

        <div class="hidden">
            <div id="vmt-form" class="popup-form-container">
                <?= $form; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
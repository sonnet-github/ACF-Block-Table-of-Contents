<?php
/**
 * Instagram Widget Template
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
    $background = get_field('background_color') ?: '#FFFFFF';

    $content_alignment = get_field('content_alignment') ?: 'center';

    $heading = get_field('heading');
    $heading_color = get_field('heading_color');

    $link = get_field('link');
    $instagram_shortcode = get_field('instagram_shortcode');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__ig-widget';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block <?= $content_alignment; ?>">
            <?php if ($heading) : ?>
                <h3 style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($link) : ?>
                <a href="<?= $link['url']; ?>" class="ig-link" target="<?= $link['target']; ?>"><?= $link['title']; ?></a>
            <?php endif; ?>
            <div class="ig-container">
                <?= $instagram_shortcode; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
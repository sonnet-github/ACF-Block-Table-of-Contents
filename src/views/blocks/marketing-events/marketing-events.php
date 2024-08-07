<?php
/**
 * Marketing Events Block Template
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
    $heading_color = get_field('heading_color') ?: '#003E61';
    $heading_alignment = get_field('heading_alignment');

    $subtitle = get_field('subtitle');
    $subtitle_color = get_field('subtitle_color') ?: '#707070';
    $subtitle_alignment = get_field('subtitle_alignment');

    $form = get_field('form_shortcode');
    $custom_form = get_field('custom_form');
    $show_line = get_field('show_line');
    $background_color = get_field('background_color') ?: '#FFFFFF';

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__marketing-events';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }
    if (!$show_line) {
        $class_name .= ' layout-two';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background_color; ?>">
        <div class="container-block">
            <?php if ($show_line) : ?>
                <hr>
            <?php endif; ?>
            <h4 class="<?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h4>
            <p class="<?= $subtitle_alignment; ?>" style="color: <?= $subtitle_color; ?>"><?= $subtitle; ?></p>
            <div class="form-container">
                <?php if ($custom_form) : ?>
                    <?= $custom_form; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($form); ?>
                <?php endif; ?>
            </div>
            
        </div>
    </div>

<?php endif; ?>
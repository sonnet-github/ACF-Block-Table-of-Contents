<?php
/**
 * WYSIWYG Block Template
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
    $background = get_field('background_color') ?: '#A8BFC7';
    $bgImg = get_field('background_image') ?: '';
    if ($bgImg) {
        $BG = 'background-image: url(' . $bgImg['url'] . ');';
    }
    else {
        $BG = '';
    }
    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#FFFFFF';
    $heading_alignment = get_field('heading_alignment');

    $form = get_field('form_shortcode');
    $customForm = get_field('custom_form');
    $form_width = get_field('form_width');

    $bottom_text = get_field('bottom_text');
    $bottom_text_color = get_field('bottom_text_color') ?: '#FFFFFF';
    $bottom_text_icon = get_field('bottom_text_icon');

    $show_line = get_field('show_line');
    $add_form_dropshadow = get_field('add_form_dropshadow');

    if ($add_form_dropshadow) {
        $boxShadow = 'form-shadow';
    }
    else {
        $boxShadow = '';
    }

    if ($show_line) {
        $line = 'show-line';
    }
    else {
        $line = '';
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__contact-form';
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

    <div class="block--custom-layout <?= $class_name ?> layout-<?= $form_width; ?> <?= $line; ?>" <?= $anchor ?> style="background-color:<?= $background ?>; <?= $BG; ?>">
        <div class="container-block">
            <?php if ($heading) : ?>
                <div class="heading-wrap <?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>">
                    <?= $heading; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-container container-block <?= $form_width; ?> <?= $boxShadow; ?>">
                <?php if ($customForm) : ?>
                    <?= $customForm; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($form); ?>
                <?php endif; ?>
        </div>

        <?php if ($bottom_text) : ?>
            <div class="container-block bottom-container">
                <div class="bottom-text" style="color: <?= $bottom_text_color; ?>">
                    <?php if ($bottom_text_icon) : ?>
                        <img src="<?= $bottom_text_icon['url']; ?>" alt="<?= $bottom_text_icon['alt']; ?>" class="bottom-text-img">
                    <?php endif; ?>
                    <div class="bottom-text-content">
                        <?= $bottom_text; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($show_line) : ?>
            <div class="container-block">
                <hr>
            </div>
        <?php endif; ?>
        </div>
    </div>

<?php endif; ?>
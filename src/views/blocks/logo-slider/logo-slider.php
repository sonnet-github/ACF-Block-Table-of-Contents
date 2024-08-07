<?php
/**
 * Logo Slider Block Template
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
    $heading_color = get_field('heading_color') ?: '#DB6D10';
    $heading_alignment = get_field('heading_alignment');

    $description = get_field('description');
    $description_color = get_field('description_color') ?: '#172438';
    $description_alignment = get_field('description_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';

    $slider_speed = get_field('slider_speed');

    $slider_manual = get_field('logo_content');
    $slider_type = get_field ('slider_type');

    if ($slider_type === 'global') {
        $slider = get_field('global_logo_slider','options');
    }
    else {
        $slider = $slider_manual;
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__logo-slider';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background_color; ?>">
        <div class="container-block">
            <h3 class="<?= $heading_alignment ?> <?php if ($description) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
            <?php if ($description) : ?>
                <p class="description <?= $description_alignment ?>" style="color: <?= $description_color; ?>"><?= $description; ?></p>
            <?php endif; ?>
            <div class="container-inner">
                <div class="content-wrap">
                    <?php if(is_admin() && isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
                        <h5 style="text-align: center;">Slider goes here<br/>(Live preview not available here)</h5>
                    <?php endif; ?>
                    <?php if($slider) : ?>
                        <div class="logo-slider owl-carousel" 
                            data-prev="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-left-grey.svg') ?>" 
                            data-next="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-right-grey.svg') ?>">
                            <?php foreach($slider as $ti => $tst) : ?>
                                <div class="slide-item">
                                    <img src="<?= $tst['logo']['url']; ?>" alt="<?= $tst['logo']['alt']; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="hidden">
            <input value="<?= $slider_speed; ?>" class="logo-slider-speed" />
        </div>
    </div>

<?php endif; ?>
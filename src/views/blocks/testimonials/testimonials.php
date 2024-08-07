<?php
/**
 * Testimonials Block Template
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

    $description = get_field('description');
    $description_color = get_field('description_color') ?: '#707071';

    $testimonials_manual = get_field('testimonials');
    $testimonial_type = get_field('testimonial_type');

    $slider_speed = get_field('slider_speed');

    if ($testimonial_type === 'global') {
        $testimonials = get_field('global_testimonials', 'option');
    }
    else {
        $testimonials = $testimonials_manual;
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__testimonials';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?>>
        <div class="container-block">
            <h3 class="<?php if ($description) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
            <?php if ($description) : ?>
                <p class="description" style="color: <?= $description_color; ?>"><?= $description; ?></p>
            <?php endif; ?>
            <div class="container-inner">
                <div class="content-wrap">
                    <?php if(is_admin() && isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
                        <h5 style="text-align: center;">Slider goes here<br/>(Live preview not available here)</h5>
                    <?php endif; ?>
                    <?php if($testimonials) : ?>
                        <div class="testimonial-slider owl-carousel" 
                            data-prev="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-left-blue.svg') ?>" 
                            data-next="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-right-blue.svg') ?>">
                            <?php foreach($testimonials as $ti => $tst) : ?>
                                <div class="slide-item">
                                    <div class="quote-content">
                                        <img src="<?= $tst['rating']['url']; ?>" alt="<?= $tst['rating']['alt']; ?>">
                                        <p>“<?= $tst['quote'] ?>” — <strong><?= $tst['name'] ?></strong></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="hidden">
            <input value="<?= $slider_speed; ?>" class="testimonial-speed" />
        </div>
    </div>

<?php endif; ?>
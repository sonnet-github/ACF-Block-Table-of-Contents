<?php
/**
 * Highlighted Slider Block Template
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
    $background = get_field('background_color') ?: '#779489';
    
    $title = get_field('bss_title', 'options');
    $title_color = get_field('bss_title_color', 'options');
    $subtitle = get_field('bss_subtitle', 'options');
    $subtitle_color = get_field('bss_subtitle_color', 'options');

    $text_alignment = get_field('text_alignment', 'options');

    $slider_manual = get_field('highlighted_posts');
    $slider_type = get_field ('content_type');

    if ($slider_type === 'global') {
        $slider = get_field('bss_highlighted_posts','options');
    }
    else {
        $slider = $slider_manual;
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__highlighted-slider';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background; ?>">
        <div class="container-block">
                <div class="content-wrap">
                    <div class="heading-wrap <?= $text_alignment; ?>">
                        <h2 class="<?php if ($subtitle) : ?>heading<?php endif; ?>" style="color: <?= $title_color; ?>"><?= $title; ?></h2>
                        <?php if ($subtitle) : ?>
                            <h4 class="subtitle" style="color: <?= $subtitle_color; ?>"><?= $subtitle; ?></h4>
                        <?php endif; ?>
                    </div>
                    <?php if(is_admin() && isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
                        <h5 style="text-align: center;">Slider goes here<br/>(Live preview not available here)</h5>
                    <?php endif; ?>
                    <?php if($slider) : ?>
                        <div class="highlighted-slider owl-carousel" 
                            data-prev="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-left-grey.svg') ?>" 
                            data-next="<?= \SDEV\Utils::getThemeResourcePath('assets/images/arrow-right-grey.svg') ?>">
                            <?php foreach($slider as $pi => $pv) : 
                                $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                                $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $terms = get_the_terms( $pv->ID, 'blog-category' );
                            ?>
                                <div class="list-item">
                                    <div class="thumbnail">
                                        <?php if (has_post_thumbnail($pv->ID)) : ?>
                                            <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                        <?php else : ?>
                                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                        <?php endif; ?> 
                                    </div>
                                    <div class="content">
                                        <p class="date">
                                                <span><?php echo get_the_date('j F Y', $pv->ID); ?></span> • 
                                                <?php 
                                                    $count = count($terms);
                                                    foreach( $terms as $term ) { 
                                                        if ($term->term_id != 1) { 
                                                            echo $term->name; if ($count > 1) echo ', '; $count--;
                                                        }
                                                    }
                                                ?>
                                        </p>
                                        <h4><?= $pv->post_title ?></h4>
                                        <p class="excerpt"><?= $pv->post_excerpt ?></p>
                                        <div class="cta-wrap">
                                            <a href="<?= get_permalink($pv->ID) ?>">Find out more</a>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
    </div>

<?php endif; ?>
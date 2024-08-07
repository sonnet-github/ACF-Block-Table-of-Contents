<?php
/**
 * Two Column Icons with Text Block Template
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
    $background_color = get_field('background_color') ?: '#F7FBFF';

    $cta = get_field('cta');
    $cta_type = get_field('cta_type');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $cta_background = get_field('cta_background');
    $cta_text_color = get_field('cta_text_color');

    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#003E61'; 
    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#003E61';

    $tiles = get_field('column_content');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__two-col-icon-text';
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
            <?php if ($heading) : ?>
                <h2 class="<?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h2>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle"><?= $subheading; ?></h4>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php foreach($tiles as $si => $sv) : ?>
                    <div class="tile-item">
                        <img src="<?= $sv['icon']['url']; ?>" alt="<?= $sv['icon']['alt']; ?>">
                        <h4 style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                        <p style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($cta_type === 'link') : 
                if($cta) : 
            ?>
                <div class="cta-wrap">
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($cta_text) : ?>
                <div class="cta-wrap">
                    <a data-fancybox data-src="#ti-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>
        <div class="hidden">
            <div id="ti-form" class="popup-form-container">
                <?= $cta_form ?>
            </div>
        </div>
    </div>

<?php endif; ?>
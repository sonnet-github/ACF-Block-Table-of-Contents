<?php
/**
 * Four Column Icons with Text Block Template
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

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#003E61';
    $subheading_alignment = get_field('subheading_alignment');

    $column_title_text = get_field('column_title_text');
    $column_title_color = get_field('column_title_color') ?: '#172438';
    $column_title_alignment = get_field('column_title_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';

    $tiles = get_field('column_content');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__four-col-icon-text';
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
                <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
            <?php endif; ?>
            <?php if ($column_title_text) : ?>
                <h4 class="col-title <?= $column_title_alignment; ?>" style="color: <?= $column_title_color; ?>"><?= $column_title_text; ?></h4>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php foreach($tiles as $si => $sv) : ?>
                    <div class="tile-item">
                        <?php if ($sv['link']) : ?>
                            <a href="<?= $sv['link']['url']; ?>" target="<?= $sv['link']['target']; ?>">
                        <?php endif; ?>
                        <?php if ($sv['icon']) : ?>
                            <img src="<?= $sv['icon']['url']; ?>" alt="<?= $sv['icon']['alt']; ?>">
                        <?php endif; ?>
                        <p class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></p>
                        <?php if ($sv['link']) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
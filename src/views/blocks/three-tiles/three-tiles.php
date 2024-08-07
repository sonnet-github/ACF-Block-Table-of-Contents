<?php
/**
 * Three Tiles Block Template
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
    $tiles = get_field('three_tiles_content');

    $bgType = get_field('background_type');
    $bgColor = get_field('background_color');
    $bgImage = get_field('background_image');

    if ($bgType === 'color') {
        $background = 'background-color: '.$bgColor;
    }
    else if ($bgType === 'image'){
        $background = 'background-image: url('.$bgImage['url'].')';
    }
    else {
        $background = '';
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__widget-three-tiles';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="<?= $background; ?>">
        <div class="container-block">
            <div class="tiles-grid">
                <?php foreach($tiles as $si => $sv) : ?>
                    <div class="tile-item">
                        <img src="<?= $sv['icon']['url']; ?>" alt="<?= $sv['icon']['alt']; ?>">
                        <p style="color: <?= $sv['content_color']; ?>" class="<?php if ($sv['description']) : ?> heading <?php endif; ?>"><?= $sv['content']; ?></p>
                        <?php if ($sv['description']) : ?>
                            <p style="color: <?= $sv['description_color']; ?>" class="description"><?= $sv['description']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
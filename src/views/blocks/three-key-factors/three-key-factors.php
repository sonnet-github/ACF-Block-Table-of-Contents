<?php
/**
 * Three Key Factors Template
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
    $background = get_field('background_color') ?: '#172438';

    $heading = get_field('heading');
    $heading_color = get_field('heading_color') ?: '#FFFFFF'; 
    $heading_alignment = get_field('heading_alignment') ?: 'center'; 

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#FFFFFF';
    $subheading_alignment = get_field('subheading_alignment') ?: 'center'; 

    $bottom_text = get_field('bottom_text');
    $bottom_text_color = get_field('bottom_text_color') ?: '#FFFFFF';
    $bottom_text_alignment = get_field('bottom_text_alignment') ?: 'center'; 

    $tiles = get_field('column_content');

    
    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__three-key-factors';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background ?>;"> 
        <div class="container-block">
            <?php if ($heading) : ?>
                <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h5 class="subtitle <?= $subheading_alignment; ?>" style="color: <?= $subheading_color; ?>">
                    <?= $subheading; ?>
                </h5>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php foreach($tiles as $si => $sv) : ?>
                    <div class="tile-item">
                        <div class="title <?= $sv['title_alignment']; ?>" style="background-color: <?= $sv['title_background_color'] ?>;">
                            <h4 style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                        </div>
                        <div class="desc" style="color: <?= $sv['description_color']; ?>; background-color: <?= $sv['description_background_color'] ?>">
                            <?= $sv['description']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($bottom_text) : ?>
                <div class="bottom-text <?= $bottom_text_alignment; ?>">
                    <h4 style="color: <?= $bottom_text_color; ?>"><?= $bottom_text; ?></h4>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php endif; ?>
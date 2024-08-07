<?php
/**
 * Pain Points Block Template
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

    $titleOne = get_field('column_one_title');
    $titleTwo = get_field('column_two_title');
    $column_title_alignment = get_field('column_title_alignment');

    $columnOne = get_field('column_one_points');
    $columnTwo = get_field('column_two_points');
    $titleColor = get_field('column_title_color') ?: '#003E61';

    $bgColor = get_field('background_color');
    
    $subheading_color = get_field('subheading_color') ?: '#003E61';
    $subheading_two_color = get_field('subheading_two_color') ?: '#003E61';
    $subheading = get_field('subheading');
    $subheading_two = get_field('subheading_two');
    $subheading_alignment = get_field('subheading_alignment');

    $mainBG = get_field('main_tabs_background_color') ?: '#003E61';
    $subBG = get_field('sub_tabs_background_color') ?: '#0C7BC0';

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__pain-points';
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

    <div class="block--custom-layout <?= $class_name ?>">
        <div class="container-block">
            <h2 class="<?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h2>
            <div class="columns-container">
                <div class="column-one">
                    <div class="main-tab" style="background-color: <?= $mainBG; ?>">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-right.png') ?>" alt="Arrow Right">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-down.png') ?>" class="active-tab" alt="Arrow Down">
                        <h2 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h2>
                    </div>
                    <div class="sub-tabs" style="background-color: <?= $subBG; ?>">
                        <h2 class="<?= $column_title_alignment; ?>" style="color: <?= $titleColor; ?>"><?= $titleOne; ?></h2>
                        <?php foreach($columnOne as $si => $sv) : ?>
                            <div class="column-item">
                                <div class="title">
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-right.png') ?>" alt="Arrow Right">
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-down.png') ?>" class="active-tab" alt="Arrow Down">
                                    <p class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><strong><?= $sv['title']; ?></strong></p>
                                </div>
                                <div class="description">
                                    <p class="<?= $sv['description_alignment']; ?>" style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="column-two">
                    <div class="main-tab" style="background-color: <?= $mainBG; ?>">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-right.png') ?>" alt="Arrow Right">
                        <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-down.png') ?>" class="active-tab" alt="Arrow Down">
                        <h2 style="color: <?= $subheading_two_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading_two; ?></h2>
                    </div>
                    <div class="sub-tabs" style="background-color: <?= $subBG; ?>">
                        <h2 class="<?= $column_title_alignment; ?>" style="color: <?= $titleColor; ?>"><?= $titleTwo; ?></h2>
                        <?php foreach($columnTwo as $si => $sv) : ?>
                            <div class="column-item">
                                <div class="title">
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-right.png') ?>" alt="Arrow Right">
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/white-down.png') ?>" class="active-tab" alt="Arrow Down">
                                    <p class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><strong><?= $sv['title']; ?></strong></p>
                                </div>
                                <div class="description">
                                    <p class="<?= $sv['description_alignment']; ?>" style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
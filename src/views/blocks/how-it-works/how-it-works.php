<?php
/**
 * How it Works Block Template
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
    $heading_color = get_field('heading_color') ?: '#EBB323'; 
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#EBB323';
    $subheading_alignment = get_field('subheading_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';

    $cta = get_field('cta');
    $cta_type = get_field('cta_type');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $cta_background = get_field('cta_background');
    $cta_text_color = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment');

    $tiles = get_field('steps');
    $layout = get_field('layout');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__how-it-works';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    if (!$cta && !$cta_text) {
        $class_name .= ' wo-cta';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?> <?= $layout; ?>" <?= $anchor ?> style="background-color: <?= $background_color; ?>"> 
        <div class="container-block">
            <?php if ($heading) : ?>
                <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
            <?php endif; ?>
            
            <div class="tiles-grid">
                <?php $i = 1; foreach($tiles as $si => $sv) : ?>
                    <?php if ($sv['image_placement'] == 'left') : ?>
                    <div class="tb-wr tile-item left">
                        <div class="tb-c-wr va-top image-cell">
                            <img src="<?= $sv['image']['url']; ?>" alt="<?= $sv['image']['alt']; ?>">
                        </div>
                        <div class="tb-c-wr va-middle text-cell">
                            <h4 class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                            <div class="<?= $sv['description_alignment']; ?>" style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></div>
                        </div>

                    </div>
                    <?php else : ?>
                    <div class="tb-wr tile-item right">
                        <div class="tb-c-wr va-middle text-cell">
                            <h4 class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                            <p class="<?= $sv['description_alignment']; ?>" style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></p>
                        </div>
                        <div class="tb-c-wr va-top image-cell">
                            <img src="<?= $sv['image']['url']; ?>" alt="<?= $sv['image']['alt']; ?>">
                        </div>
                    </div>    
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if ($cta_type === 'link') : 
                    if($cta) : 
            ?>
                <div class="<?= $cta_alignment; ?>">
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta['title'] ?>
                    </a>
                </div>
            <?php endif; ?>
            <?php else : if($cta_text) : ?>
                <div class="<?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#hiw-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>
        <div class="hidden">
            <div id="hiw-form" class="popup-form-container">
                <?= $cta_form ?>
            </div>
        </div>
    </div>

<?php endif; ?>
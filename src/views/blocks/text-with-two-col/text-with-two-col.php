<?php
/**
 * Text with Two Column Images Block Template
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
    $heading_alignment = get_field('heading_alignment') ?: 'left';
    $subtitle = get_field('subtitle');
    $subtitle_alignment = get_field('subtitle_alignment') ?: 'left';
    $subtitle_color = get_field('subtitle_color') ?: '#707070';

    $imgOne = get_field('column_one_image');
    $textOne = get_field('column_one_text');
    $imgTwo = get_field('column_two_image');
    $textTwo = get_field('column_two_text');

    $cta = get_field('cta_link');
    $cta_type = get_field('cta_type');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $cta_background = get_field('cta_background');
    $cta_text_color = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment') ?: 'left';

    $background_color = get_field('background_color') ?: '#FFFFFF';


    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__text-with-two-col-img';
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

    <div class="block--custom-layout <?= $class_name ?>" style="background-color: <?= $background_color; ?>">
        <div class="container-block">
            <hr>
            <div class="<?= $heading_alignment; ?>">
                <h3 style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
            </div>
            <div class="<?= $subtitle_alignment; ?>">
                <p style="color: <?= $subtitle_color; ?>"><?= $subtitle ?></p>
            </div>
            <div class="tb-wr">
                <div class="tb-c-wr col-one">
                    <img src="<?= $imgOne['url']; ?>" alt="<?= $imgOne['alt']; ?>">
                    <div class="content">
                        <?= $textOne; ?>
                    </div>
                </div>
                <div class="tb-c-wr col-two">
                    <img src="<?= $imgTwo['url']; ?>" alt="<?= $imgTwo['alt']; ?>">
                    <div class="content">
                        <?= $textTwo; ?>
                    </div>
                </div>
            </div>
            <?php if ($cta_type === 'link') : 
                if($cta) : 
            ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($cta_text) : ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#ttc-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>
        <div class="hidden">
            <div id="ttc-form" class="popup-form-container">
                <?= $cta_form ?>
            </div>
        </div>
    </div>

<?php endif; ?>
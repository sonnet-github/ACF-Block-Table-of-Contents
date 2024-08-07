<?php
/**
 * Text banner with CTas Block Template
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
    $heading_alignment = get_field('heading_alignment');
    $headingColor = get_field('heading_color') ?: '#003E61';

    $intro = get_field('introduction');
    $introColor = get_field('intro_color') ?: '#707070';

    $ctaOneType = get_field('cta_one_type');
    $ctaOne = get_field('cta_one');
    $ctaOneText = get_field('cta_one_text');
    $ctaOneForm = get_field('cta_one_form');
    $ctaOneBG = get_field('cta_one_background');
    $ctaOneTextColor = get_field('cta_one_text_color');
    $customForm_one = get_field('custom_form_one');

    $ctaTwoType = get_field('cta_two_type');
    $ctaTwo = get_field('cta_two');
    $ctaTwoText = get_field('cta_two_text');
    $ctaTwoForm = get_field('cta_two_form');
    $ctaTwoBG = get_field('cta_two_background');
    $ctaTwoTextColor = get_field('cta_two_text_color');
    $customForm_two = get_field('custom_form_two');
    

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__text-banner-cta';
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
            <h3 class="<?= $heading_alignment; ?>" style="color: <?= $headingColor; ?>"><?= $heading ?></h3>
            <div class="intro" style="color: <?= $introColor; ?>">
                <?= $intro ?>
            </div>
            <div class="buttons-wrapper">
                <?php if ($ctaOneType === 'link') : 
                    if($ctaOne) : 
                ?>
                    <a href="<?= $ctaOne['url'] ?>" target="<?= $ctaOne['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaOneBG; ?>; color: <?= $ctaOneTextColor; ?>">
                        <?= $ctaOne['title'] ?>
                    </a>
                    <?php endif; ?>
                <?php else : if($ctaOneText) : ?>
                    <a data-fancybox data-src="#one-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaOneBG; ?>; color: <?= $ctaOneTextColor; ?>">
                        <?= $ctaOneText; ?>
                    </a>
                <?php endif; endif; ?>

                <?php if ($ctaTwoType === 'link') : 
                    if($ctaTwo) : 
                ?>
                    <a href="<?= $ctaTwo['url'] ?>" target="<?= $ctaTwo['target'] ?>" class="btn-default primary cta-two" style="background-color: <?= $ctaTwoBG; ?>; color: <?= $ctaTwoTextColor; ?>">
                        <?= $ctaTwo['title'] ?>
                    </a>
                    <?php endif; ?>
                <?php else : if($ctaTwoText) : ?>
                    <a data-fancybox data-src="#two-form" href="javascript:;" class="btn-default primary cta-two" style="background-color: <?= $ctaTwoBG; ?>; color: <?= $ctaTwoTextColor; ?>">
                        <?= $ctaTwoText; ?>
                    </a>
                <?php endif; endif; ?>
            </div>
        </div>
        <div class="hidden">
            <div id="one-form" class="popup-form-container">
                <?php if ($customForm_one) : ?>
                    <?= $customForm_one; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($ctaOneForm); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="hidden">
            <div id="two-form" class="popup-form-container">
                <?php if ($customForm_two) : ?>
                    <?= $customForm_two; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($ctaTwoForm); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
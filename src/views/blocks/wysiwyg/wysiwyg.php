<?php
/**
 * WYSIWYG Block Template
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
    $background = get_field('background_color') ?: '#FFFFFF';

    $heading = get_field('heading');
    $heading_color = get_field('heading_color');
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color');

    $content = get_field('content');
    $content_color = get_field('content_color') ?: '#707070';
    $content_width = get_field('content_width');

    $cta_type = get_field('cta_type');
    $cta_link = get_field('cta_link');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('form_shortcode');
    $ctaBG = get_field('cta_background_color');
    $ctaColor = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment');
    $customForm = get_field('custom_form');

    $padding_bottom = get_field('padding_bottom');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__wysiwyg';
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

    <div class="block--custom-layout <?= $class_name ?> <?= $padding_bottom; ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block <?= $content_width; ?>">
            <?php if ($heading) : ?>
                <div class="heading-wrap <?= $heading_alignment; ?>"  style="color: <?= $heading_color; ?>">
                    <h4 style="color: <?= $heading_color; ?>"><?= $heading; ?></h4>
                </div>
            <?php endif; ?>

            <?php if ($subheading) : ?>
                <div class="subheading-wrap"  style="color: <?= $subheading_color; ?>">
                    <?= $subheading; ?>
                </div>
            <?php endif; ?>

            <div class="content-wrap" style="color: <?= $content_color; ?>">
                <?= $content ?>
            </div>

            <?php if ($cta_type === 'link') : 
                if($cta_link) : 
            ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a href="<?= $cta_link['url'] ?>" target="<?= $cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                        <?= $cta_link['title'] ?>
                    </a>
                </div>
                <?php endif; ?>
            <?php else : if($cta_text) :  ?>
                <div class="cta-wrap <?= $cta_alignment; ?>">
                    <a data-fancybox data-src="#rte-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                        <?= $cta_text; ?>
                    </a>
                </div>
            <?php endif; endif; ?>
        </div>
        <?php if ($customForm || $cta_form) : ?>
        <div class="hidden">
            <div id="rte-form" class="popup-form-container">
                <?php if ($customForm) : ?>
                    <?= $customForm; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($cta_form); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

<?php endif; ?>
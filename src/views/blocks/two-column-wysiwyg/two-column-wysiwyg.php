<?php
/**
 * Two Column WYSIWYG Block Template
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

    //Column One

    $heading_one = get_field('heading_one');
    $heading_one_color = get_field('heading_one_color');
    $heading_one_alignment = get_field('heading_one_alignment');

    $subheading_one = get_field('subheading_one');
    $subheading_one_color = get_field('subheading_one_color');

    $content_one = get_field('content_one');
    $content_one_color = get_field('content_one_color') ?: '#707070';

    $cta_type_one = get_field('cta_type_one');
    $cta_link_one = get_field('cta_link_one');
    $cta_text_one = get_field('cta_text_one');
    $cta_form_one = get_field('form_shortcode_one');
    $ctaBG_one = get_field('cta_background_color_one');
    $ctaColor_one = get_field('cta_text_one_color');
    $cta_alignment_one = get_field('cta_alignment_one');
    $customForm_one = get_field('custom_form_one');

    //Column Two

    $heading_two = get_field('heading_two');
    $heading_two_color = get_field('heading_two_color');
    $heading_two_alignment = get_field('heading_two_alignment');

    $subheading_two = get_field('subheading_two');
    $subheading_two_color = get_field('subheading_two_color');

    $content_two = get_field('content_two');
    $content_two_color = get_field('content_two_color') ?: '#707070';

    $cta_type_two = get_field('cta_type_two');
    $cta_link_two = get_field('cta_link_two');
    $cta_text_two = get_field('cta_text_two');
    $cta_form_two = get_field('form_shortcode_one');
    $ctaBG_two = get_field('cta_background_color_two');
    $ctaColor_two = get_field('cta_text_two_color');
    $cta_alignment_two = get_field('cta_alignment_two');
    $customForm_two = get_field('custom_form_two');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__wysiwyg two-column-wysiwyg';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    if (is_page('privacy-policy')) {
        $class_name .= ' privacy-policy';
    }

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block tb-wr">
            <div class="tb-c-wr col-one">
                <?php if ($heading_one) : ?>
                    <div class="heading-wrap <?= $heading_one_alignment; ?>"  style="color: <?= $heading_one_color; ?>">
                        <h2><?= $heading_one; ?></h2>
                    </div>
                <?php endif; ?>

                <?php if ($subheading_one) : ?>
                    <div class="subheading-wrap"  style="color: <?= $subheading_one_color; ?>">
                        <?= $subheading_one; ?>
                    </div>
                <?php endif; ?>

                <div class="content-wrap" style="color: <?= $content_one_color; ?>">
                    <?= $content_one ?>
                </div>

                <?php if ($cta_type_one === 'link') : 
                    if($cta_link_one) : 
                ?>
                    <div class="cta-wrap <?= $cta_alignment_one; ?>">
                        <a href="<?= $cta_link_one['url'] ?>" target="<?= $cta_link_one['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG_one; ?>; color: <?= $ctaColor_one; ?>">
                            <?= $cta_link_one['title'] ?>
                        </a>
                    </div>
                    <?php endif; ?>
                <?php else : if($cta_text_one) :  ?>
                    <div class="cta-wrap <?= $cta_alignment_one; ?>">
                        <a data-fancybox data-src="#rte-form-one" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG_one; ?>; color: <?= $ctaColor_one; ?>">
                            <?= $cta_text_one; ?>
                        </a>
                    </div>
                <?php endif; endif; ?>
            </div>
            <div class="tb-c-wr col-two">
                <?php if ($heading_two) : ?>
                    <div class="heading-wrap <?= $heading_two_alignment; ?>"  style="color: <?= $heading_two_color; ?>">
                        <h2><?= $heading_two; ?></h2>
                    </div>
                <?php endif; ?>

                <?php if ($subheading_two) : ?>
                    <div class="subheading-wrap"  style="color: <?= $subheading_two_color; ?>">
                        <?= $subheading_two; ?>
                    </div>
                <?php endif; ?>

                <div class="content-wrap" style="color: <?= $content_two_color; ?>">
                    <?= $content_two ?>
                </div>

                <?php if ($cta_type_two === 'link') : 
                    if($cta_link_two) : 
                ?>
                    <div class="cta-wrap <?= $cta_alignment_two; ?>">
                        <a href="<?= $cta_link_two['url'] ?>" target="<?= $cta_link_two['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG_two; ?>; color: <?= $ctaColor_two; ?>">
                            <?= $cta_link_two['title'] ?>
                        </a>
                    </div>
                    <?php endif; ?>
                <?php else : if($cta_text_two) :  ?>
                    <div class="cta-wrap <?= $cta_alignment_two; ?>">
                        <a data-fancybox data-src="#rte-form-two" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG_two; ?>; color: <?= $ctaColor_two; ?>">
                            <?= $cta_text_two; ?>
                        </a>
                    </div>
                <?php endif; endif; ?>
            </div>
        </div>

        <div class="hidden">
            <div id="rte-form-one" class="popup-form-container">
                <?php if ($customForm_one) : ?>
                    <?= $customForm_one; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($cta_form_one); ?>
                <?php endif; ?>
            </div>
            <div id="rte-form-two" class="popup-form-container">
            <?php if ($customForm_two) : ?>
                    <?= $customForm_two; ?>
                <?php else : ?>
                    <?php echo @do_shortcode($cta_form_two); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
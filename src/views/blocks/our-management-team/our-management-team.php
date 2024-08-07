<?php
/**
 * Our Management Team Template
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
    $heading_color = get_field('heading_color') ?: '#DB6D10';
    $heading_alignment = get_field('heading_alignment');

    $subheading = get_field('subheading');
    $subheading_color = get_field('subheading_color') ?: '#DB6D10';
    $subheading_alignment = get_field('subheading_alignment');

    $columns_content = get_field('team_content');

    $add_cta = get_field('add_cta');
    $cta_type = get_field('cta_type');
    $cta_link = get_field('cta_link');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_text');
    $ctaBG = get_field('cta_bg_color');
    $ctaColor = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment');
    $customForm = get_field('cta_custom_form');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__our-management-team';
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
            <?php if ($heading) : ?>
                <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
            <?php endif; ?>

            <div class="content-wrap">
                <?php foreach($columns_content as $si => $sv) : ?>
                    <div class="content-item <?= $sv['image_placement']; ?>">
                            <div class="tb-wr">
                                <div class="tb-c-wr image-cell va-top">
                                    <img src="<?= $sv['image']['url']; ?>" alt="<?= $sv['image']['alt']; ?>">
                                </div>
                                <div class="tb-c-wr text-cell va-top">
                                    <h4 class="name <?= $sv['name_alignment']; ?>" style="color: <?= $sv['name_color']; ?>"><?= $sv['name']; ?></h4>
                                    <h4 class="position <?= $sv['position_alignment']; ?>" style="color: <?= $sv['position_color']; ?>"><?= $sv['position']; ?></h4>
                                    <?php if ($sv['show_line']) : ?>
                                        <div class="<?= $sv['line_alignment']; ?>">
                                            <hr style="background-color: <?= $sv['line_color']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="description" style="color: <?= $sv['description_color']; ?>">
                                        <?= $sv['description']; ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($add_cta) : ?>
                <?php if ($cta_type === 'link') : 
                    if($cta_link) : 
                ?>
                <div class="cta-container">
                    <div class="cta-wrap <?= $cta_alignment; ?>">
                        <a href="<?= $cta_link['url'] ?>" target="<?= $cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                            <?= $cta_link['title'] ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php else : if($cta_text) :  ?>
                    <div class="cta-container">
                        <div class="cta-wrap <?= $cta_alignment; ?>">
                            <a data-fancybox data-src="#omt-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                                <?= $cta_text; ?>
                            </a>
                        </div>
                    </div>
                <?php endif; endif; ?>
            <?php endif; ?>

            <?php if ($customForm || $cta_form) : ?>
            <div class="hidden">
                <div id="omt-form" class="popup-form-container">
                    <?php if ($customForm) : ?>
                        <?= $customForm; ?>
                    <?php else : ?>
                        <?php echo @do_shortcode($cta_form); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>
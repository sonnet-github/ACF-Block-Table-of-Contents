<?php
/**
 * Two-column Image and Text Block Template
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
    $columns_content = get_field('two_column_content');

    $cta_type = get_field('main_cta_type');
    $cta_link = get_field('main_cta_link');
    $cta_text = get_field('main_cta_text');
    $cta_form = get_field('main_cta_text');
    $ctaBG = get_field('main_cta_bg_color');
    $ctaColor = get_field('main_cta_text_color');
    $cta_alignment = get_field('main_cta_alignment');
    $customForm = get_field('main_cta_custom_form');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__two-col-image-text';
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
            <div class="content-wrap">
                <?php foreach($columns_content as $si => $sv) : ?>
                    <div class="content-item <?= $sv['layout']; ?> <?= $sv['content_width']; ?>" style="background-color: <?= $sv['background_color']; ?>">
                        <?php if ($sv['image_placement'] == 'left') : ?>
                            <div class="tb-wr container-block left-col <?= $sv['text_width'] ?>">
                                <div class="tb-c-wr va-middle image-cell">
                                    <img src="<?= $sv['featured_image']['url']; ?>" alt="<?= $sv['featured_image']['alt']; ?>">
                                </div>
                                <div class="tb-c-wr va-middle text-cell <?= $sv['text_spacing']; ?>">
                                    <?php if ($sv['heading']) : ?>
                                        <div class="<?= $sv['heading_alignment']; ?>">
                                            <h4 class="<?= $sv['heading_spacing']; ?>" style="color: <?= $sv['heading_color']; ?>">
                                                <?= $sv['heading']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>
                                    <div style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></div>

                                    <?php if ($sv['cta_type'] === 'link') :  ?>
                                        <?php if($sv['cta']) : ?>
                                        <div class="<?= $sv['cta_alignment']; ?>">
                                            <a href="<?= $sv['cta']['url']; ?>" target="<?= $sv['cta']['target']; ?>" class="btn-default primary" style="background-color: <?= $sv['cta_background']; ?>; color: <?= $sv['cta_text_color']; ?>">
                                                <?= $sv['cta']['title']; ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php else : if($sv['cta_text']) : ?>
                                            <div class="<?= $sv['cta_alignment']; ?>">
                                                <a data-fancybox data-src="#tc-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $sv['cta_background']; ?>; color: <?= $sv['cta_text_color']; ?>">
                                                    <?= $sv['cta_text']; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="tb-wr container-block right-col <?= $sv['text_width'] ?>">
                                <div class="tb-c-wr va-middle text-cell <?= $sv['text_spacing']; ?>">
                                    <?php if ($sv['heading']) : ?>
                                        <div class="<?= $sv['heading_alignment']; ?>">
                                            <h4 class="<?= $sv['heading_spacing']; ?>" style="color: <?= $sv['heading_color']; ?>">
                                                <?= $sv['heading']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>
                                    <div style="color: <?= $sv['description_color']; ?>"><?= $sv['description']; ?></div>
                                    <?php if ($sv['cta_type'] === 'link') :  ?>
                                        <?php if($sv['cta']) : ?>
                                        <div class="<?= $sv['cta_alignment']; ?>">
                                            <a href="<?= $sv['cta']['url']; ?>" target="<?= $sv['cta']['target']; ?>" class="btn-default primary" style="background-color: <?= $sv['cta_background']; ?>; color: <?= $sv['cta_text_color']; ?>">
                                                <?= $sv['cta']['title']; ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php else : if($sv['cta_text']) : ?>
                                            <div class="<?= $sv['cta_alignment']; ?>">
                                                <a data-fancybox data-src="#tc-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $sv['cta_background']; ?>; color: <?= $sv['cta_text_color']; ?>">
                                                    <?= $sv['cta_text']; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?>
                                </div>
                                <div class="tb-c-wr va-middle image-cell">
                                    <img src="<?= $sv['featured_image']['url']; ?>" alt="<?= $sv['featured_image']['alt']; ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($sv['cta_type'] === 'popup') : ?>
                        <div class="hidden">
                            <div id="tc-form" class="popup-form-container">
                                <?php if ($sv['custom_form']) : ?>
                                    <?= $sv['custom_form']; ?>
                                <?php else : ?>
                                    <?php echo @do_shortcode($sv['form_shortcode']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php if ($cta_type === 'link') : 
                    if($cta_link) : 
                ?>
                    <div class="container-block cta-container">
                        <div class="cta-wrap <?= $cta_alignment; ?>">
                            <a href="<?= $cta_link['url'] ?>" target="<?= $cta_link['target'] ?>" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                                <?= $cta_link['title'] ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php else : if($cta_text) :  ?>
                    <div class="container-block cta-container">
                        <div class="cta-wrap <?= $cta_alignment; ?>">
                            <a data-fancybox data-src="#tcit-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $ctaBG; ?>; color: <?= $ctaColor; ?>">
                                <?= $cta_text; ?>
                            </a>
                        </div>
                    </div>
                <?php endif; endif; ?>
            </div>
        <?php if ($customForm || $cta_form) : ?>
        <div class="hidden">
            <div id="tcit-form" class="popup-form-container">
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
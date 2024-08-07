<?php
/**
 * Let's Talk Form Template
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

    $content = get_field('content');
    $content_color = get_field('content_color') ?: '#707070';

    $icon = get_field('linkedin_icon');
    $link = get_field('linkedin_link');

    $phoneIcon = get_field('phone_icon');
    $phoneLink = get_field('phone_link');

    $form = get_field('form_shortcode');
    $custom_form = get_field('custom_form');
    $form_placement = get_field('form_placement');

    $background_color = get_field('background_color') ?: '#FFFFFF';
    $background_image = get_field('background_image');
    
    if ($background_image) {
        $background = 'url('.$background_image['url'].')';
    }
    else {
        $background = 'none';
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__lets-talk-form';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-image: <?= $background; ?>; background-color: <?= $background_color; ?>">
        <div class="container-block">
            <?php if ($form_placement === 'right') : ?>
                <div class="tb-wr right-col">
                    <div class="tb-c-wr content-cell">
                        <h3 class="<?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
                        <div class="content-wrap" style="color: <?= $content_color; ?>">
                            <?= $content; ?>
                        </div>
                        <?php if ($phoneLink): ?>
                            <a href="<?= $phoneLink['url']; ?>" target="<?= $phoneLink['target']; ?>" class="phone-link">
                                <img src="<?= $phoneIcon['url']; ?>" alt="<?= $phoneIcon['alt']; ?>">
                                    <?= $phoneLink['title']; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($link) : ?>
                        <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>">
                            <img src="<?= $icon['url']; ?>" alt="<?= $icon['alt']; ?>">
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="tb-c-wr form-cell">
                        <div class="form-container">
                            <?php if ($custom_form) : ?>
                                <?= $custom_form; ?>
                            <?php else : ?>
                                <?php echo @do_shortcode($form); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="tb-wr left-col">
                    <div class="tb-c-wr form-cell">
                        <div class="form-container">
                            <?php if ($custom_form) : ?>
                                <?= $custom_form; ?>
                            <?php else : ?>
                                <?php echo @do_shortcode($form); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tb-c-wr content-cell">
                        <h3 class="<?= $heading_alignment; ?>" style="color: <?= $heading_color; ?>"><?= $heading ?></h3>
                        <div class="content-wrap" style="color: <?= $content_color; ?>">
                            <?= $content; ?>
                        </div>
                        <?php if ($phoneLink): ?>
                            <a href="<?= $phoneLink['url']; ?>" target="<?= $phoneLink['target']; ?>" class="phone-link">
                                <img src="<?= $phoneIcon['url']; ?>" alt="<?= $phoneIcon['alt']; ?>">
                                    <?= $phoneLink['title']; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($link) : ?>
                        <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>">
                            <img src="<?= $icon['url']; ?>" alt="<?= $icon['alt']; ?>">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>



<?php endif; ?>
<?php
/**
 * Sectors we Serve Template
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
    $subheading_color = get_field('subheading_color') ?: '#172438';
    $subheading_alignment = get_field('subheading_alignment');

    $background_color = get_field('background_color') ?: '#FFFFFF';
    $background_image = get_field('background_image') ?: '';

    $add_cta = get_field('add_cta');
    $cta = get_field('cta_link');
    $cta_type = get_field('cta_type');
    $cta_text = get_field('cta_text');
    $cta_form = get_field('cta_form');
    $cta_background = get_field('cta_background');
    $cta_text_color = get_field('cta_text_color');
    $cta_alignment = get_field('cta_alignment') ?: 'center';

    $tilesType = get_field('tiles_content');

    $tiles = get_field('tiles_custom_content');

    $queryHelper = new \SDEV\Helper\Query();

    $posts = $queryHelper->setQueryArgs([
        'post_type' => 'sectors',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
    ])
    ->setOrder('date', 'desc')
    ->setPageSize(5)
    ->setPage(1)
    ->getList();

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__sectors-we-serve';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color: <?= $background_color; ?>; background-image: url('<?= $background_image; ?>;'); "> 
        <div class="container-block">
            <?php if ($heading) : ?>
                <h3 class="<?= $heading_alignment; ?> <?php if ($subheading) : ?>heading<?php endif; ?>" style="color: <?= $heading_color; ?>"><?= $heading; ?></h3>
            <?php endif; ?>
            <?php if ($subheading) : ?>
                <h4 style="color: <?= $subheading_color; ?>" class="subtitle <?= $subheading_alignment; ?>"><?= $subheading; ?></h4>
            <?php endif; ?>
            <div class="tiles-grid">
                <?php if ($tilesType === 'sectors') : ?>
                    <?php foreach($posts as $pi => $pv) : 
                            $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($pv->ID), "full", true);
                            $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                    ?>
                        <div class="tile-item">
                            <a href="<?= get_permalink($pv->ID) ?>">
                                <?php if (has_post_thumbnail($pv->ID)) : ?>
                                    <img src="<?php echo $feat_image[0]; ?>" alt="<?=$image_alt?>">
                                <?php else : ?>
                                    <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.png') ?>" alt="placeholder">
                                <?php endif; ?> 
                                <div class="color-block"></div>
                                <h4><?= $pv->post_title ?></h4>
                                <?php if ($pv->post_excerpt) : ?>
                                    <p><?= $pv->post_excerpt ?></p>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php elseif ($tilesType === 'custom') : ?>
                    <?php foreach($tiles as $si => $sv) : ?>
                        <div class="tile-item" style="background-color: <?= $sv['background_color']; ?>">
                            <?php if ($sv['link']) : ?>
                                <a href="<?= $sv['link']['url']; ?>" target="<?= $sv['link']['target']; ?>">
                            <?php endif; ?>
                            <?php if ($sv['image']) : ?>
                                <img src="<?= $sv['image']['url']; ?>" alt="<?= $sv['image']['alt']; ?>">
                            <?php endif; ?>
                            <div class="color-block" style="background-color: <?= $sv['tile_color']; ?>"></div>
                            <h4 class="<?= $sv['title_alignment']; ?>" style="color: <?= $sv['title_color']; ?>"><?= $sv['title']; ?></h4>
                            <?php if ($sv['subtitle']) : ?>
                                <p class="<?= $sv['subtitle_alignment']; ?>" tyle="color: <?= $sv['subtitle_color']; ?>"><?= $sv['subtitle']; ?></p>
                            <?php endif; ?>

                            <?php if ($sv['link']) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
            </div>
            <?php if ($add_cta) : ?>
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
                        <a data-fancybox data-src="#sws-form" href="javascript:;" class="btn-default primary" style="background-color: <?= $cta_background; ?>; color: <?= $cta_text_color; ?>">
                            <?= $cta_text; ?>
                        </a>
                    </div>
                <?php endif; endif; ?>
            <?php endif; ?>
        </div>
        <div class="hidden">
            <div id="sws-form" class="popup-form-container">
                <?= $cta_form ?>
            </div>
        </div>
    </div>

<?php endif; ?>
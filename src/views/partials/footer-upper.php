<?php
/**
 * Footer Upper Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

?>
<div class="pf-upper">
    <div class="container-block">
        <div class="tb-wr">
            <div class="tb-c-wr left-cell va-top main-logo-cell">
                <?php $mainLogo = get_field('footer_logo', 'option'); ?>
                <a href="<?php echo site_url(); ?>"><img src="<?php echo $mainLogo['url']; ?>" alt="<?php echo $mainLogo['alt']; ?>" class="footer-logo"></a>
                <div class="icons-text-section desktop-only">
                    <?php if (have_rows('footer_icon_text', 'option')) : while (have_rows('footer_icon_text', 'option')) : the_row(); 
                        $iconTextLink = get_sub_field('fit_link', 'option'); 
                        $icon = get_sub_field('fit_icon', 'option'); 
                    ?>
                        <div class="icons-text-container">
                            <?php if ($iconTextLink) : ?>
                                <a href="<?php echo $iconTextLink; ?>">
                                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                    <p><?php the_sub_field('fit_text','option'); ?></p>
                                </a>
                            <?php else : ?>
                                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                <p><?php the_sub_field('fit_text','option'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; endif; ?>
                </div>

            </div>
            <div class="tb-c-wr va-top info-cell">
                <div class="row-one">
                    <div class="footer-links">
                        <?php if (have_rows('footer_links', 'option')) : while(have_rows('footer_links', 'option')) : the_row(); 
                            $footerLink = get_sub_field('footer_menu_link', 'option');  
                        ?>
                            <a href="<?php echo $footerLink['url']; ?>" target="<?php echo $footerLink['target']; ?>">
                                <?php echo $footerLink['title']; ?>
                            </a>
                        <?php endwhile; endif; ?>
                    </div>
                    <div class="socmed-icons">
                        <?php if (have_rows('social_media_icons', 'option')) : while(have_rows('social_media_icons', 'option')) : the_row();
                            $socmedIcon = get_sub_field('smi_icon', 'option'); 
                            $socmedLink = get_sub_field('smi_link', 'option');
                        ?>
                            <a href="<?php echo $socmedLink['url']; ?>" target="<?php echo $socmedLink['target']; ?>">
                                <img src="<?php echo $socmedIcon['url']; ?>" alt="<?php echo $socmedIcon['alt']; ?>">
                            </a>
                        <?php endwhile; endif; ?>
                    </div>
                    <div class="cta-button">
                        <?php $ctaLink = get_field('contact_button', 'option'); ?>
                        <a href="<?php echo $ctaLink['url']; ?>" target="<?php echo $ctaLink['target']; ?>" class="btn-default primary small">
                            <?php echo $ctaLink['title']; ?>
                        </a>
                    </div>
                </div>
                <div class="row-two desktop-only">
                    <p><?php the_field('copyright_text','option'); ?></p>
                    <p><?php the_field('abn_text','option'); ?></p>
                </div>
            </div>
        </div>
        <div class="mobile-content mobile-only">
                <div class="col-one">
                    <div class="icons-text-section">
                        <?php if (have_rows('footer_icon_text', 'option')) : while (have_rows('footer_icon_text', 'option')) : the_row(); 
                            $iconTextLink = get_sub_field('fit_link', 'option'); 
                            $icon = get_sub_field('fit_icon', 'option'); 
                        ?>
                            <div class="icons-text-container">
                                <?php if ($iconTextLink) : ?>
                                    <a href="<?php echo $iconTextLink; ?>">
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                        <p><?php the_sub_field('fit_text','option'); ?></p>
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                    <p><?php the_sub_field('fit_text','option'); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
                <div class="col-two">
                    <p><?php the_field('copyright_text','option'); ?></p>
                    <p><?php the_field('abn_text','option'); ?></p>
                </div>
            </div>
        <hr> 
    </div>
</div>
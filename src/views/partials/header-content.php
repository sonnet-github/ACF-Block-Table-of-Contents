<?php
/**
 * Page Header Template Block (Header Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */

    $header_logo = get_field('site_logo','option');
?>
<header id="page-header">
    <div class="upper-header-wrapper container-block">
        <div class="uh-content content-block">
            <div class="tb-wr uhc-table">
                <div class="tb-c-wr logo-cell va-middle">
                    <a href="<?= get_site_url(null, ''); ?>">
                        <img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt'] ?>" />
                    </a>
                </div>
                <div class="tb-c-wr nav-cell va-middle">
                    <nav id="main-navigation" class="desktop-only">
                        <?php get_template_part('src/views/partials/header', 'navigation-right');  ?>
                    </nav>
                    <div id="hamburger-menu" class="mobile-menu-trigger mobile-only">
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                        <div class="hm-bar"></div>
                    </div>
                    <div id="mobile-menu">
                        <div class="mm-main-wrap">
                            <div class="mobile-nav-wrapper">
                                <nav>
                                    <?php get_template_part('src/views/partials/header', 'navigation-right');  ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
